<?php

/**
* Explore page controller 
* @group Explore
*/

class ExploreController extends BaseController {

  /**
  * Meta title & description for page
  * @return Array
  */
  private function getMeta() {
    $metadata = array(
      'title' => 'Explore',    
      'desc'  => 'Request URL: ' . Config::get('app.api_url'),     
      'meta'  => array(             
        'title'   => 'Explore | Seeties',    
        'description' => 'Sample meta description'  
      ),
      'sidebar' => View::make('explore.sidebar')
    );

    return $metadata;
  }

  /**
  * GET /explore/cities view
  * @return View
  */
  public function getCities() {
    $data = $this->getMeta();
    $data['desc'] .= 'explore';

    if ( $this->chkCurlProcess('curl') ) {
      $c_url = ExploreModel::generateApiUrl( 'explore', ExploreModel::autoFill(Input::old(), ExploreModel::$qs_list_fill) );
      $c_result = ExploreModel::getResult( $c_url, 'get' );

      $data['request_url'] = $c_url;
      $data['result'] = $c_result;
    }

    return View::make('explore.cities', $data);
  }

  /**
  * POST /explore/cities view
  * @return Redirect
  */
  public function postCities() {
    $validator = Validator::make( Input::get(), ExploreModel::$qs_list_rules );

    if ( $validator->fails() ) {
      return Redirect::route('cities')->withErrors($validator)->withInput();
    }
    else {
      return Redirect::route('cities', array('curl'=>1))->withInput();
    }
  }

  /**
  * GET /explore/city view
  * @return View
  */
  public function getCity() {
    $data = $this->getMeta();
    $data['desc'] .= 'explore/&lt;city_id&gt;';
    $data['cities'] = CommonHelper::getCities();

    if ( $this->chkCurlProcess('curl') ) {
      $c_url = ExploreModel::generateApiUrl( 'explore/{city_id}', ExploreModel::autoFill(Input::old(), ExploreModel::$qs_fill) );
      $c_result = ExploreModel::getResult( $c_url, 'get' );

      $data['request_url'] = $c_url;
      $data['result'] = $c_result;
    }

    return View::make('explore.city', $data);
  }

  /**
  * POST /explore/city view
  * @return Redirect
  */
  public function postCity() {
    $validator = Validator::make( Input::get(), ExploreModel::$qs_rules );

    if ( $validator->fails() ) {
      return Redirect::route('city')->withErrors($validator)->withInput();
    }
    else {
      return Redirect::route('city', array('curl'=>1))->withInput();
    }
  }

  /**
  * GET /explore/cityposts view
  * @return View
  */
  public function getCityPosts() {
    $data = $this->getMeta();
    $data['desc'] .= 'explore/&lt;city_id&gt;/posts';
    $data['cities'] = CommonHelper::getCities();
    $data['categories'] = CommonHelper::getCategories();

    if ( $this->chkCurlProcess('curl') ) {
      $c_url = ExploreModel::generateApiUrl( 'explore/{city_id}/posts', ExploreModel::autoFill(Input::old(), ExploreModel::$qs_posts_fill) );
      $c_result = ExploreModel::getResult( $c_url, 'get' );

      $data['request_url'] = $c_url;
      $data['result'] = $c_result;
    }

    return View::make('explore.cityposts', $data);
  }

  /**
  * POST /explore/cityposts view
  * @return Redirect
  */
  public function postCityPosts() {
    $validator = Validator::make( Input::get(), ExploreModel::$qs_posts_rules );

    if ( $validator->fails() ) {
      return Redirect::route('city_posts')->withErrors($validator)->withInput();
    }
    else {
      return Redirect::route('city_posts', array('curl'=>1))->withInput();
    }
  }

}