<?php

namespace webdeveric\GetPostContentShortcode;

use WP_Post;

class PostContentShortcode extends Shortcode
{
    protected $name = 'post-content';

    public function render($attributes, $shortcode_content = null, $code = '')
    {
        global $post;

        $content = '';
        $attributes = $this->attributes($attributes);

        if ( $attributes['field'] && \get_the_ID() !== $attributes['id'] && in_array( \get_post_status($attributes['id']), $attributes['status'] ) ) {
            $original_post = $post;

            $post = \get_post($attributes['id']);

            if ( $post instanceof WP_Post ) {
                $content = \get_post_field($attributes['field'], $post->ID);

                if (! empty($content)) {
                    if ($attributes['shortcode']) {
                        $content = \do_shortcode($content);
                    }

                    if ($attributes['autop']) {
                        $content = \wpautop($content);
                    }
                }
            }

            $post = $original_post;
        }

        return $content;
    }

    protected function checkStatus( $status, $default_status = 'publish' )
    {
        $valid_fields = array_intersect( split_comma($status), \get_post_stati() );

        if (empty($valid_fields)) {
            $valid_fields[] = $default_status;
        }

        return $valid_fields;
    }

    protected function checkField( $field )
    {
        $allowed_fields = \apply_filters(
            "{$this->name}-allowed-fields",
            [
                'post_author',
                'post_date',
                'post_date_gmt',
                'post_content',
                'post_title',
                'post_excerpt',
                'post_status',
                'comment_status',
                'ping_status',
                'post_name',
                'to_ping',
                'pinged',
                'post_modified',
                'post_modified_gmt',
                'post_content_filtered',
                'post_parent',
                'guid',
                'menu_order',
                'post_type',
                'post_mime_type',
                'comment_count'
            ]
        );

        foreach ( [ $field, 'post_' . $field ] as $field_name) {
            if (in_array($field_name, $allowed_fields)) {
                return $field_name;
            }
        }

        return false;
    }

    protected function attributes( $attributes = [] )
    {
        $default_attributes = [
            'id'        => 0,
            'autop'     => true,
            'shortcode' => true,
            'field'     => 'post_content',
            'status'    => 'publish'
        ];

        $attributes = \shortcode_atts(
            array_merge(
                $default_attributes,
                \apply_filters("{$this->name}-default-attributes", $default_attributes)
            ),
            $attributes,
            $this->name
        );

        return [
            'id'        => (int) $attributes['id'],
            'autop'     => is_yes($attributes['autop']),
            'shortcode' => is_yes($attributes['shortcode']),
            'field'     => $this->checkField($attributes['field']),
            'status'    => $this->checkStatus($attributes['status'])
        ];
    }
}
