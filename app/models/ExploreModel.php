<?php

class ExploreModel extends ApiModel {

  public static $qs_fill = array(
    'city_id'     => '',
    'token'       => ''
  );

  public static $qs_rules = array(
    'city_id'     => 'required',
    'token'       => 'required'
  );

  public static $qs_list_fill = array(
    'token'       => ''
  );

  public static $qs_posts_fill = array(
    'token'       => '',
    'categories'  => '',
    'page'        => 1,
    'sort'        => '',
    'city_id'     => ''
  );

  public static $qs_list_rules = array(
    'token'       => 'required'
  );

  public static $qs_posts_rules = array(
    'token'       => 'required',
    'categories'  => 'required',
    'page'        => 'numeric|min:1',
    'sort'        => 'in:1,2',
    'city_id'     => 'required'
  );
}