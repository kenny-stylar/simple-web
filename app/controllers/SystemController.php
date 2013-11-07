<?php

/**
* System page controller 
* @group System
*/

class SystemController extends BaseController {

  /**
  * Meta title & description for page
  * @return Array
  */
  private function getMeta() {
    $metadata = array(
      'title' => 'System',    
      'desc'  => 'Request URL: ' . Config::get('app.api_url'),     
      'meta'  => array(             
        'title'   => 'System | Seeties',    
        'description' => 'Sample meta description'  
      ),
      'sidebar' => View::make('system.sidebar')
    );

    return $metadata;
  }

  /**
  * GET /system/feedback view
  * @return View
  */
  public function getFeedback() {
    $data = $this->getMeta();
    $data['desc'] .= 'system/feedback';

    if ( $this->chkCurlProcess('curl') ) {
      $c_url = SystemModel::generateApiUrl( 'system/feedback' );
      $c_result = SystemModel::getResult( $c_url, 'post', SystemModel::autoFill(Input::old(), SystemModel::$qs_feedback_fill) );
      
      $data['request_url'] = $c_url;
      $data['result'] = $c_result;
    }

    return View::make('system.feedback', $data);
  }

  /**
  * POST /system/feedback view
  * @return Redirect
  */
  public function postFeedback() {
    $validator = Validator::make( Input::get(), SystemModel::$qs_feedback_rules );
    
    if ( $validator->fails() ) {
      return Redirect::route('system_feedback')->withErrors($validator)->withInput();
    }
    else {
      return Redirect::route('system_feedback', array('curl'=>1))->withInput();
    }
  }

  /**
  * GET /system/update/category view
  * @return View
  */
  public function getCategory() {
    $data = $this->getMeta();
    $data['desc'] .= 'system/update/category';

    $c_url = SystemModel::generateApiUrl( 'system/update/category' );
    $c_result = SystemModel::getResult( $c_url, 'get' );

    $data['request_url'] = $c_url;
    $data['result'] = $c_result;

    return View::make('system.category', $data);
  }

}