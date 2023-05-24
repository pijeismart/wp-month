<?php
global $post;
if ( have_rows( 'modules' ) ) :
	while ( have_rows( 'modules' ) ) :
		the_row();
		?>
		<?php
		if ( 'banner' == get_row_layout() ) :
			$type  = get_sub_field( 'type' );
			$image = get_sub_field( 'image' );
			$video = get_sub_field( 'video' );
			?>
			<!-- Banner -->
			<section class="banner banner--<?php echo esc_attr( $type ); ?>">
				<div class="container">
					<div class="banner-media a-op">
						<?php
						get_template_part(
							'template-parts/content-modules',
							'media',
							array(
								'image' => $image,
								'video' => $video,
							)
						);
						?>
					</div>
					<div class="banner-content">
						<?php
						get_template_part_args(
							'template-parts/content-modules-text',
							array(
								'v'  => 'heading',
								't'  => 'h1',
								'tc' => 'banner-heading a-up',
							)
						);
						?>
						<?php
						get_template_part_args(
							'template-parts/content-modules-text',
							array(
								'v'  => 'content',
								't'  => 'div',
								'tc' => 'banner-copy a-up a-delay-1',
							)
						);
						?>
						<?php
						get_template_part_args(
							'template-parts/content-modules-cta',
							array(
								'v' => 'cta',
								'c' => 'btn btn-primary a-up a-delay-2',
							)
						);
						?>
						<?php
						get_template_part_args(
							'template-parts/content-modules-text',
							array(
								'v'  => 'description',
								't'  => 'div',
								'tc' => 'banner-desc a-up a-delay-3',
							)
						);
						?>
					</div>
				</div>
			</section>
			<?php
		elseif ( 'card_slider' == get_row_layout() ) :
			$enable_top = get_sub_field( 'enable_top_section' );
			$cards      = get_sub_field( 'cards' );
			$limit_cnt  = $enable_top ? 4 : 6;
			?>
			<!-- Cards Slider -->
			<section class="cards-slider <?php echo $enable_top ? 'cards-slider--full' : 'cards-slider--compact'; ?>">
				<?php if ( $enable_top ) : ?>
				<div class="container">
					<div class="cards-slider__left">
						<?php
						get_template_part_args(
							'template-parts/content-modules-text',
							array(
								'v'  => 'heading',
								't'  => 'h3',
								'tc' => 'cards-slider__heading a-up',
							)
						);
						?>
						<?php
						get_template_part_args(
							'template-parts/content-modules-text',
							array(
								'v'  => 'content',
								't'  => 'div',
								'tc' => 'cards-slider__content d-md-only a-up a-delay-1',
							)
						);
						?>
					</div>
					<div class="cards-slider__right">
						<?php
						get_template_part_args(
							'template-parts/content-modules-text',
							array(
								'v'  => 'description',
								't'  => 'div',
								'tc' => 'cards-slider__desc a-up',
							)
						);
						?>
						<?php
						get_template_part_args(
							'template-parts/content-modules-cta',
							array(
								'v' => 'cta',
								'c' => 'btn btn-download a-up a-delay-1',
							)
						);
						?>
					</div>
				</div>
				<?php endif; ?>
				<?php if ( have_rows( 'cards' ) ) : ?>
					<div class="cards-slider__carousel">
						<?php
						while ( have_rows( 'cards' ) ) :
							the_row();
							?>
							<div class="cards-slider__slide">
								<?php
								get_template_part_args(
									'template-parts/content-modules-image',
									array(
										'v'     => 'icon',
										'v2x'   => false,
										'is'    => false,
										'is_2x' => false,
										'c'     => 'cards-slider__slide__icon',
									)
								);
								?>
								<?php
								get_template_part_args(
									'template-parts/content-modules-text',
									array(
										'v'  => 'sub_heading',
										't'  => 'p',
										'tc' => 'cards-slider__slide__subheading',
									)
								);
								?>
								<?php
								get_template_part_args(
									'template-parts/content-modules-text',
									array(
										'v'  => 'heading',
										't'  => 'h3',
										'tc' => 'cards-slider__slide__heading',
									)
								);
								?>
								<?php
								get_template_part_args(
									'template-parts/content-modules-text',
									array(
										'v'  => 'content',
										't'  => 'p',
										'tc' => 'cards-slider__slide__content',
									)
								);
								?>
								<?php
								get_template_part_args(
									'template-parts/content-modules-cta',
									array(
										'v' => 'cta',
										'c' => 'link cards-slider__slide__cta',
									)
								);
								?>
							</div>
						<?php endwhile; ?>
					</div>
					<?php if ( count( $cards ) > $limit_cnt ) : ?>
						<div class="cards-slider__showmore d-sm-only">
							<button class="btn-show-more"><?php echo esc_html__( 'Show More' ); ?></button>
						</div>
					<?php endif; ?>
				<?php endif; ?>
			</section>
			<?php
		elseif ( 'content_image' == get_row_layout() ) :
			$image = get_sub_field( 'image' );
			$video = get_sub_field( 'video' );
			$type  = get_sub_field( 'options' );
			?>
			<!-- Content Image -->
			<section class="content-image content-image--<?php echo esc_attr( $type ); ?>">
				<div class="container">
					<div class="content-image__media">
						<?php
						get_template_part(
							'template-parts/content-modules',
							'media',
							array(
								'image' => $image,
								'video' => $video,
								'size'  => 'content-image-' . $type,
							)
						);
						?>
					</div>
					<div class="content-image__content">
						<?php
						get_template_part_args(
							'template-parts/content-modules-text',
							array(
								'v'  => 'heading',
								't'  => 'h2',
								'tc' => 'content-image__heading a-up',
							)
						);
						?>
						<?php
						get_template_part_args(
							'template-parts/content-modules-text',
							array(
								'v'  => 'content',
								't'  => 'div',
								'tc' => 'content-image__copy a-up a-delay-1',
							)
						);
						?>
						<?php if ( have_rows( 'cards' ) ) : ?>
							<div class="content-image__cards a-up a-delay-2">
								<?php
								while ( have_rows( 'cards' ) ) :
									the_row();
									get_template_part_args(
										'template-parts/content-modules-text',
										array(
											'v'  => 'text',
											't'  => 'div',
											'tc' => 'content-image__card',
										)
									);
								endwhile;
								?>
							</div>
						<?php endif; ?>
						<?php if ( have_rows( 'ctas' ) ) : ?>
							<div class="content-image__ctas a-up a-delay-2">
								<?php
								while ( have_rows( 'ctas' ) ) :
									the_row();
									$style = get_sub_field( 'style' );
									get_template_part_args(
										'template-parts/content-modules-cta',
										array(
											'v' => 'cta',
											'c' => 'btn btn-' . $style,
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
		elseif ( 'testimonials' == get_row_layout() ) :
			$testimonials = get_sub_field( 'testimonials' );
			?>
			<!-- Testimonials -->
			<?php if ( have_rows( 'testimonials' ) ) : ?>
				<section class="testimonials">
					<div class="testimonials-desktop d-md-only a-up">
						<div class="testimonials-main-slider">
							<?php
							while ( have_rows( 'testimonials' ) ) :
								the_row();
								?>
								<div class="testimonial-main__slide">
									<div class="testimonial-main__slide__inner">
										<div class="testimonial-main__content">
											<?php
											get_template_part_args(
												'template-parts/content-modules-text',
												array(
													'v'  => 'content',
													't'  => 'div',
													'tc' => 'testimonial-main__slide__content',
												)
											);
											?>
											<?php
											get_template_part_args(
												'template-parts/content-modules-cta',
												array(
													'v' => 'cta',
													'c' => 'link',
												)
											);
											?>
										</div>
										<div class="testimonial-main__media">
											<?php
											get_template_part_args(
												'template-parts/content-modules-image',
												array(
													'v'   => 'image',
													'v2x' => false,
													'is'  => 'testimonial-large',
													'is_2x' => 'testimonial-large-2x',
													'w'   => 'div',
													'wc'  => 'testimonial-main__slide__img',
												)
											);
											?>
											<div class="testimonial-main__controls">
												<div class="testimonial-main__pagination">
													<?php echo esc_html( get_row_index() ); ?> / <?php echo count( $testimonials ); ?>
												</div>
												<button class="link testimonial-next"><?php echo esc_html__( 'Next' ); ?></button>
											</div>
										</div>
									</div>
								</div>
							<?php endwhile; ?>
						</div>
						<div class="testimonials-next-slider">
							<?php
							while ( have_rows( 'testimonials' ) ) :
								the_row();
								if ( get_row_index() > 1 ) :
									?>
									<div class="testimonial-next__slide">
										<?php
										get_template_part_args(
											'template-parts/content-modules-image',
											array(
												'v'     => 'image',
												'v2x'   => false,
												'is'    => 'testimonial-large',
												'is_2x' => 'testimonial-large-2x',
												'w'     => 'div',
												'wc'    => 'testimonial-next__slide__img',
											)
										);
										?>
										<div class="testimonial-next__content">
											<?php
											get_template_part_args(
												'template-parts/content-modules-text',
												array(
													'v'  => 'content',
													't'  => 'div',
													'tc' => 'testimonial-next__slide__content',
												)
											);
											?>
										</div>
									</div>
								<?php endif; ?>
							<?php endwhile; ?>
							<?php
							while ( have_rows( 'testimonials' ) ) :
								the_row();
								if ( 1 == get_row_index() ) :
									?>
									<div class="testimonial-next__slide">
										<?php
										get_template_part_args(
											'template-parts/content-modules-image',
											array(
												'v'     => 'image',
												'v2x'   => false,
												'is'    => 'testimonial-large',
												'is_2x' => 'testimonial-large-2x',
												'w'     => 'div',
												'wc'    => 'testimonial-next__slide__img',
											)
										);
										?>
										<div class="testimonial-next__content">
											<?php
											get_template_part_args(
												'template-parts/content-modules-text',
												array(
													'v'  => 'content',
													't'  => 'div',
													'tc' => 'testimonial-next__slide__content',
												)
											);
											?>
										</div>
									</div>
								<?php endif; ?>
							<?php endwhile; ?>
						</div>
					</div>
					<div class="testimonials-mobile d-sm-only">
						<?php
						while ( have_rows( 'testimonials' ) ) :
							the_row();
							?>
							<div class="testimonial-card">
								<?php
								get_template_part_args(
									'template-parts/content-modules-image',
									array(
										'v'   => 'image',
										'v2x' => false,
										'is'  => 'testimonial-large',
										'w'   => 'div',
										'wc'  => 'testimonial-card__img',
									)
								);
								?>
								<?php
								get_template_part_args(
									'template-parts/content-modules-text',
									array(
										'v'  => 'content',
										't'  => 'div',
										'tc' => 'testimonial-card__content',
									)
								);
								?>
								<?php
								get_template_part_args(
									'template-parts/content-modules-cta',
									array(
										'v' => 'cta',
										'c' => 'link',
									)
								);
								?>
							</div>
						<?php endwhile; ?>
					</div>
				</section>
			<?php endif; ?>
			<?php
		elseif ( 'awards' == get_row_layout() ) :
			$awards = get_sub_field( 'awards' );
			?>
			<!-- Awards -->
			<section class="awards">
				<div class="container">
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
							'v'  => 'cta',
							'c'  => 'link',
							'w'  => 'div',
							'wc' => 'awards-cta',
						)
					);
					?>
				</div>
			</section>
			<?php
		elseif ( 'map' == get_row_layout() ) :
			?>
			<!-- Map -->
			<section class="map">
				<div class="container">
					<div class="map-content">
						<?php
						get_template_part_args(
							'template-parts/content-modules-text',
							array(
								'v'  => 'heading',
								't'  => 'h2',
								'tc' => 'map-heading a-up',
							)
						);
						?>
						<?php
						get_template_part_args(
							'template-parts/content-modules-text',
							array(
								'v'  => 'content',
								't'  => 'div',
								'tc' => 'map-copy a-up a-delay-1',
							)
						);
						?>
						<?php
						get_template_part_args(
							'template-parts/content-modules-cta',
							array(
								'v' => 'cta',
								'c' => 'link link-white a-up a-delay-2',
							)
						);
						?>
					</div>
					<?php
					get_template_part_args(
						'template-parts/content-modules-image',
						array(
							'v'     => 'image',
							'v2x'   => false,
							'is'    => false,
							'is_2x' => false,
							'c'     => 'map-image',
							'w'     => 'div',
							'wc'    => 'd-md-only',
						)
					);
					?>
				</div>
			</section>
			<?php
		elseif ( 'posts_slider' == get_row_layout() ) :
			$posts = get_sub_field( 'posts' );
			?>
			<!-- Posts -->
			<section class="posts-slider">
				<div class="container">
					<div class="posts-slider__content">
						<?php
						get_template_part_args(
							'template-parts/content-modules-text',
							array(
								'v'  => 'heading',
								't'  => 'h3',
								'tc' => 'posts-slider__heading a-up',
							)
						);
						?>
						<?php
						get_template_part_args(
							'template-parts/content-modules-text',
							array(
								'v'  => 'content',
								't'  => 'div',
								'tc' => 'posts-slider__copy a-up a-delay-1',
							)
						);
						?>
						<?php
						get_template_part_args(
							'template-parts/content-modules-cta',
							array(
								'v' => 'cta',
								'c' => 'link a-up a-delay-2',
							)
						);
						?>
					</div>
					<?php if ( $posts ) : ?>
						<div class="posts-slider__right">
							<div class="posts-slider__carousel">
								<?php
								foreach ( $posts as $post ) :
									setup_postdata( $post );
									get_template_part( 'template-parts/loop', 'post' );
								endforeach;
								?>
							</div>
							<div class="slider-controls d-md-only">
								<div class="slider-pagination">1 / 2</div>
								<button class="link slider-next" tabindex="0">Next</button>
							</div>
						</div>
						<?php
					endif;
					wp_reset_postdata();
					?>
				</div>
			</section>
			<?php
		elseif ( 'masonry' == get_row_layout() ) :
			$gallery = get_sub_field( 'gallery' );
			?>
			<!-- Gallery -->
			<section class="masonry">
				<div class="container">
					<?php if ( $gallery ) : ?>
					<div class="masonry-gallery">
						<?php
						foreach ( $gallery as $index => $image ) :
							$size = 'masonry-' . $index + 1;
							if ( 0 == ( $index + 1 ) % 4 ) :
								$size = 'masonry-1';
							endif;
							?>
							<img class="a-up a-delay-<?php echo esc_attr( $index ); ?>"
								src="<?php echo esc_url( $image['sizes'][ $size ] ); ?>"
								srcset="<?php echo esc_url( $image['sizes'][ $size . '-2x' ] ); ?> 2x"
								alt="<?php echo esc_attr( $image['alt'] ); ?>">
						<?php endforeach; ?>
					</div>
					<?php endif; ?>
					<div class="masonry-content">
						<?php
						get_template_part_args(
							'template-parts/content-modules-text',
							array(
								'v'  => 'heading',
								't'  => 'h3',
								'tc' => 'masonry-heading a-up',
							)
						);
						?>
						<?php
						get_template_part_args(
							'template-parts/content-modules-text',
							array(
								'v'  => 'content',
								't'  => 'div',
								'tc' => 'masonry-copy a-up a-up-delay-1',
							)
						);
						?>
						<?php
						get_template_part_args(
							'template-parts/content-modules-cta',
							array(
								'v' => 'cta',
								'c' => 'link a-up a-delay-2',
							)
						);
						?>
					</div>
				</div>
			</section>
		<?php else : ?>
		<?php endif; ?>
		<?php
	endwhile;
endif;
?>
<section class="content">
	<div class="container">
		<?php the_content(); ?>
	</div>
</section>
