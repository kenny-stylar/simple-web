<?php

class BaseController extends Controller {

	/**
	 * Setup the layout used by the controller.
	 *
	 * @return void
	 */
	protected function setupLayout()
	{
		if ( ! is_null($this->layout))
		{
			$this->layout = View::make($this->layout);
		}
	}

	/**
  * Check for CURL validation pass
  * @param $key - key_qs to check
  *
  * @return Boolean
  */
  protected function chkCurlProcess($key) {
  	return ( !empty(Input::get($key)) && Input::get($key) == 1 && count(Input::old()) > 0 );
  }

}