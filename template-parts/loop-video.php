<?php
global $post;
$youtube_id  = get_field( 'youtube_video_id' );
$youtube_url = 'https://www.youtube.com/embed/' . $youtube_id . '?feature=oembed';
?>
<div class="podcast">
	<div class="podcast-video">
        <div class="podcast-video__thumbnail object-cover">
            <?php the_post_thumbnail(); ?>
        </div>
		<a class="podcast-btn" href="<?php echo esc_url( $youtube_url ); ?>" data-fancybox>
			<img src="<?php echo esc_url( get_template_directory_uri() . '/assets/img/icon-play.svg' ); ?>" alt="Play Podcast">
		</a>
	</div>
    <p class="podcast-title"><?php the_title(); ?></p>
</div>
