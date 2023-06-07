<?php
global $post;
$types = get_the_terms( $post, 'claim_type' );
?>
<div class="loop-practice-area">
	<div class="loop-practice-area__content">
		<a href="<?php echo esc_url( get_the_permalink() ); ?>" class="loop-practice-area__title">
			<?php the_title(); ?>
		</a>
		<?php if ( has_excerpt() ) : ?>
			<div class="loop-practice-area__excerpt"><?php the_excerpt(); ?></div>
		<?php endif; ?>
	</div>
	<?php if ( $types ) : ?>
		<div class="loop-practice-area__metas">
			<?php
			foreach ( $types as $type ) :
				$image = get_field( 'icon', 'claim_type' . '_' . $type->term_id );
				?>
				<div class="loop-practice-area__meta">
					<?php if ( $image ) : ?>
						<img src="<?php echo esc_url( $image['url'] ); ?>" alt="<?php echo esc_attr( $type->name ); ?>">
					<?php endif; ?>
					<span><?php echo $type->name; ?></span>
				</div>
			<?php endforeach; ?>
		</div>
	<?php endif; ?>
</div>
