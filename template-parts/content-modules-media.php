<?php
$image = $args['image'];
$video = $args['video'];
if ( isset( $args['size'] ) ) :
	$size = $args['size'];
endif;
?>
<?php if ( $video ) : ?>
<video src="<?php echo esc_url( $video ); ?>" loop muted playsinline autoplay preload="metadata"
	<?php echo $image ? 'poster="' . esc_url( $image['url'] ) . '"' : ''; ?>>
	<source src="<?php echo esc_url( $video ); ?>" type="video/mp4">
</video>
	<?php
elseif ( $image ) :
	if ( $size ) :
		$url    = $image['sizes'][ $size ];
		$url_2x = $image['sizes'][ $size . '-2x' ];
	else :
		$url = $image['url'];
	endif;
	?>
	<picture>
		<img src="<?php echo esc_url( $url ); ?>"
			<?php echo $url_2x ? 'srcset="' . esc_url( $url_2x ) . ' 2x"' : ''; ?>
			alt="<?php echo esc_attr( $image['alt'] ); ?>">
	</picture>
<?php endif; ?>
