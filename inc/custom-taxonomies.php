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
		array( 'practice', 'post', 'page', 'city', 'faq', 'case_result', 'attorney' ),             // post type name
		array(
			'publicly_queryable' => false,
			'hierarchical'       => true,
			'label'              => 'Claim Type', // display name
			'query_var'          => true,
			'rewrite'            => array(
				'slug'       => 'claim-type',    // This controls the base slug that will display before each term
				'with_front' => false,  // Don't display the category base before
			),
			'show_in_rest'       => true,
		)
	);
	// Case Category - Apply to all post types (including page/post)
	register_taxonomy(
		'case_category',  // The name of the taxonomy. Name should be in slug form (must not contain capital letters or spaces).
		array( 'practice', 'post', 'page', 'city', 'faq', 'case_result', 'attorney' ),             // post type name
		array(
			'publicly_queryable' => true,
			'hierarchical'       => true,
			'label'              => 'Case Category', // display name
			'query_var'          => true,
			'rewrite'            => array(
				'slug'       => 'blog',    // This controls the base slug that will display before each term
				'with_front' => false,  // Don't display the category base before
			),
			'show_in_rest'       => true,
		)
	);
	// FAQ Type - Only for FAQ post type
	register_taxonomy(
		'faq_type',  // The name of the taxonomy. Name should be in slug form (must not contain capital letters or spaces).
		array( 'faq' ),             // post type name
		array(
			'publicly_queryable' => false,
			'hierarchical'       => true,
			'label'              => 'FAQ Type', // display name
			'query_var'          => true,
			'rewrite'            => array(
				'slug'       => 'faq-type',    // This controls the base slug that will display before each term
				'with_front' => false,  // Don't display the category base before
			),
			'show_in_rest'       => true,
		)
	);

	// State -
	register_taxonomy(
		'state',  // The name of the taxonomy. Name should be in slug form (must not contain capital letters or spaces).
		array( 'city', 'faq', 'attorney' ),             // post type name
		array(
			'publicly_queryable' => false,
			'hierarchical'       => true,
			'label'              => 'States', // display name
			'query_var'          => true,
			'rewrite'            => array(
				'slug'       => 'state',    // This controls the base slug that will display before each term
				'with_front' => false,  // Don't display the category base before
			),
			'show_in_rest'       => true,
		)
	);
}
