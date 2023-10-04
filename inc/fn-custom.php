<?php
/**
 * Custom functions that act independently of the theme templates
 *
 * Eventually, some of the functionality here could be replaced by core features.
 *
 * @package Hades
 */

/**
 * Adds custom classes to the array of body classes.
 *
 * @param array $classes Classes for the body element.
 * @return array
 */
function theme_body_classes( $classes ) {
	// Adds a class of group-blog to blogs with more than 1 published author.
	if ( is_multi_author() ) {
		$classes[] = 'group-blog';
	}

	// Adds a class of hfeed to non-singular pages.
	if ( ! is_singular() ) {
		$classes[] = 'hfeed';
	}

	return $classes;
}
add_filter( 'body_class', 'theme_body_classes' );

// Styling login form
function my_login_stylesheet() {
	wp_enqueue_style( 'custom-login', get_stylesheet_directory_uri() . '/assets/css/style-login.css' );
	// wp_enqueue_script( 'custom-login', get_stylesheet_directory_uri() . '/style-login.js' );
}
add_action( 'login_enqueue_scripts', 'my_login_stylesheet' );


// disable for post types
// add_filter('use_block_editor_for_post_type', '__return_false', 10);
// add_action('init', 'my_remove_editor_from_post_type');
// function my_remove_editor_from_post_type() {
// remove_post_type_support( 'page', 'editor' );
// }

add_post_type_support( 'page', 'excerpt' );

// ** *Enable upload for webp image files.*/
function webp_upload_mimes( $existing_mimes ) {
	$existing_mimes['webp'] = 'image/webp';
	return $existing_mimes;
}
add_filter( 'mime_types', 'webp_upload_mimes' );

// Wp ajax init
add_action( 'wp_head', 'my_wp_ajaxurl' );
function my_wp_ajaxurl() {
	$url = parse_url( home_url() );
	if ( $url['scheme'] == 'https' ) {
		$protocol = 'https';
	} else {
		$protocol = 'http';
	}
	?>
	<?php global $wp_query; ?>
	<script type="text/javascript">
		var ajaxurl = '<?php echo admin_url( 'admin-ajax.php', $protocol ); ?>';
	</script>
	<?php
}
/*
 Disable WordPress Admin Bar for all users */
// add_filter( 'show_admin_bar', '__return_false' );

/**
 * Like get_template_part() put lets you pass args to the template file
 * Args are available in the tempalte as $template_args array
 *
 * @param string $file template file url
 * @param mixed  $template_args style argument list
 * @param mixed  $cache_args cache args
 *  https://wordpress.stackexchange.com/questions/176804/passing-a-variable-to-get-template-part
 */
function get_template_part_args( $file, $template_args = array(), $cache_args = array() ) {
	$template_args = wp_parse_args( $template_args );
	$cache_args    = wp_parse_args( $cache_args );
	if ( $cache_args ) {
		foreach ( $template_args as $key => $value ) {
			if ( is_scalar( $value ) || is_array( $value ) ) {
				$cache_args[ $key ] = $value;
			} elseif ( is_object( $value ) && method_exists( $value, 'get_id' ) ) {
				$cache_args[ $key ] = call_user_func( 'get_id', $value );
			}
		}
		// phpcs:disabled WordPress.PHP.DiscouragedPHPFunctions.serialize_serialize
		$cache = wp_cache_get( $file, serialize( $cache_args ) );
		if ( false !== $cache ) {
			if ( ! empty( $template_args['return'] ) ) {
				return $cache;
			}
			// phpcs:disabled WordPress.Security.EscapeOutput.OutputNotEscaped
			echo $cache;
			return;
		}
	}
	$file_handle = $file;
	do_action( 'start_operation', 'hm_template_part::' . $file_handle );
	if ( file_exists( get_stylesheet_directory() . '/' . $file . '.php' ) ) {
		$file = get_stylesheet_directory() . '/' . $file . '.php';
	} elseif ( file_exists( get_template_directory() . '/' . $file . '.php' ) ) {
		$file = get_template_directory() . '/' . $file . '.php';
	}
	ob_start();
	$return = require $file;
	$data   = ob_get_clean();
	do_action( 'end_operation', 'hm_template_part::' . $file_handle );
	if ( $cache_args ) {
		wp_cache_set( $file, $data, serialize( $cache_args ), 3600 );
	}
	if ( ! empty( $template_args['return'] ) ) {
		if ( false === $return ) {
			return false;
		} else {
			return $data;
		}
	}
	echo $data;
}

