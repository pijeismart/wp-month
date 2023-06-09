<?php
global $post;
// Get author information
$get_author_id       = get_the_author_meta( 'ID' );
$get_author_gravatar = get_avatar_url( $get_author_id, array( 'size' => 40 ) );

// Get post fields
$terms     = get_the_terms( get_the_ID(), 'case_category' );
if ( $terms ) {
	$term_list = wp_list_pluck( $terms, 'slug' );
	$post_img  = get_field( 'default_post_image', 'case_category_' . $terms[0]->term_id );
}
if ( has_post_thumbnail() ) :
	$post_img = get_the_post_thumbnail_url( $post, 'large' );
endif;
?>
<!-- Post banner -->
<section class="post-banner">
	<div class="container">
		<div class="post-banner__content">
			<ul class="breadcrumbs a-up d-md-only">
				<li>
					<a href="<?php echo esc_url( home_url() ); ?>"><?php echo esc_html( 'Home' ); ?></a>
				</li>
				<li>
					<span><?php echo esc_html( 'Updated' ); ?> <?php echo get_the_date( 'M, d Y' ); ?></span>
				</li>
			</ul>
			<a href="<?php echo esc_url( home_url( '/blog/' ) ); ?>">
				<h6 class="h7 post-banner__subtitle a-up"><?php echo esc_html( 'Montlick Resources' ); ?></h6>
			</a>
			<h1 class="post-banner__title a-up a-delay-1"><?php the_title(); ?></h1>
			<?php if ( has_excerpt() ) : ?>
				<div class="post-banner__excerpt a-up a-delay-2"><?php the_excerpt(); ?></div>
			<?php endif; ?>
			<div class="post-banner__author a-up a-delay-3">
				<?php if ( $get_author_gravatar ) : ?>
					<img src="<?php echo esc_url( $get_author_gravatar ); ?>" alt="" class="post-banner__author__img">
				<?php endif; ?>
				<span class="post-banner__author__name">By <b><?php echo get_the_author_meta( 'display_name' ); ?></b></span>
			</div>
		</div>
		<?php if ( have_rows( 'related_pages' ) ) : ?>
			<div class="post-banner__links a-up">
				<p><?php echo esc_html( 'Related Pages' ); ?></p>
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
									'c' => 'link post-banner__link',
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

<?php if ( isset( $post_img ) ) : ?>
<!-- Post Image -->
<section class="post-img">
	<div class="container a-up">
		<img src="<?php echo esc_url( $post_img ); ?>" alt="<?php echo esc_attr( get_the_title() ); ?>">
	</div>
</section>
<?php endif; ?>

<!-- Post Detail -->
<section class="post-detail">
	<div class="container">
		<div class="post-content a-up">
			<?php the_content(); ?>
		</div>
		<div class="post-sidebar a-up a-delay-1 d-md-only">
			<?php
			get_template_part_args(
				'template-parts/content-modules-text',
				array(
					'v'  => 'call_out_heading',
					't'  => 'h3',
					'tc' => 'post-sidebar__heading',
					'o'  => 'o',
				)
			);
			?>
			<?php
			get_template_part_args(
				'template-parts/content-modules-text',
				array(
					'v'  => 'call_out_content',
					't'  => 'div',
					'tc' => 'post-sidebar__content',
					'o'  => 'o',
				)
			);
			?>
			<?php
			get_template_part_args(
				'template-parts/content-modules-cta',
				array(
					'v' => 'call_out_cta',
					'c' => 'link link-white',
					'o' => 'o',
				)
			);
			?>
		</div>
	</div>
</section>

<!-- Related Posts -->
<?php
$args  = array(
	'post_type'      => 'post',
	'post__not_in'   => array( get_the_ID() ),
	'post_status'    => 'publish',
	'posts_per_page' => 5,
);
if ( $terms ) :
	$args['tax_query'] = array(
		array(
			'taxonomy' => 'category',
			'field'    => 'slug',
			'terms'    => $term_list,
		),
	);
endif;
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
				<div class="slider-controls d-md-only">
					<div class="slider-pagination">1 / 2</div>
					<button class="link slider-next" tabindex="0">Next</button>
				</div>
			</div>
			<?php
		endif;
		wp_reset_postdata();
		?>
	</div>
</section>
