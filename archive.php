<?php
get_header(); ?>
<?php
if ( have_posts() ) :
	?>
	<section class="general-archive">
		<div class="container">
			<h1 class="h2 general-archive__title a-up"><?php the_archive_title(); ?></h1>
			<div class="general-archive__grid a-up a-delay-1">
				<?php
				while ( have_posts() ) :
					the_post();
					?>
					<article class="general-archive__post">
						<?php if ( has_post_thumbnail() ) : ?>
							<a href="<?php echo esc_url( get_the_permalink() ); ?>" class="general-archive__post-thumbnail">
								<?php the_post_thumbnail(); ?>
							</a>
						<?php endif; ?>
						<a href="<?php echo esc_url( get_the_permalink() ); ?>" class="h3 general-archive__post-title"><?php the_title(); ?></a>
						<?php if ( has_excerpt() ) : ?>
							<div class="general-archive__post-excerpt">
								<?php the_excerpt(); ?>
							</div>
						<?php endif; ?>
					</article>
					<?php
				endwhile;
				?>
			</div>
			<?php
            if ( $wp_query->max_num_pages > 1 ) :
                ?>
                <div class="general-archive__pagination a-up">
                    <?php
                    $big = 999999999; // need an unlikely integer
                    echo paginate_links(
                        array(
                            'base'    => str_replace( $big, '%#%', esc_url( get_pagenum_link( $big ) ) ),
                            'format'  => '?paged=%#%',
                            'current' => max( 1, get_query_var( 'paged' ) ),
                            'total'   => $wp_query->max_num_pages,
                        )
                    );
                    ?>
                </div>
            <?php endif; ?>
		</div>
	</section>
<?php endif; ?>
<?php get_footer(); ?>
