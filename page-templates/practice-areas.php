<?php
/**
 * Template Name: Practice Areas
 * Template Post Type: page
 */

get_header();

global $post;

$common_practice_areas = get_field( 'common_practice_areas' );
$faqs                  = get_field( 'faqs' );
?>
<section class="pa-banner">
	<div class="pa-banner__bg"></div>
	<div class="container">
		<div class="pa-banner__info">
			<ul class="breadcrumbs a-up">
				<li>
					<a href="<?php echo esc_url( home_url() ); ?>"><?php echo esc_html( 'Home' ); ?></a>
				</li>
				<li>
					<span><?php the_title(); ?></span>
				</li>
			</ul>
			<?php
			get_template_part_args(
				'template-parts/content-modules-text',
				array(
					'v'  => 's1_heading',
					't'  => 'h1',
					'tc' => 'pa-banner__heading a-up a-delay-1',
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
					'tc' => 'pa-banner__content a-up a-delay-2',
					'o'  => 'f',
				)
			);
			?>
		</div>
		<div class="pa-banner__inner">
			<?php if ( $common_practice_areas ) : ?>
			<div class="pa-banner__areas a-up a-delay-3">
				<?php
				get_template_part_args(
					'template-parts/content-modules-text',
					array(
						'v'  => 'common_practice_areas_heading',
						't'  => 'h3',
						'tc' => 'pa-banner__areas-heading',
						'o'  => 'f',
					)
				);
				?>
				<div class="pa-banner__areas-items">
					<?php
					foreach ( $common_practice_areas as $key => $post ) :
						setup_postdata( $post );
						$case_category = get_the_terms( $post, 'case_category' );
						$brief         = get_field( 'brief' );
						if ( $case_category ) :
							$icon = get_field( 'icon', 'case_category_' . $case_category[0]->term_id );
						endif;
						?>
						<div class="accordion pa-banner__areas-item">
							<div class="accordion-header pa-banner__areas-item__heading">
								<?php if ( isset( $icon ) && $icon ) : ?>
									<img class="pa-banner__areas-item__heading-icon" src="<?php echo esc_url( $icon['url'] ); ?>" alt="<?php echo esc_attr( $icon['alt'] ); ?>" />
								<?php endif; ?>
								<span class="pa-banner__areas-item__heading-text">
									<?php the_title(); ?>
								</span>
							</div>
							<?php if ( $brief ) : ?>
							<div class="accordion-body pa-banner__areas-item__content">
								<?php echo $brief; ?>
							</div>
							<?php endif; ?>
						</div>
						<?php
					endforeach;
					wp_reset_postdata();
					?>
				</div>
				<div class="pa-banner__areas-footer">
					<p><?php echo esc_html__( 'View all practice areas' ); ?></p>
					<?php
					get_template_part_args(
						'template-parts/content-modules-cta',
						array(
							'v' => 'practice_area_cta',
							'c' => 'underline-link',
							'o' => 'f',
						)
					);
					?>
				</div>
			</div>
			<?php endif; ?>
			<?php if ( $faqs ) : ?>
			<div class="pa-banner__faqs a-up a-delay-4">
				<?php
				get_template_part_args(
					'template-parts/content-modules-text',
					array(
						'v'  => 'faqs_heading',
						't'  => 'h3',
						'tc' => 'pa-banner__faqs-heading',
						'o'  => 'f',
					)
				);
				?>
				<div class="pa-banner__faqs-items">
					<?php
					foreach ( $faqs as $post ) :
						setup_postdata( $post );
						$answer = get_field( 'direct_answer' );
						?>
						<div class="accordion pa-banner__faqs-item">
							<div class="accordion-header"><?php the_title(); ?></div>
							<?php if ( $answer ) : ?>
							<div class="accordion-body">
								<?php echo $answer; ?>
							</div>
							<?php endif; ?>
						</div>
					<?php endforeach; ?>
				</div>
			</div>
			<?php endif; ?>
		</div>
	</div>
</section>

<section class="pa-grid">
	<div class="container">
		<h2 class="pa-grid__heading a-up"><?php echo esc_html__( 'All Practice Areas', 'am' ); ?></h2>
		<input type="text" class="section-archive__search pa-grid__search a-up a-delay-1" placeholder="<?php echo esc_html__( 'Search by area', 'am' ); ?>">
		<!-- Show practice_area group by alphabet -->
		<?php
		$args  = array(
			'post_type'      => 'practice',
			'post_status'    => 'publish',
			'posts_per_page' => -1,
			'orderby'        => 'title',
			'order'          => 'ASC',
		);
		$query = new WP_Query( $args );
		if ( $query->have_posts() ) :
			// all alphabets in uppercase
			$allAlphabets = array( 'A', 'B', 'C', 'D', 'E', 'F', 'G', 'H', 'I',
				'J', 'K', 'L', 'M', 'N', 'O', 'P', 'Q', 'R',
				'S', 'T', 'U', 'V', 'W', 'X', 'Y', 'Z' );
			$alphabet = array();
			while ( $query->have_posts() ) :
				$query->the_post();
				$title        = get_the_title();
				$first_letter = substr( $title, 0, 1 );
				if ( ! in_array( $first_letter, $alphabet ) ) :
					$alphabet[] = $first_letter;
				endif;
			endwhile;
			wp_reset_postdata();
			?>
			<div class="pa-grid__alphabet a-up a-delay-1">
				<?php
				foreach ( $allAlphabets as $key => $letter ) :
					?>
					<button data-target="#<?php echo esc_attr( $letter ); ?>" class="pa-grid__filter<?php echo in_array( $letter, $alphabet ) ? ' is-enabled' : ''; ?>"><?php echo esc_html( $letter ); ?></button>
				<?php endforeach; ?>
			</div>
			<?php
		endif;
		?>
		<div class="pa-grid__items a-up a-delay-2">
			<?php
			$alphabet_index = 0;
			if ( $query->have_posts() ) :
				while ( $query->have_posts() ) :
					$query->the_post();
					$title        = get_the_title();
					$first_letter = substr( $title, 0, 1 );
					if ( $first_letter == $alphabet[ $alphabet_index ] ) :
						$alphabet_index++;
						?>
						<?php if ( $alphabet_index > 1 ) : ?>
							</div>
						<?php endif; ?>
						<div class="pa-grid__group" id="<?php echo esc_attr( $first_letter ); ?>">
						<div class="pa-grid__group-letter"><?php echo esc_html( $first_letter ); ?></div>
					<?php endif; ?>
					<div class="pa-grid__item-wrapper">
						<a href="<?php echo esc_url( get_the_permalink() ); ?>" class="pa-grid__item">
							<?php the_title(); ?>  
						</a>
					</div>
				<?php endwhile; ?>
				<?php wp_reset_postdata(); ?>
			<?php endif; ?>
		</div>
	</div>
    <div class="pa-grid__no-results">
        <?php echo esc_html__( 'No results found', 'am' ); ?>
    </div>
</section>

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
</section>

<?php
get_footer();

