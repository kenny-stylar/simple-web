<?php

/**
* Post page controller 
* @group Post
*/

class PostController extends BaseController {

  /**
  * Meta title & description for page (shared)
  * @return Array
  */
  private function getMeta() {
    $metadata = array(
      'title' => 'Post',    
      'desc'  => 'Request URL: ' . Config::get('app.api_url'),     
      'meta'  => array(             
        'title'   => 'Post | Seeties',    
        'description' => 'Sample meta description'  
      ),
      'sidebar' => View::make('post.sidebar')
    );

    return $metadata;
  }

  /**
  * GET /post/userposts view
  * @return View
  */
  public function getUserPosts() {
    $data = $this->getMeta();
    $data['desc'] .= '&lt;uid&gt;/posts';
    $data['categories'] = CommonHelper::getCategories();

    if ( $this->chkCurlProcess('curl') ) {
      $c_url = PostModel::generateApiUrl( '{uid}/posts', PostModel::autoFill(Input::old(), PostModel::$qs_user_fill) );
      $c_result = PostModel::getResult( $c_url, 'get' );

      $data['request_url'] = $c_url;
      $data['result'] = $c_result;

      //create html view from output
      if ( $c_result['status'] ) {
        $data['htmlview'] = View::make('layout.feedblock', array('feeds'=>$c_result['output']['data']));
      }
    }
      
    return View::make('post.userposts', $data);
  }

  /**
  * POST /post/userposts
  * @return Redirect
  */
  public function postUserPosts() {
    $validator = Validator::make( Input::get(), PostModel::$qs_user_rules );

    if ( $validator->fails() ) {
      return Redirect::route('user_posts')->withErrors($validator)->withInput();
    }
    else {
      return Redirect::route('user_posts', array('curl'=>1))->withInput();
    }
  }

  /**
  * GET /post/userlikes view
  * @return View
  */
  public function getUserLikes() {
    $data = $this->getMeta();
    $data['desc'] .= '&lt;uid&gt;/likes';
    $data['categories'] = CommonHelper::getCategories();

    if ( $this->chkCurlProcess('curl') ) {
      $c_url = PostModel::generateApiUrl( '{uid}/likes', PostModel::autoFill(Input::old(), PostModel::$qs_user_fill) );
      $c_result = PostModel::getResult( $c_url, 'get' );

      $data['request_url'] = $c_url;
      $data['result'] = $c_result;

      //create html view from output
      if ( $c_result['status'] ) {
        $data['htmlview'] = View::make('layout.feedblock', array('feeds'=>$c_result['output']['posts']));
      }
    }

    return View::make('post.userlikes', $data);
  }

  /**
  * POST /post/userlikes
  * @return Redirect
  */
  public function postUserLikes() {
    $validator = Validator::make( Input::get(), PostModel::$qs_user_rules );

    if ( $validator->fails() ) {
      return Redirect::route('user_likes')->withErrors($validator)->withInput();
    }
    else {
      return Redirect::route('user_likes', array('curl'=>1))->withInput();
    }
  }

  /**
  * GET /post/createpost view
  * @return View
  */
  public function getCreatePost() {
    $data = $this->getMeta();
    $data['desc'] .= 'post';
    $data['categories'] = CommonHelper::getCategories();

    if ( $this->chkCurlProcess('curl') ) {
      $c_url = PostModel::generateApiUrl( 'post', PostModel::autoFill(Input::old(), PostModel::$qs_post_fill) );
      $c_result = PostModel::getResult( $c_url, 'post', PostModel::autoFill(Input::old(), PostModel::$form_create_fill) );

      $data['request_url'] = $c_url;
      $data['result'] = $c_result;
    }

    return View::make('post.createpost', $data);
  }

  /**
  * POST /post/createpost
  * @return Redirect
  */
  public function postCreatePost() {
    $validator = Validator::make( Input::get(), PostModel::$form_create_rules );

    if ( $validator->fails() ) {
      return Redirect::route('create_post')->withErrors($validator)->withInput();
    }
    else {
      return Redirect::route('create_post', array('curl'=>1))->withInput();
    }
  }

  /**
  * GET /post/readpost view
  * @return View
  */
  public function getReadPost() {
    $data = $this->getMeta();
    $data['desc'] .= 'post/&lt;post_id&gt;';

    if ( $this->chkCurlProcess('curl') ) {
      $c_url = PostModel::generateApiUrl( 'post/{post_id}', PostModel::autoFill(Input::old(), PostModel::$qs_fill) );
      $c_result = PostModel::getResult( $c_url, 'get' );

      $data['request_url'] = $c_url;
      $data['result'] = $c_result;

      if ( $c_result['status'] ) {
        $data['htmlview'] = View::make('layout.post', array('post'=>$c_result['output']['data']));
      }
    }
    
    return View::make('post.readpost', $data);
  }

  /**
  * POST /post/readpost
  * @return Redirect
  */
  public function postReadPost() {
    $validator = Validator::make( Input::get(), PostModel::$qs_rules );

    if ( $validator->fails() ) {
      return Redirect::route('read_post')->withErrors($validator)->withInput();
    }
    else {
      return Redirect::route('read_post', array('curl'=>1))->withInput();
    }
  }

  /**
  * GET /post/editpost view
  * @return View
  */
  public function getEditPost($post_id=null) {
    $data = $this->getMeta();
    $data['desc'] .= 'post/&lt;post_id&gt;';

    //get form result from $post_id 
    if ( $post_id ) {
      $c_url = PostModel::generateApiUrl( 'post/{post_id}', PostModel::autoFill(Input::old(), PostModel::$qs_fill) );
      $post = PostModel::getResult( $c_url, 'get' );

      if ( $post['status'] ) {
        $categories = CommonHelper::getCategories();
        $data['htmlview'] = View::make( 'post.editpost', array('post'=>$post['output']['data'], 'categories'=>$categories) );
      }

      $data['request_url'] = $c_url;
      $data['result'] = $post;
    }

    return View::make('post.editpost', $data);
  }

  /**
  * POST /post/editpost
  * @return Redirect
  */
  public function postEditPost($post_id=null) {
    if ( empty($post_id) )
      $validator = Validator::make( Input::get(), PostModel::$qs_rules );
    else
      $validator = Validator::make( Input::get(), PostModel::$form_create_rules );

    if ( $validator->fails() ) {
      return Redirect::route('edit_post')->withErrors($validator)->withInput();
    }
    else {
      return Redirect::route('edit_post', array('post_id'=>Input::get('post_id')))->withInput();
    }
  }

  /**
  * GET /post/deletepost view
  * @return View
  */
  public function getDeletePost() {
    $data = $this->getMeta();
    $data['desc'] .= 'post/&lt;post_id&gt;';

    if ( $this->chkCurlProcess('curl') ) {
      $c_url = PostModel::generateApiUrl( 'post/{post_id}', PostModel::autoFill(Input::old(), PostModel::$qs_fill) );
      $c_result = PostModel::getResult( $c_url, 'delete' );

      $data['request_url'] = $c_url;
      $data['result'] = $c_result;
    }
    
    return View::make('post.deletepost', $data);
  }

  /**
  * POST /post/deletepost
  * @return Redirect
  */
  public function postDeletePost() {
    $validator = Validator::make( Input::get(), PostModel::$qs_rules );

    if ( $validator->fails() ) {
      return Redirect::route('delete_post')->withErrors($validator)->withInput();
    }
    else {
      return Redirect::route('delete_post', array('curl'=>1))->withInput();
    }
  }

}