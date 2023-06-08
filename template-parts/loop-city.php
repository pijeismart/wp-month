<?php
global $post;

$states = get_the_terms( $post, 'state' );

$args = array(
	'post_type'      => 'city',
	'post_status'    => 'publish',
	'posts_per_page' => -1,
	'post_parent'    => get_the_ID(),
);
if ( $states ) {
	$args['tax_query'] = array(
		array(
			'taxonomy' => 'state',
			'terms'    => $states[0]->term_id,
		),
	);
}
$query = new WP_Query( $args );
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
	<?php if ( $query->have_posts() ) : ?>
		<div class="loop-practice-area__metas">
			<?php
			while ( $query->have_posts() ) :
				$query->the_post();
				$categories = get_the_terms( $post, 'case_category' );
				if ( $categories ) :
					$image = get_field( 'icon', 'case_category' . '_' . $categories[0]->term_id );
				endif;
				?>
				<a href="<?php echo esc_url( get_the_permalink() ); ?>" class="loop-practice-area__meta">
					<?php if ( isset( $image ) ) : ?>
						<img src="<?php echo esc_url( $image['url'] ); ?>" alt="<?php the_title(); ?>">
					<?php endif; ?>
					<span><?php the_title(); ?></span>
				</a>
			<?php endwhile; ?>
		</div>
		<?php
	endif;
	wp_reset_postdata();
	?>
</div>
