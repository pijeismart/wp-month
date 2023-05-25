<?php
/**
 * Custom taxonomies for use with this theme
 */

add_action( 'init', 'custom_taxonomies' );

/**
 * Adds custom taxonomies
 */
function custom_taxonomies() {
	// Practice State
	register_taxonomy(
		'practice_state',  // The name of the taxonomy. Name should be in slug form (must not contain capital letters or spaces).
		'practice',             // post type name
		array(
			'hierarchical' => true,
			'label'        => 'States', // display name
			'query_var'    => true,
			'rewrite'      => array(
				'slug'       => 'State',    // This controls the base slug that will display before each term
				'with_front' => false,  // Don't display the category base before
			),
			'show_in_rest' => true,
		)
	);
	// Practice City
	register_taxonomy(
		'practice_city',  // The name of the taxonomy. Name should be in slug form (must not contain capital letters or spaces).
		'practice',             // post type name
		array(
			'hierarchical' => true,
			'label'        => 'Cities', // display name
			'query_var'    => true,
			'rewrite'      => array(
				'slug'       => 'City',    // This controls the base slug that will display before each term
				'with_front' => false,  // Don't display the category base before
			),
			'show_in_rest' => true,
		)
	);
}
