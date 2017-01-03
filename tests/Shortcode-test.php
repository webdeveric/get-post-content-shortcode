<?php

class ShortcodeTest extends WP_UnitTestCase
{
    protected function do_shortcode($shortcode, $id)
    {
        return do_shortcode(sprintf($shortcode, $id));
    }

    public function testNoAttributes()
    {
        $this->assertEmpty(
            do_shortcode('[post-content]')
        );
    }

    public function testAutop()
    {
        $content = 'Hello, World!';

        $post_id = $this->factory->post->create( [ 'post_content' => $content ] );

        $this->assertEquals(
            wpautop($content),
            $this->do_shortcode('[post-content id=%d autop=true]', $post_id),
            'The content should be wrapped in a paragraph tag'
        );

        $this->assertEquals(
            $content,
            $this->do_shortcode('[post-content id=%d autop=false]', $post_id),
            'The content should not be wrapped in a paragraph tag'
        );
    }

    public function testField()
    {
        $excerpt = 'Hello, World!';

        $post_id = $this->factory->post->create( [ 'post_excerpt' => $excerpt ] );

        $this->assertEquals(
            wpautop($excerpt),
            $this->do_shortcode('[post-content id=%d field=excerpt]', $post_id)
        );
    }

    public function testStatus()
    {
        $content = 'This is pending approval.';

        $post_id = $this->factory->post->create(
            [
                'post_content' => $content,
                'post_status' => 'pending'
            ]
        );

        $this->assertEquals(
            wpautop($content),
            $this->do_shortcode('[post-content id=%d status=pending]', $post_id)
        );

        $this->assertEquals(
            wpautop($content),
            $this->do_shortcode('[post-content id=%d status="pending,publish"]', $post_id)
        );

        $this->assertEmpty(
            $this->do_shortcode('[post-content id=%d status="publish"]', $post_id)
        );
    }

    public function testNestedShortcode()
    {
        $content = 'Hello, World!';

        $inner_id = $this->factory->post->create( [ 'post_content' => $content ] );

        $shortcode = sprintf('[post-content id=%d]', $inner_id);

        $outer_id = $this->factory->post->create( [ 'post_content' => $shortcode ] );

        $this->assertEquals(
            wpautop($content),
            $this->do_shortcode('[post-content id=%d]', $outer_id)
        );

        $this->assertEquals(
            wpautop($shortcode),
            $this->do_shortcode('[post-content id=%d shortcode=false]', $outer_id)
        );
    }

    public function testSelfReferencingShortcode()
    {
        $post_id = $this->factory->post->create();

        $this->factory->post->update_object(
            $post_id,
            [ 'post_content' => sprintf('[post-content id=%d]', $post_id) ]
        );

        $post = $this->factory->post->get_object_by_id($post_id);

        $this->assertEmpty(trim(apply_filters('the_content', $post->post_content)));
    }

    public function testDefaultAttributesFilter()
    {
        add_filter('post-content-default-attributes', function() {
            return [ 'autop' => false ];
        });

        $content = 'Hello, World!';

        $post_id = $this->factory->post->create( [ 'post_content' => $content ] );

        $this->assertEquals(
            $content,
            $this->do_shortcode('[post-content id=%d]', $post_id),
            'autop attribute should default to false'
        );
    }

    public function testAllowedFieldsFilter()
    {
        add_filter('post-content-allowed-fields', function() {
            return [ 'post_excerpt' ];
        });

        $content = 'Hello, World!';

        $post_id = $this->factory->post->create( [ 'post_content' => $content ] );

        $this->assertEmpty(
            $this->do_shortcode('[post-content id=%d field=content]', $post_id)
        );
    }
}
