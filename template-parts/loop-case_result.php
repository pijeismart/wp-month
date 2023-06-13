<?php
global $post;
$type       = get_the_terms( $post, 'claim_type' );
$categories = get_the_terms( $post, 'case_category' );
$price      = get_field( 'price' );
$content    = get_field( 'content' );
$url        = get_field( 'url' ) ? get_field( 'url' ) : '#';
$theme      = $args['theme'];
?>
<a href="<?php echo esc_url( $url ); ?>" class="cards-slider__slide">
    <?php if ( $categories ) : 
        $category = $categories[0];
        $image = get_field( 'icon', 'case_category' . '_' . $category->term_id );
        if ( $image ) :
        ?>
        <img src="<?php echo esc_url( $image['url'] ); ?>" alt="<?php echo esc_attr( $category->name ); ?>" class="cards-slider__slide__icon">
        <?php endif; ?>
        <p class="cards-slider__slide__subheading"><?php echo esc_html( $category->name ); ?></p>
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
        <h3 class="cards-slider__slide__heading"><?php the_title(); ?></h3>
    <?php endif; ?>
    <?php if ( 'full' == $theme ) : ?>
        <?php if ( $content ) : ?>
            <p class="cards-slider__slide__content"><?php echo wp_trim_words( $content, 20, '...' ); ?></p>
        <?php endif; ?>
        <span class="link cards-slider__slide__cta"><?php echo esc_html__( 'Learn More' ); ?></span>
    <?php endif; ?>
</a>