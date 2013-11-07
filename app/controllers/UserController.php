<?php

/**
* User page controller 
* @group User
*/

class UserController extends BaseController {

  /**
  * Meta title & description for page
  * @return Array
  */
  private function getMeta() {
    $metadata = array(
      'title' => 'User',    
      'desc'  => 'Request URL: ' . Config::get('app.api_url'),     
      'meta'  => array(             
        'title'   => 'User | Seeties',    
        'description' => 'Sample meta description'  
      ),
      'sidebar' => View::make('user.sidebar')
    );

    return $metadata;
  }

  /**
  * GET /user/register view
  * @return View
  */
  public function getUserRegister() {
    $data = $this->getMeta();
    $data['desc'] .= 'register';

    if ( $this->chkCurlProcess('curl') ) {
      $c_url = UserModel::generateApiUrl( 'register' );
      $c_result = UserModel::getResult( $c_url, 'post', UserModel::autoFill(Input::old(), UserModel::$form_reg_fill) );

      $data['request_url'] = $c_url;
      $data['result'] = $c_result;
    }

    return View::make('user.register', $data);
  }

  /**
  * POST /user/register view
  * @return Redirect
  */
  public function postUserRegister() {
    $validator = Validator::make( Input::get(), UserModel::$form_reg_rules );

    if ( $validator->fails() ) {
      return Redirect::route('user_register')->withErrors($validator)->withInput();
    }
    else {
      return Redirect::route('user_register', array('curl'=>1))->withInput();
    }
  }

  /**
  * GET /user/login view
  * @return View
  */
  public function getUserLogin() {
    $data = $this->getMeta();
    $data['desc'] .= 'login';

    if ( $this->chkCurlProcess('curl') ) {
      $c_url = UserModel::generateApiUrl( 'login' );
      $c_result = UserModel::getResult( $c_url, 'post', UserModel::autoFill(Input::old(), UserModel::$form_log_fill) );
        
      //set user session
      if ( $c_result['status'] ) {  
        Session::put('uid', $c_result['output']['uid']);
        Session::put('user_token', $c_result['output']['token']);
      }

      $data['request_url'] = $c_url;
      $data['result'] = $c_result;
    }

    return View::make('user.login', $data);
  }

  /**
  * POST /user/login view
  * @return Redirect
  */
  public function postUserLogin() {
    $validator = Validator::make( Input::get(), UserModel::$form_log_rules );

    if ( $validator->fails() ) {
      return Redirect::route('user_login')->withErrors($validator)->withInput();
    }
    else {
      return Redirect::route('user_login', array('curl'=>1))->withInput();
    }
  }

  /**
  * GET /user/logout view
  * @return View
  */
  public function getUserLogout() {
    $data = $this->getMeta();
    $data['desc'] .= 'logout';

    if ( $this->chkCurlProcess('curl') ) {
      $c_url = UserModel::generateApiUrl( 'logout', UserModel::autoFill(Input::old(), UserModel::$qs_logout_fill) );
      $c_result = UserModel::getResult( $c_url, 'get' );
      
      //forget user session
      if ( $c_result['status'] ) { 
        Session::forget('uid');
        Session::forget('user_token');
      }

      $data['request_url'] = $c_url;
      $data['result'] = $c_result;
    }

    return View::make('user.logout', $data);
  }

  /**
  * POST /user/logout view
  * @return Redirect
  */
  public function postUserLogout() {
    $validator = Validator::make( Input::get(), UserModel::$qs_logout_rules );

    if ( $validator->fails() ) {
      return Redirect::route('user_logout')->withErrors($validator)->withInput();
    }
    else {
      return Redirect::route('user_logout', array('curl'=>1))->withInput();
    }
  }

  /**
  * GET /user/change-password view
  * @return View
  */
  public function getUserPassword() {
    $data = $this->getMeta();
    $data['desc'] .= 'change-password';

    if ( $this->chkCurlProcess('curl') ) {
      $c_url = UserModel::generateApiUrl( '{uid}/change-password', UserModel::autoFill(Input::old(), UserModel::$qs_fill) );
      $c_result = UserModel::getResult( $c_url, 'post', UserModel::autoFill(Input::old(), UserModel::$form_pas_fill) );

      //update token session
      if ( $c_result['status'] ) {
        Session::put('user_token', $c_result['output']['token']);
      }

      $data['request_url'] = $c_url;
      $data['result'] = $c_result;
    }

    return View::make('user.password', $data);
  }

  /**
  * POST /user/change-password view
  * @return Redirect
  */
  public function postUserPassword() {
    $validator = Validator::make( Input::get(), UserModel::$form_pas_rules );

    if ( $validator->fails() ) {
      return Redirect::route('user_password')->withErrors($validator)->withInput();
    }
    else {
      return Redirect::route('user_password', array('curl'=>1))->withInput();
    }
  }

