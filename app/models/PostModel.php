<?php

class PostModel extends ApiModel {

  public static $qs_fill = array(
    'post_id'     => '',
    'token'       => ''
  );

  public static $qs_rules = array(
    'post_id'     => 'required',
    'token'       => 'required'
  );

  public static $qs_post_fill = array(
    'token'       => ''
  );

  public static $qs_user_fill = array(
    'categories'  => '',
    'page'        => 1,
    'uid'         => '',
    'token'       => ''
  );

  public static $qs_user_rules = array(
    'categories'  => 'required',
    'page'        => 'numeric|min:1',
    'uid'         => 'required',
    'token'       => 'required'
  );

  /**
  * POST form validation
  */
  public static $form_create_fill = array(
    'message'     => '',
    'category'    => 1,
    'link'        => '',
    'place_name'  => '',
    'location'    => '',
  );

  public static $form_create_rules = array(
    'message'     => 'required|min:300|max:500',
    'category'    => 'required|numeric',
    'link'        => 'url',
    'place_name'  => 'required|max:50',
    'token'       => 'required',
    'post_id'     => 'required'
  );

}