<?php
/*
Plugin Name: Moka Get Posts Shortcode
Plugin URI: http://www.mokamedianyc.com/dev/get-posts-shortcode/
Description: Provides a [moka-get-posts] <a href="http://codex.wordpress.org/Shortcode_API">shortcode</a> for displaying posts or pages using the get_posts function.   The shortcode accepts most parameters that you can pass to the <a href="http://codex.wordpress.org/Template_Tags/wp_nav_menu">get_posts()</a> function.  Additional arguments are: show_fields="post_content,post_excerpt,post_thumbnail" (use post properties; additional fields include post_thumbnail and post_permalink), thumbnail_size="large" (default: "thumbnail" to set post_thumbnail size), and permalink_title (default: "true" to wrap title in permalink).  To show posts or pages, add [get-posts category="NN"] in the page or post body. To get pages, use the post_type parameter, e.g., [moka-get-posts post_type="page"].  You can also pass a template using shortcode content.  Use the %post_title% format to have fields substituted.  Substitution fields most be listed in the "show_fields" argument. 
Author: Bob Matsuoka
Version: 1.0
Author URI: http://www.mokamedianyc.com
*/

function shortcode_moka_get_posts( $atts, $content = null, $tag ) {
	
	global $post;
	
	// Set defaults
	$defaults = array(
	 	'numberposts'     => -1,
	    'offset'          => 0,
	    'category'        => '',
	    'orderby'         => 'post_date',
	    'order'           => 'DESC',
	    'include'         => '',
	    'exclude'         => '',
	    'meta_key'        => '',
	    'meta_value'      => '',
	    'post_type'       => 'post',
	    'post_mime_type'  => '',
	    'post_parent'     => '',
	    'post_status'     => 'publish',
		'show_fields'	  => 'post_title',
		'thumbnail_size'  => 'thumbnail',
		'permalink_title' => 'true',
		'class_name'      => 'get-posts', 
	);
	
	// Handle shortcusts
	if ($atts['post_parent'] && $atts['post_parent'] == 'this') {
		$atts['post_parent'] = $post->ID;
	}
		
	// Merge user provided atts with defaults
	$atts = shortcode_atts( $defaults, $atts );

	// Generate fields array
	$show_fields_list = explode(',', $atts['show_fields']);

	// Get Posts
	$posts_to_show = get_posts( $atts );
	
	// Create output
	$out = '';
	$use_template = strlen($content) > 0;
	if (!$use_template) {
		$out .= '<div class="'.$atts['class_name'].'"><ul>';
	}

	foreach ($posts_to_show as $post_to_show) {
		$permalink = get_permalink( $post_to_show->ID );
		if (!$use_template) {
			$out .= '<li>';
		}
		
		$out_template = $content;
		foreach ($show_fields_list as $show_field) {
			$show_field_value = '';
			$permalink = get_permalink( $post_to_show->ID );
			if (strlen($show_field)) {
				switch($show_field) {
					case 'post_title':
						$show_field_value = $post_to_show->post_title;
						if ($atts['permalink_title']) {
							$show_field_value = '<a href="'.$permalink.'">'.$post_to_show->post_title.'</a>';
						}
						break;
					case 'post_permalink':
						$show_field_value = $permalink;
						break;
					case 'post_thumbnail':
						$show_field_value = get_the_post_thumbnail($post_to_show->ID, $atts['thumbnail_size']);
						break;
					default: 
						$show_field_value = $post_to_show->$show_field;
						break;
				}
			}
			if (!$use_template) {
				$out .= '<div class="'.$show_field.'">'.$show_field_value.'</div>';
			} else {
				$out_template = str_replace('%'.$show_field.'%', $show_field_value, $out_template);
			}
		}		
		if (!$use_template) {
			$out .= '</li>';
		} else {
			$out .= $out_template;
		}
	}
	
	if (!$use_template) {
		$out .= '</ul></div>';
	}

	return apply_filters( 'shortcode_moka_get_posts', $out, $atts, $content, $tag );
}

add_shortcode( 'moka-get-posts', 'shortcode_moka_get_posts' );

?>