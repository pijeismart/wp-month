<?php
/**
 * Template Name: Practice Areas
 * Template Post Type: page
 */
get_header();
$states = get_terms( array( 'taxonomy' => 'practice_state' ) );
?>
<!-- Banner -->
<section class="archive-banner has-decor">
	<div class="container">
		<div class="archive-banner__left">
			<?php
			get_template_part_args(
				'template-parts/content-modules-text',
				array(
					'v'  => 'eyebrow',
					't'  => 'h6',
					'tc' => 'h7 archive-banner__subheading a-up',
					'o'  => 'f',
				)
			);
			?>
			<?php
			get_template_part_args(
				'template-parts/content-modules-text',
				array(
					'v'  => 'title',
					't'  => 'h1',
					'tc' => 'archive-banner__heading a-up a-delay-1',
					'o'  => 'f',
				)
			);
			?>
			<?php
			get_template_part_args(
				'template-parts/content-modules-text',
				array(
					'v'  => 'content',
					't'  => 'p',
					'tc' => 'archive-banner__copy a-up a-delay-2',
					'o'  => 'f',
				)
			);
			?>
		</div>
		<?php if ( have_rows( 'related_pages' ) ) : ?>
			<div class="archive-banner__right related-pages-block a-up">
				<h6 class="related-pages-block__heading"><?php echo esc_html__( 'Related Pages' ); ?></h6>
				<ul class="related-pages-block__link">
					<?php
					while ( have_rows( 'related_pages' ) ) :
						the_row();
						?>
						<li>
							<?php
							get_template_part_args(
								'template-parts/content-modules-cta',
								array(
									'v' => 'link',
									'c' => 'link',
								)
							);
							?>
						</li>
					<?php endwhile; ?>
				</ul>
			</div>
		<?php endif; ?>
	</div>
</section>

<section class="section-archive a-up">
	<div class="container">
		<div class="section-archive__sidebar">
			<?php
			if ( $states ) :
				?>
				<div class="section-archive__sidebar__widget">
					<h6 class=""><?php echo esc_html( 'By State' ); ?></h6>
					<div class="section-archive__sidebar__widget__body">
						<?php foreach ( $states as $state ) : ?>
							<button class="section-archive__filter__btn<?php echo ( isset( $_GET['state'] ) && $_GET['state'] == $state->slug ) ? ' is-active' : ''; ?>" 
								data-target="data-state"
								data-state="<?php echo esc_attr( $state->slug ); ?>">
								<?php echo esc_html( $state->name ); ?>
							</button>
						<?php endforeach; ?>
					</div>
				</div>
			<?php endif; ?>
		</div>
		<div class="section-archive__content">
			<div class="section-archive__posts"
				data-posts-per-page="-1" 
				data-post-type="practice" 
				data-state="">
				<?php
				foreach ( $states as $state ) :
					$args  = array(
						'post_type'      => 'practice',
						'post_status'    => 'publish',
						'posts_per_page' => -1,
						'tax_query'      => array(
							array(
								'taxonomy' => 'practice_state',
								'terms'    => $state->term_id,
							),
						),
					);
					$query = new WP_Query( $args );
					if ( $query->have_posts() ) :
						?>
						<div class="loop-state">
							<div class="loop-state__info">
								<h2 class="loop-state__name"><?php echo $state->name; ?></h2>
								<p class="loop-state__desc"><?php echo $state->description; ?></p>
							</div>
							<?php
							while ( $query->have_posts() ) :
								$query->the_post();
								get_template_part( 'template-parts/loop', 'practice-area' );
							endwhile;
							?>
						</div>
						<?php
					endif;
					wp_reset_postdata();
				endforeach;
				?>
			</div>
		</div>
	</div>
</section>
<?php
get_footer();
