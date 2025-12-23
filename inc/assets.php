<?php

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Carga de estilos y scripts del tema.
 */
function mauswp_enqueue_assets() {

	$theme_version = wp_get_theme()->get( 'Version' );

	// CSS principal (Tailwind compilado).
	wp_enqueue_style(
		'mauswp-style',
		get_template_directory_uri() . '/dist/app.css',
		[],
		$theme_version
	);

	// Swiper CSS (CDN)
	wp_enqueue_style(
		'mauswp-swiper',
		'https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css',
		[],
		'11.0.0'
	);

	// Swiper JS (CDN)
	wp_enqueue_script(
		'mauswp-swiper',
		'https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js',
		[],
		'11.0.0',
		true
	);

	// JS del tema
	wp_enqueue_script(
		'mauswp-app',
		get_template_directory_uri() . '/assets/src/js/app.js',
		[ 'mauswp-swiper' ], // depende de Swiper
		$theme_version,
		true
	);
}
add_action( 'wp_enqueue_scripts', 'mauswp_enqueue_assets' );