/**
 * Get child menu items
 *
 * @param id      $parent_id parent menu id
 * @param array   $nav_menu_items nav menu items array
 * @param boolean $depth
 */
function get_nav_menu_item_children( $parent_id, $nav_menu_items, $depth = true ) {
	$nav_menu_item_list = array();
	foreach ( (array) $nav_menu_items as $nav_menu_item ) {
		if ( $nav_menu_item->menu_item_parent == $parent_id ) {
			$nav_menu_item_list[] = $nav_menu_item;
			if ( $depth ) {
				if ( $children = get_nav_menu_item_children( $nav_menu_item->ID, $nav_menu_items ) ) {
					$nav_menu_item_list = array_merge( $nav_menu_item_list, $children );
				}
			}
		}
	}
	return $nav_menu_item_list;
}

if ( !function_exists( 'custom_mega_menu' ) ) {
	/**
	 * Create custom mega menu
	 *
	 * @param string $theme_location Theme location
	 */
	function custom_mega_menu( $theme_location ) {

		if ( ( $theme_location ) && ( $locations = get_nav_menu_locations() ) && isset( $locations[ $theme_location ] ) ) {

			$menu_list = '';
			$post_id   = get_the_ID();

			$menu       = get_term( $locations[ $theme_location ], 'nav_menu' );
			$menu_items = wp_get_nav_menu_items( $menu->term_id );

			foreach ( $menu_items as $menu_item ) {
				$id = get_post_meta( $menu_item->ID, '_menu_item_object_id', true );

				$is_cpt_menu = get_field( 'is_cpt_menu', $menu_item );

				if ( ! $menu_item->menu_item_parent ) {
					$curr_id     = $menu_item->ID;
					$menu_items2 = get_nav_menu_item_children( $curr_id, $menu_items );

					if ( $menu_items2 || $is_cpt_menu ) {
						$menu_list .= '<li class="menu-item menu-item-has-children' . ( $is_cpt_menu ? ' menu-item--' . get_field( 'source', $menu_item ) : '' ) . '">' . "\n";
					} else {
						$menu_list .= '<li class="menu-item' . ( ( $id == $post_id ) ? ' current-menu-item' : '' ) . '">' . "\n";
					}

					$menu_list .= '<a href="' . $menu_item->url . '">' . $menu_item->title . '</a>' . "\n";

					if ( $menu_items2 ) {
						$menu_list .= '<ul class="sub-menu sub-menu-cpt">' . "\n";
						$menu_list .= '<li class="menu-item sub-menu-top sub-menu-top-v2">';
						$menu_list .= '<button class="sub-menu-back">' . esc_html__( 'Back' ) . '</button>';
						$menu_list .= '<a href="' . $menu_item->url . '" class="parent-menu-text">' . $menu_item->title . '</a></li>';
						foreach ( $menu_items2 as $menu_item2 ) {
							if ( $menu_item2->menu_item_parent == $curr_id ) {
								$curr_id2 = $menu_item2->ID;
								$menu_items3 = get_nav_menu_item_children( $curr_id2, $menu_items );

								if ( $menu_items3 ) {
									$menu_list .= '<li class="menu-item menu-item-has-children">';
								} else {
									$menu_list .= '<li class="menu-item">';
								}
								$menu_list .= '<a href="' . $menu_item2->url . '">' . $menu_item2->title . '</a>';

								if ( $menu_items3 ) {
									$menu_list .= '<ul class="sub-menu">';
									$menu_list .= '<li class="menu-item sub-menu-top">';
									$menu_list .= '<button class="sub-menu-back">' . esc_html__( 'Back' ) . '</button>';
									$menu_list .= '<a href="' . $menu_item2->url . '" class="parent-menu-text">' . $menu_item2->title . '</a></li>';
									foreach ( $menu_items3 as $menu_item3 ) {
										$menu_list .= '<li>';
										$menu_list .= '<a href="' . $menu_item3->url . '">' . $menu_item3->title . '</a>';
										$menu_list .= '</li>';
									}

									$menu_list .= '</ul>';
								}

								$menu_list .= '</li>' . "\n";
							}
						}

						$menu_list .= '</ul>';
					}

					if ( $is_cpt_menu ) {
						$menu_list .= '<ul class="sub-menu sub-menu-cpt">' . "\n";
						$menu_list .= '<li class="menu-item sub-menu-top sub-menu-top-v2">';
						$menu_list .= '<button class="sub-menu-back">' . esc_html__( 'Back' ) . '</button>';
						$menu_list .= '<a href="' . $menu_item->url . '" class="parent-menu-text">' . $menu_item->title . '</a></li>';
						$source = get_field( 'source', $menu_item );
						$args = array(
							'post_type'      => $source,
							'post_status'    => 'publish',
							'posts_per_page' => -1,
							'post_parent'    => 0,
							'order'          => 'ASC',
							'orderby'        => 'title',
						);
						$parent_query = new WP_Query( $args );
						if ( $parent_query->have_posts() ) {
							while ( $parent_query->have_posts() ) {
								$parent_query->the_post();
								$child_query = new WP_Query(
									array (
										'post_type'      => $source,
										'post_status'    => 'publish',
										'posts_per_page' => -1,
										'post_parent'    => get_the_ID(),
										'order'          => 'ASC',
										'orderby'        => 'title',
									)
								);
								if ( $child_query->have_posts() ) {
									$menu_list .= '<li class="menu-item menu-item-has-children"><a href="' . get_the_permalink( ) . '">' . get_the_title() . '</a>';
									$menu_list .= '<ul class="sub-menu">';
									$menu_list .= '<li class="menu-item sub-menu-top">';
									$menu_list .= '<button class="sub-menu-back">' . esc_html__( 'Back' ) . '</button>';
									$menu_list .= '<a href="' . get_the_permalink() . '" class="parent-menu-text">' . get_the_title() . '</a></li>';
									while ( $child_query->have_posts() ) {
										$child_query->the_post();
										$menu_list .= '<li class="menu-item"><a href="' . get_the_permalink( ) . '">' . get_the_title() . '</a></li>';
									}
									$menu_list .= '</ul></li>';
								} else {
									$menu_list .= '<li class="menu-item"><a href="' . get_the_permalink( ) . '">' . get_the_title() . '</a></li>';
								}
								wp_reset_postdata();
							}
						}
						wp_reset_postdata();

						$menu_list .= '</ul>';
					}

					$menu_list .= '</li>' . "\n";

				}
			}
		}
		echo $menu_list;
	}
}


