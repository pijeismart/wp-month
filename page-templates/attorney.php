<?php
/**
 * Template Name: Attorney
 * Template Post Type: page
 */

get_header();
$video = get_field( 'video' );
?>
<section class="archive-attorney has-decor">
	<div class="container">
		<div class="archive-attorney__content">
			<?php
			get_template_part_args(
				'template-parts/content-modules-text',
				array(
					'v'  => 'sub_heading',
					't'  => 'h6',
					'tc' => 'h7 archive-attorney__subheading a-up',
					'o'  => 'f',
				)
			);
			?>
			<?php
			get_template_part_args(
				'template-parts/content-modules-text',
				array(
					'v'  => 'heading',
					't'  => 'h1',
					'tc' => 'archive-attorney__heading a-up a-delay-1',
					'o'  => 'f',
				)
			);
			?>
			<?php
			get_template_part_args(
				'template-parts/content-modules-text',
				array(
					'v'  => 'content',
					't'  => 'div',
					'tc' => 'archive-attorney__copy a-up a-delay-2',
					'o'  => 'f',
				)
			);
			?>
		</div>
        <?php if ( $video ) : ?>
		<div class="archive-attorney__video object-cover">
			<video src="<?php echo esc_url( $video ); ?>" loop muted playsinline autoplay preload="metadata">
				<source src="<?php echo esc_url( $video ); ?>" type="video/mp4">
			</video>
		</div>
        <?php endif; ?>
        <?php if ( have_rows( 'related_pages' ) ) : ?>
            <div class="archive-attorney__links related-pages-block a-up">
				<h6 class="related-pages-block__heading"><?php echo esc_html__( 'Related Pages' ); ?></h6>
				<ul class="related-pages-block__link">
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

<section class="attorney-cta">
	<div class="container">
        <?php
        get_template_part_args(
            'template-parts/content-modules-image',
            array(
                'v'     => 'team_image',
                'v2x'   => false,
                'is'    => false,
                'is_2x' => false,
                'c'     => 'attorney-cta__img',
                'o'     => 'f',
            )
        );
        ?>
        <div class="attorney-cta__inner">
            <?php
            get_template_part_args(
                'template-parts/content-modules-text',
                array(
                    'v'  => 'team_heading',
                    't'  => 'h2',
                    'tc' => 'attorney-cta__heading a-up',
                    'o'  => 'f',
                )
            );
            ?>
            <?php
            get_template_part_args(
                'template-parts/content-modules-text',
                array(
                    'v'  => 'team_content',
                    't'  => 'p',
                    'tc' => 'attorney-cta__content a-up a-delay-1',
                    'o'  => 'f',
                )
            );
            ?>
            <?php
            get_template_part_args(
                'template-parts/content-modules-cta',
                array(
                    'v' => 'team_cta',
                    'c' => 'attorney-cta__cta btn btn-primary a-up a-delay-2',
                    'o' => 'f',
                )
            );
            ?>
        </div>
	</div>
</section>

<?php
get_footer();
