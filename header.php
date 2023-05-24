<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, minimum-scale=1, user-scalable=no">
	<meta name="format-detection" content="telephone=no">
	<?php if ( is_singular() && pings_open( get_queried_object() ) ) : ?>
	<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">
	<?php endif; ?>
	<!-- Preload Google Font -->
	<link rel="preconnect" href="https://fonts.googleapis.com">
	<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
	<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
	<!-- Begin Header -->
	<?php
	$enable_top_bar = get_field( 'enable_top_bar', 'options' );
	$top_bar_text   = get_field( 'top_bar_text', 'options' );
	$top_bar_link   = get_field( 'top_bar_link', 'options' );
	$cta_text       = get_field( 'header_cta_text', 'options' );
	$cta_url        = get_field( 'header_cta_url', 'options' );
	?>
	<header class="header">
		<?php if ( $enable_top_bar ) : ?>
		<div class="header-top">
			<div class="container">
				<?php if ( $top_bar_link && $top_bar_text ) : ?>
					<a href="<?php echo esc_url( $top_bar_link['url'] ); ?>" 
						target="<?php echo esc_attr( $top_bar_link['target'] ? $top_bar_link['target'] : '_self' ); ?>" 
						class="header-top__link">
						<img src="<?php echo esc_url( get_template_directory_uri() . '/assets/img/icon-headphones.svg' ); ?>" alt="">
						<span><?php echo $top_bar_text; ?></span>
					</a>
				<?php endif; ?>
			</div>
		</div>
		<?php endif; ?>
		<nav class="header-main">
			<div class="container">
				<button class="hamburger">
					<span></span>
				</button>
				<a href="<?php echo esc_url( home_url() ); ?>" class="header-logo">
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
				<?php
				wp_nav_menu(
					array(
						'theme_location' => 'mainmenu',
						'menu_class'     => 'header-menu',
						'container'      => false,
					)
				);
				?>
				<?php if ( $cta_url && $cta_text ) : ?>
					<div class="header-cta__wrapper">
						<a href="<?php echo esc_url( $cta_url['url'] ); ?>" class="header-cta" target="<?php echo esc_attr( $cta_url['target'] ?: '_self' ); ?>">
							<?php echo $cta_text; ?>
						</a>
					</div>
				<?php endif; ?>
			</div>
		</nav>
	</header>
	<!-- End Header -->

	<!-- Begin Main -->
	<main class="main">
