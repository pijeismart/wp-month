<?php
global $post;
// Get custom taxonomies
$claim_type     = get_the_terms( $post, 'claim_type' );
$claim_type_ids = wp_list_pluck( $claim_type, 'term_id' );

$case_cat     = get_the_terms( $post, 'case_category' );
$case_cat_ids = wp_list_pluck( $case_cat, 'term_id' );

$faq_types = get_the_terms( $post, 'faq_type' );
$faq_type  = $faq_types[0];

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

$related_faqs_args = array(
	'post_type'      => 'faq',
	'posts_status'   => 'published',
	'post__not_in'   => array( get_the_ID() ),
	'posts_per_page' => 5,
	'tax_query'      => $tax_query,
);

$related_areas_args = array(
	'post_type'      => 'practice',
	'posts_status'   => 'published',
	'posts_per_page' => 5,
	'tax_query'      => $tax_query,
);

// get field
$video = get_field( 'youtube_video' );

$title = get_the_title();
$url   = get_the_permalink();
$phone = get_field( 'header_cta_url', 'options' );
?>
<section class="faq-detail faq-detail--<?php echo esc_attr( $faq_type->slug ); ?>">
	<div class="container">
		<div class="faq-detail__card faq-detail__card--full faq-detail__card a-up">
			<div class="faq-detail__top">
				<a href="<?php echo esc_url( home_url( '/faq' ) ); ?>" class="link link-reverse">
					<?php echo esc_html__( 'See All Frequently Asked Questions' ); ?>
				</a>
				<ul class="social-share">
					<li>
						<a href="#" class="share-url">
							<img src="<?php echo esc_url( get_template_directory_uri() . '/assets/img/icon-url.svg' ); ?>" alt="">
						</a>
					</li>
					<li>
						<a href="https://www.facebook.com/sharer/sharer.php?u=<?php echo esc_url( $url ); ?>" class="share-facebook">
							<img src="<?php echo esc_url( get_template_directory_uri() . '/assets/img/icon-facebook.svg' ); ?>" alt="">
						</a>
					</li>
					<li>
						<a href="https://twitter.com/intent/tweet?url=<?php echo esc_url( $url ); ?>&text=<?php echo esc_html( $title ); ?>" class="share-twitter">
							<img src="<?php echo esc_url( get_template_directory_uri() . '/assets/img/icon-twitter.svg' ); ?>" alt="">
						</a>
					</li>
					<li>
						<a href="http://www.linkedin.com/shareArticle?mini=true&url=<?php echo esc_url( $url ); ?>&title=<?php echo esc_html( $title ); ?>" class="share-linkedin">
							<img src="<?php echo esc_url( get_template_directory_uri() . '/assets/img/icon-linkedin.svg' ); ?>" alt="">
						</a>
					</li>
					<li class="d-sm-only">
						<a href="#" class="share-email">
							<img src="<?php echo esc_url( get_template_directory_uri() . '/assets/img/icon-mail.svg' ); ?>" alt="">
						</a>
					</li>
				</ul>
			</div>
			<p class="faq-detail__notice">
				<?php echo esc_html__( 'These questions and answers are written by the legal team at Montlick Injury Attorneys and some other disclaimer language should probably go here.' ); ?>
			</p>
			<h1 class="h2 faq-detail__title"><?php the_title(); ?></h1>
			<?php if ( 'video-shorts' == $faq_type->slug ) : ?>
				<div class="faq-detail__video__wrapper">
			<?php endif; ?>
			<?php
			get_template_part_args(
				'template-parts/content-modules-text',
				array(
					'v'  => 'direct_answer',
					't'  => 'p',
					'tc' => 'faq-detail__answer',
					'o'  => 'f',
				)
			);
			?>
			<?php if ( $video ) : ?>
				<div class="faq-detail__video embed-container">
					<?php echo $video; ?>
				</div>
			<?php endif; ?>
			<?php if ( 'video-shorts' == $faq_type->slug ) : ?>
			</div>
			<?php endif; ?>
			<?php
			get_template_part_args(
				'template-parts/content-modules-text',
				array(
					'v'  => 'content',
					't'  => 'div',
					'tc' => 'faq-detail__content',
					'o'  => 'f',
				)
			);
			?>
			<div class="faq-detail__bottom">
				<div class="faq-detail__bottom__left">
					<h6><?php echo esc_html__( 'How useful is this for you?' ); ?></h6>
					<div class="rating-buttons">
						<button class="rating-btn rating-btn--dislike" aria-label="Dislike">
							<span class="hide-text">Dislike</span>
						</button>
						<button class="rating-btn rating-btn--like" aria-label="Like">
							<span class="hide-text">Like</span>
						</button>
					</div>
				</div>
				<?php if ( $phone ) : ?>
				<div class="faq-detail__bottom__right">
					<h6><?php echo esc_html__( 'Would you like to speak with an attorney?' ); ?></h6>
					<a href="tel:<?php echo esc_attr( $phone['url'] ); ?>" class="faq-link">
						<?php echo esc_html__( 'Call Now' ); ?>
					</a>
				</div>
				<?php endif; ?>
			</div>
		</div>
		<?php
		$query = new WP_Query( $related_faqs_args );
		if ( $query->have_posts() ) :
			?>
			<div class="faq-detail__card faq-detail__card--half a-up">
				<h6 class="h7"><?php echo esc_html__( 'Related Questions' ); ?></h6>
				<ul class="links">
					<?php
					while ( $query->have_posts() ) :
						$query->the_post();
						?>
						<li>
							<a href="<?php echo esc_url( get_the_permalink() ); ?>" class="link">
								<?php echo esc_html( get_the_title() ); ?>
							</a>
						</li>    
					<?php endwhile; ?>
				</ul>
			</div>
			<?php
		endif;
		wp_reset_postdata();
		?>
		<?php
		$query = new WP_Query( $related_areas_args );
		if ( $query->have_posts() ) :
			?>
			<div class="faq-detail__card faq-detail__card--half a-up a-delay-1">
				<h6 class="h7"><?php echo esc_html__( 'Related Practice Areas' ); ?></h6>
				<ul class="links">
					<?php
					while ( $query->have_posts() ) :
						$query->the_post();
						?>
						<li>
							<a href="<?php echo esc_url( get_the_permalink() ); ?>" class="link">
								<?php echo esc_html( get_the_title() ); ?>
							</a>
						</li>    
					<?php endwhile; ?>
				</ul>
			</div>
			<?php
		endif;
		wp_reset_postdata();
		?>
	</div>
</section>

<?php get_template_part( 'template-parts/section', 'award' ); ?>

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
						get_template_part( 'template-parts/loop', 'post' );
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
