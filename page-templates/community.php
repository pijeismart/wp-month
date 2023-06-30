<?php
/**
 * Template Name: Community
 * Template Post Type: page
 */

use PgSql\Lob;

get_header();

global $post;
$parents = get_post_parent( $post );
?>
<!-- Banner -->
<?php
$type          = get_field( 'type' );
$heading       = get_field( 'banner_heading' );
$image         = get_field( 'banner_image' );
$video         = get_field( 'banner_video' );
$video_title   = get_field( 'banner_video_title' );
$card_heading  = get_field( 'card_heading' );
$card_cta_desc = get_field( 'card_cta_description' );
$card_cta      = get_field( 'card_cta' );

if ( $heading || $video || $image ) :
	?>
	<!-- Community Banner -->
	<section class="community-banner has-decor community-banner--<?php echo esc_attr( $type ); ?>">
		<div class="container">
			<div class="community-banner__left">
				<ul class="breadcrumbs a-up d-md-only">
					<li>
						<a href="<?php echo esc_url( home_url() ); ?>"><?php echo esc_html( 'Home' ); ?></a>
					</li>
					<?php if ( $parents ) : ?>
						<li>
							<a href="<?php echo esc_url( get_the_permalink( $parents ) ); ?>">
								<?php echo esc_html( get_the_title( $parents ) ); ?>
							</a>
						</li>
					<?php endif; ?>
					<li><span><?php the_title(); ?></span></li>
				</ul>
				<?php
				get_template_part_args(
					'template-parts/content-modules-text',
					array(
						'v'  => 'banner_heading',
						't'  => 'h1',
						'tc' => 'a-up a-delay-1',
						'o'  => 'f',
					)
				);
				?>
				<?php
				if ( 'content_media' != $type ) :
					get_template_part_args(
						'template-parts/content-modules-text',
						array(
							'v'  => 'banner_content',
							't'  => 'div',
							'tc' => 'community-banner__content a-up a-delay-1',
							'o'  => 'f',
						)
					);
				endif;
				?>
				<?php if ( get_field( 'partner_logo' ) ) : ?>
					<div class="community-banner__partner a-up">
						<h6><?php echo esc_html__( 'Proud Partner of' ); ?></h6>
						<?php
						get_template_part_args(
							'template-parts/content-modules-image',
							array(
								'v'     => 'partner_logo',
								'v2x'   => false,
								'is'    => false,
								'is_2x' => false,
								'c'     => 'community-banner__partner-img',
								'o'     => 'f',
							)
						);
						?>
					</div>
				<?php endif; ?>
			</div>
			<?php if ( ( $video || $image ) && 'content_only' != $type ) : ?>
			<div class="community-banner__right a-op">
				<?php if ( $video ) : ?>
				<a href="<?php echo esc_url( $video ); ?>" class="video-player" data-fancybox>
					<img src="<?php echo esc_url( get_youtube_image_from_url( $video ) ); ?>" alt="">
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
				<?php elseif ( $image ) : ?>
					<div class="video-player">
						<img src="<?php echo esc_url( $image['url'] ); ?>" alt="<?php echo esc_attr( $image['alt'] ); ?>">
					</div>
				<?php endif; ?>
			</div>
			<?php endif; ?>
			<?php if ( $card_heading || $card_cta || $card_cta_desc ) : ?>
				<div class="community-banner__right a-op">
					<div class="community-banner__card">
						<?php
						get_template_part_args(
							'template-parts/content-modules-text',
							array(
								'v'  => 'card_heading',
								't'  => 'h2',
								'tc' => 'community-banner__card-heading a-up',
								'o'  => 'f',
							)
						);
						?>
						<div class="community-banner__card-body">
							<?php
							get_template_part_args(
								'template-parts/content-modules-text',
								array(
									'v'  => 'card_cta_description',
									't'  => 'div',
									'tc' => 'community-banner__card-desc a-up a-delay-1',
									'o'  => 'f',
								)
							);
							?>
							<?php
							get_template_part_args(
								'template-parts/content-modules-cta',
								array(
									'v' => 'card_cta',
									'c' => 'community-banner__card-cta a-up a-delay-2',
									'o' => 'f',
								)
							);
							?>
						</div>
					</div>
				</div>
			<?php endif; ?>
		</div>
	</section>
<?php endif; ?>

