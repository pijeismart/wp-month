<?php
global $post;
$categories = get_the_terms( $post, 'case_category' );
?>
<div class="loop-post-card">
	<?php if ( has_post_thumbnail() ) : ?>
		<a href="<?php echo esc_url( get_the_permalink() ); ?>" class="loop-post-card__img">
			<?php the_post_thumbnail( 'post-card' ); ?>
		</a>
	<?php endif; ?>
	<div class="loop-post-card__content">
		<?php if ( $categories ) : ?>
			<div class="loop-post-card__categories">
				<?php foreach ( $categories as $category ) : ?>
					<?php echo esc_html( $category->name ); ?>
				<?php endforeach; ?>
			</div>
		<?php endif; ?>
		<a href="<?php echo esc_url( get_the_permalink() ); ?>" class="loop-post-card__title">
			<?php the_title(); ?>
		</a>
		<?php if ( has_excerpt() ) : ?>
			<div class="loop-post-card__excerpt">
				<?php the_excerpt(); ?>
			</div>
		<?php endif; ?>
	</div>
</div>
