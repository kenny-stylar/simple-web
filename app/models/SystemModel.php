<?php

class SystemModel extends ApiModel {

  public static $qs_feedback_fill = array(
    'type'       => 'feedback',
    'email'      => '',
    'message'    => '',
    'screenshot' => ''
  );

  public static $qs_feedback_rules = array(
    'type'       => 'required|in:feedback,problem',
    'email'      => 'required|email',
    'message'    => 'required|max:500'
  );

}