<?php
$video = get_field( 's2_video' );
$image = get_field( 's2_image' );
?>
<!-- Content Image -->
<?php if ( $video || $image || get_field( 's2_heading' ) || get_field( 's2_content' ) ) : ?>
<section class="c-content-image">
	<div class="container">
		<?php if ( $video || $image ) : ?>
		<div class="c-content-image__media a-op">
			<?php if ( $video ) : ?>
				<a href="<?php echo esc_url( $video ); ?>" class="video-player" data-fancybox>
					<?php $img_url = $image ? $image['url'] : get_youtube_image_from_url( $video ); ?>
					<img src="<?php echo esc_url( $img_url ); ?>" alt="">
					<span class="video-play">
						<img src="<?php echo esc_url( get_template_directory_uri() . '/assets/img/icon-play.svg' ); ?>" alt="Play Video">
					</span>
					<?php
					get_template_part_args(
						'template-parts/content-modules-text',
						array(
							'v'  => 's2_video_title',
							't'  => 'div',
							'tc' => 'video-player__title',
							'o'  => 'f',
						)
					);
					?>
				</a>
			<?php else : ?>
				<?php
				get_template_part_args(
					'template-parts/content-modules-image',
					array(
						'v'     => 's2_image',
						'v2x'   => false,
						'is'    => false,
						'is_2x' => false,
						'c'     => 'c-content-image__img',
						'o'     => 'f',
					)
				);
				?>
			<?php endif; ?>
		</div>
		<?php endif; ?>
		<div class="c-content-image__content">
			<?php
			get_template_part_args(
				'template-parts/content-modules-text',
				array(
					'v'  => 's2_heading',
					't'  => 'h3',
					'tc' => 'c-content-image__heading a-up',
					'o'  => 'f',
				)
			);
			?>
			<?php
			get_template_part_args(
				'template-parts/content-modules-text',
				array(
					'v'  => 's2_content',
					't'  => 'div',
					'tc' => 'c-content-image__copy a-up a-delay-1',
					'o'  => 'f',
				)
			);
			?>
		</div>
	</div>
</section>
<?php endif; ?>

<?php
$toc_links = array();
if ( have_rows( 'content_modules' ) ) :
	while ( have_rows( 'content_modules' ) ) :
		the_row();
		$toc_title = get_sub_field( 'toc_title' );
		if ( $toc_title ) :
			$toc_links[] = $toc_title;
		endif;
	endwhile;
