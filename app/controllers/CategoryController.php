<?php

/**
* Category page controller 
* @group System
*/

class CategoryController extends BaseController {

  /**
  * Meta title & description for page
  * @return Array
  */
  private function getMeta() {
    $metadata = array(
      'title' => 'System',    
      'desc'  => 'Request URL: GET ' . Config::get('app.api_url') . '&lt;uid&gt;/posts',     
      'meta'  => array(             
        'title'   => 'System | Seeties',    
        'description' => 'Sample meta description'  
      )
    );

    return $metadata;
  }

  /**
  * GET /system/category view
  * @return View
  */
  public function getSystemCategoryView() {

  }

  
}
