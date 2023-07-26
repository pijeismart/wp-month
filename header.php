<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=5, minimum-scale=1">
	<meta name="format-detection" content="telephone=no">
	<?php if ( is_singular() && pings_open( get_queried_object() ) ) : ?>
	<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">
	<?php endif; ?>
	<script>
		window.Userback = window.Userback || {};
		Userback.access_token = '29868|81311|0xVhNnhTfMJ6P0ePlM4raqpZa';
		(function(d) {
			var s = d.createElement('script');s.async = true;
			s.src = 'https://static.userback.io/widget/v1.js';
			(d.head || d.body).appendChild(s);
		})(document);
	</script>
	<!-- Preload Google Font -->
	<link rel="preconnect" href="https://fonts.googleapis.com">
	<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
	<?php wp_head(); ?>

	<?php
	get_template_part_args(
		'template-parts/content-modules-text',
		array(
			'v' => 'tracking_header',
			'o' => 'o',
		)
	);
	?>

	<!-- Begin JSON-LD -->
	<?php get_template_part( 'template-parts/content', 'json-ld' ); ?>
	<!-- End JSON-LD -->
</head>

<body <?php body_class(); ?>>
	<?php
	get_template_part_args(
		'template-parts/content-modules-text',
		array(
			'v' => 'tracking_begin_body',
			'o' => 'o',
		)
	);
	?>
	<!-- Begin Header -->
	<?php
	$enable_top_bar  = get_field( 'enable_top_bar', 'options' );
	$top_bar_content = get_field( 'top_bar_content', 'options' );
	$phone           = get_field( 'phone', 'options' );
	$lottie          = get_field( 'header_lottie', 'options' );
	?>
	<header class="header">
		<?php if ( $enable_top_bar && $top_bar_content ) : ?>
		<div class="header-top">
			<div class="container">
                <div class="header-top__content">
                    <?php echo $top_bar_content; ?>
                </div>
                <button class="header-top__close">&times;</button>
			</div>
		</div>
		<?php endif; ?>
		<nav class="header-main">
			<div class="container">
				<button class="hamburger" aria-label="<?php echo esc_html__( 'Toggle Menu', 'am' ); ?>" aria-expanded="false">
					<span></span>
				</button>
				<a href="<?php echo esc_url( home_url() ); ?>" class="header-logo" aria-label="<?php echo esc_html__( 'Montlick Logo', 'am' ); ?>">
					<?php
					get_template_part_args(
						'template-parts/content-modules-image',
						array(
							'v'     => 'logo',
							'v2x'   => false,
							'is'    => false,
							'is_2x' => false,
							'c'     => 'header-logo__img',
							'o'     => 'o',
						)
					);
					?>
				</a>
				<ul class="header-menu">
					<?php custom_mega_menu( 'mainmenu' ); ?>
				</ul>
				<?php if ( $phone && $lottie ) : ?>
					<div class="header-cta__wrapper">
						<a href="tel:<?php echo $phone; ?>" class="header-cta" aria-label="<?php echo esc_html__( 'Call Now', 'am' ); ?>">
							<script src="https://unpkg.com/@lottiefiles/lottie-player@latest/dist/lottie-player.js"></script>
							<lottie-player src="<?php echo esc_url( $lottie ); ?>" background="transparent" speed="1" loop autoplay></lottie-player>
						</a>
					</div>
				<?php endif; ?>
				<?php if ( $phone ) : ?>
					<a href="tel:<?php echo esc_attr( $phone ); ?>" class="header-phone">
						<img src="<?php echo esc_url( get_template_directory_uri() . '/assets/img/icon-call.svg' ); ?>" alt="<?php echo esc_html__( 'Call Now', 'am' ); ?>">
					</a>
				<?php endif; ?>
			</div>
		</nav>
	</header>
	<!-- End Header -->

	<!-- Begin Main -->
	<main class="main">
