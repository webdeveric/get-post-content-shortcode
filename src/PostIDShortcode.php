<?php

namespace webdeveric\GetPostContentShortcode;

class PostIDShortcode extends Shortcode
{
    protected $name = 'post-id';

    public function render($attributes, $shortcode_content = null, $code = '')
    {
        return (int) \get_the_ID();
    }
}