/**
 * Show Author role column in people list page in admin
 */
add_filter( 'manage_posts_columns', 'set_custom_edit_case_result_columns' );
add_action( 'manage_posts_custom_column', 'custom_case_result_column', 10, 2 );

function set_custom_edit_case_result_columns( $columns ) {
	unset( $columns['type'] );
	unset( $columns['category'] );
	$columns['category'] = __( 'Case Category', 'am' );
	$columns['type']     = __( 'Claim Type', 'am' );
	return $columns;
}

function custom_case_result_column( $column, $post_id ) {
	switch ( $column ) {

		case 'category':
			$terms = get_the_term_list( $post_id, 'case_category', '', ',', '' );
			if ( is_string( $terms ) ) {
				echo $terms;
			} else {
				_e( 'Unable to get category', 'am' );
			}
			break;

		case 'type':
			$terms = get_the_term_list( $post_id, 'claim_type', '', ',', '' );
			if ( is_string( $terms ) ) {
				echo $terms;
			} else {
				_e( 'Unable to get type', 'am' );
			}
			break;
	}
}

function search_by_title_only( $search, $wp_query ) {
	if ( ! empty( $search ) && ! empty( $wp_query->query_vars['search_terms'] ) ) {
		global $wpdb;

		$q      = $wp_query->query_vars;
		$n      = ! empty( $q['exact'] ) ? '' : '%';
		$search = array();

		foreach ( (array) $q['search_terms'] as $term ) {
			$search[] = $wpdb->prepare( "$wpdb->posts.post_title LIKE %s", $n . $wpdb->esc_like( $term ) . $n );
		}

		if ( ! is_user_logged_in() ) {
			$search[] = "$wpdb->posts.post_password = ''";
		}

		$search = ' AND ' . implode( ' AND ', $search );
	}

	return $search;
}
add_filter( 'posts_search', 'search_by_title_only', 10, 2 );

