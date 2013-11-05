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
  * @return Boolean
  */
  protected function chkCurlProcess() {
  	return ( !empty(Input::get('curl')) && Input::get('curl') == 1 && count(Input::old()) > 0 );
  }

  /**
  * Showing output if available
  * @return Array - url & output
  */
  protected function getResults($base, $model) {
    $return = array();
    
    //get data through API
    if ( preg_match('/{(.*?)}/',$base, $matches) ) {
      $key = $matches[1];
      $base = str_replace('{'.$key.'}', Input::old($key), $base);
    }

    $return['url'] = $model::generateApiUrl( $base, Input::old() );
    $return['output'] = $model::curlRequest( $return['url'] );

    if ( isset($return['output']['error']) ) 
    	return false;
    else
    	return $return;
  }

}