<?php

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Configuración básica del tema.
 */
function mauswp_setup() {
	// <title> automático en el head.
	add_theme_support( 'title-tag' );

	// Imágenes destacadas.
	add_theme_support( 'post-thumbnails' );

	// Menú principal.
	register_nav_menus(
		array(
			'primary' => __( 'Menú principal', 'mauswp' ),
		)
	);

	// Logo personalizado.
	add_theme_support(
		'custom-logo',
		array(
			'height'      => 80,
			'width'       => 240,
			'flex-height' => true,
			'flex-width'  => true,
		)
	);

	// Soporte HTML5.
	add_theme_support(
		'html5',
		array(
			'search-form',
			'comment-form',
			'comment-list',
			'gallery',
			'caption',
			'style',
			'script',
		)
	);
}
add_action( 'after_setup_theme', 'mauswp_setup' );