/**
 * load ajax cpt handler
 */
add_action( 'wp_ajax_ajax_cpt', 'ajax_cpt' );
add_action( 'wp_ajax_nopriv_ajax_cpt', 'ajax_cpt' );
function ajax_cpt() {
	$paged          = $_POST['paged'] ? $_POST['paged'] : 1;
	$type           = $_POST['post_type'] ? $_POST['post_type'] : 'post';
	$posts_per_page = $_POST['posts_per_page'] ? $_POST['posts_per_page'] : 12;
	$cat            = $_POST['cat'];
	$case_cat       = $_POST['caseCat'];
	$state          = $_POST['state'];
	$s              = $_POST['s'];
	$theme          = $_POST['type'] ? '-' . $_POST['type'] : '';
	$args           = array(
		'post_type'      => $type,
		'posts_per_page' => $posts_per_page,
		'paged'          => $paged,
	);
	if ( $s ) {
		$args['s'] = $s;
	}
	if ( $cat ) {
		$args['cat'] = $cat;
	}
	$args['tax_query']['relation'] = 'AND';
	if ( $case_cat ) {
		$args['tax_query'][] = array(
			'taxonomy' => 'case_category',
			'field'    => 'slug',
			'terms'    => $case_cat,
		);
	}
	if ( $state ) {
		$args['tax_query'][] = array(
			'taxonomy' => 'state',
			'field'    => 'slug',
			'terms'    => $state,
		);
	}
	if ( 'attorney' == $type ) {
		$args['orderby'] = 'menu_order';
	}
	$query = new WP_Query( $args );
	if ( $query->have_posts() ) :
		ob_start();
		while ( $query->have_posts() ) :
			$query->the_post();
			get_template_part( 'template-parts/loop', $type . $theme );
		endwhile;
	else :
		echo '<h2 class="no-results">No results.</h2>';
	endif;
	$res         = new \stdClass();
	$res->output = ob_get_clean();
	if ( $query->max_num_pages > $paged ) :
		$res->show_loadmore = true;
	endif;
	if ( $query->max_num_pages > 1 ) :
		ob_start();
		?>
		<button class="link prev-posts"<?php echo $paged == 1 ? ' disabled' : ''; ?>><?php echo esc_html__( 'Previous' ); ?></button>
		<div class="slider-pagination">
			<span class="current-page-num"><?php echo esc_html( $paged ); ?></span> / <span class="max-page-num"><?php echo esc_html( $query->max_num_pages ); ?></span>
		</div>
		<button class="link next-posts"<?php echo $paged == $query->max_num_pages ? ' disabled' : ''; ?>><?php echo esc_html__( 'Next' ); ?></button>
		<?php
		$res->pagination = ob_get_clean();
	endif;
	wp_reset_postdata();
	echo wp_json_encode( $res );
	wp_die();
}


/**
 * Extract youtube URL and than get preview image and save as featured image
 */
function set_youtube_as_featured_image( $post_id, $post, $update ) {
	global $post;
	$p_type = get_post_type( $post );
	if ( ( ! defined( 'DOING_AUTOSAVE' ) || ! DOING_AUTOSAVE ) && ( 'video' == $p_type ) ) {
		if ( ! has_post_thumbnail( $post ) ) {
			$youtube_video_id = get_field( 'youtube_video_id', $post_id );

			$youtube_thumb_url = 'https://img.youtube.com/vi/' . $youtube_video_id . '/hqdefault.jpg';
			$get               = wp_remote_get( $youtube_thumb_url );
			$mime_type         = wp_remote_retrieve_header( $get, 'content-type' );
			if ( ! substr_count( $mime_type, 'image' ) ) {
				return false;
			}
			$name = 'youtube-thumb-post-' . $post_id . '.jpg';
			$bits = wp_upload_bits( $name, '', wp_remote_retrieve_body( $get ) );
			if ( $bits['error'] ) {
				return false;
			}
			// save attachment post, and setting as post thumbnails
			$thumb_data   = array(
				'post_title'     => $post->post_title . ' - Video Image',
				'post_mime_type' => $mime_type,
			);
			$thumbnail_id = wp_insert_attachment( $thumb_data, $bits['file'], $post_id );
			if ( $thumbnail_id ) {
				require_once ABSPATH . 'wp-admin/includes/image.php';
				$metadata = wp_generate_attachment_metadata( $thumbnail_id, $bits['file'] );
				wp_update_attachment_metadata( $thumbnail_id, $metadata );
				set_post_thumbnail( $post, $thumbnail_id );
			}
		}
	}
}

