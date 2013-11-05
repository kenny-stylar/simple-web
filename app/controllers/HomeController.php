<?php

/**
*	Homepage controller 
* @path /
*/

class HomeController extends BaseController {

	/**
	*	Meta title & description for page
	* @return Array
	*/
	private function getMeta() {
		$metadata = array(
			'title' => 'Simple Web Version',		//* title for page
			'desc' 	=> 'Short description',			//short description about page
			'meta'	=> array(							
				'title'		=> 'Simple Web Version | Seeties',		//head <title> tag
				'description' => 'Sample meta description'	//head <meta description> tag
			)
		);

		return $metadata;
	}

	/**
	*	Homepage view
	* @return View
	*/

	public function getHomeView() {
		return View::make('index', $this->getMeta());
	}

}