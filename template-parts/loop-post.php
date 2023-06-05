<?php
global $post;
?>
<article class="loop-post">
	<a href="<?php echo esc_url( get_the_permalink() ); ?>" class="loop-post__link">
		<div class="loop-post__img">
			<?php if ( has_post_thumbnail() ) : ?>
				<?php the_post_thumbnail(); ?>
			<?php endif; ?>
		</div>
		<div class="loop-post__content">
			<h3 class="loop-post__title"><?php echo esc_html( get_the_title() ); ?></h3>
			<?php if ( has_excerpt() ) : ?>
				<div class="loop-post__excerpt"><?php the_excerpt(); ?></div>
			<?php endif; ?>
		</div>
	</a>
</article>