// set featured image and set or publish post
add_action( 'save_post', 'set_youtube_as_featured_image', 10, 3 );

// extract youtube id from url
function get_youtube_image_from_url( $url ) {
	preg_match( '%(?:youtube(?:-nocookie)?\.com/(?:[^/]+/.+/|(?:v|e(?:mbed)?)/|.*[?&]v=)|youtu\.be/)([^"&?/ ]{11})%i', $url, $match );
	$youtube_id        = $match[1];
	$youtube_thumb_url = 'https://img.youtube.com/vi/' . $youtube_id . '/hqdefault.jpg';
	return $youtube_thumb_url;
}

// year shortcode
add_shortcode( 'year', 'montlick_year' );
function montlick_year( $atts ) {
	$year = get_field( 'montlick_year', 'options' );
	return $year;
}

/**
 * Enable Shortcode excerpt
 */
add_filter( 'the_excerpt', 'do_shortcode' );
remove_filter( 'get_the_excerpt', 'wp_trim_excerpt', 10 );
add_filter( 'get_the_excerpt', 'my_custom_wp_trim_excerpt', 99, 1 );
function my_custom_wp_trim_excerpt( $text ) {
	if ( '' == $text ) {
		$text = preg_replace( '/\s/', ' ', wp_strip_all_tags( get_the_content( '' ) ) );
		$text = explode( ' ', $text, 56 );
		array_pop( $text );
		$text = implode( ' ', $text );
	}
	return $text;
}

if ( ! function_exists( 'am_get_the_post_thumbnail' ) ) {
	/***
	 * Get post thumbnail, if not exist it grabs default image from case_category or claim_type gallery
	 */
	function am_get_the_post_thumbnail( $size = 'post-thumbnail' ) {
		global $post;
		if ( has_post_thumbnail() ) {
			return get_the_post_thumbnail_url( $post, $size );
		} else {
			$case_categories = get_the_terms( $post, 'case_category' );
			$date            = get_post_timestamp( $post );
			$timestamp       = intval( substr( $date, 3, 3 ) );
			if ( $case_categories ) {
				foreach ( $case_categories as $case_category ) {
					$images = get_field( 'default_post_images', 'case_category_' . $case_category->term_id );
					if ( $images ) {
						$index = $timestamp % count( $images );
						return $images[ $index ]['url'];
					}
				}
			}
		}
	}
}

// ignore custom post type order plugin
add_filter('pto/posts_orderby/ignore', 'theme_pto_posts_orderby', 10, 3);
function theme_pto_posts_orderby($ignore, $orderBy, $query) {
	if( (! is_array($query->query_vars['post_type']) && $query->query_vars['post_type'] == 'practice') || 
			(is_array($query->query_vars)   &&  in_array('practice', $query->query_vars)))
			$ignore = TRUE;
	return $ignore;
}

// add custom body class from ACF
add_filter( 'body_class', 'am_body_class' );
function am_body_class( $classes ) {
	$classes[] = get_field( 'body_class' );
	if ( ( is_singular( 'practice' ) || is_singular( 'city' ) ) &&  ( isset( $_GET['trac'] ) && 'campaign' == $_GET['trac'] ) ) {
		$classes[] = 'is-campaign';
	}
	
	// Get query param injury_claim on contact page
	$injury_claim = isset( $_GET['injury_claim'] ) ? $_GET['injury_claim'] : false;
	if ( $injury_claim ) {
		$params = array();
		if ( have_rows( 'modules' ) ) :
			while ( have_rows( 'modules' ) ) :
				the_row();
				if ( 'contact' == get_row_layout() ) {
					if ( have_rows( 'dynamic_banners' ) ) :
						while ( have_rows( 'dynamic_banners' ) ) :
							the_row();
							$params[] = get_sub_field( 'parameter' );
						endwhile;
					endif;
				}
			endwhile;
		endif;
		if ( in_array( $injury_claim, $params ) ) {
			$classes[] = 'injury-claim';
		}
	}
	return $classes;
}