<article class="loop-attorney">
	<a href="<?php echo esc_url( get_the_permalink() ); ?>" class="loop-attorney__inner">
		<?php if ( has_post_thumbnail() ) : ?>
			<div class="loop-attorney__img">
				<?php the_post_thumbnail( 'medium' ); ?>
			</div>
		<?php endif; ?>
		<h3 class="loop-attorney__title">
			<?php echo esc_html( get_the_title() ); ?>
		</h3>
	</a>
</article>
