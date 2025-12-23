<?php
// Whitelist de bloques permitidos
function mi_tema_allowed_blocks() {
    return [
        'acf/hero',
        'acf/banner',
        'acf/jc-two-col-media-text',
        'acf/titulo-4col',
        'acf/hero-timeline-slider',
        // Añade aquí los que vayas creando
    ];
}

// Limitar bloques en el editor
add_filter( 'allowed_block_types_all', function( $allowed_blocks, $editor_context ) {

    // Si necesitas filtrarlo por post_type, deja esto.  
    // Si no, eliminalo.
    if ( isset( $editor_context->post )
        && $editor_context->post->post_type !== 'page' ) {
        return $allowed_blocks;
    }

    return mi_tema_allowed_blocks();

}, 10, 2 );
