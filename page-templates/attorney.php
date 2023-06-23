<?php
/**
 * Template Name: Attorney
 * Template Post Type: page
 */

get_header();
$video = get_field( 'video' );
?>
<section class="archive-attorney has-decor">
	<div class="container">
		<div class="archive-attorney__content">
			<?php
			get_template_part_args(
				'template-parts/content-modules-text',
				array(
					'v'  => 'sub_heading',
					't'  => 'h6',
					'tc' => 'h7 archive-attorney__subheading a-up',
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
					'tc' => 'archive-attorney__heading a-up a-delay-1',
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
					'tc' => 'archive-attorney__copy a-up a-delay-2',
					'o'  => 'f',
				)
			);
			?>
		</div>
		<?php if ( $video ) : ?>
		<div class="archive-attorney__video object-cover">
			<video src="<?php echo esc_url( $video ); ?>" loop muted playsinline autoplay preload="metadata">
				<source src="<?php echo esc_url( $video ); ?>" type="video/mp4">
			</video>
		</div>
		<?php endif; ?>
		<?php if ( have_rows( 'related_pages' ) ) : ?>
			<div class="archive-attorney__links related-pages-block a-up">
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

<?php
$community = get_field( 'community' );
$history   = get_field( 'history' );
$results   = get_field( 'results' );

$team_image   = get_field( 'team_image' );
$team_heading = get_field( 'team_heading' );
$team_content = get_field( 'team_content' );
$team_cta     = get_field( 'team_cta' );

$states = get_terms( array( 'taxonomy' => 'state' ) );
$args   = array(
	'post_type'      => 'attorney',
	'post_status'    => 'publish',
	'posts_per_page' => -1,
	'orderby'        => 'menu_order',
);
$query  = new WP_Query( $args );
$i      = 0;
if ( $query->have_posts() ) :
	?>
	<section class="section-archive section-archive--attorney">
		<div class="container">
			<div class="section-archive__filters attorney-filters">
				<?php if ( $states && count( $states ) > 1 ) : ?>
				<select name="states" id="state" class="attorney-select">
					<option value="">Location</option>
					<?php foreach ( $states as $state ) : ?>
						<option value="<?php echo esc_attr( $state->slug ); ?>"><?php echo esc_html( $state->name ); ?></option>
					<?php endforeach; ?>
				</select>
				<?php endif; ?>
				<div class="section-archive__search-box">
					<input type="text" class="section-archive__search" placeholder="<?php echo esc_html__( 'Search for someone' ); ?>">
					<!-- <input type="submit" value="<?php echo esc_html__( 'Search' ); ?>" class="btn btn-primary btn-search"> -->
				</div>
			</div>
			<div class="section-archive__posts attorney-grid"
				data-posts-per-page="-1" 
				data-post-type="attorney" 
				data-state="" 
				data-s="">
				<?php
				while ( $query->have_posts() ) :
					$query->the_post();
					if ( 2 == $i ) :
						if ( $community ) :
							?>
							<?php if ( $community['link'] ) : ?>
								<a href="<?php echo esc_url( $community['link'] ); ?>" class="loop-attorney-card loop-attorney-card--community">
							<?php else : ?>
								<div class="loop-attorney-card loop-attorney-card--community">
							<?php endif; ?>
								<?php if ( $community['heading'] ) : ?>
									<h2 class="loop-attorney-card__title"><?php echo esc_html( $community['heading'] ); ?></h2>
								<?php endif; ?>
								<?php if ( $community['content'] ) : ?>
									<p class="loop-attorney-card__content"><?php echo $community['content']; ?></p>
								<?php endif; ?>
							<?php if ( $community['link'] ) : ?>
								</a>
							<?php else : ?>
								</div>
							<?php endif; ?>
							<?php
						endif;
					endif;
					if ( 5 == $i ) :
						?>
						<?php if ( $history ) : ?>
							<div class="loop-attorney-card loop-attorney-card--firm">
								<?php if ( $history['heading'] ) : ?>
									<h2 class="loop-attorney-card__title"><?php echo esc_html( $history['heading'] ); ?></h2>
								<?php endif; ?>
								<?php if ( $history['content'] ) : ?>
									<p class="loop-attorney-card__content"><?php echo $history['content']; ?></p>
								<?php endif; ?>
							</div>
						<?php endif; ?>
						<?php
					endif;
					if ( 13 == $i ) :
						?>
						<?php if ( $results ) : ?>
							<div class="loop-attorney-card loop-attorney-card--results">
								<?php if ( $results['heading'] ) : ?>
									<h2 class="loop-attorney-card__title"><?php echo esc_html( $results['heading'] ); ?></h2>
								<?php endif; ?>
								<?php if ( $results['content'] ) : ?>
									<p class="loop-attorney-card__content"><?php echo $results['content']; ?></p>
								<?php endif; ?>
							</div>
						<?php endif; ?>
						<?php
					endif;
					get_template_part( 'template-parts/loop', 'attorney' );
					if ( 6 == $i ) :
						?>
						<div class="attorney-cta">
							<?php if ( $team_image ) : ?>
								<img src="<?php echo esc_url( $team_image['url'] ); ?>" 
									alt="<?php echo esc_attr( $team_image['alt'] ); ?>" 
									class="attorney-cta__img">
							<?php endif; ?>
							<div class="attorney-cta__inner">
								<?php if ( $team_heading ) : ?>
									<h2 class="attorney-cta__heading a-up"><?php echo $team_heading; ?></h2>
								<?php endif; ?>
								<?php if ( $team_content ) : ?>
									<p class="attorney-cta__content a-up a-delay-1"><?php echo $team_content; ?></p>
								<?php endif; ?>
								<?php if ( $team_cta ) : ?>
									<a href="<?php echo esc_url( $team_cta['url'] ); ?>" 
										class="attorney-cta__cta btn btn-primary a-up a-delay-2"
										target="<?php echo esc_html( $team_cta['target'] ? $team_cta['target'] : '_self' ); ?>">
										<?php echo esc_html( $team_cta['title'] ); ?>
									</a>
								<?php endif; ?>
							</div>
						</div>
						<?php
					endif;
					$i ++;
				endwhile;
				?>
			</div>
		</div>
	</section>
<?php
endif;
wp_reset_postdata();
?>

<?php
get_footer();