  /**
  * GET /user/info view
  * @return View
  */
  public function getUserInfo() {
    $data = $this->getMeta();
    $data['desc'] .= '&lt;uid&gt;';

    if ( $this->chkCurlProcess('curl') ) {
      $c_url = UserModel::generateApiUrl( '{uid}', UserModel::autoFill(Input::old(), UserModel::$qs_fill) );
      $c_result = UserModel::getResult( $c_url, 'get' );

      $data['request_url'] = $c_url;
      $data['result'] = $c_result;
    }

    return View::make('user.info', $data);
  }

  /**
  * POST /user/info view
  * @return Redirect
  */
  public function postUserInfo() {
    $validator = Validator::make( Input::get(), UserModel::$qs_rules );

    if ( $validator->fails() ) {
      return Redirect::route('user_info')->withErrors($validator)->withInput();
    }
    else {
      return Redirect::route('user_info', array('curl'=>1))->withInput();
    }
  }

  /**
  * GET /user/update/<uid?> view
  * @return View
  */
  public function getUserUpdate($uid=null) {
    $data = $this->getMeta();
    $data['desc'] .= '&lt;uid&gt;';
    $data['categories'] = CommonHelper::getCategories();
    $data['scripts'] = array(
      'http://maps.googleapis.com/maps/api/js?sensor=false&amp;libraries=places',
      URL::asset('js/jquery.geocomplete.min.js'),
      URL::asset('js/geolocation.js')
    );

    //default load user data
    if ( Session::has('uid') && Session::has('user_token') ) {
      $c_url = UserModel::generateApiUrl( '{uid}', array( 'uid'=>Session::get('uid'), 'token'=>Session::get('user_token') ) );
      $user = UserModel::getResult( $c_url, 'get' );

      if ( $user['status'] )
        $data['user'] = $user['output'];
    }

    return View::make('user.update', $data);
  }

  /**
  * POST /user/update/<uid?> view
  * @return Redirect
  */
  public function postUserUpdate($uid=null) {
    //cater for file upload
    $files = array();
    foreach ( Input::file() AS $name => $file ) {
      $files[$name] = new CurlFile($file->getRealPath(), $file->getMimeType(), $file->getClientOriginalName());
    }
    $data = array_merge(Input::get(), $files);

    $validator = Validator::make( $data, UserModel::$form_upd_rules );

    if ( $validator->fails() ) {
      return Redirect::route('user_update')->withErrors($validator)->withInput();
    }
    else {
      $c_url = UserModel::generateApiUrl( '{uid}', UserModel::autoFill($data, UserModel::$qs_fill) );
      $c_result = UserModel::getResult( $c_url, 'post', UserModel::autoFill($data, UserModel::$form_upd_fill) );

      return Redirect::route('user_update')->withInput();
    }
  }

  /**
  * GET /user/provisioning view
  * @return View
  */
  public function getUserProvisioning() {
    $data = $this->getMeta();
    $data['desc'] .= '&lt;uid&gt;/provisioning';
    $data['categories'] = CommonHelper::getCategories();

    if ( $this->chkCurlProcess('curl') ) {
      $c_url = UserModel::generateApiUrl( '{uid}/provisioning', UserModel::autoFill(Input::old(), UserModel::$qs_fill) );
      $c_result = UserModel::getResult( $c_url, 'post', UserModel::autoFill(Input::old(), UserModel::$form_pro_fill) );

      $data['request_url'] = $c_url;
      $data['result'] = $c_result;
    }

    return View::make('user.provisioning', $data);
  }

  /**
  * POST /user/provisioning view
  * @return Redirect
  */
  public function postUserProvisioning() {
    $validator = Validator::make( Input::get(), UserModel::$form_pro_rules );

    if ( $validator->fails() ) {
      return Redirect::route('user_provisioning')->withErrors($validator)->withInput();
    }
    else {
      return Redirect::route('user_provisioning', array('curl'=>1))->withInput();
    }
  }

  /**
  * GET /user/profilepic view
  * @return View
  */
  public function getUserProfilePic() {
    $data = $this->getMeta();
    $data['desc'] .= '&lt;uid&gt;/profile-photo';

    if ( $this->chkCurlProcess('curl') ) {
      $c_url = UserModel::generateApiUrl( '{uid}/profile-photo', UserModel::autoFill(Input::old(), UserModel::$qs_fill) );

      $data['request_url'] = $c_url;
      $data['result'] = $c_url;
    }

    return View::make('user.profilepic', $data);
  }

  /**
  * POST /user/profilepic view
  * @return Redirect
  */
  public function postUserProfilePic() {
    $validator = Validator::make( Input::get(), UserModel::$qs_rules );

    if ( $validator->fails() ) {
      return Redirect::route('user_profilepic')->withErrors($validator)->withInput();
    }
    else {
      return Redirect::route('user_profilepic', array('curl'=>1))->withInput();
    }
  }

}