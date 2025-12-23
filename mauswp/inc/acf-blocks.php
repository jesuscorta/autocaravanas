<?php

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Registro de bloques ACF del tema.
 */
function mauswp_register_acf_blocks() {

	// ACF no disponible, salir.
	if ( ! function_exists( 'acf_register_block_type' ) ) {
		return;
	}

	// Bloque: Hero básico.
	acf_register_block_type(
		array(
			'name'            => 'hero',
			'title'           => __( 'Hero', 'mauswp' ),
			'description'     => __( 'Bloque de hero con título, texto, botón e imagen.', 'mauswp' ),
			'render_template' => get_template_directory() . '/template-parts/blocks/hero.php',
			'category'        => 'home',
			'icon'            => 'align-full-width',
			'keywords'        => array( 'hero', 'cabecera', 'portada' ),
			'mode'            => 'edit',
			'supports'        => array(
				'align'  => array( 'wide', 'full' ),
				'anchor' => true,
			),
		)
	);

	// Bloque: Dos columnas imagen + texto.
	acf_register_block_type(
		array(
			'name'            => 'jc-two-col-media-text',
			'title'           => __( 'Dos columnas: imagen + texto', 'mauswp' ),
			'description'     => __( 'Bloque de dos columnas con imagen, texto y CTA', 'mauswp' ),
			'render_template' => get_template_directory() . '/template-parts/blocks/two-col-media-text.php',
			'category'        => 'home',
			'icon'            => 'columns',
			'mode'            => 'preview',
			'supports'        => array(
				'align'  => false,
				'anchor' => true,
			),
			'enqueue_assets'  => function () {
				// Hook para assets específicos del bloque si hace falta.
			},
		)
	);

	// Bloque: Banner.
	acf_register_block_type(
		array(
			'name'            => 'banner',
			'title'           => __( 'Banner', 'mauswp' ),
			'description'     => __( 'Banner con fondo, texto, CTA y lista de items.', 'mauswp' ),
			'render_template' => get_template_directory() . '/template-parts/blocks/banner.php',
			'category'        => 'contacto',
			'icon'            => 'slides',
			'keywords'        => array( 'banner', 'cta', 'info' ),
			'mode'            => 'edit',
			'supports'        => array(
				'anchor' => true,
			),
		)
	);

	acf_register_block_type( [
	'name'            => 'hero-timeline-slider',
	'title'           => __( 'Hero – Slider timeline', 'mauswp' ),
	'description'     => __( 'Hero con slider y timeline lateral', 'mauswp' ),
	'render_template' => get_template_directory() . '/template-parts/blocks/hero-timeline-slider.php',
	'category'        => 'home',
	'icon'            => 'slides',
	'mode'            => 'edit',
	'supports'        => [
		'align'  => [ 'wide', 'full' ],
		'anchor' => true,
	],
] );


	// Bloque: subtitulo + titulo + 4 columnas cards.
	acf_register_block_type(
		array(
			'name'            => 'titulo-4col',
			'title'           => __( '4 cards con título y subtítulo', 'mauswp' ),
			'description'     => __( '4 cards (icono + título + texto) con título y subtítulo', 'mauswp' ),
			'render_template' => get_template_directory() . '/template-parts/blocks/titulo-4col.php',
			'category'        => 'home',
			'icon'            => 'columns',
			'mode'            => 'preview',
			'supports'        => array(
				'align'  => false,
				'anchor' => true,
			),
			'enqueue_assets'  => function () {
				// Hook para assets específicos del bloque si hace falta.
			},
		)
	);
}

add_action( 'acf/init', 'mauswp_register_acf_blocks' );
