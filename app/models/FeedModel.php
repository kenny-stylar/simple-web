<?php

class FeedModel extends ApiModel {

  public static $qs_fill = array(
    'type'        => 'all',
    'categories'  => '',
    'page'        => 1,
    'sort'        => 1,
    'token'       => ''
  );

  public static $qs_rules = array(
    'type'        => 'required',
    'categories'  => 'required',
    'page'        => 'numeric|min:1',
    'sort'        => 'numeric|min:1|max:2',
    'token'       => 'required'
  );

}