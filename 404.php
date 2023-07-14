<?php
/**
 * 404 Page
 */
get_header();
?>
<section class="error-page">
    <div class="container">
        <img class="error-page__img" src="<?php echo esc_url( get_template_directory_uri() . '/assets/img/404.svg' ); ?>" alt="404">
        <?php
        get_template_part_args(
            'template-parts/content-modules-text',
            array(
                'v'  => 'error_heading',
                't'  => 'h1',
                'tc' => 'error-page__heading',
                'o'  => 'o',
            )
        );
        ?>
        <?php
        get_template_part_args(
            'template-parts/content-modules-cta',
            array(
                'v' => 'error_cta',
                'c' => 'btn btn-primary error-page__cta',
                'o' => 'o',
            )
        );
        ?>
    </div>
</section>
<?php
get_footer();
