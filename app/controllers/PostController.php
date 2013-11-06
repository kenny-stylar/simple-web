<?php

/**
* Postpage controller 
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
      'desc'  => 'Request URL: GET ' . Config::get('app.api_url') . '&lt;uid&gt;/posts',     
      'meta'  => array(             
        'title'   => 'Post | Seeties',    
        'description' => 'Sample meta description'  
      ),
      'sidebar' => View::make('post.sidebar')
    );

    return $metadata;
  }

  /**
  * GET /post/user view
  * @return View
  */
  public function getUserPost() {
    $data = $this->getMeta();
    $data['categories'] = CommonHelper::getCategories();

    if ( $this->chkCurlProcess() ) {
      if ( $result = $this->getResults('{uid}/posts', new UserPostModel) ) {
        $result['output'] = View::make('layout.feedblock', array('feeds'=>$result['output']['data']));

        $data['result'] = $result;
      }
    }
      
    return View::make('post.userPost', $data);
  }

  /**
  * POST /post/user
  * @return Redirect
  */
  public function postUserPost() {
    $validator = Validator::make( Input::get(), UserPostModel::$rules );

    if ( $validator->fails() ) {
      return Redirect::route('userpost')->withErrors($validator)->withInput();
    }
    else {
      return Redirect::route('userpost', array('curl'=>1))->withInput();
    }
  }

  /**
  * GET /post/userlike view
  * @return View
  */
  public function getUserLike() {
    $data = $this->getMeta();
    $data['desc'] = 'Request URL: GET ' . Config::get('app.api_url') . '&lt;uid&gt;/likes';
    $data['categories'] = CommonHelper::getCategories();

    if ( $this->chkCurlProcess() ) {
      if ( $result = $this->getResults('{uid}/likes', new UserPostModel) ) {
        $result['output'] = View::make('layout.feedblock', array('feeds'=>$result['output']['posts']));

        $data['result'] = $result;
      }
    }

    return View::make('post.userLike', $data);
  }

  /**
  * POST /post/userlike
  * @return Redirect
  */
  public function postUserLike() {
    $validator = Validator::make( Input::get(), UserPostModel::$rules );

    if ( $validator->fails() ) {
      return Redirect::route('userlike')->withErrors($validator)->withInput();
    }
    else {
      return Redirect::route('userlike', array('curl'=>1))->withInput();
    }
  }

  /**
  * GET /post/createpost view
  * @return View
  */
  public function getCreatePost() {
    $data = $this->getMeta();
    $data['desc'] = 'Request URL: POST ' . Config::get('app.api_url') . 'post';
    $data['categories'] = CommonHelper::getCategories();

    if ( $this->chkCurlProcess() ) {
      $result = $this->getResults('post', new PostModel);
      $data['result'] = $result;
    }

    return View::make('post.createPost', $data);
  }

  /**
  * GET /post/readpost view
  * @return View
  */
  public function getReadPost() {
    $data = $this->getMeta();
    $data['desc'] = 'Request URL: GET ' . Config::get('app.api_url') . 'post/&lt;post_id&gt;';

    if ( $this->chkCurlProcess() ) {
      if ( $result = $this->getResults('post/{post_id}', new PostModel) ) {
        $result['output'] = View::make('layout.post', array('post'=>$result['output']['data']));

        $data['result'] = $result;
      }
    } 
    
    return View::make('post.readPost', $data);
  }

  /**
  * POST /post/readpost
  * @return Redirect
  */
  public function postReadPost() {
    $validator = Validator::make( Input::get(), PostModel::$rules );

    if ( $validator->fails() ) {
      return Redirect::route('readpost')->withErrors($validator)->withInput();
    }
    else {
      return Redirect::route('readpost', array('curl'=>1))->withInput();
    }
  }

  /**
  * GET /post/editpost view
  * @return View
  */
  public function getEditPost($post_id=null) {
    $data = $this->getMeta();
    $data['desc'] = 'Request URL: POST ' . Config::get('app.api_url') . 'post/&lt;post_id&gt;';

    //get form result from $post_id 
    if ( $post_id ) {
      if ( $result = $this->getResults('post/'.$post_id, new PostModel) ) {
        $categories = CommonHelper::getCategories();
        $result['output'] = View::make('post.editpost', array('post'=>$result['output']['data'], 'categories'=>$categories));
        
        $data['result'] = $result;
      }
    }

    return View::make('post.editPost', $data);
  }

  /**
  * POST /post/editpost
  * @return Redirect
  */
  public function postEditPost() {
    $validator = Validator::make( Input::get(), PostModel::$rules );

    if ( $validator->fails() ) {
      return Redirect::route('editpost')->withErrors($validator)->withInput();
    }
    else {
      return Redirect::route('editpost', array('post_id'=>Input::get('post_id')))->withInput();
    }
  }

  /**
  * GET /post/deletepost view
  * @return View
  */
  public function getDeletePost() {
    $data = $this->getMeta();
    $data['desc'] = 'Request URL: DELETE ' . Config::get('app.api_url') . 'post/&lt;post_id&gt;';

    return View::make('post.editPost', $data);
  }

  /**
  * POST /post/deletepost
  * @return Redirect
  */
  public function postDeletePost() {
    $validator = Validator::make( Input::get(), PostModel::$rules );

    if ( $validator->fails() ) {
      return Redirect::route('editpost')->withErrors($validator)->withInput();
    }
    else {
      return Redirect::route('editpost', array('post_id'=>Input::get('post_id')))->withInput();
    }
  }

}