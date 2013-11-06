<?php

class PostModel extends ApiModel {

  const TOKEN     = 1;        //indicated if token needed

  public static $defaults = array();

  public static $rules = array(
    'post_id'     => 'required'
  );

  public static $formdefaults = array(
    'message'     => '',
    'category'    => 1,
    'link'        => '',
    'place_name'  => '',
    'location'    => '',
  );

  public static $formrules = array(
    'message'     => 'required|min:300|max:500',
    'category'    => 'required',
    'link'        => 'required',
    'place_name'  => 'required',
    'location'    => 'required'
  );

}