<?php get_header(); ?>


	<?php if ( have_posts() ) : ?>

		<?php
		while ( have_posts() ) :
			the_post();
			?>

			<?php
			$type = get_post_type();
			if ( 'city' == $type || 'practice' == $type ) :
				get_template_part( 'templates/content', 'page' );
			else :
				get_template_part( 'templates/content', $type );
			endif;
			?>

	<?php endwhile; ?>

	<?php else : ?>
		<?php get_template_part( 'templates/content', 'none' ); ?>
	<?php endif; ?>


<?php
get_footer();
