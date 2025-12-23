document.addEventListener('DOMContentLoaded', () => {
	// Swiper debe estar cargado desde el CDN
	if (typeof Swiper === 'undefined') {
		return;
	}

	const autoplayDelay = 5000;

	// Carrusel móvil genérico (si lo sigues usando en otros sitios)
	if (window.innerWidth <= 768 && document.querySelector('.mySwiper')) {
		new Swiper('.mySwiper', {
			slidesPerView: 1.2,
			spaceBetween: 20,
			pagination: {
				el: '.swiper-pagination',
				clickable: true
			}
		});
	}

	// Hero timeline slider
	const sliders = document.querySelectorAll('.js-hero-timeline-slider');
	if (!sliders.length) return;

	sliders.forEach((sliderRoot) => {
		const swiperEl = sliderRoot.querySelector('.js-hero-timeline-swiper');
		if (!swiperEl) return;

		const bulletsDesktop = Array.from(
			sliderRoot.querySelectorAll('[data-hero-bullet]')
		);
		const bulletsMobile = Array.from(
			sliderRoot.querySelectorAll('[data-hero-bullet-mobile]')
		);
		const allBullets = [...bulletsDesktop, ...bulletsMobile];

		const slideContents = Array.from(
			swiperEl.querySelectorAll('[data-hero-slide-content]')
		);

		const swiper = new Swiper(swiperEl, {
			effect: 'fade',
			fadeEffect: {
				crossFade: true
			},
			speed: 900,
			loop: false,
			slidesPerView: 1,
			autoHeight: false,
			allowTouchMove: true,
			autoplay: {
				delay: autoplayDelay,
				disableOnInteraction: false
			}
		});

		const setActiveBullet = (index) => {
			allBullets.forEach((bullet, i) => {
				if (i === index) {
					bullet.dataset.active = 'true';
					bullet.setAttribute('aria-current', 'true');
				} else {
					delete bullet.dataset.active;
					bullet.removeAttribute('aria-current');
				}
			});
		};

		const updateHeroBg = () => {
			const activeSlide = swiperEl.querySelector('.swiper-slide.swiper-slide-active');
			if (!activeSlide) return;

			const bg = activeSlide.getAttribute('data-hero-bg');
			if (bg) {
				sliderRoot.style.backgroundImage = `url(${bg})`;
			}
		};

		const animateActiveContent = () => {
			slideContents.forEach((el, i) => {
				if (i === swiper.realIndex) {
					el.classList.add('opacity-100', 'translate-y-0');
					el.classList.remove('opacity-0', 'translate-y-3');
				} else {
					el.classList.remove('opacity-100', 'translate-y-0');
					el.classList.add('opacity-0', 'translate-y-3');
				}
			});
		};

		// Estado inicial
		setActiveBullet(swiper.realIndex);
		updateHeroBg();
		animateActiveContent();

		// Cambio de slide → actualizar bullets, fondo y animación de texto
		swiper.on('slideChangeTransitionStart', () => {
			setActiveBullet(swiper.realIndex);
			updateHeroBg();
			animateActiveContent();
		});

		// Click en bullets → cambiar slide + reiniciar autoplay
		allBullets.forEach((bullet, index) => {
			bullet.addEventListener('click', () => {
				swiper.slideTo(index);
				if (swiper.autoplay) {
					swiper.autoplay.restart();
				}
			});
		});
	});
});
