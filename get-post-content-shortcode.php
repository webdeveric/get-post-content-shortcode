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

function gpcs_requirements()
{
    return version_compare(PHP_VERSION, '5.4', '>=');
}

function gpcs_activate()
{
   if ( ! gpcs_requirements() ) {
        unset($_GET['activate']);
        deactivate_plugins( plugin_basename( __FILE__ ) );
        wp_die(
            sprintf(
                'Get Post Content Shortcode requires <strong>PHP 5.4+</strong>. You are using <strong>PHP %s</strong>.',
                PHP_VERSION
            )
        );
    }
}

if ( gpcs_requirements() ) {

    include __DIR__ . '/main.php';

} else {

    register_activation_hook( __FILE__, 'gpcs_activate' );

}
