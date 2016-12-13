<?php

namespace webdeveric\GetPostContentShortcode;

class OuterPostID extends Shortcode
{
    protected $name = 'outer-post-id';

    public function __construct()
    {
        parent::__construct();

        \add_action( 'loop_start', [ $this, 'handleLoopStart' ]);
    }

    public function handleLoopStart($query)
    {
        $this->outer_post_id = $query->queried_object->ID;
    }

    public function render($attributes, $shortcode_content = null, $code = '')
    {
        return (int) $this->outer_post_id;
    }
}
