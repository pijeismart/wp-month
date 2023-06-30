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
				<a href="<?php echo esc_url( home_url( '/attorney/' ) ); ?>" class="h7">
					<?php echo esc_html__( 'Attorneys' ); ?>
				</a>
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
			<?php
			get_template_part_args(
				'template-parts/content-modules-text',
				array(
					'v'  => 'description',
					't'  => 'p',
					'tc' => 'attorney-banner__desc d-md-only a-up a-delay-3',
					'o'  => 'f',
				)
			);
			?>
		</div>
	</div>
</section>

<?php if ( have_rows( 'awards' ) ) : ?>
	<!-- Awards -->
	<section class="attorney-awards">
		<div class="container">
			<h6 class="attorney-awards__heading a-up"><?php echo esc_html__( 'Professional Affiliations & Awards' ); ?></h6>
			<div class="attorney-awards__arrows a-up a-delay-1">
				<button class="attorney-awards__arrow prev">
					<svg width="15" height="13" viewBox="0 0 15 13" fill="none" xmlns="http://www.w3.org/2000/svg">
						<path d="M1.15625 7.34375L6.34375 12.8438C6.4375 12.9688 6.59375 13 6.71875 13C6.84375 13 6.96875 12.9688 7.0625 12.875C7.28125 12.6875 7.28125 12.375 7.09375 12.1875L2.71875 7.5H14.5C14.7812 7.5 15 7.28125 15 7.03125C15 6.78125 14.7812 6.5 14.5 6.5H2.71875L7.09375 1.84375C7.28125 1.65625 7.28125 1.34375 7.0625 1.15625C6.84375 0.96875 6.53125 0.96875 6.34375 1.1875L1.15625 6.6875C0.96875 6.875 0.96875 7.15625 1.15625 7.34375Z" fill="#8DCB7E"/>
					</svg>
				</button>
				<button class="attorney-awards__arrow next">
					<svg width="15" height="13" viewBox="0 0 15 13" fill="none" xmlns="http://www.w3.org/2000/svg">
						<path d="M13.8438 7.34375L8.65625 12.8438C8.5625 12.9688 8.40625 13 8.28125 13C8.15625 13 8.03125 12.9688 7.9375 12.875C7.71875 12.6875 7.71875 12.375 7.90625 12.1875L12.2812 7.5H0.5C0.21875 7.5 0 7.28125 0 7.03125C0 6.78125 0.21875 6.5 0.5 6.5H12.2812L7.90625 1.84375C7.71875 1.65625 7.71875 1.34375 7.9375 1.15625C8.15625 0.96875 8.46875 0.96875 8.65625 1.1875L13.8438 6.6875C14.0312 6.875 14.0312 7.15625 13.8438 7.34375Z" fill="#8DCB7E"/>
					</svg>
				</button>
			</div>
			<div class="attorney-awards__carousel__wrapper a-up a-delay-1">
				<div class="attorney-awards__carousel d-sm-only">
					<?php
					while ( have_rows( 'awards' ) ) :
						the_row();
						$type = get_sub_field( 'type' );
						if ( 'award' == $type ) :
							?>
							<?php
							get_template_part_args(
								'template-parts/content-modules-image',
								array(
									'v'     => 'award',
									'v2x'   => false,
									'is'    => false,
									'is_2x' => false,
									'w'     => 'div',
									'wc'    => 'attorney-awards__slide attorney-awards__slide--award',
								)
							);
							?>
							<?php
						elseif ( 'affiliation' == $type ) :
							$affiliation = get_sub_field( 'affiliation' );
							if ( $affiliation ) :
								?>
								<div class="attorney-awards__slide attorney-awards__slide--affiliation">
									<img src="<?php echo esc_url( get_template_directory_uri() . '/assets/img/icon-favicon.svg' ); ?>" alt="">
									<p><?php echo $affiliation; ?></p>
								</div>
							<?php endif; ?>
						<?php endif; ?>
					<?php endwhile; ?>
				</div>
				<div class="attorney-awards__carousel d-md-only">
					<?php
					while ( have_rows( 'awards' ) ) :
						the_row();
						$type = get_sub_field( 'type' );
						if ( 'award' == $type ) :
							?>
							<?php
							get_template_part_args(
								'template-parts/content-modules-image',
								array(
									'v'     => 'award',
									'v2x'   => false,
									'is'    => false,
									'is_2x' => false,
									'w'     => 'div',
									'wc'    => 'attorney-awards__slide attorney-awards__slide--award',
								)
							);
							?>
							<?php
						elseif ( 'affiliation' == $type ) :
							$affiliation = get_sub_field( 'affiliation' );
							if ( $affiliation ) :
								?>
								<div class="attorney-awards__slide attorney-awards__slide--affiliation">
									<img src="<?php echo esc_url( get_template_directory_uri() . '/assets/img/icon-favicon.svg' ); ?>" alt="">
									<p><?php echo $affiliation; ?></p>
								</div>
							<?php endif; ?>
						<?php endif; ?>
					<?php endwhile; ?>
				</div>
			</div>
		</div>
	</section>
<?php endif; ?>

<!-- Attorney Details -->
<section class="attorney-details">
	<div class="container attorney-details__inner">
		<div class="attorney-details__sidebar">
			<?php if ( $office ) : ?>
			<!-- <div class="sidebar-widget">
				<h6><?php echo esc_html( 'Office Locations' ); ?></h6>
				<div class="sidebar-widget__content">
					<?php echo $office; ?>
				</div>
			</div> -->
			<?php endif; ?>
			<?php if ( $education ) : ?>
			<div class="sidebar-widget accordion">
				<div class="accordion-header"><h6><?php echo esc_html( 'Education' ); ?></h6></div>
				<div class="sidebar-widget__content accordion-body">
					<?php echo $education; ?>
				</div>
			</div>
			<?php endif; ?>
			<?php if ( $community_activities ) : ?>
			<div class="sidebar-widget accordion">
				<div class="accordion-header"><h6><?php echo esc_html( 'Community Activities' ); ?></h6></div>
				<div class="sidebar-widget__content accordion-body">
					<?php echo $community_activities; ?>
				</div>
			</div>
			<?php endif; ?>
			<?php if ( $publications_and_speaking_engagements ) : ?>
			<div class="sidebar-widget accordion">
				<div class="accordion-header"><h6><?php echo esc_html( 'Publications and Speaking Engagements' ); ?></h6></div>
				<div class="sidebar-widget__content accordion-body">
					<?php echo $publications_and_speaking_engagements; ?>
				</div>
			</div>
			<?php endif; ?>
			<?php if ( $professional_affiliations_and_awards ) : ?>
			<div class="sidebar-widget accordion">
				<div class="accordion-header"><h6><?php echo esc_html( 'Professional Affiliations & Awards' ); ?></h6></div>
				<div class="sidebar-widget__content accordion-body">
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

