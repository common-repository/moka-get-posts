=== Plugin Name ===
Contributors: Bob Matsuoka
Donate link:
Tags: shortcodes, get posts, posts
Requires at least: 3.1
Tested up to: 3.2
Stable tag: 1.0

Provides a [moka-get-posts] <a href="http://codex.wordpress.org/Shortcode_API">shortcode</a> for displaying posts or pages using the get_posts function.

== Description ==

Provides a [moka-get-posts] <a href="http://codex.wordpress.org/Shortcode_API">shortcode</a> for displaying posts or pages using the get_posts function.   The shortcode accepts most parameters that you can pass to the <a href="http://codex.wordpress.org/Template_Tags/wp_nav_menu">get_posts()</a> function.  Additional arguments are: show_fields="post_content,post_excerpt,post_thumbnail" (use post properties; additional fields include post_thumbnail and post_permalink), thumbnail_size="large" (default: "thumbnail" to set post_thumbnail size), and permalink_title (default: "true" to wrap title in permalink).  To show posts or pages, add [get-posts category="NN"] in the page or post body. To get pages, use the post_type parameter, e.g., [moka-get-posts post_type="page"].  You can also pass a template using shortcode content.  Use the %post_title% format to have fields substituted.  Substitution fields most be listed in the "show_fields" argument. 

Note: unlike the get_posts function, this shortcode defaults to 99 items.  Override using the numberposts attribute.

= Please Note =

The default values are the same as for the `get_posts()` function (http://codex.wordpress.org/Template_Tags/get_posts) with the following exceptions:

<u>Standard Attributes</u>
'numberposts'     => -1,
'orderby'         => 'post_date',
'order'           => 'DESC',
'post_type'       => 'post',
'post_parent'     => '',

Note:  'post_parent' also supports a non-standard "this" value, which will use the current post or page as its argument.

<u>Non-Standard Attributes</u>

'show_fields'	  => 'post_title',

Selects fields to include in output.  By default, post_title is shown. Other options are: post_excerpt, post_content, post_thumbnail, post_permalink

'thumbnail_size'  => 'thumbnail',

If 'post_thumbnail' is used in 'show_fields', this will determine the size of the thumbnail.

'permalink_title' => 'true',

If true, wrap post_title with post_permalink.

'class_name'      => 'get-posts', 

Can use an alternate classname for the wrapping div.  Use if a template is not provided.


== Changelog ==

= 1.0 =

* First release.

== Installation ==

1. Download and unzip the most recent version of this plugin
2. Upload the show-menu-shortcode folder to /path-to-wordpress/wp-content/plugins/
3. Login to your WP Admin panel, click Plugins, and activate "Show Aposts Shortcode"