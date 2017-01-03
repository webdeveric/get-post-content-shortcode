<?php
/*
Plugin Name: Get Post Content Shortcode
Plugin Group: Shortcodes
Plugin URI: http://phplug.in/
Description: This plugin provides a shortcode to get the content of a post based on ID number.
Version: 0.5.0
Author: Eric King
Author URI: http://webdeveric.com/
*/

namespace webdeveric\GetPostContentShortcode;

require_once 'src/functions.php';
require_once 'src/Shortcode.php';
require_once 'src/PostContentShortcode.php';
require_once 'src/PostIDShortcode.php';
require_once 'src/OuterPostIDShortcode.php';

new PostContentShortcode();
new PostIDShortcode();
new OuterPostIDShortcode();
