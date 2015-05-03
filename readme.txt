=== Get Post Content Shortcode ===
Contributors: webdeveric
Tags: post content, shortcode
Requires at least: 3.0.0
Tested up to: 4.2.0
Stable tag: 0.3.1

This plugin provides a shortcode to get the content of a post based on ID number.

== Description ==

This plugin provides a shortcode to get the content of a post based on ID number.
The content will be passed through wpautop and do_shortcode unless you tell it not to.

**Examples:**

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
If you omit the status, it will default to "publish".

The possible statuses are: publish, pending, draft, auto-draft, future, private, inherit, trash

**Note:**
The containing post may still have wpautop called on it's content.

== Installation ==

1. Upload `get-post-content-shortcode` folder to the `/wp-content/plugins/` directory
1. Activate the plugin through the 'Plugins' menu in WordPress
1. Place `[post-content id="SOME OTHER POST ID"]` in your content.

== Changelog ==

= 0.3.1 =
* By default, this shortcode will only get content of published posts, unless you specify the status attribute.

= 0.3.0 =
* I updated the code to temporarily switch to the other post so that shortcodes in the other post will work as expected.

= 0.2.0 =
* I updated the code to use the `get_post_field` function instead of `get_post`.

= 0.1.0 =
* Initial build
