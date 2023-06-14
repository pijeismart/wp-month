<?php
/*
Template Name: Sitemap
*/
get_header(); ?>

<section class="content">
	<div class="container site-map">
		<h1>
			<?php echo esc_html__( 'Sitemap' ); ?>
		</h1>
		<ul class="site-map__list">
			<?php
				wp_list_pages(
					array(
						'title_li'  => __( 'Practice Areas', 'am' ),
						'post_type' => 'practice',
					)
				);
            ?>
			<?php
				wp_list_pages(
					array(
						'title_li'  => __( 'Areas We Serve', 'am' ),
						'post_type' => 'city',
					)
				);
            ?>
			<?php
				wp_list_pages(
					array(
						'exclude'   => '310',
						'title_li'  => '',
						'post_type' => 'page',
					)
				);
            ?>
		</ul>
	</div>
</section>

<?php get_footer(); ?>
