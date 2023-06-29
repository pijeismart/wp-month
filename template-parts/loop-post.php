<?php
global $post;

$post_img = am_get_the_post_thumbnail();
?>
<article class="loop-post">
	<a href="<?php echo esc_url( get_the_permalink() ); ?>" class="loop-post__link">
		<?php if ( isset( $post_img ) ) : ?>
		<div class="loop-post__img">
			<img src="<?php echo esc_url( $post_img ); ?>" alt="<?php echo esc_attr( get_the_title() ); ?>">
		</div>
		<?php endif; ?>
		<div class="loop-post__content">
			<h3 class="loop-post__title"><?php echo esc_html( get_the_title() ); ?></h3>
			<?php if ( has_excerpt() ) : ?>
				<div class="loop-post__excerpt"><?php the_excerpt(); ?></div>
			<?php endif; ?>
		</div>
	</a>
</article>
