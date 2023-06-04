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
				'v'  => 'awards_download_cta',
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
			<?php
			get_template_part_args(
				'template-parts/content-modules-cta',
				array(
					'v' => 'awards_download_cta',
					'c' => 'btn btn-download a-up a-delay-1',
					'o' => 'o',
				)
			);
			?>
		</div>
	</div>
</section>
