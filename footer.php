<?php if ( is_singular( 'post' ) || is_page_template( 'page-templates/faqs.php') || is_page_template( 'page-templates/blog.php') || is_page_template( 'page-templates/areas-we-serve.php' ) ) : ?>
			<section class="results">
				<div class="container">
					<div class="results-content">
						<?php
						get_template_part_args(
							'template-parts/content-modules-text',
							array(
								'v'  => 'results_heading',
								't'  => 'h3',
								'tc' => 'results-heading a-up',
								'o'  => 'o',
							)
						);
						?>
						<?php
						get_template_part_args(
							'template-parts/content-modules-text',
							array(
								'v'  => 'results_content',
								't'  => 'div',
								'tc' => 'results-content a-up a-delay-1',
								'o'  => 'o',
							)
						);
						?>
					</div>
					<?php if ( have_rows( 'results_cards', 'options' ) ) : ?>
						<div class="contact-form__cards">
							<?php
							while ( have_rows( 'results_cards', 'options' ) ) :
								the_row();
								$type = get_sub_field( 'type' );
								?>
							<div class="contact-form__cards__item <?php echo esc_attr( $type ); ?> a-up a-delay-1">
								<?php
								get_template_part_args(
									'template-parts/content-modules-text',
									array(
										'v'  => 'eyebrow',
										't'  => 'h5',
										'tc' => 'item-eyebrow',
									)
								);
								?>
								<?php
								get_template_part_args(
									'template-parts/content-modules-image',
									array(
										'v'     => 'badge',
										'v2x'   => false,
										'is'    => false,
										'is_2x' => false,
										'c'     => 'item-badge__img',
										'w'     => 'div',
										'wc'    => 'item-badge',
									)
								);
								?>
								<?php
								get_template_part_args(
									'template-parts/content-modules-image',
									array(
										'v'     => 'award',
										'v2x'   => false,
										'is'    => false,
										'is_2x' => false,
										'c'     => 'item-award__img',
										'w'     => 'div',
										'wc'    => 'item-award',
									)
								);
								?>
								<?php
								get_template_part_args(
									'template-parts/content-modules-text',
									array(
										'v'  => 'content',
										't'  => 'h5',
										'tc' => 'item-content',
									)
								);
								?>
								<?php
								get_template_part_args(
									'template-parts/content-modules-text',
									array(
										'v'  => 'sub_title',
										't'  => 'h5',
										'tc' => 'item-sub_title',
									)
								);
								?>
								<?php
								get_template_part_args(
									'template-parts/content-modules-cta',
									array(
										'v' => 'cta',
										'c' => 'contact-form__cards__item__cta link',
									)
								);
								?>
							</div>
							<?php endwhile; ?>
						</div>
					<?php endif; ?>
				</div>
			</section>
			<section class="subscribe-form">
				<div class="subscribe-form__img d-md-only">
					<?php
					get_template_part_args(
						'template-parts/content-modules-image',
						array(
							'v'     => 'subscribe_image',
							'v2x'   => false,
							'is'    => false,
							'is_2x' => false,
							'o'     => 'o',
						)
					);
					?>
				</div>
				<div class="subscribe-form__content">
					<div class="subscribe-form__inner">
						<?php
						get_template_part_args(
							'template-parts/content-modules-text',
							array(
								'v'  => 'subscribe_eyebrow',
								't'  => 'h6',
								'tc' => 'h7 subscribe-form__subheading a-up',
								'o'  => 'o',
							)
						);
						?>
						<?php
						get_template_part_args(
							'template-parts/content-modules-text',
							array(
								'v'  => 'subscribe_heading',
								't'  => 'h2',
								'tc' => 'subscribe-form__heading a-up a-delay-1',
								'o'  => 'o',
							)
						);
						?>
						<?php
						get_template_part_args(
							'template-parts/content-modules-text',
							array(
								'v'  => 'subscribe_content',
								't'  => 'p',
								'tc' => 'subscribe-form__copy a-up a-delay-2',
								'o'  => 'o',
							)
						);
						?>
					</div>
					<?php
					get_template_part_args(
						'template-parts/content-modules-shortcode',
						array(
							'v'  => 'subscribe_form',
							't'  => 'div',
							'tc' => 'subscribe-form__form',
							'o'  => 'o',
						)
					);
					?>
				</div>
			</section>
		<?php endif; ?>
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
					<a href="<?php echo esc_url( $cta_url['url'] ); ?>" class="footer-cta" target="<?php echo esc_attr( $cta_url['target'] ? $cta_url['target'] : '_self' ); ?>">
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

	<!-- Feedback Popup -->
	<div class="popup" id="popup-feedback">
		<?php
		get_template_part_args(
			'template-parts/content-modules-text',
			array(
				'v'  => 'feedback_heading',
				't'  => 'div',
				'tc' => 'popup-heading',
				'o'  => 'o',
			)
		);
		?>
		<?php
		get_template_part_args(
			'template-parts/content-modules-shortcode',
			array(
				'v'  => 'feedback_form',
				't'  => 'div',
				'tc' => 'popup-content',
				'o'  => 'o',
			)
		);
		?>
	</div>
	<!-- End Feedback Popup -->
	<?php wp_footer(); ?>
</body>
</html>

