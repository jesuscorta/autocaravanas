<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

$slides = get_field( 'slides' );

if ( ! $slides || ! is_array( $slides ) ) {
	return;
}

$block_id    = ! empty( $block['anchor'] ) ? $block['anchor'] : 'hero-timeline-slider-' . $block['id'];
$block_class = 'hero-timeline-slider';

// Fondo inicial: imagen del primer slide
$first_bg_url = '';
if ( ! empty( $slides[0]['bg_image'] ) ) {
	$first_bg_url = wp_get_attachment_image_url( $slides[0]['bg_image'], 'full' );
}

$card_bg_attr = $first_bg_url
	? ' style="background-image: url(' . esc_url( $first_bg_url ) . ');"'
	: '';
?>

<section id="<?php echo esc_attr( $block_id ); ?>" class="py-10 md:py-16 <?php echo esc_attr( $block_class ); ?>">
	<div class="container mx-auto px-4">
		<div
			class="js-hero-timeline-slider relative rounded-[28px] overflow-hidden text-white bg-slate-900 bg-cover bg-center bg-no-repeat"
			<?php echo $card_bg_attr; ?>
		>
			<!-- Overlay oscuro sobre toda la tarjeta -->
			<div class="pointer-events-none absolute inset-0 bg-slate-950/70"></div>

			<!-- Contenido -->
			<div class="relative z-10 grid grid-cols-1 md:grid-cols-[90px_minmax(0,1fr)]">
				<!-- Timeline escritorio -->
				<aside class="relative hidden md:flex items-stretch py-10 pl-6 pr-4">
					<div class="relative mx-auto flex h-full flex-col items-center justify-between">
						<span class="pointer-events-none absolute inset-y-0 left-1/2 w-px -translate-x-1/2 bg-white/25"></span>

						<?php foreach ( $slides as $index => $slide ) : ?>
							<button
								type="button"
								class="relative z-10 flex h-3 w-3 items-center justify-center rounded-full border border-white/60 bg-transparent transition-all duration-300 ease-out data-[active=true]:h-3.5 data-[active=true]:w-3.5 data-[active=true]:border-white data-[active=true]:bg-white data-[active=true]:shadow-[0_0_0_6px_rgba(255,255,255,0.18)]"
								data-hero-bullet
								data-index="<?php echo esc_attr( $index ); ?>"
								<?php echo 0 === $index ? 'data-active="true" aria-current="true"' : ''; ?>
							>
								<span class="sr-only">
									<?php
									printf(
										/* translators: %d slide number */
										esc_html__( 'Ir a la diapositiva %d', 'mauswp' ),
										(int) $index + 1
									);
									?>
								</span>
							</button>
						<?php endforeach; ?>
					</div>
				</aside>

				<!-- Slider texto -->
				<div class="relative">
					<div class="swiper js-hero-timeline-swiper h-full">
						<div class="swiper-wrapper">
							<?php foreach ( $slides as $slide ) :
								$bg_image_id = $slide['bg_image'] ?? null;
								$text        = $slide['text'] ?? '';

								$bg_url = $bg_image_id
									? wp_get_attachment_image_url( $bg_image_id, 'full' )
									: '';
								?>
								<div
									class="swiper-slide min-h-[220px] sm:min-h-[260px] md:min-h-[320px] lg:min-h-[360px]"
									<?php echo $bg_url ? ' data-hero-bg="' . esc_url( $bg_url ) . '"' : ''; ?>
								>
									<div class="flex h-full items-center justify-center px-6 md:px-16 py-10">
										<div
											class="hero-slide-content w-full max-w-full md:max-w-3xl text-left sm:text-center opacity-0 translate-y-3 transition-all duration-500 ease-out"
											data-hero-slide-content
										>
											<?php if ( $text ) : ?>
												<p class="text-sm sm:text-base md:text-xl lg:text-2xl font-medium leading-relaxed">
													<?php echo wp_kses_post( $text ); ?>
												</p>
											<?php endif; ?>
										</div>
									</div>
								</div>
							<?php endforeach; ?>
						</div>
					</div>

					<!-- Dots móviles horizontales -->
					<div class="flex md:hidden relative z-20 items-center justify-center gap-3 pb-5 pt-3">

						<?php foreach ( $slides as $index => $slide ) : ?>
							<button
								type="button"
								class="h-2 w-2 rounded-full border border-white/60 bg-transparent transition-all duration-300 ease-out data-[active=true]:h-2.5 data-[active=true]:w-2.5 data-[active=true]:border-white data-[active=true]:bg-white data-[active=true]:shadow-[0_0_0_4px_rgba(255,255,255,0.18)]"
								data-hero-bullet-mobile
								data-index="<?php echo esc_attr( $index ); ?>"
								<?php echo 0 === $index ? 'data-active="true" aria-current="true"' : ''; ?>
							>
								<span class="sr-only">
									<?php
									printf(
										esc_html__( 'Ir a la diapositiva %d', 'mauswp' ),
										(int) $index + 1
									);
									?>
								</span>
							</button>
						<?php endforeach; ?>
					</div>
				</div><!-- /Slider -->
			</div>
		</div>
	</div>
</section>
