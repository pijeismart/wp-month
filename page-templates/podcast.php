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
<?php if ( have_rows( 'podcast' ) ) : ?>
<section class="podcasts-grid">
	<div class="container">
		<div class="podcasts-grid__inner">
			<?php
			while ( have_rows( 'podcast' ) ) :
				the_row();
				$title   = get_sub_field( 'title' );
				$youtube = get_sub_field( 'youtube' );
				if ( $youtube ) :
					preg_match( '/src="(.+?)"/', $youtube, $matches );
					$src = $matches[1];
					?>
					<div class="podcast">
						<div class="podcast-video">
							<div class="embed-container">
								<?php echo $youtube; ?>
							</div>
							<a class="podcast-btn" href="<?php echo esc_url( $src ); ?>">
								<img src="<?php echo esc_url( get_template_directory_uri() . '/assets/img/icon-play.svg' ); ?>" alt="Play Podcast">
                            </a>
						</div>
						<?php
						get_template_part_args(
							'template-parts/content-modules-text',
							array(
								'v'  => 'title',
								't'  => 'p',
								'tc' => 'podcast-title',
							)
						);
						?>
					</div>
					<?php
				endif;
				if ( 9 == get_row_index() ) :
					?>
					<div class="podcasts-loadmore d-md-only">
						<button class="underline-link podcasts-loadmore__btn"><?php echo esc_html( 'Load More' ); ?></button>
					</div>
					<?php
				endif;
			endwhile;
			?>
		</div>
	</div>
</section>

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
<?php endif; ?>
<?php
get_footer();
