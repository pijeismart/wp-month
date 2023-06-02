<?php get_header(); ?>


	<?php if ( have_posts() ) : ?>

		<?php
		while ( have_posts() ) :
			the_post();
			?>

			<?php
			if ( 'post' == get_post_type() ) :
				get_template_part( 'templates/content', 'post' );
			else :
				get_template_part( 'templates/content', 'page' );
			endif;
			?>

	<?php endwhile; ?>

	<?php else : ?>
		<?php get_template_part( 'templates/content', 'none' ); ?>
	<?php endif; ?>


<?php
get_footer();
