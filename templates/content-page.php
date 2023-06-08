<?php
global $post;

if ( have_rows( 'modules' ) ) :
	while ( have_rows( 'modules' ) ) :
		the_row();
		$anchor_id = get_sub_field( 'anchor_id' );
		?>
		<?php
		if ( 'banner' == get_row_layout() ) :
			$type  = get_sub_field( 'type' );
			$image = get_sub_field( 'image' );
			$video = get_sub_field( 'video' );
			$claim_types = get_the_terms( $post, 'claim_type' );
			?>
			<!-- Banner -->
			<section class="banner banner--<?php echo esc_attr( $type ); ?>"
				<?php echo $anchor_id ? ' id="' . esc_attr( $anchor_id ) . '"' : ''; ?>>
				<div class="container">
						<?php
					if ( 'home' != $type ) :
						$parents = get_post_parent( $post );
						?>
						<ul class="breadcrumbs a-up">
							<li>
								<a href="<?php echo esc_url( home_url() ); ?>"><?php echo esc_html( 'Home' ); ?></a>
							</li>
							<li>
								<?php if ( 'city' == get_post_type( ) ) : ?>
								<a href="<?php echo esc_url( home_url( '/areas-we-serve/' ) ); ?>">
									<?php echo esc_html( 'Areas We Serve' ); ?>
								</a>
								<?php else : ?>
									<?php if ( $claim_types ) : ?>
									<span>
										<?php echo esc_html( $claim_types[0]->name ); ?>
									</span>
									<?php endif; ?>
								<?php endif; ?>
							</li>
							<?php if ( $parents ) : ?>
								<li>
									<a href="<?php echo esc_url( get_the_permalink( $parents ) ); ?>">
										<?php echo esc_html( get_the_title( $parents ) ); ?>
									</a>
								</li>
							<?php endif; ?>
							<li>
								<span><?php the_title(); ?></span>
							</li>
						</ul>
					<?php endif; ?>
					<div class="banner-inner">
						<?php if ( 'practice-cards' != $type ) : ?>
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
						<?php else : ?>
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
									<?php if ( 'money' == $type ) : ?>
										<div class="item-badge">
											<svg width="16" height="28" viewBox="0 0 16 28" fill="none" xmlns="http://www.w3.org/2000/svg">
												<path opacity="0.8" d="M9.09375 4.18945C10.7285 4.34766 12.3105 4.66406 13.4707 4.98047C13.9453 5.08594 14.209 5.50781 14.1035 5.98242C13.998 6.45703 13.5234 6.7207 13.1016 6.61523C11.3613 6.19336 8.77734 5.66602 6.50977 5.87695C5.40234 5.98242 4.45312 6.19336 3.76758 6.66797C3.08203 7.14258 2.60742 7.77539 2.39648 8.77734C2.23828 9.56836 2.34375 10.1484 2.55469 10.5703C2.76562 11.0449 3.13477 11.4141 3.71484 11.7832C4.875 12.5215 6.5625 12.9434 8.46094 13.4707H8.51367C10.3066 13.9453 12.2578 14.4727 13.6289 15.3691C14.3672 15.8438 15 16.4238 15.4219 17.2148C15.791 18.0586 15.8965 19.0078 15.7383 20.0625C15.3691 21.8555 14.1035 23.0684 12.416 23.7539C11.4141 24.123 10.3066 24.334 9.09375 24.3867V26.918C9.09375 27.3926 8.67188 27.7617 8.25 27.7617C7.77539 27.7617 7.40625 27.3926 7.40625 26.918V24.334C7.03711 24.2812 6.7207 24.2812 6.4043 24.2285C4.98047 24.0176 2.92383 23.543 1.13086 22.752C0.708984 22.5938 0.498047 22.0664 0.708984 21.6445C0.867188 21.2227 1.39453 21.0117 1.81641 21.2227C3.39844 21.9082 5.34961 22.3301 6.61523 22.541C8.67188 22.8574 10.4648 22.6992 11.7832 22.1719C13.1016 21.6445 13.8398 20.8535 14.0508 19.7461C14.209 18.9551 14.1035 18.4277 13.8926 17.9531C13.6816 17.5312 13.3125 17.1094 12.7324 16.793C11.5723 16.0547 9.88477 15.5801 7.98633 15.1055L7.93359 15.0527C6.14062 14.5781 4.18945 14.1035 2.81836 13.207C2.08008 12.7324 1.44727 12.0996 1.02539 11.3086C0.65625 10.5176 0.550781 9.56836 0.708984 8.46094C1.02539 6.98438 1.76367 5.98242 2.81836 5.24414C3.87305 4.61133 5.13867 4.29492 6.4043 4.18945C6.7207 4.13672 7.03711 4.13672 7.40625 4.13672V1.60547C7.40625 1.18359 7.77539 0.761719 8.25 0.761719C8.67188 0.761719 9.09375 1.18359 9.09375 1.60547V4.18945Z" fill="#78BE38"/>
											</svg>
										</div>
										<?php
									else: 
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
									endif;
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
						<?php endif; ?>
						<div class="banner-content">
							<?php if ( 'home' != $type && $claim_types ) :
								$img = get_field( 'icon', 'claim_type_' . $claim_types[0]->term_id );  ?>
								<div class="banner-categories">
									<?php if ( $img ) : ?>
										<img src="<?php echo esc_url( $img['url'] ); ?>" alt="<?php echo esc_attr( $img['alt'] ); ?>">
									<?php endif; ?>
									<h6 class="banner-subheading"><?php echo esc_html( $claim_types[0]->name ); ?></h6>
								</div>
							<?php endif; ?>
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
				</div>
			</section>
			<?php
		elseif ( 'card_slider' == get_row_layout() ) :
			$case_results = get_sub_field( 'case_results' );
			$theme        = get_sub_field( 'theme' ) ? get_sub_field( 'theme' ) : 'compact';
			$limit_cnt    = ( 'full' == $theme ) ? 4 : 6;
			?>
			<!-- Cards Slider -->
			<section class="cards-slider cards-slider--<?php echo esc_attr( $theme ); ?>"
				<?php echo $anchor_id ? ' id="' . esc_attr( $anchor_id ) . '"' : ''; ?>>
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
			$image     = get_sub_field( 'image' );
			$video     = get_sub_field( 'video' );
			$type      = get_sub_field( 'options' );
			$direction = get_sub_field( 'content_direction' );
			?>
			<!-- Content Image -->
			<section class="content-image content-image--<?php echo esc_attr( $type ); ?> content-image--<?php echo esc_attr( $direction ); ?>"
				<?php echo $anchor_id ? ' id="' . esc_attr( $anchor_id ) . '"' : ''; ?>>
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
						<?php if ( 'experience-testimonial' == $type ) : ?>
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
								<?php
								$claim_types = get_sub_field( 'claim_type' );
								if ( $claim_types ) :
									$args  = array(
										'post_type'      => 'city',
										'post_status'    => 'publish',
										'post__not_in'   => array( get_the_ID() ),
										'posts_per_page' => 10,
										'tax_query'      => array(
											array(
												'taxonomy' => 'claim_type',
												'field'    => 'term_id',
												'terms'    => $claim_types,
											),
										),
									);
									$query = new WP_Query( $args );
									if ( $query->have_posts() ) :
										?>
										<ul class="content-image__experience__cities">
											<?php
											while ( $query->have_posts() ) :
												$query->the_post();
												$state = get_the_terms( $post, 'state' );
												?>
												<li>
													<a href="<?php echo esc_url( get_the_permalink() ); ?>">
														<?php echo $state ? $state[0]->name . ', ' : ''; ?><?php the_title(); ?>
													</a>
												</li>
												<?php
											endwhile;
											?>
										</ul>
										<?php
									endif;
									wp_reset_postdata();
								endif;
								?>
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
				<section class="testimonials"
					<?php echo $anchor_id ? ' id="' . esc_attr( $anchor_id ) . '"' : ''; ?>>
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
			<section class="map"<?php echo $anchor_id ? ' id="' . esc_attr( $anchor_id ) . '"' : ''; ?>>
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
			<section class="posts-slider"<?php echo $anchor_id ? ' id="' . esc_attr( $anchor_id ) . '"' : ''; ?>>
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
			<section class="masonry"<?php echo $anchor_id ? ' id="' . esc_attr( $anchor_id ) . '"' : ''; ?>>
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
			<section class="contact-form"<?php echo $anchor_id ? ' id="' . esc_attr( $anchor_id ) . '"' : ''; ?>>
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
								<?php if ( 'money' == $type ) : ?>
									<div class="item-badge">
										<svg width="16" height="28" viewBox="0 0 16 28" fill="none" xmlns="http://www.w3.org/2000/svg">
											<path opacity="0.8" d="M9.09375 4.18945C10.7285 4.34766 12.3105 4.66406 13.4707 4.98047C13.9453 5.08594 14.209 5.50781 14.1035 5.98242C13.998 6.45703 13.5234 6.7207 13.1016 6.61523C11.3613 6.19336 8.77734 5.66602 6.50977 5.87695C5.40234 5.98242 4.45312 6.19336 3.76758 6.66797C3.08203 7.14258 2.60742 7.77539 2.39648 8.77734C2.23828 9.56836 2.34375 10.1484 2.55469 10.5703C2.76562 11.0449 3.13477 11.4141 3.71484 11.7832C4.875 12.5215 6.5625 12.9434 8.46094 13.4707H8.51367C10.3066 13.9453 12.2578 14.4727 13.6289 15.3691C14.3672 15.8438 15 16.4238 15.4219 17.2148C15.791 18.0586 15.8965 19.0078 15.7383 20.0625C15.3691 21.8555 14.1035 23.0684 12.416 23.7539C11.4141 24.123 10.3066 24.334 9.09375 24.3867V26.918C9.09375 27.3926 8.67188 27.7617 8.25 27.7617C7.77539 27.7617 7.40625 27.3926 7.40625 26.918V24.334C7.03711 24.2812 6.7207 24.2812 6.4043 24.2285C4.98047 24.0176 2.92383 23.543 1.13086 22.752C0.708984 22.5938 0.498047 22.0664 0.708984 21.6445C0.867188 21.2227 1.39453 21.0117 1.81641 21.2227C3.39844 21.9082 5.34961 22.3301 6.61523 22.541C8.67188 22.8574 10.4648 22.6992 11.7832 22.1719C13.1016 21.6445 13.8398 20.8535 14.0508 19.7461C14.209 18.9551 14.1035 18.4277 13.8926 17.9531C13.6816 17.5312 13.3125 17.1094 12.7324 16.793C11.5723 16.0547 9.88477 15.5801 7.98633 15.1055L7.93359 15.0527C6.14062 14.5781 4.18945 14.1035 2.81836 13.207C2.08008 12.7324 1.44727 12.0996 1.02539 11.3086C0.65625 10.5176 0.550781 9.56836 0.708984 8.46094C1.02539 6.98438 1.76367 5.98242 2.81836 5.24414C3.87305 4.61133 5.13867 4.29492 6.4043 4.18945C6.7207 4.13672 7.03711 4.13672 7.40625 4.13672V1.60547C7.40625 1.18359 7.77539 0.761719 8.25 0.761719C8.67188 0.761719 9.09375 1.18359 9.09375 1.60547V4.18945Z" fill="#78BE38"/>
										</svg>
									</div>
									<?php
								else: 
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
								endif;
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
			<section class="cards-content"<?php echo $anchor_id ? ' id="' . esc_attr( $anchor_id ) . '"' : ''; ?>>
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
			<section class="testimonial-slider"<?php echo $anchor_id ? ' id="' . esc_attr( $anchor_id ) . '"' : ''; ?>>
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
			<section class="milestone-cards"<?php echo $anchor_id ? ' id="' . esc_attr( $anchor_id ) . '"' : ''; ?>>
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
			<?php
		elseif ( 'podcasts' == get_row_layout() ) :
			$podcasts = get_sub_field( 'podcasts' );
			?>
		<!-- Podcasts -->
			<section class="podcasts"<?php echo $anchor_id ? ' id="' . esc_attr( $anchor_id ) . '"' : ''; ?>>
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
					<?php if ( $podcasts ) : ?>
						<div class="podcasts-items">
							<?php
							foreach ( $podcasts as $post ) :
								setup_postdata( $post );
								$youtube_id  = get_field( 'youtube_video_id' );
								$youtube_url = 'https://www.youtube.com/embed/' . $youtube_id . '?feature=oembed';
								?>
								<div class="podcasts-item a-up a-delay-1">
									<?php if ( has_post_thumbnail() ) : ?>
									<div class="podcasts-item__media video-player">
										<?php the_post_thumbnail(); ?>
										<a href="<?php echo esc_url( $youtube_url ); ?>" class="video-player__btn" data-fancybox>
											<img src="<?php echo esc_url( get_template_directory_uri() . '/assets/img/icon-play-blue.svg' ); ?>" alt="Play">
										</a>
									</div>
									<?php endif; ?>
									<h6 class="opdcasts-item__heading"><?php the_title(); ?></h6>
									<?php if ( has_excerpt() ) : ?>
										<div class="podcasts-item__content"><?php the_excerpt(); ?></div>
									<?php endif; ?>
								</div>
							<?php endforeach; ?>
						</div>
						<?php
						endif;
					wp_reset_postdata();
					?>
				</div>
			</section>
			<?php
		elseif ( 'video_content' == get_row_layout() ) :
			$image = get_sub_field( 'image' );
			$video = get_sub_field( 'video' );
			?>
			<!-- Section Video Content -->
			<section class="video-content"<?php echo $anchor_id ? ' id="' . esc_attr( $anchor_id ) . '"' : ''; ?>>
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
							<div class="video-content__video a-up a-delay-1 video-player">
								<?php
								get_template_part(
									'template-parts/content-modules',
									'media',
									array(
										'image'            => $image,
										'video'            => $video,
										'disable_autoplay' => true,
									)
								);
								?>
								<?php if ( $video ) : ?>
									<a href="<?php echo esc_url( $video ); ?>" class="video-player__btn" data-fancybox>
										<img src="<?php echo esc_url( get_template_directory_uri() . '/assets/img/icon-play-blue.svg' ); ?>" alt="Play">
									</a>
								<?php endif; ?>
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
			$case_categories = get_sub_field( 'case_category' );
			$claim_types     = get_sub_field( 'claim_type' );
			?>
			<!-- Practice FAQs -->
			<section class="practice-faqs"<?php echo $anchor_id ? ' id="' . esc_attr( $anchor_id ) . '"' : ''; ?>>
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
			$case_categories = get_sub_field( 'case_category' );
			$claim_types     = get_sub_field( 'claim_type' );
			?>
			<!-- Practice Case Results -->
			<section class="case-results"<?php echo $anchor_id ? ' id="' . esc_attr( $anchor_id ) . '"' : ''; ?>>
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
			<section class="practice-areas"<?php echo $anchor_id ? ' id="' . esc_attr( $anchor_id ) . '"' : ''; ?>>
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
			<section class="block-content"<?php echo $anchor_id ? ' id="' . esc_attr( $anchor_id ) . '"' : ''; ?>>
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
					<?php
					get_template_part_args(
						'template-parts/content-modules-cta',
						array(
							'v' => 'cta',
							'c' => 'btn btn-primary block-content__cta',
						)
					);
					?>
				</div>
			</section>
			<?php
		elseif ( 'navigation_bar' == get_row_layout() ) :
			$social = get_sub_field( 'social' );
			?>
			<!-- Navigation Bar -->
			<section class="navigation-bar"<?php echo $anchor_id ? ' id="' . esc_attr( $anchor_id ) . '"' : ''; ?>>
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
									if ( get_row_index() < 4 ) :
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
									<?php endif; ?>
								<?php endwhile; ?>
								<?php if ( count( get_sub_field( 'sections' ) ) > 3 ) : ?>
									<div class="navigation-bar__nav__menu__item">
										<a href="javascript:;" data-src="#navigation-popup" class="navigation-bar__nav__menu__item__cta navigation-popup__toggler" data-fancybox>
											<?php echo esc_html__( 'Expand Table of Contents' ); ?>
										</a>
									</div>
									<div class="navigation-popup" id="navigation-popup">
										<div class="navigation-popup__header">
											<h5 class="navigation-popup__title"><?php echo esc_html__( 'Table of contents' ); ?></h5>
										</div>
										<div class="navigation-popup__body">
											<div class="navigation-popup__dates">
												Page Published <?php echo get_the_date( 'm/d/y' ); ?> | Page Updated <?php echo get_the_modified_date( 'm/d/y' ); ?>
											</div>
											<ul class="navigation-popup__links">
												<?php
												while ( have_rows( 'sections' ) ) :
													the_row();
													?>
													<li>
														<?php
														get_template_part_args(
															'template-parts/content-modules-cta',
															array(
																'v' => 'cta',
																'c' => 'navigation-popup__link',
															)
														);
														?>
													</li>
												<?php endwhile; ?>
											</ul>
										</div>
									</div>
								<?php endif; ?>
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
								<li class="navigation-bar__social__item facebook"><a href="http://facebook.com/sharer.php?u=<?php echo esc_url( get_the_permalink() ); ?>"><img src="<?php echo esc_url( get_template_directory_uri() . '/assets/img/facebook.svg' ); ?>" alt="twitter" class="navigation-bar__social__item__img"></a></li>
								<li class="navigation-bar__social__item twitter"><a href="https://twitter.com/intent/tweet?url=<?php echo esc_url( get_the_permalink() ); ?>&text=<?php echo esc_html( get_the_title() ); ?>"><img src="<?php echo esc_url( get_template_directory_uri() . '/assets/img/twitter.svg' ); ?>" alt="linkedin" class="navigation-bar__social__item__img"></a></li>
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
