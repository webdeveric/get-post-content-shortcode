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

if ( ! version_compare(PHP_VERSION, '5.4', '>=') ) {

    function gpcs_requirements_not_met()
    {
        $message = sprintf('Get Post Content Shortcode has been deactivated. It requires <strong>PHP 5.4+</strong>. You are using <strong>PHP %s</strong>.', PHP_VERSION);
        echo '<div class="notice notice-error is-dismissible"><p>', $message, '</p></div>';
        deactivate_plugins(plugin_basename(__FILE__));
        unset($_GET['activate']);
    }

    add_action('admin_notices', 'gpcs_requirements_not_met');

    return;

}

include __DIR__ . '/main.php';
