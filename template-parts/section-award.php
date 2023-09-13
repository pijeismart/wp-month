<?php
$awards = get_field( 'awards', 'options' );
?>
<!-- Awards -->
<section class="awards">
	<div class="awards-top container">
		<?php if ( $awards ) : ?>
			<div class="awards-gallery">
				<?php foreach ( $awards as $image ) : ?>
					<img src="<?php echo esc_url( $image['url'] ); ?>" alt="<?php echo esc_attr( $image['alt'] ); ?>">
				<?php endforeach; ?>
			</div>
		<?php endif; ?>
		<?php
		get_template_part_args(
			'template-parts/content-modules-cta',
			array(
				'v'  => 'awards_cta',
				'c'  => 'link',
				'w'  => 'div',
				'wc' => 'awards-cta',
				'o'  => 'o',
			)
		);
		?>
	</div>
	<div class="awards-bottom container">
		<div class="awards-left">
			<?php
			get_template_part_args(
				'template-parts/content-modules-text',
				array(
					'v'  => 'awards_heading',
					't'  => 'h3',
					'tc' => 'awards-heading a-up',
					'o'  => 'o',
				)
			);
			?>
			<?php
			get_template_part_args(
				'template-parts/content-modules-text',
				array(
					'v'  => 'awards_content',
					't'  => 'div',
					'tc' => 'awards-content d-md-only a-up a-delay-1',
					'o'  => 'o',
				)
			);
			?>
		</div>
		<div class="awards-right">
			<?php
			get_template_part_args(
				'template-parts/content-modules-text',
				array(
					'v'  => 'awards_description',
					't'  => 'div',
					'tc' => 'awards-desc a-up',
					'o'  => 'o',
				)
			);
			?>
			<?php if ( have_rows( 'awards_dropdown', 'options' ) ) : ?>
			<div class="awards-dropdown dropdown">
				<button class="dropdown-toggler btn btn-download a-up a-delay-1">
					<?php echo esc_html__( 'What kind of accident did you have?', 'am' ); ?>
				</button>
				<ul class="dropdown-content">
					<?php
					while ( have_rows( 'awards_dropdown', 'options' ) ) :
						the_row();
						get_template_part_args(
							'template-parts/content-modules-cta',
							array(
								'v' => 'link',
								'c' => 'dropdown-link',
								'w' => 'li',
							)
						);
					endwhile;
					?>
				</ul>
			</div>
			<?php endif; ?>
		</div>
	</div>
</section>
