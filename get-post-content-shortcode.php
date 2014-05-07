<?php
/*
Plugin Name: Get Post Content Shortcode
Description: This plugin provides a shortcode to get the content of a post based on ID number.
Author: Eric King
Version: 0.2
Author URI: http://webdeveric.com/
Plugin Group: Shortcodes
*/

if ( ! function_exists('is_affirmative')):
    function is_affirmative($arg)
    {
        if (is_string($arg))
            $arg = strtolower($arg);
        return in_array($arg, array( true, 'true', 'yes', 'y', '1', 1));
    }
endif;

function wde_get_post_content_shortcode($atts, $shortcode_content = null, $code = '')
{
    global $post;

    $atts = shortcode_atts(
        array(
            'id'           => 0,
            'wpautop'      => true,
            'do_shortcode' => true
        ),
        $atts
    );

    $atts['id']           = (int)$atts['id'];
    $atts['wpautop']      = is_affirmative($atts['wpautop']);
    $atts['do_shortcode'] = is_affirmative($atts['do_shortcode']);

    if (isset($post, $post->ID) && $post->ID != $atts['id'] && $atts['id'] > 0) {
        $content = get_post_field('post_content', $atts['id']);

        if (is_wp_error($content))
            return '';

        if ($atts['wpautop'])
            $content = wpautop($content);

        if ($atts['do_shortcode'])
            $content = do_shortcode($content);

        return $content;
    }
    return '';
}
add_shortcode('post-content', 'wde_get_post_content_shortcode');
