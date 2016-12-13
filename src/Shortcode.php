<?php

namespace webdeveric\GetPostContentShortcode;

abstract class Shortcode
{
    protected $name;

    public function __construct()
    {
        $this->register();
    }

    public function render($attributes, $shortcode_content = null, $code = '')
    {
        return '';
    }

    public function register()
    {
        \add_shortcode( $this->name, [ $this, 'render' ]);
    }

    public function remove()
    {
        \remove_shortcode( $this->name );
    }
}
