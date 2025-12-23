<?php
/**
 * Bloque: Imagen + Texto
 */

$image          = get_field('image');
$heading        = get_field('heading');
$heading_level  = get_field('heading_level') ?: 'h2';
$content        = get_field('content');
$cta_label      = get_field('cta_label');
$cta_url        = get_field('cta_url');

$order_desktop  = get_field('order_desktop'); // image-left | image-right
$order_mobile   = get_field('order_mobile');  // image-first | text-first

$mobile_order_class = $order_mobile === 'text-first'
    ? 'flex-col-reverse'
    : 'flex-col';

$desktop_order_class = $order_desktop === 'image-right'
    ? 'lg:flex-row-reverse'
    : 'lg:flex-row';

$wrapper_classes = implode(' ', [
    // Ojo: sin "container"
    'mx-auto',
    'flex',
    $mobile_order_class,
    $desktop_order_class,
    'items-stretch',
    'gap-10 lg:gap-16',
    'py-16',
]);
?>

<section class="<?php echo esc_attr($wrapper_classes); ?>">
    <?php if ( $image ) : ?>
        <?php $image_id = is_array( $image ) ? $image['ID'] : (int) $image; ?>
        <div class="w-full lg:w-7/12">
            <figure class="h-full">
                <?php
                echo wp_get_attachment_image(
                    $image_id,
                    'full',
                    false,
                    [
                        'class'   => 'h-full w-full object-cover',
                        'loading' => 'lazy',
                    ]
                );
                ?>
            </figure>
        </div>
    <?php endif; ?>

    <div class="w-full lg:w-5/12 flex items-center">
        <!-- Simulamos el "container" solo para el texto -->
        <div class="w-full max-w-xl ml-auto px-6 lg:px-12">
            <?php if ( $heading ) : ?>
                <<?php echo esc_attr($heading_level); ?>
                    class="text-slate-900 text-2xl md:text-3xl font-semibold leading-tight">
                    <?php echo esc_html($heading); ?>
                </<?php echo esc_attr($heading_level); ?>>
            <?php endif; ?>

            <?php if ( $content ) : ?>
                <div class="mt-4 space-y-4 text-slate-600">
                    <?php echo wp_kses_post($content); ?>
                </div>
            <?php endif; ?>

            <?php if ( $cta_label && $cta_url ) : ?>
                <div class="mt-8">
                    <a href="<?php echo esc_url($cta_url); ?>"
                       class="inline-flex items-center rounded-full border border-amber-400 bg-white px-6 py-3 text-sm font-semibold text-slate-900 shadow-sm hover:bg-amber-50 focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-amber-400 focus-visible:ring-offset-2">
                        <?php echo esc_html($cta_label); ?>
                    </a>
                </div>
            <?php endif; ?>
        </div>
    </div>
</section>
