<?php
global $post;
$type       = get_the_terms( $post, 'claim_type' );
$categories = get_the_terms( $post, 'case_category' );
$price      = get_field( 'price' );
$content    = get_field( 'content' );
$url        = get_field( 'url' ) ? get_field( 'url' ) : get_term_link( $categories[0] );
if ( $categories ) :
	$url = get_field( 'default_page_url', 'case_category_' . $categories[0]->term_id );
endif;
$theme = $args['theme'];
?>
<a href="<?php echo esc_url( $url ); ?>" class="cards-slider__slide">
	<?php
	if ( $categories ) :
		$category = $categories[0];
		$image    = get_field( 'icon', 'case_category' . '_' . $category->term_id );
		$sub_heading = 'Auto Accidents' == $category->name ? esc_html__( 'Auto Accident', 'am' ) : $category->name;
		if ( $image ) :
			?>
		<img src="<?php echo esc_url( $image['url'] ); ?>" alt="<?php echo esc_attr( $sub_heading ); ?>" class="cards-slider__slide__icon">
		<?php endif; ?>
		<p class="cards-slider__slide__subheading"><?php echo esc_html( $sub_heading ); ?></p>
	<?php endif; ?>
	<?php if ( 'compact' == $theme ) : ?>
		<?php if ( $price ) : ?>
			<?php if ( floatval( $price ) / 1000000 >= 1 ) : ?>
				<h3 class="cards-slider__slide__heading"><?php echo esc_html( '$' . floatval( $price ) / 1000000 ); ?></h3>
				<p class="cards-slider__slide__content"><?php echo esc_html__( 'Million' ); ?></p>
			<?php else : ?>
				<h3 class="cards-slider__slide__heading"><?php echo esc_html( '$' . number_format( intval( $price ) ) ); ?></h3>
			<?php endif; ?>
		<?php endif; ?>
	<?php else : ?>
		<h3 class="cards-slider__slide__heading">
			<?php the_title(); ?>
		</h3>
	<?php endif; ?>
	<?php if ( 'full' == $theme ) : ?>
		<?php if ( $content ) : ?>
			<p class="cards-slider__slide__content"><?php echo wp_trim_words( $content, 20, '...' ); ?></p>
		<?php endif; ?>
		<span class="link cards-slider__slide__cta"><?php echo esc_html__( 'Learn More' ); ?></span>
	<?php endif; ?>
</a>
