	</main>
	<!-- End Main -->

	<!-- Begin Footer -->
	<?php
	$cta_text       = get_field( 'header_cta_text', 'options' );
	$cta_url        = get_field( 'header_cta_url', 'options' );
	$footer_content = get_field( 'footer_bottom_content', 'options' );
	$copyright      = get_field( 'copyright', 'options' );
	?>
	<footer class="footer">
		<div class="container">
			<div class="footer-left">
				<a href="<?php echo esc_url( home_url() ); ?>" class="footer-logo">
					<?php
					get_template_part_args(
						'template-parts/content-modules-image',
						array(
							'v'     => 'footer_logo',
							'v2x'   => false,
							'is'    => false,
							'is_2x' => false,
							'c'     => 'footer-logo__img',
							'o'     => 'o',
						)
					);
					?>
				</a>
				<?php
				get_template_part_args(
					'template-parts/content-modules-text',
					array(
						'v'  => 'footer_content',
						't'  => 'div',
						'tc' => 'footer-info',
						'o'  => 'o',
					)
				);
				?>
				<?php if ( $cta_url && $cta_text ) : ?>
					<a href="<?php echo esc_url( $cta_url['url'] ); ?>" class="footer-cta" target="<?php echo esc_attr( $cta_url['target'] ?: '_self' ); ?>">
						<?php echo $cta_text; ?>
					</a>
				<?php endif; ?>
				<div class="footer-left__bottom d-md-only">
					<?php
					get_template_part_args(
						'template-parts/content-modules-text',
						array(
							'v'  => 'footer_bottom_content',
							't'  => 'div',
							'tc' => 'footer-content',
							'o'  => 'o',
						)
					);
					?>
					<div class="footer-copyright">
						&copy; 2003-<?php echo esc_html( date( 'Y' ) ); ?>, <?php echo $copyright; ?>
					</div>
				</div>
			</div>
			<div class="footer-right">
				<?php
				wp_nav_menu(
					array(
						'theme_location' => 'footermenu',
						'menu_class'     => 'footer-menu',
						'container'      => false,
					)
				);
				?>
				<div class="footer-right__bottom d-sm-only">
					<?php
					get_template_part_args(
						'template-parts/content-modules-text',
						array(
							'v'  => 'footer_bottom_content',
							't'  => 'div',
							'tc' => 'footer-content',
							'o'  => 'o',
						)
					);
					?>
					<div class="footer-copyright">
						&copy; 2003-<?php echo esc_html( date( 'Y' ) ); ?>, <?php echo $copyright; ?>
					</div>
				</div>
			</div>
		</div>
	</footer>
	<!-- End Footer -->
	<?php wp_footer(); ?>
</body>
</html>

