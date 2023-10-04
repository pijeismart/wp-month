<?php
/**
 * Template Name: Quiz
 * Template Post Type: page
 */
get_header( 'quiz' );
?>
<section class="quiz">
    <div class="container">
        <?php echo do_shortcode( '[gravityform id="4" title="false"]' ); ?>
    </div>
</section>
<?php
get_footer( 'quiz' );
