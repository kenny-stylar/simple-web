<?php

/**
* Feed page controller 
* @group Feed
*/

class FeedController extends BaseController {

  /**
  * Meta title & description for page
  * @return Array
  */
  private function getMeta() {
    $metadata = array(
      'title' => 'Feed',    
      'desc'  => 'Request URL: ' . Config::get('app.api_url'),     
      'meta'  => array(             
        'title'   => 'Feed | Seeties',    
        'description' => 'Sample meta description'  
      ),
      'sidebar' => View::make('feed.sidebar')
    );

    return $metadata;
  }

  /**
  * GET /feed view
  * @return View
  */
  public function getFeed() {
    $data = $this->getMeta();
    $data['desc'] .= 'feed';
    $data['categories'] = CommonHelper::getCategories();

    if ( $this->chkCurlProcess('curl') ) {
      $c_url = FeedModel::generateApiUrl( 'feed', FeedModel::autoFill(Input::old(), FeedModel::$qs_fill) );
      $c_result = FeedModel::getResult( $c_url, 'get' );

      $data['request_url'] = $c_url;
      $data['result'] = $c_result;

      //create html view from output
      if ( $c_result['status'] ) {
        $data['htmlview'] = View::make('layout.feedblock', array('feeds'=>$c_result['output']['data']));
      }
    }

    return View::make('feed.feed', $data);
  }

  /**
  * POST /feed view
  * @return Redirect
  */
  public function postFeed() {
    $validator = Validator::make( Input::get(), FeedModel::$qs_rules );

    if ( $validator->fails() ) {
      return Redirect::route('feed')->withErrors($validator)->withInput();
    }
    else {
      return Redirect::route('feed', array('curl'=>1))->withInput();
    }
  }

}