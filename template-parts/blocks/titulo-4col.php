<?php
// Campos principales
$subtitle = get_field( 'subtitle' );
$title    = get_field( 'title' );

$cards = get_field( 'cards' );
if ( ! $cards || ! is_array( $cards ) ) {
	return;
}

$cards_count        = count( $cards );
$slides_desktop_max = min( 4, $cards_count );
?>

<section class="container mx-auto py-16">
	<!-- Cabecera -->
	<?php if ( $subtitle || $title ) : ?>
		<header class="max-w-3xl mx-auto text-center mb-12">
			<?php if ( $subtitle ) : ?>
				<p class="text-sm font-semibold tracking-wide uppercase">
					<?php echo esc_html( $subtitle ); ?>
				</p>
			<?php endif; ?>

			<?php if ( $title ) : ?>
				<h2 class="mt-4 text-3xl md:text-5xl font-semibold leading-tight">
					<?php echo esc_html( $title ); ?>
				</h2>
			<?php endif; ?>
		</header>
	<?php endif; ?>

	<?php if ( have_rows( 'cards' ) ) : ?>
		<div class="swiper mySwiper">
			<div class="swiper-wrapper">
				<?php
				while ( have_rows( 'cards' ) ) :
					the_row();

					$icon       = get_sub_field( 'icon' );
					$card_title = get_sub_field( 'card_title' );
					$card_text  = get_sub_field( 'card_text' );
					$cta_text   = get_sub_field( 'cta_text' );
					$cta_url    = get_sub_field( 'cta_url' );
					?>
					<div class="swiper-slide">
						<article class="bg-slate-50 rounded-3xl shadow-md p-8 relative h-[250px] flex flex-col justify-end transition-shadow duration-300 group hover:shadow-xl">
							<div class="transition-transform duration-300 group-hover:-translate-y-6">
								<?php if ( $icon ) : ?>
									<div class="mb-6">
										<img
											src="<?php echo esc_url( $icon['url'] ); ?>"
											alt="<?php echo esc_attr( $icon['alt'] ); ?>"
											class="w-10 h-10"
										/>
									</div>
								<?php endif; ?>

								<?php if ( $card_title ) : ?>
									<h3 class="text-lg font-semibold mb-3">
										<?php echo esc_html( $card_title ); ?>
									</h3>
								<?php endif; ?>

								<?php if ( $card_text ) : ?>
									<p class="text-sm leading-relaxed text-slate-600 pb-3">
										<?php echo esc_html( $card_text ); ?>
									</p>
								<?php endif; ?>
							</div>

							<?php if ( $cta_text && $cta_url ) : ?>
								<a href="<?php echo esc_url( $cta_url ); ?>"
								   class="absolute left-8 bottom-8 inline-flex items-center gap-2 text-amber-600 font-semibold opacity-0 translate-y-2 group-hover:opacity-100 group-hover:translate-y-0 transition-all duration-300 mt-4">
									<?php echo esc_html( $cta_text ); ?>

									<svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-5 h-5">
										<path stroke-linecap="round" stroke-linejoin="round" d="M17.25 8.25L21 12m0 0l-3.75 3.75M21 12H3" />
									</svg>
								</a>
							<?php endif; ?>
						</article>
					</div>
				<?php endwhile; ?>
			</div>

			<!-- Dots -->
			<div class="swiper-pagination mt-8"></div>
		</div>
	<?php endif; ?>
</section>

<script>
document.addEventListener("DOMContentLoaded", function () {
	if (typeof Swiper === "undefined") {
		return;
	}

	var swiper = new Swiper(".mySwiper", {
		slidesPerView: 1.1,
		spaceBetween: 16,
		loop: <?php echo $cards_count > 1 ? 'true' : 'false'; ?>,
		pagination: {
			el: ".mySwiper .swiper-pagination",
			clickable: true,
		},
		breakpoints: {
			768: {
				slidesPerView: 2.5,
				spaceBetween: 24,
			},
			1024: {
				slidesPerView: <?php echo (int) $slides_desktop_max; ?>,
				spaceBetween: 24,
			},
		},
	});
});
</script>
