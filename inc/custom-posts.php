<?php
/**
 * Custom posts for use with this theme
 */

add_action( 'init', 'custom_post_type', 0 );
/**
 * Register Custom Post Type
 */
function custom_post_type() {
	// Register Practice Custom Post Type
	$labels_practice = array(
		'name'                  => _x( 'Practices', 'practices', 'text_domain' ),
		'singular_name'         => _x( 'Practice', 'practice', 'text_domain' ),
		'menu_name'             => __( 'Practices', 'text_domain' ),
		'name_admin_bar'        => __( 'Practices', 'text_domain' ),
		'archives'              => __( 'Practices Archives', 'text_domain' ),
		'attributes'            => __( 'Practices Attributes', 'text_domain' ),
		'parent_item_colon'     => __( 'Parent Practices:', 'text_domain' ),
		'all_items'             => __( 'All Practices', 'text_domain' ),
		'add_new_item'          => __( 'Add Practice', 'text_domain' ),
		'add_new'               => __( 'Add Practice', 'text_domain' ),
		'new_item'              => __( 'New Practice', 'text_domain' ),
		'edit_item'             => __( 'Edit Practice', 'text_domain' ),
		'update_item'           => __( 'Update Practice', 'text_domain' ),
		'view_item'             => __( 'View Practice', 'text_domain' ),
		'view_items'            => __( 'View Practices', 'text_domain' ),
		'search_items'          => __( 'Search Practices', 'text_domain' ),
		'not_found'             => __( 'Not found', 'text_domain' ),
		'not_found_in_trash'    => __( 'Not found in Trash', 'text_domain' ),
		'featured_image'        => __( 'Featured Image', 'text_domain' ),
		'set_featured_image'    => __( 'Set featured image', 'text_domain' ),
		'remove_featured_image' => __( 'Remove featured image', 'text_domain' ),
		'use_featured_image'    => __( 'Use as featured image', 'text_domain' ),
		'insert_into_item'      => __( 'Insert into Practice', 'text_domain' ),
		'uploaded_to_this_item' => __( 'Uploaded to this Practice', 'text_domain' ),
		'items_list'            => __( 'Practices list', 'text_domain' ),
		'items_list_navigation' => __( 'Practices list navigation', 'text_domain' ),
		'filter_items_list'     => __( 'Filter Practices list', 'text_domain' ),
	);
	$args_practice   = array(
		'label'               => __( 'Practices', 'text_domain' ),
		'description'         => __( 'Practices post type', 'text_domain' ),
		'labels'              => $labels_practice,
		'supports'            => array( 'title', 'custom-fields', 'page-attributes', 'thumbnail', 'excerpt', 'editor' ),
		'hierarchical'        => true,
		'public'              => true,
		'show_ui'             => true,
		'show_in_menu'        => true,
		'show_in_rest'        => true,
		'menu_position'       => 5,
		'show_in_admin_bar'   => true,
		'show_in_nav_menus'   => true,
		'can_export'          => true,
		'has_archive'         => false,
		'exclude_from_search' => false,
		'publicly_queryable'  => true,
		'capability_type'     => 'post',
		'menu_icon'           => 'dashicons-media-text',
	);
	register_post_type( 'practice', $args_practice );
}
