<?php
global $post;
$categories = get_the_terms( $post, 'case_category' );
$post_img   = am_get_the_post_thumbnail( 'post-card' );
?>
<div class="loop-post-card">
	<?php if ( isset( $post_img ) && !get_field( 'disable_thumbnail_images', 'options' ) ) : ?>
		<a href="<?php echo esc_url( get_the_permalink() ); ?>" class="loop-post-card__img">
			<img src="<?php echo esc_url( $post_img ); ?>" alt="<?php echo esc_attr( get_the_title() ); ?>">
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
