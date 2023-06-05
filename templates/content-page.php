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
				<?php
				get_template_part_args(
					'template-parts/content-modules-image',
					array(
						'v'     => 'background_image',
						'v2x'   => false,
						'is'    => false,
						'is_2x' => false,
						'c'     => 'background-image',
						'w'     => 'div',
						'wc'    => 'banner-background',
					)
				);
				?>
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
						<div class="banner-media__small">
							<?php
							get_template_part_args(
								'template-parts/content-modules-image',
								array(
									'v'     => 'small_image',
									'v2x'   => false,
									'is'    => false,
									'is_2x' => false,
									'c'     => 'small-image',
								)
							);
							?>
						</div>
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
			$case_results = get_sub_field( 'case_results' );
			$theme        = get_sub_field( 'theme' ) ? get_sub_field( 'theme' ) : 'compact';
			$limit_cnt    = ( 'full' == $theme ) ? 4 : 6;
			?>
			<!-- Cards Slider -->
			<section class="cards-slider cards-slider--<?php echo esc_attr( $theme ); ?>">
				<?php if ( $case_results ) : ?>
					<div class="cards-slider__carousel">
						<?php
						foreach ( $case_results as $post ) :
							setup_postdata( $post );
							get_template_part(
								'template-parts/loop',
								'case_result',
								array(
									'theme' => $theme,
								)
							);
						endforeach;
						?>
					</div>
					<?php if ( count( $case_results ) > $limit_cnt ) : ?>
						<div class="cards-slider__showmore d-sm-only">
							<button class="btn-show-more"><?php echo esc_html__( 'Show More' ); ?></button>
						</div>
					<?php endif; ?>
					<?php
					endif;
				wp_reset_query();
				?>
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
						<?php if ( $type == 'experience-testimonial' ) : ?>
						<div class="content-image__experience">
							<?php
							get_template_part_args(
								'template-parts/content-modules-text',
								array(
									'v'  => 'experience_heading',
									't'  => 'h5',
									'tc' => 'content-image__experience__heading',
								)
							);
							?>
							<?php if ( have_rows( 'experience_cities' ) ) : ?>
							<div class="content-image__experience__cities">
								<?php
								while ( have_rows( 'experience_cities' ) ) :
									the_row();
									get_template_part_args(
										'template-parts/content-modules-text',
										array(
											'v'  => 'city',
											't'  => 'h5',
											'tc' => 'content-image__experience__cities__item a-up a-delay-1',
										)
									);
								endwhile;
								?>
							</div>
							<?php endif; ?>
						</div>
						<?php endif; ?>
					</div>
					<div class="content-image__content">
						<?php
						get_template_part_args(
							'template-parts/content-modules-text',
							array(
								'v'  => 'sub_heading',
								't'  => 'h5',
								'tc' => 'content-image__sub_heading a-up',
							)
						);
						?>
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

						<?php
						get_template_part_args(
							'template-parts/content-modules-text',
							array(
								'v'  => 'testimonial',
								't'  => 'div',
								'tc' => 'content-image__testimonial a-up a-delay-1',
							)
						);
						?>
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
											<div class="slider-controls testimonial-main__controls">
												<div class="testimonial-main__pagination slider-pagination">
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
			get_template_part( 'template-parts/section', 'award' );
			?>
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
									get_template_part( 'template-parts/loop', 'post-card' );
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
			<?php
		elseif ( 'contact_form' == get_row_layout() ) :
			$form = get_sub_field( 'form' );
			?>
			<!-- Contact Form -->
			<section class="contact-form">
				<div class="container">
					<div class="contact-form__main">
						<?php if ( have_rows( 'cards' ) ) : ?>
						<div class="contact-form__cards">
							<?php
							while ( have_rows( 'cards' ) ) :
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
						<div class="contact-form__content">
							<?php
							get_template_part_args(
								'template-parts/content-modules-text',
								array(
									'v'  => 'sub_heading',
									't'  => 'h5',
									'tc' => 'contact-form__content__sub_heading a-up a-delay-1',
								)
							);
							?>
							<?php
							get_template_part_args(
								'template-parts/content-modules-text',
								array(
									'v'  => 'heading',
									't'  => 'h3',
									'tc' => 'contact-form__content__heading a-up a-delay-1',
								)
							);
							?>
							<?php
							get_template_part_args(
								'template-parts/content-modules-text',
								array(
									'v'  => 'content',
									'w'  => 'div',
									'wc' => 'contact-form__content__content a-up a-delay-1',
								)
							);
							?>
						</div>
					</div>
					<div class="contact-form__form a-up a-delay-1">
						<?php
						get_template_part_args(
							'template-parts/content-modules-text',
							array(
								'v'  => 'form_sub_heading',
								't'  => 'h5',
								'tc' => 'contact-form__form__sub_heading',
							)
						);
						?>
						<?php
						get_template_part_args(
							'template-parts/content-modules-text',
							array(
								'v'  => 'form_heading',
								't'  => 'h4',
								'tc' => 'contact-form__form__heading',
							)
						);
						?>
						<?php
						get_template_part_args(
							'template-parts/content-modules-text',
							array(
								'v'  => 'form_content',
								't'  => 'p',
								'tc' => 'contact-form__form__content',
							)
						);
						?>
						<?php echo do_shortcode( $form ); ?>
						<?php
						get_template_part_args(
							'template-parts/content-modules-image',
							array(
								'v'     => 'logo',
								'v2x'   => false,
								'is'    => false,
								'is_2x' => false,
								'c'     => 'logo',
								'w'     => 'div',
								'wc'    => 'contact-form__form__logo',
							)
						);
						?>
					</div>
				</div>
			</section>
		<?php elseif ( 'cards_content' == get_row_layout() ) : ?>
			<!-- Two Cards and Content -->
			<section class="cards-content">
				<div class="container">
					<div class="cards-content__cards">
						<?php
						get_template_part_args(
							'template-parts/content-modules-text',
							array(
								'v'  => 'cards_heading',
								't'  => 'h5',
								'tc' => 'cards-content__cards__heading a-up',
							)
						);
						?>
						<?php if ( have_rows( 'cards' ) ) : ?>
							<div class="cards-content__cards__items">
								<?php
								while ( have_rows( 'cards' ) ) :
									the_row();
									$color = get_sub_field( 'background_color' );
									?>
									<div class="cards-content__cards__item a-up a-delay-1" style="background-color: <?php echo esc_attr( $color ); ?>">
										<?php
										get_template_part_args(
											'template-parts/content-modules-text',
											array(
												'v'  => 'heading',
												't'  => 'h5',
												'tc' => 'cards-content__cards__item__heading',
											)
										);
										?>
										<?php
										get_template_part_args(
											'template-parts/content-modules-text',
											array(
												'v'  => 'content',
												'w'  => 'div',
												'wc' => 'cards-content__cards__item__content',
											)
										);
										?>
									</div>
								<?php endwhile; ?>
							</div>
						<?php endif; ?>
					</div>
					<div class="cards-content__content">
						<?php
						get_template_part_args(
							'template-parts/content-modules-text',
							array(
								'v'  => 'content_heading',
								't'  => 'h5',
								'tc' => 'cards-content__content__heading a-up a-delay-1',
							)
						);
						?>
						<?php
						get_template_part_args(
							'template-parts/content-modules-text',
							array(
								'v'  => 'content',
								'w'  => 'div',
								'wc' => 'cards-content__content__content a-up a-delay-1',
							)
						);
						?>
					</div>
				</div>
			</section>
		<?php elseif ( 'testimonials_slider' == get_row_layout() ) : ?>
			<!-- Testimonial Slider -->
			<section class="testimonial-slider">
				<?php if ( have_rows( 'testimonials' ) ) : ?>
				<div class="testimonial-slider__items">
					<?php
					while ( have_rows( 'testimonials' ) ) :
						the_row();
						?>
					<div class="testimonial-slider__item">
						<?php
						get_template_part_args(
							'template-parts/content-modules-text',
							array(
								'v'  => 'content',
								'w'  => 'div',
								'wc' => 'testimonial-slider__item__content',
							)
						);
						?>
						<div class="testimonial-slider__item__info">
							<?php
							get_template_part_args(
								'template-parts/content-modules-text',
								array(
									'v'  => 'name',
									't'  => 'h5',
									'tc' => 'testimonial-slider__item__name',
								)
							);
							?>
						</div>
					</div>
					<?php endwhile; ?>
				</div>
				<?php endif; ?>
			</section>
		<?php elseif ( 'milestone_cards' == get_row_layout() ) : ?>
			<!-- Milestone Cards -->
			<section class="milestone-cards">
				<div class="container">
					<?php
					get_template_part_args(
						'template-parts/content-modules-text',
						array(
							'v'  => 'heading',
							't'  => 'h3',
							'tc' => 'milestone-cards__heading a-up',
						)
					);
					?>
					<?php if ( have_rows( 'cards' ) ) : ?>
						<div class="milestone-cards__items">
							<?php
							while ( have_rows( 'cards' ) ) :
								the_row();
								$color = get_sub_field( 'background_color' );
								?>
							<div class="milestone-cards__item a-up a-delay-1" style="background-color: <?php echo esc_attr( $color ); ?>">
								<?php
								get_template_part_args(
									'template-parts/content-modules-text',
									array(
										'v'  => 'heading',
										't'  => 'h3',
										'tc' => 'milestone-cards__item__heading',
									)
								);
								?>
								<?php
								get_template_part_args(
									'template-parts/content-modules-text',
									array(
										'v'  => 'sub_heading',
										't'  => 'h6',
										'tc' => 'milestone-cards__item__sub_heading',
									)
								);
								?>
								<?php
								get_template_part_args(
									'template-parts/content-modules-text',
									array(
										'v'  => 'content',
										'w'  => 'div',
										'wc' => 'milestone-cards__item__content',
									)
								);
								?>
							</div>
							<?php endwhile; ?>
						</div>
					<?php endif; ?>
				</div>
			</section>
		<?php elseif ( 'podcasts' == get_row_layout() ) : ?>
		<!-- Podcasts -->
			<section class="podcasts">
				<div class="container">
					<?php
					get_template_part_args(
						'template-parts/content-modules-text',
						array(
							'v'  => 'sub_heading',
							't'  => 'h5',
							'tc' => 'podcasts-sub_heading a-up',
						)
					);
					?>
					<div class="podcasts-info">
						<?php
						get_template_part_args(
							'template-parts/content-modules-text',
							array(
								'v'  => 'heading',
								't'  => 'h3',
								'tc' => 'podcasts-heading a-up a-delay-1',
							)
						);
						?>
						<?php
						get_template_part_args(
							'template-parts/content-modules-cta',
							array(
								'v' => 'cta',
								'c' => 'podcasts-cta link a-up a-delay-1',
							)
						);
						?>
					</div>
					<?php if ( have_rows( 'podcasts' ) ) : ?>
						<div class="podcasts-items">
							<?php
							while ( have_rows( 'podcasts' ) ) :
								the_row();
								$image = get_sub_field( 'image' );
								$video = get_sub_field( 'video' );
								?>
							<div class="podcasts-item a-up a-delay-1">
								<div class="podcasts-item__media">
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
								<?php
								get_template_part_args(
									'template-parts/content-modules-text',
									array(
										'v'  => 'heading',
										't'  => 'h6',
										'tc' => 'podcasts-item__heading',
									)
								);
								?>
								<?php
								get_template_part_args(
									'template-parts/content-modules-text',
									array(
										'v'  => 'content',
										'w'  => 'div',
										'wc' => 'podcasts-item__content',
									)
								);
								?>
							</div>
							<?php endwhile; ?>
						</div>
					<?php endif; ?>
				</div>
			</section>
			<?php
		elseif ( 'video_content' == get_row_layout() ) :
			$image = get_sub_field( 'image' );
			$video = get_sub_field( 'video' );
			?>
			<!-- Section Video Content -->
			<section class="video-content">
				<div class="container">
					<div class="video-content__wrapper">
						<?php
						get_template_part_args(
							'template-parts/content-modules-text',
							array(
								'v'  => 'heading',
								't'  => 'h5',
								'tc' => 'video-content__heading a-up',
							)
						);
						?>
						<div class="video-content__main">
							<div class="video-content__video a-up a-delay-1">
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
							<div class="video-content__content a-up a-delay-1">
								<?php
								get_template_part_args(
									'template-parts/content-modules-text',
									array(
										'v'  => 'content',
										'w'  => 'div',
										'wc' => 'video-content__text',
									)
								);
								?>
								<?php
								get_template_part_args(
									'template-parts/content-modules-cta',
									array(
										'v' => 'cta',
										'c' => 'video-content__cta link',
									)
								);
								?>
							</div>
						</div>
					</div>
				</div>
			</section>
			<?php
		elseif ( 'accordion' == get_row_layout() ) :
			$content_type    = get_sub_field( 'content_type' );
			$case_categories = get_field( 'case_category' );
			$claim_types     = get_field( 'claim_type' );
			?>
			<!-- Practice FAQs -->
			<section class="practice-faqs">
				<div class="container">
					<div class="practice-faqs__info a-up">
						<?php
						get_template_part_args(
							'template-parts/content-modules-text',
							array(
								'v'  => 'sub_heading',
								't'  => 'h5',
								'tc' => 'practice-faqs__sub_heading',
							)
						);
						?>
						<?php
						get_template_part_args(
							'template-parts/content-modules-text',
							array(
								'v'  => 'heading',
								't'  => 'h3',
								'tc' => 'practice-faqs__heading',
							)
						);
						?>
					</div>
					<?php if ( 'manual' == $content_type ) : ?>
						<?php if ( have_rows( 'accordions' ) ) : ?>
						<div class="practice-faqs__items a-up a-delay-1">
							<?php
							while ( have_rows( 'accordions' ) ) :
								the_row();
								?>
								<div class="accordion practice-faqs__item">
									<?php
									$heading = get_sub_field( 'heading' );
									if ( $heading ) :
										?>
										<h5 class="accordion-header practice-faqs__item__heading">
											<span class="accordion-header__icon"></span>
											<?php echo $heading; ?>
										</h5>
									<?php endif; ?>
									<div class="accordion-body practice-faqs__item__main">
										<?php
										get_template_part_args(
											'template-parts/content-modules-text',
											array(
												'v'  => 'content',
												'w'  => 'div',
												'wc' => 'practice-faqs__item__content',
											)
										);
										?>
										<?php
										get_template_part_args(
											'template-parts/content-modules-cta',
											array(
												'v' => 'cta',
												'c' => 'practice-faqs__item__cta link',
											)
										);
										?>
									</div>
								</div>
							<?php endwhile; ?>
						</div>
						<?php endif; ?>
					<?php else : ?>
						<?php
						$tax_query = array();
						if ( $case_categories ) {
							$tax_query[] = array(
								'taxonomy' => 'case_category',
								'terms'    => $case_categories,
							);
						}
						if ( $claim_types ) {
							$tax_query[] = array(
								'taxonomy' => 'claim_type',
								'terms'    => $claim_types,
							);
						}
						if ( $case_categories && $claim_types ) {
							$tax_query['relation'] = 'AND';
						}
						$args  = array(
							'post_type'      => 'faq',
							'post_status'    => 'publish',
							'posts_per_page' => -1,
							'tax_query'      => $tax_query,
						);
						$query = new WP_Query( $args );
						if ( $query->have_posts() ) :
							?>
							<div class="practice-faqs__items a-up a-delay-1">
								<?php
								while ( $query->have_posts() ) :
									$query->the_post();
									?>
									<div class="accordion practice-faqs__item">
										<h5 class="accordion-header practice-faqs__item__heading">
											<span class="accordion-header__icon"></span>
											<?php the_title(); ?>
										</h5>
										<div class="accordion-body practice-faqs__item__main">
											<?php
											get_template_part_args(
												'template-parts/content-modules-text',
												array(
													'v'  => 'direct_answer',
													'w'  => 'div',
													'wc' => 'practice-faqs__item__content',
													'o'  => 'f',
												)
											);
											?>
											<a href="<?php echo esc_url( get_the_permalink() ); ?>" class="practice-faqs__item__cta link">
												<?php echo esc_html__( 'Read more' ); ?>
											</a>
										</div>
									</div>
								<?php endwhile; ?>
							</div>
							<?php
						endif;
						wp_reset_postdata();
						?>
					<?php endif; ?>
				</div>
			</section>
			<?php
		elseif ( 'case_results' == get_row_layout() ) :
			$content_type    = get_sub_field( 'content_type' );
			$case_categories = get_field( 'case_category' );
			$claim_types     = get_field( 'claim_type' );
			?>
			<!-- Practice Case Results -->
			<section class="case-results">
				<div class="container">
					<div class="case-results__info a-up">
						<?php
						get_template_part_args(
							'template-parts/content-modules-text',
							array(
								'v'  => 'sub_heading',
								't'  => 'h5',
								'tc' => 'case-results__sub_heading',
							)
						);
						?>
						<?php
						get_template_part_args(
							'template-parts/content-modules-text',
							array(
								'v'  => 'heading',
								't'  => 'h3',
								'tc' => 'case-results__heading',
							)
						);
						?>
					</div>
					<?php if ( 'manual' == $content_type ) : ?>
						<?php if ( have_rows( 'results' ) ) : ?>
						<div class="case-results__items a-up a-delay-1">
							<?php
							while ( have_rows( 'results' ) ) :
								the_row();
								?>
							<div class="case-results__item">
								<?php
								get_template_part_args(
									'template-parts/content-modules-image',
									array(
										'v'     => 'icon',
										'v2x'   => false,
										'is'    => false,
										'is_2x' => false,
										'c'     => 'icon',
										'w'     => 'div',
										'wc'    => 'case-results__item__icon',
									)
								);
								?>
								<div class="case-results__item__info">
									<div class="case-results__item__main">
										<?php
										get_template_part_args(
											'template-parts/content-modules-text',
											array(
												'v'  => 'heading',
												't'  => 'h5',
												'tc' => 'case-results__item__heading',
											)
										);
										?>
										<?php
										get_template_part_args(
											'template-parts/content-modules-text',
											array(
												'v'  => 'content',
												't'  => 'p',
												'tc' => 'case-results__item__content',
											)
										);
										?>
									</div>
									<div class="case-results__item__val">
										<?php
										get_template_part_args(
											'template-parts/content-modules-text',
											array(
												'v'  => 'value',
												't'  => 'h2',
												'tc' => 'case-results__item__value',
											)
										);
										?>
										<?php
										get_template_part_args(
											'template-parts/content-modules-text',
											array(
												'v'  => 'value_caption',
												't'  => 'h5',
												'tc' => 'case-results__item__value_caption',
											)
										);
										?>
									</div>
								</div>
							</div>
							<?php endwhile; ?>
						</div>
						<?php endif; ?>
					<?php else : ?>
						<?php
						$tax_query = array();
						if ( $case_categories ) {
							$tax_query[] = array(
								'taxonomy' => 'case_category',
								'terms'    => $case_categories,
							);
						}
						if ( $claim_types ) {
							$tax_query[] = array(
								'taxonomy' => 'claim_type',
								'terms'    => $claim_types,
							);
						}
						if ( $case_categories && $claim_types ) {
							$tax_query['relation'] = 'AND';
						}
						$args  = array(
							'post_type'      => 'case_result',
							'post_status'    => 'publish',
							'posts_per_page' => -1,
							'tax_query'      => $tax_query,
						);
						$query = new WP_Query( $args );
						if ( $query->have_posts() ) :
							?>
							<div class="case-results__items a-up a-delay-1">
								<?php
								while ( $query->have_posts() ) :
									$query->the_post();
									$categories = get_the_terms( $post, 'case_category' );
									$price      = get_field( 'price' );
									$content    = get_field( 'content' );
									?>
									<div class="case-results__item">
										<?php
										if ( $categories ) :
											$category = $categories[0];
											$image    = get_field( 'icon', 'case_category' . '_' . $category->term_id );
											if ( $image ) :
												?>
												<div class="case-results__item__icon">
													<img src="<?php echo esc_url( $image['url'] ); ?>" alt="<?php echo esc_attr( $category->name ); ?>" class="icon">
												</div>
											<?php endif; ?>
										<?php endif; ?>
										<div class="case-results__item__info">
											<div class="case-results__item__main">
												<h5 class="case-results__item__heading">
													<?php the_title(); ?>
												</h5>
												<?php if ( $content ) : ?>
													<p class="case-results__item__content">
														<?php echo wp_trim_words( $content, 20, '...' ); ?>
													</p>
												<?php endif; ?>
											</div>
											<div class="case-results__item__val">
												<h2 class="case-results__item__value"><?php echo esc_html( '$' . floatval( $price ) / 1000000 ); ?></h3>
												<h5 class="case-results__item__value_caption"><?php echo esc_html__( 'Million' ); ?></p>
											</div>
										</div>
									</div>
								<?php endwhile; ?>
							</div>
							<?php
						endif;
						wp_reset_postdata();
						?>
					<?php endif; ?>
				</div>
			</section>
		<?php elseif ( 'practice_areas' == get_row_layout() ) : ?>
			<!-- Practice Areas -->
			<section class="practice-areas">
				<div class="container">
					<div class="practice-areas__main">
						<div class="practice-areas__title a-up">
							<?php
							get_template_part_args(
								'template-parts/content-modules-text',
								array(
									'v'  => 'sub_heading',
									't'  => 'h5',
									'tc' => 'practice-areas__sub_heading',
								)
							);
							?>
							<?php
							get_template_part_args(
								'template-parts/content-modules-text',
								array(
									'v'  => 'heading',
									't'  => 'h3',
									'tc' => 'practice-areas__heading',
								)
							);
							?>
							<div class="practice-areas__title__map a-up a-delay-1">
								<?php
								get_template_part_args(
									'template-parts/content-modules-image',
									array(
										'v'     => 'map',
										'v2x'   => false,
										'is'    => false,
										'is_2x' => false,
										'c'     => 'area-map',
									)
								);
								?>
							</div>
						</div>
						<?php if ( have_rows( 'areas' ) ) : ?>
						<div class="practice-areas__items a-up a-delay-1">
							<?php
							while ( have_rows( 'areas' ) ) :
								the_row();
								?>
								<div class="practice-areas__item">
									<?php if ( have_rows( 'items' ) ) : ?>
										<?php
										while ( have_rows( 'items' ) ) :
											the_row();
											?>
											<?php
											get_template_part_args(
												'template-parts/content-modules-text',
												array(
													'v'  => 'area',
													't'  => 'h5',
													'tc' => 'practice-areas__item__area',
												)
											);
											?>
											<?php
											endwhile;
									endif;
									?>
								</div>
							<?php endwhile; ?>
						</div>
						<?php endif; ?>
						<?php
						get_template_part_args(
							'template-parts/content-modules-cta',
							array(
								'v' => 'cta',
								'c' => 'practice-areas__cta link a-up a-delay-1',
							)
						);
						?>
					</div>
					<div class="practice-areas__map a-up a-delay-1">
						<?php
						get_template_part_args(
							'template-parts/content-modules-image',
							array(
								'v'     => 'map',
								'v2x'   => false,
								'is'    => false,
								'is_2x' => false,
								'c'     => 'area-map',
							)
						);
						?>
					</div>
				</div>
			</section>
		<?php elseif ( 'block_content' == get_row_layout() ) : ?>
			<!-- Block Content -->
			<section class="block-content">
				<div class="container">
					<?php
					get_template_part_args(
						'template-parts/content-modules-text',
						array(
							'v'  => 'sub_heading',
							't'  => 'h5',
							'tc' => 'block-content__sub_heading a-up a-delay-1',
						)
					);
					?>
					<?php
					get_template_part_args(
						'template-parts/content-modules-text',
						array(
							'v'  => 'heading',
							't'  => 'h3',
							'tc' => 'block-content__heading a-up a-delay-1',
						)
					);
					?>
					<?php if ( have_rows( 'blocks' ) ) : ?>
					<div class="block-content__items">
						<?php
						while ( have_rows( 'blocks' ) ) :
							the_row();
							$type = get_sub_field( 'type' );
							?>
						<div class="block-content__item <?php echo esc_attr( $type ); ?> a-up a-delay-1">
							<?php
							get_template_part_args(
								'template-parts/content-modules-text',
								array(
									'v'  => 'heading',
									't'  => 'p',
									'tc' => 'block-content__item__heading',
								)
							);
							?>
							<div class="block-content__item__main">
								<div class="block-content__item__block">
									<?php
									get_template_part_args(
										'template-parts/content-modules-text',
										array(
											'v'  => 'block_heading',
											't'  => 'h4',
											'tc' => 'block-content__item__block__heading',
										)
									);
									?>
									<?php
									get_template_part_args(
										'template-parts/content-modules-text',
										array(
											'v'  => 'block_content',
											'w'  => 'div',
											'wc' => 'block-content__item__block__content',
										)
									);
									?>
									<?php
									get_template_part_args(
										'template-parts/content-modules-cta',
										array(
											'v' => 'block_cta',
											'c' => 'block-content__item__block__cta link',
										)
									);
									?>
								</div>
								<?php
								get_template_part_args(
									'template-parts/content-modules-text',
									array(
										'v'  => 'content',
										'w'  => 'div',
										'wc' => 'block-content__item__content',
									)
								);
								?>
							</div>
						</div>
						<?php endwhile; ?>
					</div>
					<?php endif; ?>
				</div>
			</section>
			<?php
		elseif ( 'navigation_bar' == get_row_layout() ) :
			$social = get_sub_field( 'social' );
			?>
			<!-- Navigation Bar -->
			<section class="navigation-bar">
				<div class="container">
					<div class="navigation-bar__main">
						<div class="navigation-bar__nav">
							<?php
							get_template_part_args(
								'template-parts/content-modules-text',
								array(
									'v'  => 'section_heading',
									't'  => 'h5',
									'tc' => 'navigation-bar__nav__heading',
								)
							);
							?>
							<?php if ( have_rows( 'sections' ) ) : ?>
							<div class="navigation-bar__nav__menu">
								<?php
								while ( have_rows( 'sections' ) ) :
									the_row();
									?>
								<div class="navigation-bar__nav__menu__item">
									<?php
									get_template_part_args(
										'template-parts/content-modules-cta',
										array(
											'v' => 'cta',
											'c' => 'navigation-bar__nav__menu__item__cta',
										)
									);
									?>
								</div>
								<?php endwhile; ?>
							</div>
							<?php endif; ?>
						</div>
						<div class="navigation-bar__social">
							<?php
							get_template_part_args(
								'template-parts/content-modules-text',
								array(
									'v'  => 'feedback_heading',
									't'  => 'h5',
									'tc' => 'navigation-bar__social__heading',
								)
							);
							?>
							<ul class="navigation-bar__social__items">
								<li class="navigation-bar__social__item facebook" data-url="<?php echo the_permalink(); ?>"><a href="http://facebook.com/sharer.php?u=<?php esc_url( the_permalink() ); ?>"><img src="<?php echo esc_url( get_template_directory_uri() . '/assets/img/facebook.svg' ); ?>" alt="twitter" class="navigation-bar__social__item__img"></a></li>
								<li class="navigation-bar__social__item twitter" data-url="<?php the_permalink(); ?>"><img src="<?php echo esc_url( get_template_directory_uri() . '/assets/img/twitter.svg' ); ?>" alt="linkedin" class="navigation-bar__social__item__img"></li>
								<li class="navigation-bar__social__item share" data-url=""><img src="<?php echo esc_url( get_template_directory_uri() . '/assets/img/share.svg' ); ?>" alt="linkedin" class="navigation-bar__social__item__img"></li>
							</ul>
						</div>
					</div>
				</div>
			</section>
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
