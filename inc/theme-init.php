<?php

global $am_option;

if ( ! is_admin() ) {
	add_action( 'wp_enqueue_scripts', 'am_add_javascript' );
	add_action( 'wp_print_styles', 'am_add_css' );
}

load_theme_textdomain( $am_option['textdomain'], get_template_directory() . '/languages' );

add_filter( 'body_class', 'am_browser_body_class' );
add_filter( 'excerpt_more', 'am_excerpt_more' );
add_action( 'widgets_init', 'am_the_widgets_init' );
add_action( 'widgets_init', 'am_unregister_default_wp_widgets', 1 );
add_filter( 'the_title', 'am_has_title' );
add_filter( 'the_content', 'am_texturize_shortcode_before' );
add_action( 'login_headerurl', 'am_login_logo_url' );
add_filter( 'comment_form_fields', 'am_move_comment_field_to_bottom' );
add_filter( 'upload_mimes', 'am_mime_types' );
add_action( 'admin_head', 'am_svg_thumb_display' );

// create demo user which can not install plugins and themes
add_action( 'init', 'am_demo_role' );

// acf plugin
if ( function_exists( 'acf_add_options_page' ) ) {

	$parent = acf_add_options_page(
		array(
			'page_title' => 'Theme General Settings',
			'menu_title' => 'Global Settings',
			'menu_slug'  => 'theme-general-settings',
			'capability' => 'edit_posts',
			'redirect'   => false,
			'position'   => 59,
		)
	);

	 // Add sub page.
	acf_add_options_sub_page(
		array(
			'page_title'  => __( 'Global Sections' ),
			'menu_title'  => __( 'Global Sections' ),
			'parent_slug' => $parent['menu_slug'],
		)
	);
	acf_add_options_sub_page(
		array(
			'page_title'  => __( 'Community Page Settings' ),
			'menu_title'  => __( 'Community Settings' ),
			'parent_slug' => $parent['menu_slug'],
		)
	);
	acf_add_options_sub_page(
		array(
			'page_title'  => __( 'Post Settings' ),
			'menu_title'  => __( 'Post Settings' ),
			'parent_slug' => $parent['menu_slug'],
		)
	);
}

// This theme uses wp_nav_menu() in one location.
register_nav_menus(
	array(
		'mainmenu'   => __( 'Header Menu', 'am' ),
		'footermenu' => __( 'Footer Menu', 'am' ),
	)
);

// This theme styles the visual editor with editor-style.css to match the theme style.
add_editor_style();

// This theme uses post thumbnails
add_theme_support( 'post-thumbnails' );

add_theme_support( 'html5', array( 'comment-list', 'comment-form', 'search-form', 'gallery', 'caption' ) );

/*
 * Let WordPress manage the document title.
 * By adding theme support, we declare that this theme does not use a
 * hard-coded <title> tag in the document head, and expect WordPress to
 * provide it for us.
 */
add_theme_support( 'title-tag' );

// Add default posts and comments RSS feed links to head
add_theme_support( 'automatic-feed-links' );

// Allow Shortcodes in Sidebar Widgets
add_filter( 'widget_text', 'do_shortcode' );

// remove_filter( 'the_content', 'wpautop' );
// add_filter( 'the_content', 'wpautop' , 99);
// add_filter( 'the_content', 'shortcode_unautop',100 );

// Image Sizes
add_image_size( 'content-image-cards', 530, 560, true );
add_image_size( 'content-image-cards-2x', 1060, 1120, true );
add_image_size( 'content-image-full-ctas', 0, 555, true );
add_image_size( 'content-image-full-ctas-2x', 0, 1110, true );
add_image_size( 'content-image-contained-ctas', 707, 480, true );
add_image_size( 'content-image-contained-ctas-2x', 1414, 960, true );
add_image_size( 'content-image-experience-testimonial', 390, 820, true );
add_image_size( 'content-image-experience-testimonial-2x', 780, 1640, true );
add_image_size( 'testimonial-large', 310, 420, true );
add_image_size( 'testimonial-large-2x', 620, 840, true );
add_image_size( 'post-card', 420, 290, true );
add_image_size( 'post-card-2x', 840, 580, true );
add_image_size( 'masonry-1', 200, 260, true );
add_image_size( 'masonry-1-2x', 400, 520, true );
add_image_size( 'masonry-2', 640, 436, true );
add_image_size( 'masonry-2-2x', 1280, 872, true );
add_image_size( 'masonry-3', 570, 380, true );
add_image_size( 'masonry-3-2x', 1140, 760, true );

// show_admin_bar(false);
// define( 'WPCF7_AUTOP', false );

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function am_content_width() {
	$GLOBALS['content_width'] = apply_filters( 'wfc_content_width', 960 );
}

add_action( 'after_setup_theme', 'am_content_width', 0 );
