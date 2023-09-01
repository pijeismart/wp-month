<?php
global $post;
$role = get_field( 'role', $post );
?>
<article class="loop-attorney">
	<a href="<?php echo esc_url( get_the_permalink() ); ?>" class="loop-attorney__inner">
		<?php if ( has_post_thumbnail() ) : ?>
			<div class="loop-attorney__img">
				<?php the_post_thumbnail( 'large' ); ?>
			</div>
		<?php endif; ?>
		<div class="loop-attorney__content">
			<h3 class="loop-attorney__title">
				<?php echo esc_html( get_the_title() ); ?>
			</h3>
			<?php if ( $role ) : ?>
				<p class="loop-attorney__role">
					<?php echo esc_html( $role ); ?>
				</p>
			<?php endif; ?>
		</div>
	</a>
</article>
