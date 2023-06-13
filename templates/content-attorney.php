<?php
/**
 * Attorney Single
 */

// Get custom taxonomies
$claim_type     = get_the_terms( $post, 'claim_type' );
$claim_type_ids = wp_list_pluck( $claim_type, 'term_id' );

$case_cat     = get_the_terms( $post, 'case_category' );
$case_cat_ids = wp_list_pluck( $case_cat, 'term_id' );

// create queries
$tax_query = array(
	'relation' => 'OR',
	array(
		'taxonomy' => 'case_category',
		'terms'    => $case_cat_ids,
	),
	array(
		'taxonomy' => 'claim_type',
		'terms'    => $claim_type_ids,
	),
);

// Get fields
$education                             = get_field( 'education' );
$office                                = get_field( 'office' );
$community_activities                  = get_field( 'community_activities' );
$publications_and_speaking_engagements = get_field( 'publications_and_speaking_engagements' );
$professional_affiliations_and_awards  = get_field( 'professional_affiliations_and_awards' );
?>
<!-- Attorney Banner -->
<section class="attorney-banner has-decor">
	<div class="container">
		<?php if ( has_post_thumbnail() ) : ?>
			<div class="attorney-banner__img">
				<?php the_post_thumbnail(); ?>
			</div>
		<?php endif; ?>
		<div class="attorney-banner__content">
			<div class="attorney-banner__meta a-up">
				<?php
				get_template_part_args(
					'template-parts/content-modules-text',
					array(
						'v'  => 'attorney_title',
						't'  => 'h6',
						'tc' => 'h7',
						'o'  => 'f',
					)
				);
				?>
				<h1 class="h7 attorney-banner__title"><?php the_title(); ?></h1>
			</div>
			<?php
			get_template_part_args(
				'template-parts/content-modules-text',
				array(
					'v'  => 'banner_heading',
					't'  => 'h2',
					'tc' => 'attorney-banner__quote a-up a-delay-1',
					'o'  => 'f',
				)
			);
			?>
			<?php
			get_template_part_args(
				'template-parts/content-modules-text',
				array(
					'v'  => 'banner_content',
					't'  => 'div',
					'tc' => 'attorney-banner__copy a-up a-delay-2',
					'o'  => 'f',
				)
			);
			?>
			<?php if ( have_rows( 'attorney_links', 'options' ) ) : ?>
				<div class="attorney-banner__links">
					<?php
					while ( have_rows( 'attorney_links', 'options' ) ) :
						the_row();
						get_template_part_args(
							'template-parts/content-modules-cta',
							array(
								'v' => 'link',
								'c' => 'attorney-banner__link',
							)
						);
					endwhile;
					?>
				</div>
			<?php endif; ?>
		</div>
	</div>
</section>

<!-- Attorney Details -->
<section class="attorney-details">
	<div class="container attorney-details__inner">
		<div class="attorney-details__sidebar">
			<?php if ( $office ) : ?>
			<div class="sidebar-widget">
				<h6><?php echo esc_html( 'Office Locations' ); ?></h6>
				<div class="sidebar-widget__content">
					<?php echo $office; ?>
				</div>
			</div>
			<?php endif; ?>
			<?php if ( $education ) : ?>
			<div class="sidebar-widget">
				<h6><?php echo esc_html( 'Education' ); ?></h6>
				<div class="sidebar-widget__content">
					<?php echo $education; ?>
				</div>
			</div>
			<?php endif; ?>
			<?php if ( $community_activities ) : ?>
			<div class="sidebar-widget">
				<h6><?php echo esc_html( 'Community Activities' ); ?></h6>
				<div class="sidebar-widget__content">
					<?php echo $community_activities; ?>
				</div>
			</div>
			<?php endif; ?>
			<?php if ( $publications_and_speaking_engagements ) : ?>
			<div class="sidebar-widget">
				<h6><?php echo esc_html( 'Publications and Speaking Engagements' ); ?></h6>
				<div class="sidebar-widget__content">
					<?php echo $publications_and_speaking_engagements; ?>
				</div>
			</div>
			<?php endif; ?>
			<?php if ( $professional_affiliations_and_awards ) : ?>
			<div class="sidebar-widget">
				<h6><?php echo esc_html( 'Professional Affiliations & Awards' ); ?></h6>
				<div class="sidebar-widget__content">
					<?php echo $professional_affiliations_and_awards; ?>
				</div>
			</div>
			<?php endif; ?>
		</div>
		<div class="attorney-details__content">
			<?php the_content(); ?>
		</div>
	</div>
</section>


<!-- Related Posts -->
<?php
$args  = array(
	'post_type'      => 'post',
	'post_status'    => 'publish',
	'posts_per_page' => 5,
	'tax_query'      => $tax_query,
);
$query = new WP_Query( $args );
?>
<section class="posts-slider related-posts">
	<div class="container">
		<div class="posts-slider__content">
			<h3 class="posts-slider__heading a-up"><?php echo esc_html( 'Blog and News Section' ); ?></h3>
		</div>
		<?php if ( $query->have_posts() ) : ?>
			<div class="posts-slider__right">
				<div class="posts-slider__carousel">
					<?php
					while ( $query->have_posts() ) :
						$query->the_post();
						get_template_part( 'template-parts/loop', 'post-card' );
					endwhile;
					?>
				</div>
			</div>
			<?php
		endif;
		wp_reset_postdata();
		?>
	</div>
</section>

