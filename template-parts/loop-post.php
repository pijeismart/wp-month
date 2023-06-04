<?php
global $post;
$categories = get_the_terms( $post, 'case_category' );
?>
<div class="loop-post">
	<?php if ( has_post_thumbnail() ) : ?>
		<a href="<?php echo esc_url( get_the_permalink() ); ?>" class="loop-post__img">
			<?php the_post_thumbnail( 'post-card' ); ?>
		</a>
	<?php endif; ?>
	<div class="loop-post__content">
		<?php if ( $categories ) : ?>
			<div class="loop-post__categories">
				<?php foreach ( $categories as $category ) : ?>
					<?php echo esc_html( $category->name ); ?>
				<?php endforeach; ?>
			</div>
		<?php endif; ?>
		<a href="<?php echo esc_url( get_the_permalink() ); ?>" class="loop-post__title">
			<?php the_title(); ?>
		</a>
		<?php if ( has_excerpt() ) : ?>
			<p class="loop-post__excerpt">
				<?php the_excerpt(); ?>
			</p>
		<?php endif; ?>
	</div>
</div>
