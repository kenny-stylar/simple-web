<?php

/**
* Common Helper functions
*/

class CommonHelper {

  /**
  * Get list of categories
  * @param $ddl - convert to 2D ddl format
  *
  * @return Array
  */
  public static function getCategories($ddl=true) {
    $c_url = CategoryModel::generateApiUrl('system/update/category');
    $result = CategoryModel::getResult($c_url, 'get');

    $return = array();
    if ( $result['status'] ) {
      //reconstructs object 
      foreach ( $result['output']['categories'] AS $category ) {
        if ( $ddl )
          $return[ $category['id'] ] = $category['single_line'];
        else
          $return[ $category['id'] ] = array_except($category, array('id'));
      }
    }

    return $return;
  }

  /**
  * Get list of cities
  * @return Array
  */
  public static function getCities() {
    $c_url = ExploreModel::generateApiUrl('explore', array('token'=>Session::get('user_token')));
    $result = ExploreModel::getResult($c_url, 'get');

    $return = array();
    if ( $result['status'] ) {
      //reconstructs object 
      foreach ( $result['output'] AS $city ) {
        $return[ $city['city_id'] ] = $city['name'];
      }
    }

    return $return;
  }

  /**
  * Convert multiple array to single array
  * @param $array - array to convert
  * @param $join - implode string
  *
  * @return Array
  */
  public static function singleArray($array, $join=",") {
    
    if ( !is_array($array) )   return $array;

    $return = array();
    foreach( $array AS $key => $val) {
      if ( is_array($val) )
        $val = implode($val, $join);
      $return[$key] = $val;
    }

    return $return;
  }

  /**
  * Echo formatted Object / Array with <pre>
  * @param $obj - object / array / string
  *
  * @return String
  */
  public static function preEcho($obj) {
    if ( is_object($obj) || is_array($obj) ) {
      echo "<pre>";
      print_r($obj);
      echo "</pre>";
    }
    else {
      echo $obj;
    }
  }
}