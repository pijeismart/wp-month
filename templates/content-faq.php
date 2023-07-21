<?php
global $post;
// Get custom taxonomies
$claim_type     = get_the_terms( $post, 'claim_type' );
$claim_type_ids = wp_list_pluck( $claim_type, 'term_id' );

$case_cat     = get_the_terms( $post, 'case_category' );
$case_cat_ids = wp_list_pluck( $case_cat, 'term_id' );

$faq_types = get_the_terms( $post, 'faq_type' );
$faq_type  = $faq_types[0];

$state = get_the_terms( $post, 'state' );

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
	'post_type'      => 'city',
	'posts_status'   => 'published',
	'posts_per_page' => 5,
	'tax_query'      => $tax_query,
);

// get field
$video = get_field( 'youtube_video' );

$title = get_the_title();
$url   = get_the_permalink();
$phone = get_field( 'phone', 'options' );
?>
<section class="faq-detail faq-detail--<?php echo esc_attr( $faq_type->slug ); ?>">
	<div class="container">
		<div class="faq-detail__card faq-detail__card--full faq-detail__card a-up">
			<div class="faq-detail__top">
				<?php if ( 'state-law-montlick-explains' == $faq_type->slug ) : ?>
					<a href="<?php echo esc_url( home_url( '/faq/?state=' ) . $state[0]->slug ); ?>" class="link link-reverse">
						<?php echo esc_html__( 'See All Frequently Asked Questions' ) . ' | ' . $state[0]->name; ?>
					</a>
				<?php else : ?>
					<a href="<?php echo esc_url( home_url( '/faq' ) ); ?>" class="link link-reverse">
						<?php echo esc_html__( 'See All Frequently Asked Questions' ); ?>
					</a>
				<?php endif; ?>
				<ul class="social-share">
					<li>
						<a href="#" class="share-url">
							<img src="<?php echo esc_url( get_template_directory_uri() . '/assets/img/icon-url.svg' ); ?>" alt="">
						</a>
					</li>
					<li>
						<a href="https://www.facebook.com/sharer/sharer.php?u=<?php echo esc_url( $url ); ?>" class="share-facebook">
							<img src="<?php echo esc_url( get_template_directory_uri() . '/assets/img/icon-facebook.svg' ); ?>" alt="Facebook">
						</a>
					</li>
					<li>
						<a href="https://twitter.com/intent/tweet?url=<?php echo esc_url( $url ); ?>&text=<?php echo esc_html( $title ); ?>" class="share-twitter">
							<img src="<?php echo esc_url( get_template_directory_uri() . '/assets/img/icon-twitter.svg' ); ?>" alt="Twitter">
						</a>
					</li>
					<li>
						<a href="http://www.linkedin.com/shareArticle?mini=true&url=<?php echo esc_url( $url ); ?>&title=<?php echo esc_html( $title ); ?>" class="share-linkedin">
							<img src="<?php echo esc_url( get_template_directory_uri() . '/assets/img/icon-linkedin.svg' ); ?>" alt="Linkedin">
						</a>
					</li>
					<li>
						<a href="mailto:?subject=<?php echo esc_attr( get_the_title() ); ?>&body=Link:<?php echo esc_url( get_the_permalink() ); ?>" class="share-email">
							<img src="<?php echo esc_url( get_template_directory_uri() . '/assets/img/icon-mail.svg' ); ?>" alt="Email">
						</a>
					</li>
					<li class="d-sm-only">
						<a href="sms:?&body=<?php echo esc_url( get_the_permalink() ); ?>" class="share-sms">
							<img src="<?php echo esc_url( get_template_directory_uri() . '/assets/img/icon-sms.svg' ); ?>" alt="SMS">
						</a>
					</li>
				</ul>
			</div>
			<?php
			get_template_part_args(
				'template-parts/content-modules-text',
				array(
					'v'  => 'faq_notice',
					't'  => 'p',
					'tc' => 'faq-detail__notice',
					'o'  => 'o',
				)
			);
			?>
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
						<button class="rating-btn rating-btn--dislike" aria-label="Dislike" data-fancybox data-src="#popup-feedback">
							<span class="hide-text">Dislike</span>
						</button>
						<button class="rating-btn rating-btn--like" aria-label="Like" data-fancybox data-src="#popup-feedback">
							<span class="hide-text">Like</span>
						</button>
					</div>
				</div>
				<?php if ( $phone ) : ?>
				<div class="faq-detail__bottom__right">
					<h6><?php echo esc_html__( 'Would you like to speak with an attorney?' ); ?></h6>
					<a href="tel:<?php echo esc_attr( $phone ); ?>" class="underline-link faq-link">
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
if ( $query->have_posts() ) :
	?>
	<section class="posts-slider related-posts">
		<div class="container">
			<div class="posts-slider__content">
				<h3 class="posts-slider__heading a-up"><?php echo esc_html( 'Blog and News Section' ); ?></h3>
			</div>
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
		</div>
	</section>
	<?php
endif;
wp_reset_postdata();
