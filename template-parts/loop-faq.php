<?php
global $post;
$categories = get_the_terms( $post, 'case_category' );
$types      = get_the_terms( $post, 'faq_type' );
?>
<article class="loop-faq">
	<a href="<?php echo esc_url( get_the_permalink() ); ?>">
		<h3 class="loop-faq__question"><?php echo esc_html__( get_the_title() ); ?></h2>
		<?php
		get_template_part_args(
			'template-parts/content-modules-text',
			array(
				'v'  => 'direct_answer',
				't'  => 'p',
				'tc' => 'loop-faq__answer',
				'o'  => 'f',
			)
		);
		?>
		<div class="loop-faq__meta">
			<?php if ( $categories ) : ?>
				<div class="loop-faq__categories">
					<?php foreach ( $categories as $category ) : ?>
						<span class="loop-faq__cat"><?php echo esc_html( $category->name ); ?></span>
					<?php endforeach; ?>  
				</div>
			<?php endif; ?>

			<a href="<?php echo esc_url( get_the_permalink() ); ?>" class="underline-link loop-faq__link">
				<?php echo ( 'video-shorts' == $types[0]->slug ) ? 'Watch Video' : 'Keep Reading'; ?>
			</a>
		</div>
	</a>
</article>
