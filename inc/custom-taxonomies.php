<?php
/**
 * Custom taxonomies for use with this theme
 */

add_action( 'init', 'custom_taxonomies' );

/**
 * Adds custom taxonomies
 */
function custom_taxonomies() {
	// Claim Type - Apply to all post types (including page/post)
	register_taxonomy(
		'claim_type',  // The name of the taxonomy. Name should be in slug form (must not contain capital letters or spaces).
		array( 'practice', 'post', 'page', 'city', 'faq', 'case_result' ),             // post type name
		array(
			'hierarchical' => true,
			'label'        => 'Claim Type', // display name
			'query_var'    => true,
			'rewrite'      => array(
				'slug'       => 'claim-type',    // This controls the base slug that will display before each term
				'with_front' => false,  // Don't display the category base before
			),
			'show_in_rest' => true,
		)
	);
	// Case Category - Apply to all post types (including page/post)
	register_taxonomy(
		'case_category',  // The name of the taxonomy. Name should be in slug form (must not contain capital letters or spaces).
		array( 'practice', 'post', 'page', 'city', 'faq', 'case_result' ),             // post type name
		array(
			'hierarchical' => true,
			'label'        => 'Case Category', // display name
			'query_var'    => true,
			'rewrite'      => array(
				'slug'       => 'case-category',    // This controls the base slug that will display before each term
				'with_front' => false,  // Don't display the category base before
			),
			'show_in_rest' => true,
		)
	);
	// FAQ Type - Only for FAQ post type
	register_taxonomy(
		'faq_type',  // The name of the taxonomy. Name should be in slug form (must not contain capital letters or spaces).
		array( 'faq' ),             // post type name
		array(
			'hierarchical' => true,
			'label'        => 'FAQ Type', // display name
			'query_var'    => true,
			'rewrite'      => array(
				'slug'       => 'faq-type',    // This controls the base slug that will display before each term
				'with_front' => false,  // Don't display the category base before
			),
			'show_in_rest' => true,
		)
	);
	
	// Practice State - Only for Practice Areas post type
	register_taxonomy(
		'practice_state',  // The name of the taxonomy. Name should be in slug form (must not contain capital letters or spaces).
		'practice',             // post type name
		array(
			'hierarchical' => true,
			'label'        => 'States', // display name
			'query_var'    => true,
			'rewrite'      => array(
				'slug'       => 'practice-state',    // This controls the base slug that will display before each term
				'with_front' => false,  // Don't display the category base before
			),
			'show_in_rest' => true,
		)
	);
	// Practice City - Only for Practice Areas post type
	register_taxonomy(
		'practice_city',  // The name of the taxonomy. Name should be in slug form (must not contain capital letters or spaces).
		'practice',             // post type name
		array(
			'hierarchical' => true,
			'label'        => 'Cities', // display name
			'query_var'    => true,
			'rewrite'      => array(
				'slug'       => 'practice-city',    // This controls the base slug that will display before each term
				'with_front' => false,  // Don't display the category base before
			),
			'show_in_rest' => true,
		)
	);
}
