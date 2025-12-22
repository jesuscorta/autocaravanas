<?php
/**
 * Template del bloque Hero (ACF).
 *
 * @package mauswp
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

// Campos ACF.
$title       = get_field( 'hero_title' );
$text        = get_field( 'hero_text' );
$button_text = get_field( 'hero_button_text' );
$button_url  = get_field( 'hero_button_url' );
$image       = get_field( 'hero_image' ); // campo imagen ACF (array).
$align_class = ! empty( $block['align'] ) ? 'align' . $block['align'] : '';
$block_id    = ! empty( $block['anchor'] ) ? $block['anchor'] : $block['id'];
?>

<section id="<?php echo esc_attr( $block_id ); ?>" class="<?php echo esc_attr( $align_class ); ?> min-h-[70vh] flex items-center py-12 md:py-0">
	<div class="container mx-auto grid gap-12 md:grid-cols-2 items-center px-6">

		<div class="space-y-6">
			<?php if ( $title ) : ?>
				<h2 class="text-4xl md:text-5xl font-extrabold leading-tight">
					<?php echo esc_html( $title ); ?>
				</h2>
			<?php endif; ?>

			<?php if ( $text ) : ?>
				<p class="text-lg text-slate-600 leading-relaxed">
					<?php echo esc_html( $text ); ?>
				</p>
			<?php endif; ?>

			<?php if ( $button_text && $button_url ) : ?>
				<a href="<?php echo esc_url( $button_url ); ?>"
				   class="inline-flex items-center px-6 py-3 bg-slate-900 text-white font-medium rounded-md hover:bg-slate-800 transition">
					<?php echo esc_html( $button_text ); ?>
				</a>
			<?php endif; ?>
		</div>

		<?php if ( $image ) : ?>
			<div class="flex justify-center md:justify-end">
				<?php
				echo wp_get_attachment_image(
					$image['ID'],
					'large',
					false,
					array(
						'class' => 'w-full max-w-md h-auto rounded-xl shadow-xl',
					)
				);
				?>
			</div>
		<?php endif; ?>

	</div>
</section>


