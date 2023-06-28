<?php
/**
 * Post Slider Section
 */

$o = $args['option'] ? $args['option'] : 's';

$source        = 'f' == $o ? get_field( 'content_type' ) : get_sub_field( 'content_type' );
$claim_type    = 'f' == $o ? get_field( 'claim_type' ) : get_sub_field( 'claim_type' );
$case_category = 'f' == $o ? get_field( 'case_category' ) : get_sub_field( 'case_category' );
$custom_posts  = 'f' == $o ? get_field( 'custom_posts' ) : get_sub_field( 'custom_posts' );

$toc_title = get_sub_field( 'toc_title' );
$anchor_id = $toc_title ? str_replace( ' ', '-', strtolower( $toc_title ) ) : get_sub_field( 'anchor_id' );

if ( 'custom' != $source ) :
	$args = array(
		'post_type'      => 'post',
		'posts_per_page' => 10,
		'post_status'    => 'publish',
	);
	if ( 'case_category' == $source && $case_category ) :
		$args['tax_query'] = array(
			'taxonomy' => 'case_category',
			'terms'    => $case_category,
		);
	endif;
	if ( 'claim_type' == $source && $claim_type ) :
		$args['tax_query'] = array(
			'taxonomy' => 'claim_type',
			'terms'    => $claim_type,
		);
	endif;
else :
	if ( $custom_posts ) :
		$args = array(
			'post_type'      => 'post',
			'posts_per_page' => -1,
			'post_status'    => 'publish',
			'post__in'       => $custom_posts,
		);
	endif;
endif;
$query = new WP_Query( $args );
if ( $query->have_posts() ) :
	?>
<!-- Posts -->
<section class="posts-slider"<?php echo $anchor_id ? ' id="' . esc_attr( $anchor_id ) . '"' : ''; ?>>
	<div class="container">
		<div class="posts-slider__content">
			<?php
			get_template_part_args(
				'template-parts/content-modules-text',
				array(
					'v'  => 'c2_heading',
					't'  => 'h3',
					'tc' => 'posts-slider__heading a-up',
					'o'  => 'o',
				)
			);
			?>
			<?php
			get_template_part_args(
				'template-parts/content-modules-text',
				array(
					'v'  => 'c2_content',
					't'  => 'div',
					'tc' => 'posts-slider__copy a-up a-delay-1',
					'o'  => 'o',
				)
			);
			?>
			<?php
			get_template_part_args(
				'template-parts/content-modules-cta',
				array(
					'v' => 'c2_cta',
					'c' => 'link a-up a-delay-2',
					'o' => 'o',
				)
			);
			?>
		</div>
		<div class="posts-slider__right">
			<div class="posts-slider__carousel">
				<?php
				while ( $query->have_posts() ) :
					$query->the_post();
					get_template_part( 'template-parts/loop', 'post-card' );
				endwhile;
				?>
			</div>
			<div class="slider-controls d-md-only">
				<div class="slider-pagination">1 / 2</div>
				<button class="link slider-next" tabindex="0">Next</button>
			</div>
		</div>
	</div>
</section>
	<?php
endif;
wp_reset_postdata();
