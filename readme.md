# Get Post Content Shortcode

[![Build Status](https://travis-ci.org/webdeveric/get-post-content-shortcode.svg?branch=master)](https://travis-ci.org/webdeveric/get-post-content-shortcode)

This WordPress plugin provides a shortcode to get the content of a post based on ID number.

## Usage

`[post-content id="42"]`

This gets the content of post 42.

`[post-content id="42" autop="false"]`

This gets the content of post 42 and does not call wpautop on the content.

`[post-content id="42" shortcode="false"]`

This gets the content of post 42 and does not call do_shortcode on the content.

`[post-content id="42" autop="false" shortcode="false"]`

This gets the content of post 42 and does not call wpautop or do_shortcode on the content.

`[post-content id="42" status="publish,future"]`

This gets the content of post 42 only if the post_status is "publish" or "future".

`[post-content id="42" field="excerpt"]`

This gets the excerpt of post 42.

## Filter examples

**Only allow the `post_content` field**

```php
add_filter('post-content-allowed-fields', function($allowed_fields) {
  return [ 'post_content' ];
});
```

**Set the default value of the `autop` attribute to `false`**

```php
add_filter('post-content-default-attributes', function ($default_attributes) {
  return [ 'autop' => false ];
});
```

## Tests

[setup instructions](http://wp-cli.org/docs/plugin-unit-tests/)

`vendor/bin/phpunit`
