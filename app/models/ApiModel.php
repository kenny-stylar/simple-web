<?php

abstract class ApiModel {

  public function __construct() {
    
  }

  /**
  * CURL GET request function
  * @return Array
  */
  public static function curlGetRequest($url) {
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_HEADER, 0);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    $return = curl_exec($ch);
    curl_close($ch);

    return json_decode($return, true);
  }

  /**
  * CURL POST request function
  * @return Array
  */
  public static function curlPostRequest($url, $data) {
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_HEADER, 0);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_POST, 1);
    curl_setopt($ch, CURLOPT_POSTFIELDS, CommonHelper::singleArray($data));
    $return = curl_exec($ch);
    curl_close($ch);

    return json_decode($return, true);
  }

  /**
  * CURL POST request function
  * @return Array
  */
  public static function curlDeleteRequest($url) {
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_HEADER, 0);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'DELETE');
    $return = curl_exec($ch);
    curl_close($ch);

    return json_decode($return, true);
  }

  /**
  * Showing output if available
  * @param $url - request URL
  * @param $method - request method ('get', 'post', 'delete')
  * @param $data - data to proceed
  * 
  * @return Array - status, url & output
  */
  public static function getResult($url, $method, $data=null) {
    $return = array();

    switch (strtolower($method)) {
      case 'get':
        $return['output'] = self::curlGetRequest( $url );
        break;
      case 'post':
        $return['output'] = self::curlPostRequest( $url, $data );
        break;
      case 'delete':
        $return['output'] = self::curlDeleteRequest( $url );
        break;
      default:
        
        break;
    }

    //set status for request
    if ( isset($return['output']['error']) ) 
      $return['status'] = 0; 
    else 
      $return['status'] = 1;

    return $return;
  }

  /**
  * Generate CURL request URL
  * @param $base - API base URL
  * @param $params - query string params
  *
  * @return String
  */ 
  public static function generateApiUrl($base, $params=null) {
    //convert base wif param
    if ( preg_match('/{(.*?)}/',$base, $matches) ) {
      $key = $matches[1];      
      $base = str_replace('{'.$key.'}', $params[$key], $base);
      unset($params[$key]);
    }

    $return = Config::get('app.api_url') . $base . "?";

    if ( isset($params) && count($params) > 0 ) {
      foreach ( $params AS $key => $value ) {
        if ( is_array($value) )
          $value = implode($value, ",");
        $return .= "$key=$value&";
      }
    }

    return rtrim($return, "&?");
  }

  /**
  * Auto fill request param with defaults value
  * @param $data - data to be filled
  * @param $default - default data
  *
  * @return Array
  */
  public static function autoFill($data, $default) {
    $return = array();

    foreach ( $default AS $key => $value ) {
      $return[$key] = (array_key_exists($key, $data)) ? $data[$key] : $value;
    }
    return $return;
  }

  /**
  * Merge data with Input::File() in CurlFile format
  * @param $data - data to be merged
  *
  * @return Array
  */
  public static function mergeFilesUpload($data) {

    if ( !is_array($data) ) 
      return $data;

    if ( count(Input::file()) < 1)   
      return $data;

    if( is_array(Input::file(array_keys(Input::file())[0])) && empty(Input::file(array_keys(Input::file())[0])[0]) )
      return $data;

    $files = array();
    foreach ( Input::file() AS $name => $file ) {
      if ( is_array($file) ) {
        foreach( $file AS $f ) {
          $files[$name.'[]'] = new CurlFile($f->getRealPath(), $f->getMimeType(), $f->getClientOriginalName());
        } 
      }
      else
        $files[$name] = new CurlFile($file->getRealPath(), $file->getMimeType(), $file->getClientOriginalName());
    }

    return array_merge($data, $files);
  }

}