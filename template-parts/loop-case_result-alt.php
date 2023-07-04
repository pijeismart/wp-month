<?php
global $post;
$type       = get_the_terms( $post, 'claim_type' );
$categories = get_the_terms( $post, 'case_category' );
$price      = get_field( 'price' );
$content    = get_field( 'content' );
if ( $categories ) :
	$url = get_field( 'default_page_url', 'case_category_' . $categories[0]->term_id );
endif;
?>
<div class="loop-case-result">
	<?php if ( $price ) : ?>
		<?php if ( floatval( $price ) / 1000000 >= 1 ) : ?>
			<h3 class="loop-case-result__pricing"><?php echo esc_html( '$' . floatval( $price ) / 1000000 ); ?></h3>
			<p class="loop-case-result__unit"><?php echo esc_html__( 'Million' ); ?></p>
		<?php else : ?>
			<h3 class="loop-case-result__pricing"><?php echo esc_html( '$' . number_format( floatval( $price ) / 1000 ) ); ?></h3>
			<p class="loop-case-result__unit"><?php echo esc_html__( 'Thousand' ); ?></p>
		<?php endif; ?>
	<?php endif; ?>
	<h6 class="loop-case-result__heading"><?php the_title(); ?></h6>
	<?php if ( $content ) : ?>
		<p class="loop-case-result__content"><?php echo wp_trim_words( $content, 30, '...' ); ?></p>
	<?php endif; ?>
	<?php if ( $url ) : ?>
    <div class="loop-case-result__cta">
        <a href="<?php echo esc_url( $url ); ?>" class="underline-link"><?php echo esc_html__( 'Learn More' ); ?></a>
    </div>
	<?php endif; ?>
</div>
