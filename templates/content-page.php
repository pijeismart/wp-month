<?php
global $post;
$toc_links = array();
if ( have_rows( 'modules' ) ) :
	while ( have_rows( 'modules' ) ) :
		the_row();
		$toc_title = get_sub_field( 'toc_title' );
		if ( $toc_title ) :
			$toc_links[] = $toc_title;
		endif;
		if ( 'awards_content' == get_row_layout() || 'side_modules' == get_row_layout() ) :
			if ( have_rows( 'blocks' ) ) :
				while ( have_rows( 'blocks' ) ) :
					the_row();
					$toc_title = get_sub_field( 'toc_title' );
					if ( $toc_title ) :
						$toc_links[] = $toc_title;
					endif;
				endwhile;
			endif;
		endif;
	endwhile;
endif;
if ( have_rows( 'modules' ) ) :
	while ( have_rows( 'modules' ) ) :
		the_row();
		$toc_title = get_sub_field( 'toc_title' );
		$anchor_id = $toc_title ? str_replace( ' ', '-', strtolower( $toc_title ) ) : get_sub_field( 'anchor_id' );
		?>
		<?php
		if ( 'banner' == get_row_layout() ) :
			$type               = get_sub_field( 'type' );
			$image              = get_sub_field( 'image' );
			$video              = get_sub_field( 'video' );
			$mobile_video       = get_sub_field( 'mobile_video' );
			$disable_navigation = get_sub_field( 'disable_navigation_bar' );
			$case_categories    = get_the_terms( $post, 'case_category' );
			$has_decor          = ( 'home' == $type && get_sub_field( 'has_decoration' ) );
			$disable_breadcrumb = get_sub_field( 'disable_breadcrumbs' );
			?>
			<!-- Banner -->
			<section class="banner banner--<?php echo esc_attr( $type ); ?><?php echo $has_decor ? ' has-decor' : ''; ?>"
				<?php echo $anchor_id ? ' id="' . esc_attr( $anchor_id ) . '"' : ''; ?>>
				<div class="container">
					<?php
					if ( 'home' != $type && ! $disable_breadcrumb ) :
						$parents = get_post_parent( $post );
						?>
						<ul class="breadcrumbs a-up d-md-only">
							<li>
								<a href="<?php echo esc_url( home_url() ); ?>"><?php echo esc_html( 'Home' ); ?></a>
							</li>
							<?php if ( 'city' == get_post_type() ) : ?>
							<li>
								<a href="<?php echo esc_url( home_url( '/areas-we-serve/' ) ); ?>">
									<?php echo esc_html( 'Areas We Serve' ); ?>
								</a>
							</li>
							<?php endif; ?>
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
						<div class="banner-media a-op">
							<div class="banner-media__large">
								<?php
								get_template_part(
									'template-parts/content-modules',
									'media',
									array(
										'image'        => $image,
										'video'        => $video,
										'mobile_video' => $mobile_video,
									)
								);
								?>
							</div>
							<?php if ( 'practice' == $type ) : ?>
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
							<?php endif; ?>
						</div>
						<div class="banner-content">
							<?php
							if ( 'home' != $type ) :
								if ( $case_categories ) :
									$img = get_field( 'icon', 'claim_type_' . $case_categories[0]->term_id );
								endif;
								?>
								<div class="banner-categories a-up">
									<?php if ( isset( $img ) && $img ) : ?>
										<img src="<?php echo esc_url( $img['url'] ); ?>" alt="<?php echo esc_attr( $img['alt'] ); ?>">
									<?php endif; ?>
									<?php
									get_template_part_args(
										'template-parts/content-modules-text',
										array(
											'v'  => 'heading',
											't'  => 'h1',
											'tc' => 'h6 banner-subheading',
										)
									);
									?>
								</div>
								<?php
								get_template_part_args(
									'template-parts/content-modules-shortcode',
									array(
										'v'  => 'sub_heading',
										't'  => 'h2',
										'tc' => 'h1 banner-heading a-up a-delay-1',
									)
								);
								?>
							<?php else : ?>
								<?php
								get_template_part_args(
									'template-parts/content-modules-text',
									array(
										'v'  => 'sub_heading',
										't'  => 'h6',
										'tc' => 'banner-subheading a-up',
									)
								);
								?>
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
							<?php endif; ?>
							<?php
							if ( 'home' == $type ) :
								get_template_part_args(
									'template-parts/content-modules-text',
									array(
										'v'  => 'content',
										't'  => 'div',
										'tc' => 'banner-copy a-up a-delay-1',
									)
								);
							endif;
							?>
							<?php if ( have_rows( 'cards' ) ) : ?>
							<div class="contact-form__cards">
								<?php
								while ( have_rows( 'cards' ) ) :
									the_row();
									$type   = get_sub_field( 'type' );
									$cta    = get_sub_field( 'cta' );
									$rating = get_sub_field( 'rating' );
									?>
									<?php if ( $cta ) : ?>
									<a href="<?php echo esc_url( $cta['url'] ); ?>" class="contact-form__cards__item <?php echo esc_attr( $type ); ?> a-up a-delay-1" target="<?php echo esc_attr( $cta['target'] ? $cta['target'] : '_self' ); ?>">
									<?php else : ?>
									<div class="contact-form__cards__item <?php echo esc_attr( $type ); ?> a-up a-delay-1">
									<?php endif; ?>
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
										<?php if ( $rating ) : ?>
											<div class="contact-form__cards__item__rating d-md-only">
												<?php for ( $i = 0; $i < $rating; $i ++ ) : ?>
													<svg width="18" height="17" viewBox="0 0 18 17" fill="none" xmlns="http://www.w3.org/2000/svg">
														<path opacity="0.8" d="M9.8878 0.5625L11.919 4.71875L16.3878 5.375C16.7628 5.4375 17.0753 5.6875 17.2003 6.0625C17.3253 6.40625 17.2315 6.8125 16.9503 7.0625L13.7003 10.2812L14.4815 14.8438C14.544 15.2188 14.3878 15.5938 14.0753 15.8125C13.7628 16.0625 13.3565 16.0625 13.0128 15.9062L9.0128 13.75L4.98155 15.9062C4.66905 16.0625 4.2628 16.0625 3.9503 15.8125C3.6378 15.5938 3.48155 15.2188 3.54405 14.8438L4.29405 10.2812L1.04405 7.0625C0.794049 6.8125 0.700299 6.40625 0.794049 6.0625C0.919049 5.6875 1.23155 5.4375 1.60655 5.375L6.10655 4.71875L8.10655 0.5625C8.2628 0.21875 8.60655 0 9.0128 0C9.3878 0 9.73155 0.21875 9.8878 0.5625Z" fill="#FFA800"/>
													</svg>
												<?php endfor; ?>
											</div>
										<?php endif; ?>
									<?php if ( $cta ) : ?>
										</a>
									<?php else : ?>
										</div>
									<?php endif; ?>
								<?php endwhile; ?>
							</div>
							<?php endif; ?>
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
			<?php if ( ! $disable_navigation && count( $toc_links ) > 0 ) : ?>
			<!-- Navigation Bar -->
			<section class="navigation-bar">
				<div class="container">
					<div class="navigation-bar__main">
						<div class="navigation-bar__nav">
							<h5 class="navigation-bar__nav__heading"><?php echo esc_html__( 'On This Page' ); ?>:</h5>
							<div class="navigation-bar__nav__menu">
								<?php
								foreach ( $toc_links as $key => $toc_link ) :
									if ( $key < 3 ) :
										?>
										<div class="navigation-bar__nav__menu__item">
											<a href="#<?php echo esc_attr( str_replace( ' ', '-', strtolower( $toc_link ) ) ); ?>" class="navigation-bar__nav__menu__item__cta">
												<?php echo $toc_link; ?>
											</a>
										</div>
										<?php
									endif;
								endforeach;
								?>
								<?php if ( count( $toc_links ) > 3 ) : ?>
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
												<?php foreach ( $toc_links as $toc_link ) : ?>
													<li>
														<a href="#<?php echo esc_attr( str_replace( ' ', '-', strtolower( $toc_link ) ) ); ?>" 
															class="navigation-popup__link">
															<?php echo $toc_link; ?>
														</a>
													</li>
												<?php endforeach; ?>
											</ul>
										</div>
									</div>
								<?php endif; ?>
							</div>
						</div>
						<div class="navigation-bar__social">
							<h5 class="navigation-bar__social__heading">
								<?php echo esc_html__( 'Leave Feedback' ); ?>
							</h5>
							<ul class="navigation-bar__social__items">
								<li class="navigation-bar__social__item instagram">
									<a href="">
										<img src="<?php echo esc_url( get_template_directory_uri() . '/assets/img/instagram.svg' ); ?>" 
											alt="instagram" 
											class="navigation-bar__social__item__img">
									</a>
								</li>
								<li class="navigation-bar__social__item facebook">
									<a href="http://facebook.com/sharer.php?u=<?php echo esc_url( get_the_permalink() ); ?>">
										<img src="<?php echo esc_url( get_template_directory_uri() . '/assets/img/facebook.svg' ); ?>" 
											alt="twitter" 
											class="navigation-bar__social__item__img">
									</a>
								</li>
								<li class="navigation-bar__social__item twitter">
									<a href="https://twitter.com/intent/tweet?url=<?php echo esc_url( get_the_permalink() ); ?>&text=<?php echo esc_html( get_the_title() ); ?>">
										<img src="<?php echo esc_url( get_template_directory_uri() . '/assets/img/twitter.svg' ); ?>" 
											alt="linkedin" 
											class="navigation-bar__social__item__img">
									</a>
								</li>
							</ul>
						</div>
					</div>
				</div>
			</section>
			<?php endif; ?>
			<?php
		elseif ( 'homepage_mobile_banner' == get_row_layout() ) :
			$video = get_sub_field( 'video' );
			?>
			<!-- Homepage Mobile Banner -->
			<section class="hp-mobile-banner d-sm-only">
				<div class="container">
					<?php
					get_template_part_args(
						'template-parts/content-modules-cta',
						array(
							'v' => 'cta',
							'c' => 'btn btn-primary btn-phone a-up',
						)
					);
					?>
					<?php if ( $video ) : ?>
						<div class="hp-mobile-banner__video a-up a-delay-1">
							<video src="<?php echo esc_url( $video ); ?>" loop muted playsinline autoplay preload="metadata">
								<source src="<?php echo esc_url( $video ); ?>" type="video/mp4">
							</video>
						</div>
					<?php endif; ?>
					<?php
					get_template_part_args(
						'template-parts/content-modules-text',
						array(
							'v'  => 'sub_heading',
							't'  => 'h6',
							'tc' => 'hp-mobile-banner__subheading a-up a-delay-2',
						)
					);
					?>
					<?php
					get_template_part_args(
						'template-parts/content-modules-text',
						array(
							'v'  => 'heading',
							't'  => 'h2',
							'tc' => 'hp-mobile-banner__heading a-up a-delay-3',
						)
					);
					?>
					<?php if ( have_rows( 'cards' ) ) : ?>
						<div class="hp-mobile-banner__cards">
							<?php
							while ( have_rows( 'cards' ) ) :
								the_row();
								?>
								<div class="hp-mobile-banner__card">
									<?php
									get_template_part_args(
										'template-parts/content-modules-image',
										array(
											'v'     => 'icon',
											'v2x'   => false,
											'is'    => false,
											'is_2x' => false,
											'c'     => 'hp-mobile-banner__card__img',
										)
									);
									?>
									<?php
									get_template_part_args(
										'template-parts/content-modules-text',
										array(
											'v'  => 'content',
											't'  => 'p',
											'tc' => 'hp-mobile-banner__card__text',
										)
									);
									?>
								</div>
							<?php endwhile; ?>
						</div>
					<?php endif; ?>
				</div>
				<div class="hp-mobile-banner__bottom">
					<div class="container">
						<?php
						get_template_part_args(
							'template-parts/content-modules-text',
							array(
								'v'  => 'bottom_heading',
								't'  => 'h2',
								'tc' => 'hp-mobile-banner__bottom-heading a-up',
							)
						);
						?>
						<?php
						get_template_part_args(
							'template-parts/content-modules-text',
							array(
								'v'  => 'bottom_content',
								't'  => 'p',
								'tc' => 'hp-mobile-banner__bottom-content a-up a-delay-1',
							)
						);
						?>
						<?php
						get_template_part_args(
							'template-parts/content-modules-cta',
							array(
								'v' => 'bottom_cta',
								'c' => 'btn btn-primary',
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
					<?php if ( count( $case_results ) > $limit_cnt && 'full' == $theme ) : ?>
						<div class="cards-slider__showmore d-sm-only">
							<button class="btn-show-more"><?php echo esc_html__( 'Show More' ); ?></button>
						</div>
					<?php endif; ?>
					<?php
					endif;
				wp_reset_query();
				?>
				<?php
				get_template_part_args(
					'template-parts/content-modules-text',
					array(
						'v'  => 'sub_heading',
						't'  => 'p',
						'tc' => 'cards-slider__subheading',
						'w'  => 'div',
						'wc' => 'container',
					)
				);
				?>
			</section>
			<?php
		elseif ( 'content_image' == get_row_layout() ) :
			$image     = get_sub_field( 'image' );
			$video     = get_sub_field( 'video' );
			$video_url = get_sub_field( 'video_url' );
			$type      = get_sub_field( 'options' );
			$direction = get_sub_field( 'content_direction' );
			$theme     = get_sub_field( 'theme' );
			$is_margin = get_sub_field( 'remove_margins' );
			?>
			<!-- Content Image -->
			<section class="content-image content-image--<?php echo esc_attr( $type ); ?> content-image--<?php echo esc_attr( $direction ); ?> <?php echo esc_attr( $theme ); ?><?php echo $is_margin ? ' my-0' : ''; ?>"
				<?php echo $anchor_id ? ' id="' . esc_attr( $anchor_id ) . '"' : ''; ?>>
				<div class="container">
					<div class="content-image__media">
						<?php if ( $video_url ) : ?>
						<a href="<?php echo esc_url( $video_url ); ?>" class="video-player" data-fancybox>
							<img src="<?php echo esc_url( get_youtube_image_from_url( $video_url ) ); ?>" alt="">
							<span class="video-play">
								<img src="<?php echo esc_url( get_template_directory_uri() . '/assets/img/icon-play.svg' ); ?>" alt="Play Video">
							</span>
							<?php
							get_template_part_args(
								'template-parts/content-modules-text',
								array(
									'v'  => 'banner_video_title',
									't'  => 'div',
									'tc' => 'video-player__title',
									'o'  => 'f',
								)
							);
							?>
						</a>	
							<?php
						else :
							get_template_part(
								'template-parts/content-modules',
								'media',
								array(
									'image' => $image,
									'video' => $video,
									'size'  => 'content-image-' . $type,
								)
							);
						endif;
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
								$source_type = get_sub_field( 'experience_links_source' ) ? get_sub_field( 'experience_links_source' ) : 'claim_type';
								$claim_types = get_sub_field( $source_type );
								if ( $claim_types ) :
									$args  = array(
										'post_type'      => 'city',
										'post_status'    => 'publish',
										'post__not_in'   => array( get_the_ID() ),
										'posts_per_page' => 10,
										'tax_query'      => array(
											array(
												'taxonomy' => $source_type,
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
														<?php the_title(); ?>
													</a>
												</li>
												<?php
											endwhile;
											?>
										</ul>
										<a href="<?php echo esc_url( home_url( '/areas-we-serve/' ) ); ?>" class="underline-link">
											<?php echo esc_html__( 'More Areas We Serve' ); ?>
										</a>
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
			$testimonials = get_field( 'testimonials', 'options' );
			?>
			<?php if ( have_rows( 'testimonials', 'options' ) ) : ?>
				<section class="testimonials"
					<?php echo $anchor_id ? ' id="' . esc_attr( $anchor_id ) . '"' : ''; ?>>
					<div class="testimonials-desktop d-md-only a-up">
						<div class="testimonials-main-slider">
							<?php
							while ( have_rows( 'testimonials', 'options' ) ) :
								the_row();
								$cta = get_sub_field( 'cta' );
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
											<?php if ( $cta ) : ?>
												<a href="<?php echo esc_url( $cta['url'] ); ?>" class="link" data-fancybox>
													<?php echo esc_html( $cta['title'] ); ?>
												</a>
											<?php endif; ?>
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
							while ( have_rows( 'testimonials', 'options' ) ) :
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
							while ( have_rows( 'testimonials', 'options' ) ) :
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
						while ( have_rows( 'testimonials', 'options' ) ) :
							the_row();
							$cta = get_sub_field( 'cta' );
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
								<?php if ( $cta ) : ?>
									<a href="<?php echo esc_url( $cta['url'] ); ?>" class="link" data-fancybox>
										<?php echo esc_html( $cta['title'] ); ?>
									</a>
								<?php endif; ?>
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
								'v'  => 'map_heading',
								't'  => 'h2',
								'tc' => 'map-heading a-up',
								'o'  => 'o',
							)
						);
						?>
						<?php
						get_template_part_args(
							'template-parts/content-modules-text',
							array(
								'v'  => 'map_content',
								't'  => 'div',
								'tc' => 'map-copy a-up a-delay-1',
								'o'  => 'o',
							)
						);
						?>
						<?php
						get_template_part_args(
							'template-parts/content-modules-cta',
							array(
								'v' => 'map_cta',
								'c' => 'link link-white a-up a-delay-2',
								'o' => 'o',
							)
						);
						?>
					</div>
					<div class="map-image a-up">
						<div class="select-block d-sm-only">
							<select class="map-state-selector" id="map-redirect">
								<option><?php echo esc_html__( 'Select State', 'am' ); ?></option>
								<?php if ( have_rows( 'map_locations', 'options' ) ) : ?>
									<?php while ( have_rows( 'map_locations', 'options' ) ) : ?> 
										<?php the_row(); ?>
										<?php if ( get_sub_field( 'active' ) ) : ?> 
											<?php
											$location = array(
												'state_code' => get_sub_field( 'state_code' ),
												'state_url' => get_sub_field( 'state_url' ),
											);
											$field    = get_sub_field_object( 'state_code' );
											$value    = get_sub_field( 'state_code' );
											$state    = $field['choices'][ $value ];
											?>
											<option value="<?php echo $location['state_url']; ?>">
												<?php echo $state; ?>
											</option>
										<?php endif; ?>
									<?php endwhile; ?>
								<?php endif; ?>
							</select>
						</div>
						<div class="map-area d-md-only" id="map1"></div>
						<script>
							var location_arr = [];
							<?php $location_array = array(); ?>
							<?php if ( have_rows( 'map_locations', 'options' ) ) : ?>
								<?php while ( have_rows( 'map_locations', 'options' ) ) : ?>
									<?php the_row(); ?>
									<?php if ( get_sub_field( 'active' ) ) : ?>
										<?php
										$location = array(
											'state_code' => get_sub_field( 'state_code' ),
											'state_url'  => get_sub_field( 'state_url' ),
										);
										array_push( $location_array, $location );
										?>
									<?php endif ?>
								<?php endwhile; ?>
							<?php endif; ?>
							location_arr = <?php echo ! empty( $location_array ) ? json_encode( $location_array ) : ''; ?>;
							jQuery(document).ready(function($) {
								// initialize Map
								$('#map1').usmap({
										'stateSpecificStyles': {
										<?php if ( have_rows( 'map_locations', 'options' ) ) : ?>
											<?php while ( have_rows( 'map_locations', 'options' ) ) : ?>
												<?php the_row(); ?>
												<?php if ( get_sub_field( 'active' ) ) : ?>
												'<?php echo get_sub_field( 'state_code' ); ?>' : {fill: '#AEDF82'},
												<?php endif ?>
											<?php endwhile; ?>
										<?php endif; ?>
										},
										'stateStyles': {
											fill: "#fff",
											stroke: "#0A1631",
											"stroke-width": 1,
											"stroke-linejoin": "round",
											scale: [1, 1]
										},
										'stateHoverStyles': {
											fill: "#78BE38",
											stroke: "#000",
										},
										'click' : function(event, data) {
											if (location_arr.length > 0){
											$.each(location_arr, function(index, obj) {
											if (data.name == obj.state_code){
											window.location = obj.state_url;
											return;
											}
										});
										}
										/* $( '#alert' )
										.text( 'Click '+data.name+' on map 1' )
										.stop()
										.css( 'backgroundColor', '#ff0' )
										.animate({backgroundColor: '#ddd'}, 1000);*/
										}
								});
								// redirect to url when updating state selector
								$('#map-redirect').on('change', function() {
									window.location.href = $(this).val();
								});
							});
						</script>
					</div>
				</div>
			</section>
			<?php
		elseif ( 'posts_slider' == get_row_layout() ) :
			?>
			<?php get_template_part( 'template-parts/section', 'post-slider', array( 'option' => 's' ) ); ?>		
			<?php
		elseif ( 'masonry' == get_row_layout() ) :
			$gallery = get_field( 'masonry_gallery', 'options' );
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
								'v'  => 'masonry_heading',
								't'  => 'h3',
								'tc' => 'masonry-heading a-up',
								'o'  => 'o',
							)
						);
						?>
						<?php
						get_template_part_args(
							'template-parts/content-modules-text',
							array(
								'v'  => 'masonry_content',
								't'  => 'div',
								'tc' => 'masonry-copy a-up a-up-delay-1',
								'o'  => 'o',
							)
						);
						?>
						<?php
						get_template_part_args(
							'template-parts/content-modules-cta',
							array(
								'v' => 'masonry_cta',
								'c' => 'link a-up a-delay-2',
								'o' => 'o',
							)
						);
						?>
					</div>
				</div>
			</section>
			<?php
		elseif ( 'contact_form' == get_row_layout() ) :
			$form       = get_sub_field( 'form' ) ? get_field( 'practice_form', 'options' ) : get_field( 'practice_form', 'options' );
			$form_only  = get_sub_field( 'form_only' );
			$has_border = get_sub_field( 'content_has_border' );
			?>
			<!-- Contact Form -->
			<section class="contact-form<?php echo $has_border ? ' contact-form--border' : ''; ?><?php echo $form_only ? ' contact-form--only' : ''; ?>"
				<?php echo $anchor_id ? ' id="' . esc_attr( $anchor_id ) . '"' : ''; ?>>
				<div class="container">
					<?php if ( ! $form_only ) : ?>
					<div class="contact-form__main">
						<?php if ( have_rows( 'cards' ) ) : ?>
							<div class="contact-form__cards">
								<?php
								while ( have_rows( 'cards' ) ) :
									the_row();
									$type = get_sub_field( 'type' );
									$cta  = get_sub_field( 'cta' );
									?>
									<?php if ( $cta ) : ?>
									<a href="<?php echo esc_url( $cta['url'] ); ?>" class="contact-form__cards__item <?php echo esc_attr( $type ); ?> a-up a-delay-1" target="<?php echo esc_attr( $cta['target'] ? $cta['target'] : '_self' ); ?>">
									<?php else : ?>
									<div class="contact-form__cards__item <?php echo esc_attr( $type ); ?> a-up a-delay-1">
									<?php endif; ?>
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
										else :
											get_template_part_args(
												'template-parts/content-modules-image',
												array(
													'v'   => 'badge',
													'v2x' => false,
													'is'  => false,
													'is_2x' => false,
													'c'   => 'item-badge__img',
													'w'   => 'div',
													'wc'  => 'item-badge',
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
										<?php if ( $cta ) : ?>
											<span class="contact-form__cards__item__cta link" aria-label="<?php echo esc_attr( $cta['title'] ); ?>"></span>
										<?php endif; ?>
									<?php if ( $cta ) : ?>
										</a>
									<?php else : ?>
										</div>
									<?php endif; ?>
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
								'template-parts/content-modules-shortcode',
								array(
									'v'  => 'content',
									't'  => 'div',
									'tc' => 'contact-form__content__content a-up a-delay-1',
								)
							);
							?>
						</div>
					</div>
					<?php endif; ?>
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
						<?php if ( $form ) : ?>
							<div class="contact-form__form__form">
								<?php echo do_shortcode( $form ); ?>
							</div>
						<?php endif; ?>
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
											'template-parts/content-modules-shortcode',
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
			<?php
		elseif ( 'testimonials_slider' == get_row_layout() ) :
			$testimonials = get_sub_field( 'testimonials' );
			?>
			<!-- Testimonial Slider -->
			<?php if ( $testimonials ) : ?>
			<section class="testimonial-slider"<?php echo $anchor_id ? ' id="' . esc_attr( $anchor_id ) . '"' : ''; ?>>
				<?php echo do_shortcode( $testimonials ); ?>
			</section>
			<?php endif; ?>
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
			$image     = get_sub_field( 'image' );
			$video     = get_sub_field( 'video' );
			$video_url = get_sub_field( 'video_url' );
			$video_src = $video_url ? $video_url : $video;
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
							<?php if ( $video || $image || $video_url ) : ?>
							<div class="video-content__video a-up a-delay-1 video-player">
								<?php if ( $video_url ) : ?>
									<img src="<?php echo esc_url( get_youtube_image_from_url( $video_url ) ); ?>" alt="">
								<?php else : ?>
									<?php
									get_template_part(
										'template-parts/content-modules',
										'media',
										array(
											'image' => $image,
											'video' => $video,
											'disable_autoplay' => true,
										)
									);
									?>
								<?php endif; ?>
								<?php if ( $video_src ) : ?>
									<a href="<?php echo esc_url( $video_src ); ?>" class="video-player__btn" data-fancybox>
										<img src="<?php echo esc_url( get_template_directory_uri() . '/assets/img/icon-play-blue.svg' ); ?>" alt="Play">
									</a>
								<?php endif; ?>
							</div>
							<?php endif; ?>
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
						$tax_query = array(
							'relation' => 'AND',
							array(
								'taxonomy' => 'faq_type',
								'field'    => 'slug',
								'terms'    => array( 'state-law-montlick-explains' ),
								'operator' => 'NOT IN',
							),
						);
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
						$args  = array(
							'post_type'      => 'faq',
							'post_status'    => 'publish',
							'posts_per_page' => 4,
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
							'posts_per_page' => 4,
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
												<?php if ( floatval( $price ) / 1000000 > 1 ) : ?>
													<h2 class="case-results__item__value"><?php echo esc_html( '$' . floatval( $price ) / 1000000 ); ?></h3>
													<h5 class="case-results__item__value_caption"><?php echo esc_html__( 'Million' ); ?></p>
												<?php else : ?>
													<h2 class="case-results__item__value"><?php echo esc_html( '$' . floatval( $price ) / 1000 ); ?></h3>
													<h5 class="case-results__item__value_caption"><?php echo esc_html__( 'Thousand' ); ?></p>
												<?php endif; ?>
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
								'template-parts/content-modules-shortcode',
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
		elseif ( 'support_module' == get_row_layout() ) :
			$image = get_field( 'support_image', 'options' );
			$video = get_field( 'support_video', 'options' );
			?>
			<!-- Support Module -->
			<section class="content-image content-image--cards content-image--right"
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
								'size'  => 'content-image-cards',
							)
						);
						?>
					</div>
					<div class="content-image__content">
						<?php
						get_template_part_args(
							'template-parts/content-modules-text',
							array(
								'v'  => 'support_heading',
								't'  => 'h2',
								'tc' => 'content-image__heading a-up',
								'o'  => 'o',
							)
						);
						?>
						<?php
						get_template_part_args(
							'template-parts/content-modules-text',
							array(
								'v'  => 'support_content',
								't'  => 'div',
								'tc' => 'content-image__copy a-up a-delay-1',
								'o'  => 'o',
							)
						);
						?>
						<?php if ( have_rows( 'support_cards', 'options' ) ) : ?>
							<div class="content-image__cards a-up a-delay-2">
								<?php
								while ( have_rows( 'support_cards', 'options' ) ) :
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
					</div>
				</div>
			</section>
			<?php
		elseif ( 'about_module' == get_row_layout() ) :
			$image = get_field( 'about_image', 'options' );
			$video = get_field( 'about_video', 'options' );
			?>
			<!-- About Module -->
			<section class="content-image content-image--full-ctas content-image--right"
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
								'size'  => 'content-image-full-ctas',
							)
						);
						?>
					</div>
					<div class="content-image__content">
						<?php
						get_template_part_args(
							'template-parts/content-modules-text',
							array(
								'v'  => 'about_content',
								't'  => 'div',
								'tc' => 'content-image__copy a-up a-delay-1',
								'o'  => 'o',
							)
						);
						?>
						<?php if ( have_rows( 'about_ctas', 'options' ) ) : ?>
							<div class="content-image__ctas a-up a-delay-2">
								<?php
								while ( have_rows( 'about_ctas', 'options' ) ) :
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
		elseif ( 'awards_grid' == get_row_layout() ) :
			$gallery = get_sub_field( 'awards' );
			?>
			<!-- Awards Grid -->
			<section class="awards-grid bg-navy"<?php echo $anchor_id ? ' id="' . esc_attr( $anchor_id ) . '"' : ''; ?>>
				<div class="container">
					<?php
					get_template_part_args(
						'template-parts/content-modules-text',
						array(
							'v'  => 'content',
							't'  => 'div',
							'tc' => 'awards-grid__content a-up',
						)
					);
					?>
					<?php if ( $gallery ) : ?>
						<div class="awards-grid__images a-up a-delay-1">
							<?php foreach ( $gallery as $image ) : ?>
								<img src="<?php echo esc_url( $image['url'] ); ?>" alt="<?php echo esc_attr( $image['alt'] ); ?>">
							<?php endforeach; ?>
						</div>
					<?php endif; ?>
				</div>
			</section>
			<?php
		elseif ( 'awards_content' == get_row_layout() ) :
			$form = get_sub_field( 'form' );
			?>
			<!-- Awards Content -->
			<section class="contact-form awards-content"<?php echo $anchor_id ? ' id="' . esc_attr( $anchor_id ) . '"' : ''; ?>>
				<div class="container">
					<?php if ( have_rows( 'blocks' ) ) : ?>
					<div class="contact-form__main">
						<?php
						while ( have_rows( 'blocks' ) ) :
							the_row();
							if ( 'heading' == get_row_layout() ) :
								get_template_part_args(
									'template-parts/content-modules-text',
									array(
										'v'  => 'heading',
										't'  => 'h3',
										'tc' => 'a-up',
										'w'  => 'div',
										'wc' => 'awards-content-heading',
									)
								);
							elseif ( 'content' == get_row_layout() ) :
								$heading    = get_sub_field( 'heading' );
								$blockquote = get_sub_field( 'blockquote' );
								$cite       = get_sub_field( 'cite' );
								$toc_title  = get_sub_field( 'toc_title' );
								$padding    = get_sub_field( 'padding' );
								?>
								<div class="awards-content-block awards-content-block--<?php echo esc_attr( $padding ); ?><?php echo 'small' == $padding ? ' accordion' : ''; ?>"
									id="<?php echo $toc_title ? str_replace( ' ', '-', strtolower( $toc_title ) ) : ''; ?>">
									<?php if ( $heading ) : ?>
										<div class="awards-content-block__heading<?php echo 'small' == $padding ? ' accordion-header' : ''; ?>">
											<span class="accordion-header__icon">
											</span>
											<h3><?php echo esc_html( $heading ); ?></h3>
										</div>
									<?php endif; ?>
									<div class="awards-content-block__body<?php echo 'small' == $padding ? ' accordion-body' : ''; ?>">
										<?php
										get_template_part_args(
											'template-parts/content-modules-text',
											array(
												'v'  => 'content',
												't'  => 'div',
												'tc' => 'awards-content-block__content',
											)
										);
										?>
										<?php
										get_template_part_args(
											'template-parts/content-modules-cta',
											array(
												'v'  => 'link',
												'c'  => 'underline-link',
												'w'  => 'div',
												'wc' => 'clear-both',
											)
										);
										?>
										<?php if ( $blockquote || $cite ) : ?>
											<blockquote class="awards-content-block__blockquote">
												<?php if ( $blockquote ) : ?>
													<p><?php echo $blockquote; ?></p>
												<?php endif; ?>
												<?php if ( $cite ) : ?>
													<cite><?php echo $cite; ?></cite>
												<?php endif; ?>
											</blockquote>
										<?php endif; ?>
									</div>
								</div>
							<?php endif; ?>
						<?php endwhile; ?>
					</div>
					<?php endif; ?>
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
						<?php if ( $form ) : ?>
							<div class="contact-form__form__form">
								<?php echo do_shortcode( $form ); ?>
							</div>
						<?php endif; ?>
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
			<?php
		elseif ( 'person_cta' == get_row_layout() ) :
			?>
			<!-- Person CTA -->
			<section class="person-cta"<?php echo $anchor_id ? ' id="' . esc_attr( $anchor_id ) . '"' : ''; ?>>
				<div class="container person-cta__inner">
					<?php
					get_template_part_args(
						'template-parts/content-modules-image',
						array(
							'v'     => 'image',
							'v2x'   => false,
							'is'    => false,
							'is_2x' => false,
							'w'     => 'div',
							'wc'    => 'person-cta__img',
						)
					);
					?>
					<div class="person-cta__content">
						<?php
						get_template_part_args(
							'template-parts/content-modules-text',
							array(
								'v'  => 'heading',
								't'  => 'h2',
								'tc' => 'person-cta__heading a-up',
							)
						);
						?>
						<?php
						get_template_part_args(
							'template-parts/content-modules-text',
							array(
								'v'  => 'content',
								't'  => 'div',
								'tc' => 'person-cta__copy a-up a-delay-1',
							)
						);
						?>
					</div>
				</div>
			</section>
			<?php
		elseif ( 'side_modules' == get_row_layout() ) :
			?>
			<!-- Side Modules -->
			<section class="community-modules">
				<div class="container">
					<?php if ( have_rows( 'sidebar_links' ) ) : ?>
					<div class="community-modules__sidebar d-md-only">
						<h6><?php echo esc_html__( 'Related Pages' ); ?></h6>
						<ul>
							<?php
							while ( have_rows( 'sidebar_links' ) ) :
								the_row();
								get_template_part_args(
									'template-parts/content-modules-cta',
									array(
										'v' => 'link',
										'w' => 'li',
									)
								);
							endwhile;
							?>
						</ul>
					</div>
					<?php endif; ?>
					<?php if ( have_rows( 'blocks' ) ) : ?>
						<div class="community-modules__content">
							<?php
							while ( have_rows( 'blocks' ) ) :
								the_row();
								$toc_title = get_sub_field( 'toc_title' );
								if ( 'general_block' == get_row_layout() ) :
									?>
									<div class="general-block" id="<?php echo $toc_title ? str_replace( ' ', '-', strtolower( $toc_title ) ) : ''; ?>">
										<div class="general-block__inner">
											<?php
											get_template_part_args(
												'template-parts/content-modules-text',
												array(
													'v'  => 'heading',
													't'  => 'h3',
													'tc' => 'block-heading',
												)
											);
											?>
											<?php
											get_template_part_args(
												'template-parts/content-modules-text',
												array(
													'v'  => 'content',
													't'  => 'div',
													'tc' => 'general-block__content',
												)
											);
											?>
										</div>
									</div>
									<?php
								endif;
							endwhile;
							?>
						</div>
					<?php endif; ?>
				</div>
			</section>
			<?php
		elseif ( 'contact' == get_row_layout() ) :
			$phone         = get_sub_field( 'notice_phone' );
			$lottie        = get_sub_field( 'lottie' );
			$mobile_lottie = get_sub_field( 'mobile_lottie' );
			$video_url     = get_sub_field( 'video' );
			$case_results  = get_sub_field( 'case_results' );
			?>
			<!-- Conctact -->
			<section class="contact">
				<div class="contact-left">
					<ul class="breadcrumbs a-up d-md-only">
						<li>
							<a href="<?php echo esc_url( home_url() ); ?>"><?php echo esc_html( 'Home' ); ?></a>
						</li>
						<li>
							<span><?php echo esc_html__( 'Contact Montlick & Associates' ); ?></span>
						</li>
					</ul>
					<div class="contact-mobile d-sm-only">
						<?php if ( $mobile_lottie ) : ?>
							<a href="tel:<?php echo esc_attr( $phone ); ?>" class="contact-mobile__lottie">
								<script src="https://unpkg.com/@lottiefiles/lottie-player@latest/dist/lottie-player.js"></script>
								<lottie-player src="<?php echo esc_url( $mobile_lottie ); ?>" background="transparent" speed="1" style="width: 280px;height:180px" loop autoplay></lottie-player>
							</a>
						<?php endif; ?>
						<?php
						get_template_part_args(
							'template-parts/content-modules-text',
							array(
								'v'  => 'mobile_heading',
								't'  => 'h2',
								'tc' => 'h1 contact-mobile__heading a-up a-delay-1',
							)
						);
						?>
						<?php if ( $video_url ) : ?>
						<a href="<?php echo esc_url( $video_url ); ?>" class="video-player a-up a-delay-2" data-fancybox>
							<img src="<?php echo esc_url( get_youtube_image_from_url( $video_url ) ); ?>" alt="">
							<span class="video-play">
								<img src="<?php echo esc_url( get_template_directory_uri() . '/assets/img/icon-play.svg' ); ?>" alt="Play Video">
							</span>
						</a>
						<?php endif; ?>
						<?php if ( get_sub_field( 'faqs' ) ) : ?>
							<a href="#contact-faq" class="contact-mobile__link a-up a-delay-2">
								<?php echo esc_html__( 'Read Frequently ASked Questions (click here)' ); ?>
							</a>
						<?php endif; ?>
						<?php
						get_template_part_args(
							'template-parts/content-modules-text',
							array(
								'v'  => 'mobile_copy',
								't'  => 'div',
								'tc' => 'contact-mobile__copy a-up a-delay-3',
							)
						);
						?>
						<?php
						get_template_part_args(
							'template-parts/content-modules-cta',
							array(
								'v'  => 'mobile_cta',
								'c'  => 'underline-link a-up a-delay-3',
								'w'  => 'div',
								'wc' => 'contact-mobile__cta',
							)
						);
						?>
						<?php
						get_template_part_args(
							'template-parts/content-modules-cta',
							array(
								'v'  => 'mobile_button',
								'c'  => 'btn btn-primary a-up a-delay-3',
								'w'  => 'div',
								'wc' => 'contact-mobile__btn',
							)
						);
						?>
					</div>
					<?php
					get_template_part_args(
						'template-parts/content-modules-text',
						array(
							'v'  => 'heading',
							't'  => 'h1',
							'tc' => 'contact-heading a-up a-delay-1 d-md-only',
						)
					);
					?>
					<?php
					get_template_part_args(
						'template-parts/content-modules-text',
						array(
							'v'  => 'content',
							't'  => 'div',
							'tc' => 'contact-content a-up a-delay-2',
						)
					);
					?>
					<?php if ( have_rows( 'cards' ) ) : ?>
						<div class="contact-form__cards">
							<?php
							while ( have_rows( 'cards' ) ) :
								the_row();
								$type   = get_sub_field( 'type' );
								$cta    = get_sub_field( 'cta' );
								$rating = get_sub_field( 'rating' );
								?>
								<?php if ( $cta ) : ?>
								<a href="<?php echo esc_url( $cta['url'] ); ?>" class="contact-form__cards__item <?php echo esc_attr( $type ); ?> a-up a-delay-1" target="<?php echo esc_attr( $cta['target'] ? $cta['target'] : '_self' ); ?>">
								<?php else : ?>
								<div class="contact-form__cards__item <?php echo esc_attr( $type ); ?> a-up a-delay-1">
								<?php endif; ?>
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
									<?php if ( $rating ) : ?>
										<div class="contact-form__cards__item__rating d-md-only">
											<?php for ( $i = 0; $i < $rating; $i ++ ) : ?>
												<svg width="18" height="17" viewBox="0 0 18 17" fill="none" xmlns="http://www.w3.org/2000/svg">
													<path opacity="0.8" d="M9.8878 0.5625L11.919 4.71875L16.3878 5.375C16.7628 5.4375 17.0753 5.6875 17.2003 6.0625C17.3253 6.40625 17.2315 6.8125 16.9503 7.0625L13.7003 10.2812L14.4815 14.8438C14.544 15.2188 14.3878 15.5938 14.0753 15.8125C13.7628 16.0625 13.3565 16.0625 13.0128 15.9062L9.0128 13.75L4.98155 15.9062C4.66905 16.0625 4.2628 16.0625 3.9503 15.8125C3.6378 15.5938 3.48155 15.2188 3.54405 14.8438L4.29405 10.2812L1.04405 7.0625C0.794049 6.8125 0.700299 6.40625 0.794049 6.0625C0.919049 5.6875 1.23155 5.4375 1.60655 5.375L6.10655 4.71875L8.10655 0.5625C8.2628 0.21875 8.60655 0 9.0128 0C9.3878 0 9.73155 0.21875 9.8878 0.5625Z" fill="#FFA800"/>
												</svg>
											<?php endfor; ?>
										</div>
									<?php endif; ?>
								<?php if ( $cta ) : ?>
									</a>
								<?php else : ?>
									</div>
								<?php endif; ?>
							<?php endwhile; ?>
						</div>
					<?php endif; ?>
					<div class="contact-faqs a-up">
						<?php
						get_template_part_args(
							'template-parts/content-modules-text',
							array(
								'v'  => 'faq_heading',
								't'  => 'h3',
								'tc' => 'contact-faqs__heading',
							)
						);
						?>
						<?php
						if ( have_rows( 'faqs' ) ) :
							while ( have_rows( 'faqs' ) ) :
								the_row();
								?>
								<div class="contact-faq accordion" id="contact-faq">
									<?php
									get_template_part_args(
										'template-parts/content-modules-text',
										array(
											'v'  => 'question',
											't'  => 'div',
											'tc' => 'contact-faq__question accordion-header',
										)
									);
									?>
									<?php
									get_template_part_args(
										'template-parts/content-modules-text',
										array(
											'v'  => 'answer',
											't'  => 'div',
											'tc' => 'contact-faq__answer accordion-body',
										)
									);
									?>
								</div>
								<?php
							endwhile;
						endif;
						?>
						<div class="contact-faqs__bottom">
							<?php
							get_template_part_args(
								'template-parts/content-modules-text',
								array(
									'v'  => 'faq_description',
									't'  => 'p',
									'tc' => 'contact-faqs__desc',
								)
							);
							?>
							<?php
							get_template_part_args(
								'template-parts/content-modules-cta',
								array(
									'v' => 'faq_cta',
									'c' => 'underline-link contact-faqs__cta',
								)
							);
							?>
						</div>
					</div>
					<div class="cards-slider cards-slider--compact d-sm-only">
						<?php if ( $case_results ) : ?>
							<div class="cards-slider__carousel">
								<?php
								foreach ( $case_results as $post ) :
									setup_postdata( $post );
									get_template_part(
										'template-parts/loop',
										'case_result',
										array(
											'theme' => 'compact',
										)
									);
								endforeach;
								?>
							</div>
							<?php
							endif;
						wp_reset_query();
						?>
						<div class="cards-slider__bottom">
							<?php
							get_template_part_args(
								'template-parts/content-modules-text',
								array(
									'v'  => 'case_results_description',
									't'  => 'p',
									'tc' => 'cards-slider__subheading',
								)
							);
							?>
							<div class="cards-slider__btn">
								<button class="btn-arrow btn-prev" aria-label="Prev">
									<svg width="19" height="16" viewBox="0 0 19 16" fill="none" xmlns="http://www.w3.org/2000/svg">
										<path d="M0.191061 8.44618L7.23911 15.7913C7.36648 15.9583 7.57877 16 7.7486 16C7.91844 16 8.08827 15.9583 8.21564 15.8331C8.51285 15.5827 8.51285 15.1653 8.2581 14.9149L2.31397 8.65485H18.3207C18.7028 8.65485 19 8.36271 19 8.02884C19 7.69497 18.7028 7.31937 18.3207 7.31937H2.31397L8.2581 1.10103C8.51285 0.850628 8.51285 0.43329 8.21564 0.182887C7.91844 -0.0675162 7.49385 -0.0675162 7.23911 0.22462L0.191061 7.56977C-0.0636871 7.82017 -0.0636871 8.19578 0.191061 8.44618Z" fill="#8DCB7E"/>
									</svg>
								</button>
								<button class="btn-arrow btn-next" aria-label="Next">
									<svg width="19" height="16" viewBox="0 0 19 16" fill="none" xmlns="http://www.w3.org/2000/svg">
										<path d="M18.8089 8.44618L11.7609 15.7913C11.6335 15.9583 11.4212 16 11.2514 16C11.0816 16 10.9117 15.9583 10.7844 15.8331C10.4872 15.5827 10.4872 15.1653 10.7419 14.9149L16.686 8.65485H0.67933C0.297207 8.65485 0 8.36271 0 8.02884C0 7.69497 0.297207 7.31937 0.67933 7.31937H16.686L10.7419 1.10103C10.4872 0.850628 10.4872 0.43329 10.7844 0.182887C11.0816 -0.0675162 11.5061 -0.0675162 11.7609 0.22462L18.8089 7.56977C19.0637 7.82017 19.0637 8.19578 18.8089 8.44618Z" fill="#8DCB7E"/>
									</svg>
								</button>
							</div>
						</div>
					</div>
					<?php
					get_template_part_args(
						'template-parts/content-modules-shortcode',
						array(
							'v'  => 'reviews',
							't'  => 'div',
							'tc' => 'contact-reviews d-md-only',
						)
					);
					?>
				</div>
				<div class="contact-right">
					<?php if ( $phone ) : ?>
					<a href="tel:<?php echo esc_attr( $phone ); ?>" class="contact-cta d-md-only">
						<?php
						get_template_part_args(
							'template-parts/content-modules-text',
							array(
								'v'  => 'notice_heading',
								't'  => 'h6',
								'tc' => 'contact-cta__heading',
							)
						);
						?>
						<?php
						get_template_part_args(
							'template-parts/content-modules-text',
							array(
								'v'  => 'number',
								't'  => 'h3',
								'tc' => 'contact-cta__number',
							)
						);
						?>
						<span class="contact-cta__phone"><?php echo esc_html( $phone ); ?></span>
						<div class="contact-cta__bottom">
							<?php
							get_template_part_args(
								'template-parts/content-modules-text',
								array(
									'v'  => 'notice_description',
									't'  => 'p',
									'tc' => 'contact-cta__desc',
								)
							);
							?>
							<?php if ( $lottie ) : ?>
								<div class="contact-cta__lottie">
									<script src="https://unpkg.com/@lottiefiles/lottie-player@latest/dist/lottie-player.js"></script>
									<lottie-player src="<?php echo esc_url( $lottie ); ?>" background="transparent" speed="1" style="width: 170px; height: 75px;" loop autoplay></lottie-player>
								</div>
							<?php endif; ?>
						</div>
					</a>
					<?php endif; ?>
					<div class="contact-form__form a-up a-delay-1" id="contact-form">
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
								'v'  => 'form_description',
								't'  => 'p',
								'tc' => 'contact-form__form__content',
							)
						);
						?>
						<?php
						get_template_part_args(
							'template-parts/content-modules-shortcode',
							array(
								'v'  => 'form',
								't'  => 'div',
								'tc' => 'contact-form__form__form',
							)
						);
						?>
					</div>
				</div>
			</section>
			<?php
		elseif ( 'case_results_grid' == get_row_layout() ) :
			$source = get_sub_field( 'content_source' );
			$args   = array(
				'post_type'      => 'case_result',
				'posts_per_page' => 12,
				'post_status'    => 'publish',
			);
			if ( 'custom' == $source ) :
				$args['post__in'] = get_sub_field( 'case_results' );
			endif;
			$query = new WP_Query( $args );
			?>
			<!-- Case Results Grid -->
			<section class="case-results-alt">
				<div class="container">
					<?php
					get_template_part_args(
						'template-parts/content-modules-text',
						array(
							'v'  => 'heading',
							't'  => 'h2',
							'tc' => 'case-results-alt__heading a-up',
						)
					);
					?>
					<?php if ( $query->have_posts() ) : ?>
						<div class="section-archive__posts case-results-alt__grid"
							data-post-type="case_result"
							data-posts-per-page="12"
							data-theme="alt"
							data-paged="1">
							<?php
							while ( $query->have_posts() ) :
								$query->the_post();
								get_template_part(
									'template-parts/loop',
									'case_result-alt'
								);
							endwhile;
							?>
						</div>
						<?php if ( $query->max_num_pages > 1 ) : ?>
							<div class="cpt-load-more">
								<button class="underline-link cpt-load-more-btn">
									<?php echo esc_html__( 'Load More' ); ?>
								</button>
							</div>
						<?php endif; ?>
						<?php
						endif;
					wp_reset_postdata();
					?>
				</div>
			</section>
			<?php
		elseif ( 'testimonial_videos' == get_row_layout() ) :
			?>
			<!-- Testimonial Videos -->
			<section class="testimonial-videos">
				<div class="container js-loadmore-wrapper">
					<?php
					get_template_part_args(
						'template-parts/content-modules-text',
						array(
							'v'  => 'heading',
							't'  => 'h2',
							'tc' => 'testimonial-videos__heading a-up',
						)
					);
					?>
					<?php if ( have_rows( 'videos' ) ) : ?>
						<div class="testimonial-videos__grid a-up a-delay-1 js-loadmore-grid">
							<?php
							while ( have_rows( 'videos' ) ) :
								the_row();
								$video_url = get_sub_field( 'video' );
								?>
								<?php if ( $video_url ) : ?>
									<div class="testimonial-video js-loadmore-child">
										<a href="<?php echo esc_url( $video_url ); ?>" class="video-player" data-fancybox>
											<img src="<?php echo esc_url( get_youtube_image_from_url( $video_url ) ); ?>" alt="">
											<span class="video-play">
												<img src="<?php echo esc_url( get_template_directory_uri() . '/assets/img/icon-play.svg' ); ?>" alt="Play Video">
											</span>
											<?php
											get_template_part_args(
												'template-parts/content-modules-text',
												array(
													'v'  => 'video_title',
													't'  => 'div',
													'tc' => 'video-player__title',
												)
											);
											?>
										</a>
										<div class="testimonial-video__cotnent">
										<?php
											get_template_part_args(
												'template-parts/content-modules-text',
												array(
													'v'  => 'video_title',
													't'  => 'p',
													'tc' => 'testimonial-video__title',
												)
											);
										?>
											<?php
											get_template_part_args(
												'template-parts/content-modules-text',
												array(
													'v'  => 'content',
													't'  => 'p',
													'tc' => 'testimonial-video__copy',
												)
											);
											?>
										</div>
									</div>
								<?php endif; ?>
							<?php endwhile; ?>
						</div>
						<?php if ( count( get_sub_field( 'videos' ) ) > 4 ) : ?>
							<div class="testimonial-videos__loadmore__wrapper js-loadmore-btn-wrapper a-up a-delay-2">
								<button class="underline-link testimonial-videos__loadmore js-loadmore-btn" data-page="1" data-posts-per-page="4"><?php echo esc_html__( 'Load More' ); ?></button>
							</div>
						<?php endif; ?>
					<?php endif; ?>
				</div>
			</section>
			<?php
		elseif ( 'customer_quotes' == get_row_layout() ) :
			?>
			<!-- Customer Quotes -->
			<section class="customer-quotes">
				<div class="container js-loadmore-wrapper">
					<?php
					get_template_part_args(
						'template-parts/content-modules-text',
						array(
							'v'  => 'heading',
							't'  => 'h2',
							'tc' => 'customer-quotes__heading a-up',
						)
					);
					?>
					<?php if ( have_rows( 'quotes' ) ) : ?>
						<div class="customer-quotes__grid js-loadmore-grid a-up a-delay-1">
							<?php
							while ( have_rows( 'quotes' ) ) :
								the_row();
								get_template_part_args(
									'template-parts/content-modules-text',
									array(
										'v'  => 'quote',
										't'  => 'div',
										'tc' => 'customer-quotes__quote js-loadmore-child',
									)
								);
							endwhile;
							?>
						</div>
						<?php if ( count( get_sub_field( 'quotes' ) ) > 1 ) : ?>
							<div class="customer-quotes__loadmore__wrapper js-loadmore-btn-wrapper a-up a-delay-2">
								<button class="underline-link js-loadmore-btn" data-page="1" data-posts-per-page="6"><?php echo esc_html__( 'Load More' ); ?></button>
							</div>
						<?php endif; ?>
					<?php endif; ?>
				</div>
			</section>
		<?php endif; ?>
		<?php
	endwhile;
endif;
if ( '' !== get_post()->post_content ) :
	?>
	<section class="content">
		<div class="container">
			<?php the_content(); ?>
		</div>
	</section>
	<?php
endif;
