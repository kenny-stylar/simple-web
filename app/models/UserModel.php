<?php

class UserModel extends ApiModel {

  public static $qs_fill = array(
    'uid'         => '',
    'token'       => ''
  );

  public static $qs_rules = array(
    'uid'         => 'required',
    'token'       => 'required'
  );

  public static $qs_logout_fill = array(
    'token'       => ''
  );

  public static $qs_logout_rules = array(
    'token'       => 'required'
  );

  /**
  * POST form validation
  */
  public static $form_reg_fill = array(
    'email'       => '',
    'username'    => '',
    'password'    => '',
    'fb_id'       => '',
    'name'        => '',
    'dob'         => '',
    'gender'      => 'm'
  );

  public static $form_log_fill = array(
    'login_id'    => '',
    'password'    => ''
  );

  public static $form_pas_fill = array(
    'old_password' => '',
    'new_password' => ''
  );

  public static $form_upd_fill = array(
    'email'       => '',
    'fb_id'       => '',
    'fb_token'    => '',
    'name'        => '',
    'dob'         => '',
    'gender'      => '',
    'home_city'   => '',
    'other_city'  => '',
    'categories'  => '',
    'description' => '',
    'profile_photo' => '',
    'personal_link' => ''
  );

  public static $form_pro_fill = array(
    'categories'  => '',
    'home_city'   => '',
    'other_city'  => ''
  );

  public static $form_reg_rules = array(
    'email'       => 'required|email|max:100',
    'username'    => 'required|alpha_dash|min:5|max:30',
    'password'    => 'required|min:8|max:50|confirmed',
    'fb_id'       => 'numeric',
    'name'        => 'required|min:1|max:50',
    'dob'         => 'required|date_format:Y-m-d',
    'gender'      => 'required|in:m,f'
  );

  public static $form_log_rules = array(
    'login_id'    => 'required',
    'password'    => 'required|min:8|max:50'
  );

  public static $form_pas_rules = array(
    'old_password' => 'required|min:8|max:50',
    'new_password' => 'required|min:8|max:50|confirmed'
  );

  public static $form_upd_rules = array(
    'email'       => 'required|email|max:100',
    'fb_id'       => 'numeric',
    'fb_token'    => '',
    'name'        => 'required|min:1|max:50',
    'dob'         => 'required|date_format:Y-m-d',
    'gender'      => 'required|in:m,f',
    'categories'  => 'required',
    'description' => 'max:500',
    'personal_link' => 'max:500'
  );

  public static $form_pro_rules = array(
    'categories'  => 'required'
  );

}