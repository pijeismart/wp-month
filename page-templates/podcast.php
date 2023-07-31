<?php
/**
 * Template Name: Podcast
 * Template Post Type: page
 */

get_header();
?>
<!-- Podcast Banner -->
<section class="podcast-banner">
	<div class="container">
		<div class="podcast-banner__inner">
			<div class="podcast-banner__left">
				<?php
				get_template_part_args(
					'template-parts/content-modules-text',
					array(
						'v'  => 'sub_heading',
						't'  => 'h6',
						'tc' => 'h7 podcast-banner__subheading a-up',
						'o'  => 'f',
					)
				);
				?>
				<?php
				get_template_part_args(
					'template-parts/content-modules-text',
					array(
						'v'  => 'heading',
						't'  => 'h1',
						'tc' => 'podcast-banner__heading a-up a-delay-1',
						'o'  => 'f',
					)
				);
				?>
				<?php
				get_template_part_args(
					'template-parts/content-modules-text',
					array(
						'v'  => 'content',
						't'  => 'div',
						'tc' => 'podcast-banner__content a-up a-delay-2',
						'o'  => 'f',
					)
				);
				?>
			</div>
			<?php
			get_template_part_args(
				'template-parts/content-modules-image',
				array(
					'v'     => 'image',
					'v2x'   => false,
					'is'    => false,
					'is_2x' => false,
					'w'     => 'div',
					'wc'    => 'podcast-banner__img d-md-only',
					'o'     => 'f',
				)
			);
			?>
		</div>
	</div>
</section>

<!-- Social Section -->
<section class="podcast-share">
	<div class="container">
		<div class="podcast-share__content">
			<?php
			get_template_part_args(
				'template-parts/content-modules-text',
				array(
					'v'  => 's2_heading',
					't'  => 'h2',
					'tc' => 'podcast-share__heading a-up',
					'o'  => 'f',
				)
			);
			?>
			<?php
			get_template_part_args(
				'template-parts/content-modules-text',
				array(
					'v'  => 's2_content',
					't'  => 'div',
					'tc' => 'podcast-share__content a-up a-delay-1',
					'o'  => 'f',
				)
			);
			?>
		</div>
		<?php
		get_template_part_args(
			'template-parts/content-modules-image',
			array(
				'v'     => 's2_image',
				'v2x'   => false,
				'is'    => false,
				'is_2x' => false,
				'w'     => 'div',
				'wc'    => 'podcast-share__image',
				'o'     => 'f',
			)
		);
		?>
		<?php if ( have_rows( 's2_links' ) ) : ?>
		<div class="podcast-share__links">
			<?php
			while ( have_rows( 's2_links' ) ) :
				the_row();
				$icon = get_sub_field( 'icon' );
				$link = get_sub_field( 'link' );
				if ( $link ) :
					?>
					<a href="<?php echo esc_url( $link['url'] ); ?>" class="podcast-share__link" target="<?php echo esc_attr( $link['target'] ? $link['target'] : '_self' ); ?>">
						<?php if ( $icon ) : ?>
							<img src="<?php echo esc_url( $icon['url'] ); ?>" alt="<?php echo esc_attr( $icon['alt'] ); ?>" class="podcast-share__link__icon">
						<?php endif; ?>
						<?php echo esc_html( $link['title'] ); ?>
					</a>
					<?php
				endif;
			endwhile;
			?>
		</div>
		<?php endif; ?>
	</div>
</section>

<!-- Podcasts -->
<?php
$posts_per_page = get_field( 'posts_per_page' ) ? get_field( 'posts_per_page' ) : 9;
$args           = array(
	'post_type'      => 'video',
	'posts_per_page' => $posts_per_page,
	'post_status'    => 'publish',
);
$query          = new WP_Query( $args );
if ( $query->have_posts() ) :
	?>
	<section class="podcasts-grid">
		<div class="container">
			<div class="podcasts-grid__inner section-archive__posts" 
				data-post-type="video" 
				data-posts-per-page="<?php echo esc_attr( $posts_per_page ); ?>" 
				data-paged="1">
				<?php
				while ( $query->have_posts() ) :
					$query->the_post();
					get_template_part( 'template-parts/loop', 'video' );
				endwhile;
				?>
			</div>
			<?php if ( $query->max_num_pages > 1 ) : ?>
				<div class="podcasts-loadmore d-md-only cpt-load-more">
					<button class="underline-link podcasts-loadmore__btn cpt-load-more-btn"><?php echo esc_html( 'Load More' ); ?></button>
				</div>
			<?php endif; ?>
		</div>
	</section>
	<?php
endif;
wp_reset_postdata();
?>

<!-- Content Image -->
<section class="p-content-image">
	<div class="container">
		<?php
		get_template_part_args(
			'template-parts/content-modules-image',
			array(
				'v'     => 's4_image',
				'v2x'   => false,
				'is'    => false,
				'is_2x' => false,
				'w'     => 'div',
				'wc'    => 'p-content-image__image',
				'o'     => 'f',
			)
		);
		?>
		<div class="p-content-image__content">
			<?php
			get_template_part_args(
				'template-parts/content-modules-text',
				array(
					'v'  => 's4_heading',
					't'  => 'h2',
					'tc' => 'p-content-image__heading a-up',
					'o'  => 'f',
				)
			);
			?>
			<?php
			get_template_part_args(
				'template-parts/content-modules-text',
				array(
					'v'  => 's4_content',
					't'  => 'div',
					'tc' => 'p-content-image__copy a-up a-delay-1',
					'o'  => 'f',
				)
			);
			?>
		</div>
	</div>
</section>
<?php
get_footer();
