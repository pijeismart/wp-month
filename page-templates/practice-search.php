<?php
/**
 * Template Name: Practice Search
 * Template Post Type: page
 */
get_header();
?>
<section class="practice-banner">
	<div class="container">
		<div class="practice-banner__content">
			<?php
			get_template_part_args(
				'template-parts/content-modules-text',
				array(
					'v'  => 's1_eyebrow',
					't'  => 'h6',
					'tc' => 'h7 practice-banner__subheading a-up',
					'o'  => 'f',
				)
			);
			?>
			<?php
			get_template_part_args(
				'template-parts/content-modules-text',
				array(
					'v'  => 's1_title',
					't'  => 'h1',
					'tc' => 'practice-banner__heading a-up a-delay-1',
					'o'  => 'f',
				)
			);
			?>
			<?php
			get_template_part_args(
				'template-parts/content-modules-text',
				array(
					'v'  => 's1_content',
					't'  => 'div',
					'tc' => 'practice-banner__copy a-up a-delay-2',
					'o'  => 'f',
				)
			);
			?>
		</div>
		<div class="practice-banner__side a-up d-md-only">
			<?php
			get_template_part_args(
				'template-parts/content-modules-text',
				array(
					'v'  => 'ctas_label',
					't'  => 'p',
					'tc' => 'practice-banner__side__label',
					'o'  => 'f',
				)
			);
			?>
			<?php if ( have_rows( 's1_ctas' ) ) : ?>
				<div class="practice-banner__links">
					<?php
					while ( have_rows( 's1_ctas' ) ) :
						the_row();
						get_template_part_args(
							'template-parts/content-modules-cta',
							array(
								'v' => 'cta',
								'c' => 'link',
							)
						);
				    endwhile;
					?>
				</div>
			<?php endif; ?>
		</div>
	</div>
</section>
<?php
get_footer();