endif;
if ( have_rows( 'content_modules' ) || have_rows( 'sidebar_links' ) ) :
	?>
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
			<?php if ( have_rows( 'content_modules' ) ) : ?>
				<div class="community-modules__content">
					<?php
					while ( have_rows( 'content_modules' ) ) :
						the_row();
						if ( 'general_block' == get_row_layout() ) :
							$toc_title          = get_sub_field( 'toc_title' );
							$anchor_id          = $toc_title ? str_replace( ' ', '-', strtolower( $toc_title ) ) : '';
							$enable_image_links = get_sub_field( 'enable_image_links' );
							$enable_external    = get_sub_field( 'enable_external_sites' );
							?>
							<div class="general-block<?php echo get_sub_field( 'disable_container_padding' ) ? ' general-block--no-padding' : ''; ?>"<?php echo $anchor_id ? ' id="' . esc_attr( $anchor_id ) . '"' : ''; ?>>
								<?php
								get_template_part_args(
									'template-parts/content-modules-image',
									array(
										'v'     => 'image',
										'v2x'   => false,
										'is'    => false,
										'is_2x' => false,
										'c'     => 'general-block__img',
									)
								);
								?>
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
									<?php
									get_template_part_args(
										'template-parts/content-modules-cta',
										array(
											'v' => 'cta',
											'c' => 'underline-link',
										)
									);
									?>
								</div>
								<?php if ( $enable_image_links && have_rows( 'image_links' ) ) : ?>
									<div class="general-block__image-links">
										<?php
										while ( have_rows( 'image_links' ) ) :
											the_row();
											$cta = get_sub_field( 'cta' );
											?>
											<a href="<?php echo esc_url( $cta['url'] ); ?>" class="general-block__image-link" target="<?php echo esc_attr( $cta['target'] ? $cta['target'] : '_self' ); ?>">
												<?php
												get_template_part_args(
													'template-parts/content-modules-image',
													array(
														'v'   => 'image',
														'v2x' => false,
														'is'  => false,
														'is_2x' => false,
														'c'   => 'link-img',
													)
												);
												?>
												<span class="link-title">
													<?php echo esc_html( $cta['title'] ); ?>
													<svg width="25" height="25" viewBox="0 0 25 25" fill="none" xmlns="http://www.w3.org/2000/svg">
														<path d="M13.3335 6.08984L19.3335 12.0898M19.3335 12.0898L13.3335 18.0898M19.3335 12.0898H4.3335" stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
													</svg>
												</span>
											</a>
										<?php endwhile; ?>
									</div>
								<?php endif; ?>
								<?php if ( $enable_external && have_rows( 'external_sites' ) ) : ?>
									<div class="general-block__externals">
										<?php
										while ( have_rows( 'external_sites' ) ) :
											the_row();
											$url = get_sub_field( 'url' );
											?>
											<a href="<?php echo esc_url( $url ); ?>" class="general-block__external" target="_blank">
												<?php
												get_template_part_args(
													'template-parts/content-modules-image',
													array(
														'v'   => 'image',
														'v2x' => false,
														'is'  => false,
														'is_2x' => false,
														'w'   => 'div',
														'wc'  => 'external-image',
													)
												);
												?>
												<?php
												get_template_part_args(
													'template-parts/content-modules-text',
													array(
														'v'  => 'content',
														't'  => 'div',
														'tc' => 'external-content',
													)
												);
												?>
											</a>
										<?php endwhile; ?>
									</div>
								<?php endif; ?>
							</div>
							<?php
						elseif ( 'videos_block' == get_row_layout() ) :
							$is_full_width = get_sub_field( 'is_full_width' );
							if ( have_rows( 'videos' ) ) :
								?>
								<?php if ( $is_full_width ) : ?>
										</div>
									</div>
								</section>
								<section class="full-videos-block">
									<div class="container">
								<?php endif; ?>
								<div class="videos-block<?php echo $is_full_width ? ' videos-block--full' : ''; ?>"<?php echo $anchor_id ? ' id="' . esc_attr( $anchor_id ) . '"' : ''; ?>>
									<?php
									while ( have_rows( 'videos' ) ) :
										the_row();
										$video = get_sub_field( 'video' );
										if ( $video ) :
											?>
											<a href="<?php echo esc_url( $video ); ?>" class="video-player" data-fancybox>
												<img src="<?php echo esc_url( get_youtube_image_from_url( $video ) ); ?>" alt="">
												<span class="video-play">
													<img src="<?php echo esc_url( get_template_directory_uri() . '/assets/img/icon-play.svg' ); ?>" alt="Play Video">
												</span>
												<?php
												get_template_part_args(
													'template-parts/content-modules-text',
													array(
														'v'  => 'name',
														't'  => 'div',
														'tc' => 'video-player__title',
													)
												);
												?>
											</a>
										<?php endif; ?>
									<?php endwhile; ?>
								</div>
								<?php if ( $is_full_width ) : ?>
									</div>
								</section>
								<?php endif; ?>
							<?php endif; ?>
							<?php
						elseif ( 'guides_block' == get_row_layout() ) :
							?>
							<div class="guides-block"<?php echo $anchor_id ? ' id="' . esc_attr( $anchor_id ) . '"' : ''; ?>>
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
								if ( have_rows( 'guides_row' ) ) :
									while ( have_rows( 'guides_row' ) ) :
										the_row();
										?>
										<div class="guides-block-row">
											<div class="guides-block-row__heading">
												<?php
												get_template_part_args(
													'template-parts/content-modules-text',
													array(
														'v'  => 'title',
														't'  => 'span',
														'tc' => 'guides-block-row__title',
													)
												);
												?>
												<?php
												get_template_part_args(
													'template-parts/content-modules-cta',
													array(
														'v' => 'cta',
														'c' => 'guides-block-row__cta',
													)
												);
												?>
											</div>
											<?php if ( have_rows( 'guides' ) ) : ?>
											<div class="guides-block-row__content">
												<?php
												while ( have_rows( 'guides' ) ) :
													the_row();
													$image = get_sub_field( 'guide_image' );
													$url   = get_sub_field( 'guide_url' );
													?>
													<a href="<?php echo esc_url( $url ); ?>" class="guides-block-row__col" target="_blank">
														<?php
														get_template_part_args(
															'template-parts/content-modules-image',
															array(
																'v'     => 'guide_image',
																'v2x'   => false,
																'is'    => false,
																'is_2x' => false,
															)
														);
														?>
													</a>
												<?php endwhile; ?>
											</div>
											<?php endif; ?>
										</div>
										<?php
									endwhile;
								endif;
								?>
							</div>
							<?php
						elseif ( 'accordions' == get_row_layout() ) :
							$font_size = get_sub_field( 'font_size' ) ? get_sub_field( 'font_size' ) : 'normal';
							?>
							<div class="accordions-block accordions-block--<?php echo esc_attr( $font_size ); ?>"<?php echo $anchor_id ? ' id="' . esc_attr( $anchor_id ) . '"' : ''; ?>>
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
								<?php if ( have_rows( 'accordions' ) ) : ?>
									<div class="accordions">
										<?php
										while ( have_rows( 'accordions' ) ) :
											the_row();
											$content_type = get_sub_field( 'content_type' );
											$for_teachter = get_sub_field( 'for_teachers' );
											$main_video   = get_sub_field( 'main_video' );
											$gallery      = get_sub_field( 'gallery' );
											?>
											<div class="accordion">
												<?php
												get_template_part_args(
													'template-parts/content-modules-text',
													array(
														'v'  => 'heading',
														't'  => 'h3',
														'tc' => 'accordion-header',
													)
												);
												?>
												<div class="accordion-body">
													<?php
													get_template_part_args(
														'template-parts/content-modules-text',
														array(
															'v'  => 'content',
															't'  => 'div',
															'tc' => 'accordion-copy',
														)
													);
													?>
													<?php if ( 'video' == $content_type ) : ?>
														<?php if ( $for_teachter ) : ?>
															<?php
															get_template_part_args(
																'template-parts/content-modules-text',
																array(
																	'v'  => 'main_video_heading',
																	't'  => 'p',
																	'tc' => 'accordion-video__title',
																)
															);
															?>
															<?php if ( $main_video || $gallery ) : ?>
																<div class="row">
																	<?php if ( $main_video ) : ?>
																		<div class="accordion-main__video embed-container">
																			<?php echo $main_video; ?>
																		</div>
																	<?php endif; ?>
																	<?php if ( $gallery ) : ?>
																		<div class="accordion-main__gallery">
																			<?php foreach ( $gallery as $image ) : ?>
																				<img src="<?php echo esc_url( $image['url'] ); ?>" alt="<?php echo esc_attr( $image['alt'] ); ?>">
																			<?php endforeach; ?>
																		</div>
																	<?php endif; ?>
																</div>
															<?php endif; ?>
														<?php endif; ?>
														<?php
														get_template_part_args(
															'template-parts/content-modules-text',
															array(
																'v'  => 'videos_heading',
																't'  => 'h6',
																'tc' => 'accordion-video__title',
															)
														);
														?>
														<?php if ( have_rows( 'videos' ) ) : ?>
															<div class="accordion-videos">
																<?php
																while ( have_rows( 'videos' ) ) :
																	the_row();
																	$video  = get_sub_field( 'video' );
																	$iframe = get_sub_field( 'iframe' );
																	?>
																	<div class="accordion-video">
																		<?php if ( $for_teachter ) : ?>
																			<?php if ( $iframe ) : ?>
																				<div class="video-player">
																					<?php echo $iframe; ?>
																				</div>
																			<?php endif; ?>
																		<?php else : ?>
																			<a href="<?php echo esc_url( $video ); ?>" class="video-player" data-fancybox>
																				<img src="<?php echo esc_url( get_youtube_image_from_url( $video ) ); ?>" alt="">
																				<span class="video-play">
																					<img src="<?php echo esc_url( get_template_directory_uri() . '/assets/img/icon-play.svg' ); ?>" alt="Play Video">
																				</span>
																				<?php
																				get_template_part_args(
																					'template-parts/content-modules-text',
																					array(
																						'v'  => 'title',
																						't'  => 'div',
																						'tc' => 'video-player__title',
																					)
																				);
																				?>
																			</a>
																		<?php endif; ?>
																		<?php
																		get_template_part_args(
																			'template-parts/content-modules-text',
																			array(
																				'v'  => 'content',
																				't'  => 'p',
																				'tc' => 'accordion-video__content',
																			)
																		);
																		?>
																	</div>
																<?php endwhile; ?>
															</div>
														<?php endif; ?>
													<?php else : ?>
														<?php if ( have_rows( 'people' ) ) : ?>
															<div class="accordion-people">
																<?php
																while ( have_rows( 'people' ) ) :
																	the_row();
																	$cta = get_sub_field( 'cta' );
																	?>
																	<div class="person-card">
																		<?php
																		get_template_part_args(
																			'template-parts/content-modules-image',
																			array(
																				'v'     => 'image',
																				'v2x'   => false,
																				'is'    => false,
																				'is_2x' => false,
																				'c'     => 'person-card__img',
																			)
																		);
																		?>
																		<?php
																		get_template_part_args(
																			'template-parts/content-modules-text',
																			array(
																				'v'  => 'name',
																				't'  => 'h6',
																				'tc' => 'person-card__name',
																			)
																		);
																		?>
																		<?php
																		get_template_part_args(
																			'template-parts/content-modules-text',
																			array(
																				'v'  => 'info',
																				't'  => 'p',
																				'tc' => 'person-card__info',
																			)
																		);
																		?>
																		<?php
																		get_template_part_args(
																			'template-parts/content-modules-text',
																			array(
																				'v'  => 'description',
																				't'  => 'p',
																				'tc' => 'person-card__desc',
																			)
																		);
																		?>
																		<?php if ( $cta ) : ?>
																			<a href="<?php echo esc_url( $cta['url'] ); ?>"
																				class="underline-link person-card__cta"
																				data-fancybox
																				target="<?php echo esc_attr( $cta['target'] ? $cta['target'] : '_self' ); ?>">
																				<?php echo esc_html( $cta['title'] ); ?>
																			</a>
																		<?php endif; ?>
																	</div>
																<?php endwhile; ?>
															</div>
														<?php endif; ?>
													<?php endif; ?>
												</div>
											</div>
										<?php endwhile; ?>
									</div>
								<?php endif; ?>
							</div>
							<?php
						elseif ( 'time_slider' == get_row_layout() ) :
							?>
									</div>
								</div>
							</section>
							<section class="timeslider">
								<div class="container">
									<?php
									get_template_part_args(
										'template-parts/content-modules-text',
										array(
											'v'  => 'heading',
											't'  => 'h3',
											'tc' => 'timeslider-heading a-up',
										)
									);
									?>
									<?php if ( have_rows( 'slides' ) ) : ?>
										<div class="timeslider-carousel">
											<?php
											while ( have_rows( 'slides' ) ) :
												the_row();
												$year = get_sub_field( 'year' );
												?>
												<div class="timeslider-slide" data-year="<?php echo esc_attr( $year ); ?>">
													<div class="timeslider-slide__content">
														<?php
														get_template_part_args(
															'template-parts/content-modules-text',
															array(
																'v'  => 'title',
																't'  => 'h6',
																'tc' => 'timeslider-slide__title',
															)
														);
														?>
														<?php
														get_template_part_args(
															'template-parts/content-modules-text',
															array(
																'v'  => 'heading',
																't'  => 'p',
																'tc' => 'timeslider-slide__heading',
															)
														);
														?>
														<?php
														get_template_part_args(
															'template-parts/content-modules-text',
															array(
																'v'  => 'content',
																't'  => 'p',
																'tc' => 'timeslider-slide__copy',
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
															'w'     => 'div',
															'wc'    => 'timeslider-slide__image',
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
						elseif ( 'hero_central_videos' == get_row_layout() ) :
							?>
							<?php if ( have_rows( 'videos' ) ) : ?>
							</div></div></section>
							<style>
								.community-modules {
									display: none;
								}
							</style>
							<section class="hc-videos">
								<div class="container">
									<?php
									$years = array();
									while ( have_rows( 'videos' ) ) :
										the_row();
										$date = get_sub_field( 'date' );
										if ( $date ) {
											$date_arr = explode( ', ', $date );
											$year     = $date_arr[1];
											if ( ! in_array( $year, $years ) ) {
												$years[] = $year;
											}
										}
									endwhile;
									?>
									<select name="video_year" id="video_year" class="hc-videos__select a-up" jcf-select>
										<option value="all"><?php echo esc_html__( 'All' ); ?></option>
										<?php foreach ( $years as $year ) : ?>
											<option value="<?php echo esc_attr( $year ); ?>"><?php echo esc_html( $year ); ?></option>
										<?php endforeach; ?>
									</select>
									<div class="hc-videos__grid a-up">
										<?php
										while ( have_rows( 'videos' ) ) :
											the_row();
											$video = get_sub_field( 'video_url' );
											$date  = get_sub_field( 'date' );
											if ( $date ) {
												$date_arr = explode( ', ', $date );
											}
											if ( $video ) :
												?>
												<div class="hc-videos__item is-active" data-year="<?php echo $date_arr[1]; ?>">
													<a href="<?php echo esc_url( $video ); ?>" class="video-player" data-fancybox>
														<img src="<?php echo esc_url( get_youtube_image_from_url( $video ) ); ?>" alt="">
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
													<?php if ( $date ) : ?>
														<h6 class="hc-videos__item-date"><?php echo esc_html( $date ); ?></h6>
													<?php endif; ?>
												</div>
											<?php endif; ?>
										<?php endwhile; ?>
									</div>
									<?php if ( count( get_sub_field( 'videos' ) ) > 12 ) : ?>
										<div class="hc-videos__loadmore a-up">
											<button class="underline-link btn-loadmore-videos" data-paged="1"><?php echo esc_html( 'Load More' ); ?></button>
										</div>
									<?php endif; ?>
								</div>
							</section>
							<?php endif; ?>
						<?php else : ?>
						<?php endif; ?>
					<?php endwhile; ?>
				</div>
			<?php endif; ?>
		</div>
	</section>
<?php endif; ?>

<?php
$gallery = get_field( 'gallery' );
if ( get_field( 'gallery_heading' ) || $gallery ) :
	?>
	<!-- Gallery -->
	<section class="gallery-block">
		<div class="container">
			<?php
			get_template_part_args(
				'template-parts/content-modules-text',
				array(
					'v'  => 'gallery_heading',
					't'  => 'h3',
					'tc' => 'gallery-block__heading a-up',
					'o'  => 'f',
				)
			);
			?>
			<?php if ( $gallery ) : ?>
				<div class="gallery-block__grid a-up a-delay-1">
					<?php foreach ( $gallery as $image ) : ?>
						<a class="gallery-block__image" href="<?php echo esc_url( $image['url'] ); ?>" data-fancybox="gallery">
							<img src="<?php echo esc_url( $image['url'] ); ?>" alt="<?php echo esc_attr( $image['alt'] ); ?>">
						</a>
					<?php endforeach; ?>
				</div>
			<?php endif; ?>
		</div>
	</section>
<?php endif; ?>

<?php
$enable_athletes = get_field( 'enable_section_athelets' );
if ( $enable_athletes ) :
	?>
	<!-- Athletes -->
	<section class="hc-videos hc-videos--athlete">
		<div class="container">
			<?php
			get_template_part_args(
				'template-parts/content-modules-text',
				array(
					'v'  => 'athelets_heading',
					't'  => 'h2',
					'tc' => 'hc-videos__heading a-up',
					'o'  => 'f',
				)
			);
			?>
			<?php if ( have_rows( 'athelets_videos' ) ) : ?>
				<?php
				$years = array();
				while ( have_rows( 'athelets_videos' ) ) :
					the_row();
					$year = get_sub_field( 'year' );
					if ( $year && ! in_array( $year, $years ) ) {
						$years[] = $year;
					}
				endwhile;
				?>
				<div class="hc-videos__toolbar">
					<div class="hc-videos__toolbar-label a-up"><?php echo esc_html__( 'Advance Filter' ); ?>:</div>
					<div class="hc-videos__filter">
						<select name="video_year" id="video_year" class="hc-videos__select a-up" jcf-select>
							<option value="all"><?php echo esc_html__( 'All' ); ?></option>
							<?php foreach ( $years as $year ) : ?>
								<option value="<?php echo esc_attr( $year ); ?>"><?php echo esc_html( $year ); ?></option>
							<?php endforeach; ?>
						</select>
					</div>
					<div class="hc-videos__search-box a-up a-delay-1">
						<input class="hc-videos__search" type="search" placeholder="Search for someone">
					</div>
				</div>
				<div class="hc-videos__grid a-up">
					<?php
					while ( have_rows( 'athelets_videos' ) ) :
						the_row();
						$video = get_sub_field( 'video' );
						$year  = get_sub_field( 'year' );
						$week  = get_sub_field( 'week' );
						if ( $video ) :
							?>
							<div class="hc-videos__item hc-videos__item-alt is-active" data-year="<?php echo esc_attr( $year ); ?>">
								<?php
								get_template_part_args(
									'template-parts/content-modules-image',
									array(
										'v'     => 'image',
										'v2x'   => false,
										'is'    => false,
										'is_2x' => false,
										'c'     => 'hc-videos__item-alt__img',
									)
								);
								?>
								<div class="hc-videos__item-alt__content">
									<a href="<?php echo esc_url( $video ); ?>" class="hc-videos__item-alt__play" data-fancybox>
										<svg width="33" height="33" viewBox="0 0 33 33" fill="none" xmlns="http://www.w3.org/2000/svg">
											<rect x="0.5" y="0.5" width="32" height="32" rx="16" fill="#D8DCE2"/>
											<path d="M24.5 16.5L12.5 23.4282L12.5 9.5718L24.5 16.5Z" fill="#0A1631"/>
										</svg>
									</a>
									<div class="hc-videos__item-alt__info">
										<?php
										get_template_part_args(
											'template-parts/content-modules-text',
											array(
												'v'  => 'name',
												't'  => 'h6',
												'tc' => 'hc-videos__item-alt__name',
											)
										);
										?>
										<?php if ( $week ) : ?>
											<p class="hc-videos__item-alt__week">
												<?php echo esc_html__( 'Week' ) . $week; ?>
											</p>
										<?php endif; ?>
									</div>
									<a href="<?php echo esc_url( $video ); ?>" class="underline-link" data-fancybox>
										<?php echo esc_html__( 'Watch' ); ?>
									</a>
								</div>
							</div>
						<?php endif; ?>
					<?php endwhile; ?>
				</div>
				<?php if ( count( get_field( 'athelets_videos' ) ) > 12 ) : ?>
					<div class="hc-videos__loadmore a-up">
						<button class="underline-link btn-loadmore-videos" data-paged="1"><?php echo esc_html( 'Load More' ); ?></button>
					</div>
				<?php endif; ?>
			<?php endif; ?>
		</div>
	</section>
<?php endif; ?>

<?php
$enable_winners = get_field( 'enable_section_winners' );
if ( $enable_winners ) :
	?>
	<!-- Winners -->
	<section class="athlete-winners">
		<div class="container">
			<?php
			get_template_part_args(
				'template-parts/content-modules-text',
				array(
					'v'  => 'winners_heading',
					't'  => 'h2',
					'tc' => 'athlete-winners__heading a-up',
					'o'  => 'f',
				)
			);
			?>
			<?php if ( have_rows( 'athelets_winners' ) ) : ?>
				<div class="tab athlete-winners__inner">
					<ul class="tab-links athlete-winners__links">
						<?php
						while ( have_rows( 'athelets_winners' ) ) :
							the_row();
							$year = get_sub_field( 'year' );
							if ( $year ) :
								?>
								<li>
									<button class="tab-link<?php echo 1 == get_row_index() ? ' is-active' : ''; ?>" data-target="#tab-<?php echo esc_attr( get_row_index() ); ?>">
										<?php echo esc_html( $year ); ?>
									</button>
								</li>
								<?php
							endif;
						endwhile;
						?>
					</ul>
					<div class="tab-contents athlete-winners__contents">
						<?php
						while ( have_rows( 'athelets_winners' ) ) :
							the_row();
							$content = get_sub_field( 'content' );
							$gallery = get_sub_field( 'gallery' );
							?>
							<div class="tab-content athlete-winners__content<?php echo 1 == get_row_index() ? ' is-active' : ''; ?>" id="tab-<?php echo esc_attr( get_row_index() ); ?>">
								<?php
								get_template_part_args(
									'template-parts/content-modules-text',
									array(
										'v'  => 'heading',
										't'  => 'h3',
										'tc' => 'winners-heading',
									)
								);
								?>
								<?php if ( have_rows( 'cards' ) ) : ?>
								<div class="winners-cards">
									<?php
									while ( have_rows( 'cards' ) ) :
										the_row();
										?>
										<div class="winners-card">
											<?php
											get_template_part_args(
												'template-parts/content-modules-text',
												array(
													'v'  => 'title',
													't'  => 'p',
													'tc' => 'winners-card__title',
												)
											);
											?>
											<?php
											get_template_part_args(
												'template-parts/content-modules-image',
												array(
													'v'     => 'image',
													'v2x'   => false,
													'is'    => false,
													'is_2x' => false,
													'c'     => 'winners-card__img',
												)
											);
											?>
											<?php
											get_template_part_args(
												'template-parts/content-modules-text',
												array(
													'v'  => 'name',
													't'  => 'p',
													'tc' => 'winners-card__name',
												)
											);
											?>
											<?php
											get_template_part_args(
												'template-parts/content-modules-text',
												array(
													'v'  => 'description',
													't'  => 'p',
													'tc' => 'winners-card__desc',
												)
											);
											?>
											<img class="winners-card__sep" src="<?php echo esc_url( get_template_directory_uri() . '/assets/img/icon-gradient-line.svg' ); ?>" alt="">
											<a href="javascript:;" class="underline-link" data-fancybox data-src="#winners-card-<?php echo esc_attr( get_row_index() ); ?>">
												<?php echo esc_html__( 'Watch Video' ); ?>
											</a>
											<div class="winners-card-popup" id="winners-card-<?php echo esc_attr( get_row_index() ); ?>">
												<?php
												get_template_part_args(
													'template-parts/content-modules-text',
													array(
														'v'  => 'popup_title',
														't'  => 'h3',
														'tc' => 'winners-card-popup__title',
													)
												);
												?>
												<div class="winners-card-popup__content">
													<?php
													get_template_part_args(
														'template-parts/content-modules-image',
														array(
															'v'     => 'image',
															'v2x'   => false,
															'is'    => false,
															'is_2x' => false,
															'c'     => 'winners-card-popup__img',
														)
													);
													?>
													<div class="winners-card-popup__right">
														<?php
														get_template_part_args(
															'template-parts/content-modules-text',
															array(
																'v'  => 'content',
																't'  => 'div',
																'tc' => 'winners-card-popup__copy',
															)
														);
														?>
														<?php if ( have_rows( 'videos' ) ) : ?> 
														<div class="winners-card-popup__videos">
															<?php
															while ( have_rows( 'videos' ) ) :
																the_row();
																$video = get_sub_field( 'video' );
																if ( $video ) :
																	?>
																	<div class="embed-container">
																		<?php echo $video; ?>
																	</div>
																	<?php
																endif;
															endwhile;
															?>
														</div>
														<?php endif; ?>
													</div>
												</div>
											</div>
										</div>
										<?php
									endwhile;
									?>
								</div>
								<?php endif; ?>

								<?php if ( $content || $gallery ) : ?>
									<div class="athlete-winners__block">
										<?php if ( $content ) : ?>
											<div class="athlete-winners__block__content">
												<?php echo $content; ?>
											</div>
										<?php endif; ?>
										<?php if ( $gallery ) : ?>
											<div class="athlete-winners__block__gallery">
												<?php foreach ( $gallery as $image ) : ?>
													<a href="<?php echo esc_url( $image['url'] ); ?>" data-fancybox>
														<img src="<?php echo esc_url( $image['url'] ); ?>" alt="<?php echo esc_attr( $image['alt'] ); ?>">
													</a>
												<?php endforeach; ?>
											</div>
										<?php endif; ?>
									</div>
								<?php endif; ?>
							</div>
						<?php endwhile; ?>
					</div>
				</div>
			<?php endif; ?>
		</div>
	</section>
<?php endif; ?>

<?php
$enable_athletes_slider = get_field( 'enable_athletes_slider' );
if ( $enable_athletes_slider ) :
	?>
	<!-- Enable Slider -->
	<section class="athlete-slider">
		<div class="container">
			<?php
			get_template_part_args(
				'template-parts/content-modules-text',
				array(
					'v'  => 'athletes_slider_heading',
					't'  => 'h2',
					'tc' => 'athlete-slider__heading a-up',
					'o'  => 'f',
				)
			);
			?>
			<?php if ( have_rows( 'athletes_slider' ) ) : ?>
				<div class="athlete-carousel">
					<?php
					while ( have_rows( 'athletes_slider' ) ) :
						the_row();
						?>
						<div class="winners-card">
							<?php
							get_template_part_args(
								'template-parts/content-modules-text',
								array(
									'v'  => 'title',
									't'  => 'p',
									'tc' => 'winners-card__title',
								)
							);
							?>
							<?php
							get_template_part_args(
								'template-parts/content-modules-image',
								array(
									'v'     => 'image',
									'v2x'   => false,
									'is'    => false,
									'is_2x' => false,
									'c'     => 'winners-card__img',
								)
							);
							?>
							<?php
							get_template_part_args(
								'template-parts/content-modules-text',
								array(
									'v'  => 'name',
									't'  => 'p',
									'tc' => 'winners-card__name',
								)
							);
							?>
							<?php
							get_template_part_args(
								'template-parts/content-modules-text',
								array(
									'v'  => 'description',
									't'  => 'p',
									'tc' => 'winners-card__desc',
								)
							);
							?>
							<img class="winners-card__sep" src="<?php echo esc_url( get_template_directory_uri() . '/assets/img/icon-gradient-line.svg' ); ?>" alt="">
							<?php
							get_template_part_args(
								'template-parts/content-modules-cta',
								array(
									'v' => 'cta',
									'c' => 'underline-link winners-card__cta',
								)
							);
							?>
						</div>
						<?php
					endwhile;
					?>
				</div>
			<?php endif; ?>
		</div>
	</section>
<?php endif; ?>


<?php
if ( ! get_field( 'disable_content_video' ) ) :
	$image = get_field( 'c1_image', 'options' );
	$video = get_field( 'c1_video', 'options' );
	?>
	<!-- Content Image -->
	<section class="content-image content-image--contained-ctas content-image--right">
		<div class="container">
			<div class="content-image__media<?php echo $video ? ' video-player' : ''; ?>">
				<?php
				get_template_part_args(
					'template-parts/content-modules-image',
					array(
						'v'     => 'c1_image',
						'v2x'   => false,
						'is'    => 'content-image-contained-ctas',
						'is_2x' => 'content-image-contained-ctas-2x',
						'o'     => 'o',
					)
				);
				?>
				<?php if ( $video ) : ?>
					<a href="<?php echo esc_url( $video ); ?>" class="video-play" data-fancybox>
						<img src="<?php echo esc_url( get_template_directory_uri() . '/assets/img/icon-play-blue.svg' ); ?>" alt="Play">
					</a>
				<?php endif; ?>
			</div>
			<div class="content-image__content">
				<?php
				get_template_part_args(
					'template-parts/content-modules-text',
					array(
						'v'  => 'c1_heading',
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
						'v'  => 'c1_content',
						't'  => 'div',
						'tc' => 'content-image__copy a-up a-delay-1',
						'o'  => 'o',
					)
				);
				?>
				<?php
				get_template_part_args(
					'template-parts/content-modules-cta',
					array(
						'v' => 'c1_cta',
						'c' => 'btn btn-primary',
						'o' => 'o',
					)
				);
				?>
			</div>
		</div>
	</section>
<?php endif; ?>

<?php
get_template_part(
	'template-parts/section',
	'post-slider',
	array(
		'option' => 'f',
	)
);
?>

<?php
if ( ! get_field( 'disable_footer_cta' ) ) :
	?>
<!-- Footer CTA -->
<section class="c-footer-cta">
	<?php
	get_template_part_args(
		'template-parts/content-modules-image',
		array(
			'v'     => 'c3_background',
			'v2x'   => false,
			'is'    => false,
			'is_2x' => false,
			'c'     => 'c-footer-cta__bg',
			'o'     => 'o',
		)
	);
	?>
	<div class="container">
		<div class="c-footer-cta__inner">
			<?php
			get_template_part_args(
				'template-parts/content-modules-text',
				array(
					'v'  => 'c3_content',
					't'  => 'h3',
					'tc' => 'c-footer-cta__heading a-up',
					'o'  => 'o',
				)
			);
			?>
			<?php
			get_template_part_args(
				'template-parts/content-modules-cta',
				array(
					'v' => 'c3_cta',
					'c' => 'underline-link a-up a-delay-1',
					'o' => 'o',
				)
			);
			?>
		</div>
	</div>
</section>
<?php endif; ?>

<?php
get_footer();

