<?php
/**
 * Blog Case Category Template
 */
get_header();
// get current taxonomy
$term    = get_queried_object();
$heading = get_field( 'archive_heading', 'case_category_' . $term->term_id );
$content = get_field( 'archive_content', 'case_category_' . $term->term_id );
$links   = get_field( 'related_pages', 'case_category_' . $term->term_id );
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
					<a href="<?php echo esc_url( home_url( '/blog/' ) ); ?>"><?php echo esc_html( 'Montlick Resources' ); ?></a>
				</li>
				<li>
					<span><?php echo esc_html( $term->name ); ?></span>
				</li>
			</ul>
			<?php if ( $heading ) : ?>
				<h1 class="archive-banner__heading a-up a-delay-1">
					<?php echo $heading; ?>
				</h1>
			<?php endif; ?>
			<?php if ( $content ) : ?>
				<div class="archive-banner__copy a-up a-delay-2">
					<?php echo $content; ?>
				</div>
			<?php endif; ?>
		</div>
		<?php if ( $links ) : ?>
			<div class="archive-banner__right related-pages-block a-up">
				<h6 class="related-pages-block__heading"><?php echo esc_html__( 'Related Pages' ); ?></h6>
				<ul class="related-pages-block__link">
					<?php
					foreach ( $links as $link ) :
						$cta = $link['link'];
						if ( $cta ) :
							?>
							<li>
								<a href="<?php echo esc_url( $cta['url'] ); ?>" class="link" target="<?php echo esc_attr( $cta['target'] ? $cta['target'] : '_self' ); ?>">
									<?php echo esc_html( $cta['title'] ); ?>
								</a>
							</li>
							<?php
						endif;
					endforeach;
					?>
				</ul>
			</div>
		<?php endif; ?>
	</div>
</section>

<!-- Archive -->
<?php
$paged = isset( $_GET['paged'] ) ? $_GET['paged'] : 1;
$args  = array(
	'post_type'      => 'post',
	'post_status'    => 'publish',
	'posts_per_page' => 5,
	'paged'          => $paged,
	'tax_query'      => array(
		array(
			'taxonomy' => 'case_category',
			'terms'    => $term->term_id,
		),
	),
);
$query = new WP_Query( $args );
if ( $query->have_posts() ) :
	?>
	<section class="section-archive a-up">
		<div class="container">
			<div class="section-archive__sidebar">
				<div class="section-archive__search-box">
					<input type="text" class="section-archive__search" placeholder="<?php echo esc_html__( 'Search Blog' ); ?>">
				</div>
				<?php
				$categories = get_categories();
				if ( $categories ) :
					?>
					<div class="accordion section-archive__sidebar__widget">
						<div class="accordion-header">
							<?php echo esc_html__( 'By Resource Category' ); ?>
						</div>
						<div class="accordion-body">
							<?php foreach ( $categories as $category ) : ?>
								<button class="section-archive__filter__btn<?php echo ( isset( $_GET['category'] ) && $_GET['category'] == $category->slug ) ? ' is-active' : ''; ?>" 
									data-target="data-cat"
									data-cat="<?php echo esc_attr( $category->slug ); ?>">
									<?php echo esc_html( $category->name ); ?>
								</button>
							<?php endforeach; ?>
						</div>
					</div>
				<?php endif; ?>
				<?php
				$case_categories = get_terms( array( 'taxonomy' => 'case_category' ) );
				if ( $case_categories ) :
					?>
					<div class="accordion section-archive__sidebar__widget">
						<div class="accordion-header active">
							<?php echo esc_html__( 'Popular Categories' ); ?>
						</div>
						<div class="accordion-body" style="display: block">
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
			</div>
			<div class="section-archive__content">
				<div class="section-archive__posts"
					data-paged="<?php echo esc_attr( $paged ); ?>"
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
				<?php if ( $query->max_num_pages > 1 ) : ?>
					<div class="slider-controls posts-pagination">
						<button class="link prev-posts" disabled><?php echo esc_html__( 'Previous' ); ?></button>
						<div class="slider-pagination">
							<span class="current-page-num"><?php echo esc_html( $paged ); ?></span> / <span class="max-page-num"><?php echo esc_html( $query->max_num_pages ); ?></span>
						</div>
						<button class="link next-posts"><?php echo esc_html__( 'Next' ); ?></button>
					</div>
				<?php endif; ?>
			</div>
		</div>
	</section>
	<?php
endif;
wp_reset_postdata();
?>
<?php
get_footer();
