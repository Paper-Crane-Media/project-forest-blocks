// Forest Blocks — front-end JS entry point.
import { Swiper } from 'swiper';
import { Navigation } from 'swiper/modules';

/**
 * Hero Header — cycle the "active" highlight through feature cards.
 * Desktop only: one card highlights at a time with a smooth transition,
 * looping infinitely from top → bottom → top.
 */
function initHeroCardCycle() {
	const mq = window.matchMedia('(min-width: 1024px)');
	if (!mq.matches) return;

	document.querySelectorAll('.hero-header__cards').forEach((container) => {
		const cards = container.querySelectorAll('.hero-header__card');
		if (cards.length < 2) return;

		let current = 0;
		const DWELL = 3000; // ms each card stays highlighted

		// Activate first card immediately.
		cards[current].classList.add('hero-header__card--active');

		setInterval(() => {
			cards[current].classList.remove('hero-header__card--active');
			current = (current + 1) % cards.length;
			cards[current].classList.add('hero-header__card--active');
		}, DWELL);
	});
}

/**
 * Video Block — bind Fancybox to [data-fancybox] elements for YouTube lightbox.
 */
function initFancybox() {
	if (window.Fancybox) {
		window.Fancybox.bind('[data-fancybox]');
	}
}

/**
 * Metrics & Gallery — initialize Swiperjs carousels with navigation buttons.
 */
function initMetricsGallerySlider() {
	document.querySelectorAll('.metrics-gallery__swiper').forEach((swiperEl) => {
		const prevBtn = swiperEl.parentElement.querySelector('.metrics-gallery__prev-btn');
		const nextBtn = swiperEl.parentElement.querySelector('.metrics-gallery__next-btn');

		if (!prevBtn || !nextBtn) return;

		new Swiper(swiperEl, {
			modules: [Navigation],
			loop: true,
			slidesPerView: 1,
			navigation: {
				prevEl: prevBtn,
				nextEl: nextBtn,
			},
		});
	});
}

/**
 * Step Section — GSAP ScrollTrigger: swap the left image and highlight the active
 * step card as each card crosses the viewport midpoint on desktop.
 */
function initStepSectionScroll() {
	if (typeof gsap === 'undefined' || typeof ScrollTrigger === 'undefined') return;

	gsap.registerPlugin(ScrollTrigger);

	document.querySelectorAll('.step-section').forEach((section) => {
		const cards = section.querySelectorAll('.step-section__card');
		const images = section.querySelectorAll('.step-section__image');

		if (!cards.length) return;

		const setActiveStep = (index) => {
			cards.forEach((card) => {
				const text = card.querySelector('.step-section__card-text');
				if (!text) return;

				if (card.dataset.stepIndex === index) {
					text.classList.remove('opacity-25');
				} else if (!text.classList.contains('opacity-25')) {
					text.classList.add('opacity-25');
				}
			});

			images.forEach((img) => {
				if (img.dataset.stepIndex === index) {
					img.classList.remove('opacity-0');
					img.classList.add('opacity-100');
				} else {
					img.classList.remove('opacity-100');
					img.classList.add('opacity-0');
				}
			});
		};

		// Create a ScrollTrigger for each card — activates when the card hits
		// the vertical center of the viewport, deactivates when it scrolls past.
		cards.forEach((card) => {
			ScrollTrigger.create({
				trigger: card,
				start: 'top center',
				end: 'bottom center',
				onToggle: (self) => {
					if (self.isActive) {
						setActiveStep(card.dataset.stepIndex);
					}
				},
			});
		});

		// Parallax effect on tree header.
		const trees = section.querySelector('.step-section__trees');
		if (trees) {
			let ticking = false;
			const onScroll = () => {
				if (ticking) return;
				ticking = true;
				requestAnimationFrame(() => {
					const rect = section.getBoundingClientRect();
					if (rect.top < window.innerHeight && rect.bottom > 0) {
						trees.style.transform = `translateY(${Math.round(-rect.top * 0.15)}px)`;
					}
					ticking = false;
				});
			};
			window.addEventListener('scroll', onScroll, { passive: true });
		}
	});
}

/**
 * CTA Form — parallax scroll on geo-wave banner layers.
 * Each wave layer scrolls at a different speed based on data-parallax-speed.
 */
function initCtaFormParallax() {
	document.querySelectorAll('.cta-form').forEach((section) => {
		const geo = section.querySelector('.cta-form__geo');
		if (!geo) return;

		const layers = geo.querySelectorAll('[data-parallax-speed]');
		if (!layers.length) return;

		let ticking = false;

		const onScroll = () => {
			if (ticking) return;
			ticking = true;
			requestAnimationFrame(() => {
				const rect = section.getBoundingClientRect();
				if (rect.top < window.innerHeight && rect.bottom > 0) {
					const offset = -rect.top;
					layers.forEach((layer) => {
						const speed = parseFloat(layer.dataset.parallaxSpeed) || 0;
						layer.style.transform = `translateY(${Math.round(offset * speed)}px)`;
					});
				}
				ticking = false;
			});
		};

		window.addEventListener('scroll', onScroll, { passive: true });
	});
}

/**
 * GSAP stagger animations — reveal [data-stagger="true"] containers on scroll.
 * Each container staggers its children with a cumulative delay based on sibling count.
 */
function computeStaggerDelay(element) {
	let delay = 0;
	const parent = element.parentElement;
	if (parent && parent.hasAttribute('data-stagger')) {
		delay += 0.2;
	}
	let sibling = element.previousElementSibling;
	while (sibling) {
		if (sibling.hasAttribute('data-stagger')) {
			delay += 0.2;
		}
		sibling = sibling.previousElementSibling;
	}
	return delay;
}

function initStaggerAnimations() {
	if (typeof gsap === 'undefined' || typeof ScrollTrigger === 'undefined') return;

	gsap.registerPlugin(ScrollTrigger);

	document.querySelectorAll('[data-stagger="true"]').forEach((container) => {
		const delay = computeStaggerDelay(container);
		const children = container.children;
		const tl = gsap.timeline({
			delay,
			scrollTrigger: {
				trigger: container,
				start: 'top bottom-=100',
				end: 'bottom top+=100',
				toggleActions: 'play none none reverse',
			},
		});

		gsap.set(children, { opacity: 0, y: 50 });

		tl.to(children, {
			opacity: 1,
			y: 0,
			duration: 0.5,
			stagger: 0.1,
		});
	});
}

document.addEventListener('DOMContentLoaded', () => {
	initHeroCardCycle();
	initFancybox();
	initMetricsGallerySlider();
	initCtaFormParallax();
});

window.addEventListener('load', () => {
	initStaggerAnimations();
	initStepSectionScroll();
});
