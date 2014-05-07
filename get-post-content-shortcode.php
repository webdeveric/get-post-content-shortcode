<?php
/*
Plugin Name: Get Post Content Shortcode
Description: This plugin provides a shortcode to get the content of a post based on ID number.
Author: Eric King
Version: 0.2
Author URI: http://webdeveric.com/
Plugin Group: Shortcodes
*/

function wde_get_post_content_shortcode($atts, $shortcode_content = null, $code = '')
{
    global $post;
    $atts = shortcode_atts(array('id' => 0), $atts);

    $atts['id'] = (int)$atts['id'];

    if (isset($post, $post->ID) && $post->ID != $atts['id'] && $atts['id'] > 0) {
        $content = get_post_field('post_content', $atts['id']);
        return is_wp_error($content) ? '' : do_shortcode(wpautop($content));
    }
    return '';
}
add_shortcode('post-content', 'wde_get_post_content_shortcode');
