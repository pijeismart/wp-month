<?php
/**
 * Template Name: Blogs
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
					<span><?php echo esc_html( 'Montlick Resources' ); ?></span>
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
			<div class="archive-banner__right a-up">
				<h6><?php echo esc_html__( 'Related Pages' ); ?></h6>
				<ul>
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
	'post_type'      => 'post',
	'post_status'    => 'publish',
	'posts_per_page' => 5,
);
if ( isset( $_GET['case-category'] ) ) {
	$args['tax_query'][] = array(
		'taxonomy' => 'case_category',
		'field'    => 'slug',
		'terms'    => $_GET['case-category'],
	);
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
						<?php echo esc_html__( 'By Case Type' ); ?>
					</div>
					<div class="accordion-body">
						<?php foreach ( $case_categories as $category ) : ?>
							<button class="section-archive__filter__btn<?php echo ( isset( $_GET['case-category'] ) && $_GET['case-category'] == $category->slug ) ? ' is-active' : ''; ?>" 
								data-target="data-cat"
								data-cat="<?php echo esc_attr( $category->slug ); ?>">
								<?php echo esc_html( $category->name ); ?>
							</button>
						<?php endforeach; ?>
					</div>
				</div>
			<?php endif; ?>
		</div>
		<div class="section-archive__content">
			<div class="section-archive__search-box">
				<input type="text" class="section-archive__search" placeholder="<?php echo esc_html__( 'Search The Blog' ); ?>">
			</div>
			<div class="section-archive__posts"
				data-posts-per-page="5" 
				data-post-type="post" 
				data-cat="" 
				data-state="" 
				data-s="">
				<?php
				while ( $query->have_posts() ) :
					$query->the_post();
					get_template_part( 'template-parts/loop', 'post' );
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
