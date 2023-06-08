<?php
/**
 * Template Name: FAQs
 * Template Post Type: page
 */

get_header();
?>
<!-- Banner -->
<section class="archive-banner has-decor">
	<div class="container">
		<div class="archive-banner__left">
			<ul class="breadcrumbs a-up">
				<li>
					<a href="<?php echo esc_url( home_url() ); ?>"><?php echo esc_html( 'Home' ); ?></a>
				</li>
				<li>
					<span><?php echo esc_html( 'Montlick Attorneys' ); ?></span>
				</li>
			</ul>
			<?php
			get_template_part_args(
				'template-parts/content-modules-text',
				array(
					'v'  => 'heading',
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
					'v'  => 'copy',
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

<!-- Archive -->
<?php
$args = array(
	'post_type'      => 'faq',
	'post_status'    => 'publish',
	'posts_per_page' => -1,
);
if ( isset( $_GET['case-category'] ) ) {
	$args['tax_query'][] = array(
		'taxonomy' => 'case_category',
		'field'    => 'slug',
		'terms'    => $_GET['case-category'],
	);
}
if ( isset( $_GET['state'] ) ) {
	$args['tax_query'][] = array(
		'taxonomy' => 'state',
		'field'    => 'slug',
		'terms'    => $_GET['state'],
	);
}
if ( isset( $_GET['case-category'] ) && isset( $GET['state'] ) ) {
	$args['tax_query']['relation'] = 'AND';
}
$query = new WP_Query( $args );
if ( $query->have_posts() ) :
	?>
<section class="section-archive a-up">
	<div class="container">
		<div class="section-archive__sidebar">
			<?php
			$case_categories = get_terms( array( 'taxonomy' => 'case_category' ) );
			if ( $case_categories ) :
				?>
				<div class="accordion section-archive__sidebar__widget">
					<div class="accordion-header">
						<?php echo esc_html__( 'Jump to navigation' ); ?>
					</div>
					<div class="accordion-body">
						<?php foreach ( $case_categories as $category ) : ?>
							<button class="section-archive__filter__btn<?php echo ( isset( $_GET['case-category'] ) && $_GET['case-category'] == $category->slug ) ? ' is-active' : ''; ?>" 
								data-target="data-case-cat"
								data-case-cat="<?php echo esc_attr( $category->slug ); ?>">
								<?php echo esc_html( $category->name ); ?>
							</button>
						<?php endforeach; ?>
					</div>
				</div>
			<?php endif; ?>
			<?php
			$states = get_terms( array( 'taxonomy' => 'state' ) );
			if ( $states ) :
				?>
				<div class="accordion section-archive__sidebar__widget">
					<div class="accordion-header">
						<?php echo esc_html( 'State Law Guides' ); ?>
					</div>
					<div class="accordion-body">
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
			<div class="section-archive__search-box">
				<input type="text" class="section-archive__search" placeholder="<?php echo esc_html__( 'Search for An FAQ' ); ?>">
			</div>
			<div class="section-archive__posts"
				data-posts-per-page="-1" 
				data-post-type="faq" 
				data-case-cat="" 
				data-state="" 
				data-s="">
				<?php
				while ( $query->have_posts() ) :
					$query->the_post();
					get_template_part( 'template-parts/loop', 'faq' );
				endwhile;
				?>
			</div>
		</div>
	</div>
</section>
	<?php
endif;
wp_reset_postdata();
?>

<?php
get_footer();
