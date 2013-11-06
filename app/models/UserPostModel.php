<?php

class UserPostModel extends ApiModel {

  const TOKEN     = 1;        //indicated if token needed

  public static $defaults = array(
    'categories'  => '',
    'page'        => 1
  );

  public static $rules = array(
    'uid'        => 'required',
    'categories' => 'required',
    'page'       => 'numeric|min:1'
  );

}