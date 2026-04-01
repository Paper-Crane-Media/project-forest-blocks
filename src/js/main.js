// Forest Blocks — front-end JS entry point.
import { Swiper } from 'swiper';
import { Navigation, Pagination } from 'swiper/modules';

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
 * Media Section — initialize Swiperjs slider for the gallery variant.
 */
function initMediaSectionSlider() {
	document.querySelectorAll('.media-section__swiper').forEach((swiperEl) => {
		const wrapper = swiperEl.parentElement;
		const prevBtn = wrapper.querySelector('.media-section__prev-btn');
		const nextBtn = wrapper.querySelector('.media-section__next-btn');
		const paginationEl = swiperEl.querySelector('.media-section__pagination');

		if (!prevBtn || !nextBtn) return;

		new Swiper(swiperEl, {
			modules: [Navigation, Pagination],
			loop: true,
			slidesPerView: 1,
			navigation: {
				prevEl: prevBtn,
				nextEl: nextBtn,
			},
			pagination: {
				el: paginationEl,
				clickable: true,
				bulletClass: 'media-section__dot',
				bulletActiveClass: 'media-section__dot--active',
			},
		});
	});
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
	document.querySelectorAll('.step-section').forEach((section) => {
		const cards = section.querySelectorAll('.step-section__card');
		const images = section.querySelectorAll('.step-section__image');

		if (!cards.length) return;

		// Prepare arc stroke animation: hide all arcs except the first.
		cards.forEach((card, ci) => {
			const arcPath = card.querySelector('.step-section__arc path');
			if (!arcPath) return;
			const len = arcPath.getTotalLength();
			arcPath.dataset.arcLen = len;
			gsap.set(arcPath, {
				strokeDasharray: len + 2,
				strokeDashoffset: ci === 0 ? 0 : len + 2,
			});
		});

		const setActiveStep = (index) => {
			cards.forEach((card) => {
				const text = card.querySelector('.step-section__card-text');
				const circle = card.querySelector('.step-section__circle');
				const arc = card.querySelector('.step-section__arc');
				const arcPath = arc ? arc.querySelector('path') : null;
				const number = card.querySelector('.step-section__number');
				if (!text) return;

				const activeIdx = parseInt(index, 10);
				const cardIdx = parseInt(card.dataset.stepIndex, 10);
				const isActive = cardIdx === activeIdx;
				const isPrior = cardIdx < activeIdx;

				if (isActive) {
					text.classList.remove('opacity-25');
					card.classList.add('scale-[1.01]');
					if (circle) circle.classList.remove('opacity-30');
					if (arc) arc.classList.remove('opacity-30');
					if (number) number.classList.add('scale-[1.02]');

					// Animate arc stroke drawing on.
					if (arcPath) {
						gsap.to(arcPath, {
							strokeDashoffset: 0,
							duration: 0.6,
							ease: 'power2.out',
						});
					}

					// Split-flap digit animation: slide each digit track up then reset.
					const tracks = card.querySelectorAll('.step-section__digit-track');
					tracks.forEach((track, ti) => {
						gsap.fromTo(
							track,
							{ y: 0 },
							{
								y: '-50%',
								duration: 0.35,
								delay: ti * 0.06,
								ease: 'power3.in',
								onComplete() {
									gsap.set(track, { y: 0 });
								},
							}
						);
					});
				} else if (isPrior) {
					// Prior cards: full color, arc stays drawn.
					text.classList.remove('opacity-25');
					card.classList.remove('scale-[1.01]');
					if (circle) circle.classList.remove('opacity-30');
					if (arc) arc.classList.remove('opacity-30');
					if (arcPath) gsap.set(arcPath, { strokeDashoffset: 0 });
					if (number) number.classList.remove('scale-[1.02]');
				} else {
					// Below active: faded out, arc hidden.
					if (!text.classList.contains('opacity-25')) text.classList.add('opacity-25');
					card.classList.remove('scale-[1.01]');
					if (circle && !circle.classList.contains('opacity-30')) circle.classList.add('opacity-30');
					if (arc && !arc.classList.contains('opacity-30')) arc.classList.add('opacity-30');
					if (arcPath) {
						const len = parseFloat(arcPath.dataset.arcLen) || 0;
						gsap.set(arcPath, { strokeDashoffset: len + 2 });
					}
					if (number) number.classList.remove('scale-[1.02]');
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
				invalidateOnRefresh: true,
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
						const offset = Math.max(3, Math.round(-rect.top * 0.15) + 3);
						trees.style.transform = `translateY(${offset}px)`;
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
					const offset = Math.max(0, -rect.top);
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
 * Video Block — parallax scroll on geo-wave banner layers.
 * Each wave layer scrolls at a different speed based on data-parallax-speed.
 * Closer layers (higher z-index) have higher speeds for depth effect.
 */
function initVideoBlockParallax() {
	document.querySelectorAll('.video-block').forEach((block) => {
		const geo = block.querySelector('.video-block__geo');
		if (!geo) return;

		const layers = geo.querySelectorAll('[data-parallax-speed]');
		if (!layers.length) return;

		let ticking = false;

		const onScroll = () => {
			if (ticking) return;
			ticking = true;
			requestAnimationFrame(() => {
				const rect = block.getBoundingClientRect();
				if (rect.top < window.innerHeight && rect.bottom > 0) {
					const offset = Math.max(0, -rect.top);
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
	document.querySelectorAll('[data-stagger="true"]').forEach((container) => {
		const delay = computeStaggerDelay(container);
		const children = container.children;
		const isEarly = container.hasAttribute('data-stagger-early');

		// If the element is already above the viewport (user loaded mid-page),
		// show it immediately — don't hide then animate something already passed.
		const rect = container.getBoundingClientRect();
		if (rect.bottom < 0) {
			return; // Already scrolled past — leave visible.
		}

		gsap.set(children, { opacity: 0, y: 50 });

		const tl = gsap.timeline({
			delay,
			scrollTrigger: {
				trigger: container,
				start: isEarly ? 'top bottom' : 'top bottom-=100',
				toggleActions: 'play none none none',
				once: true,
				invalidateOnRefresh: true,
			},
		});

		tl.to(children, {
			opacity: 1,
			y: 0,
			duration: 0.5,
			stagger: 0.1,
		});
	});
}

/**
 * Metrics & Gallery — GSAP ScrollTrigger countup animation.
 * Parses data attributes on each .metrics-gallery__number element and animates
 * from 0 to the target value when the metrics section scrolls into view.
 */
function initMetricsCountUp() {
	document.querySelectorAll('.metrics-gallery__number, .figures-section__number').forEach((el) => {
		const endValue = parseInt(el.dataset.countTo, 10) || 0;
		const prefix = el.dataset.countPrefix || '';
		const suffix = el.dataset.countSuffix || '';
		const useCommas = el.dataset.countCommas === 'true';

		const formatNumber = (n) => {
			const rounded = Math.round(n);
			if (!useCommas) return rounded.toString();
			return rounded.toLocaleString('en-US');
		};

		// Already scrolled past — show final value immediately.
		if (el.getBoundingClientRect().bottom < 0) {
			el.textContent = prefix + formatNumber(endValue) + suffix;
			return;
		}

		const obj = { val: 0 };

		gsap.to(obj, {
			val: endValue,
			duration: 2,
			ease: 'power2.out',
			scrollTrigger: {
				trigger: el,
				start: 'top bottom-=100',
				toggleActions: 'play none none none',
				once: true,
				invalidateOnRefresh: true,
			},
			onUpdate() {
				el.textContent = prefix + formatNumber(obj.val) + suffix;
			},
		});
	});
}

/**
 * Tree Growth Animation — draws SVG tree paths on scroll using stroke-dashoffset.
 * Supports four tree types: simple, pine, round, triangle.
 * Each wrapper uses data-tree-grow="<type>" and optional data-tree-delay="<seconds>".
 */
function initTreeGrowth() {
	// Helper: hide a path by setting dashoffset to its full length.
	// Use negative offset to reverse the draw direction (draw from end → start).
	const hidePath = (p, reverse) => {
		const len = p.getTotalLength();
		const off = reverse ? -(len + 2) : len + 2;
		gsap.set(p, { strokeDasharray: len + 2, strokeDashoffset: off });
	};

	// Helper: tween a path's stroke to fully visible.
	const draw = (tl, p, dur, ease, pos) => {
		tl.to(p, { strokeDashoffset: 0, duration: dur, ease }, pos);
	};

	document.querySelectorAll('[data-tree-grow]').forEach((wrapper) => {
		const svg = wrapper.querySelector('svg');
		if (!svg) return;

		const paths = svg.querySelectorAll('path');
		const type = wrapper.dataset.treeGrow;
		const delay = parseFloat(wrapper.dataset.treeDelay) || 0;

		// Already scrolled past — show tree fully drawn.
		const triggerEl = wrapper.closest('[data-tree-grow-group]') || wrapper;
		if (triggerEl.getBoundingClientRect().bottom < 0) {
			paths.forEach((p) => {
				const len = p.getTotalLength();
				gsap.set(p, { strokeDasharray: len + 2, strokeDashoffset: 0 });
			});
			return;
		}

		// Hide all paths up front (pine trunk is reversed — draws bottom → top).
		if (type === 'pine' && paths.length >= 9) {
			hidePath(paths[0], true);
			for (let i = 1; i < paths.length; i++) hidePath(paths[i]);
		} else {
			paths.forEach((p) => hidePath(p));
		}

		const trigger = wrapper.closest('[data-tree-grow-group]') || wrapper;

		const tl = gsap.timeline({
			delay,
			scrollTrigger: {
				trigger,
				start: 'top 97%',
				toggleActions: 'play none none none',
				once: true,
			},
		});

		if (type === 'simple' && paths.length >= 5) {
			// Paths: 0=trunk, 1=branch-low-L, 2=branch-high-L, 3=branch-R, 4=canopy
			draw(tl, paths[0], 0.7, 'power2.out');
			draw(tl, paths[1], 0.35, 'power2.out', '-=0.15');
			draw(tl, paths[3], 0.35, 'power2.out', '-=0.2');
			draw(tl, paths[2], 0.35, 'power2.out', '-=0.2');
			draw(tl, paths[4], 0.9, 'power3.out', '-=0.1');

		} else if (type === 'pine' && paths.length >= 9) {
			// Paths: 0=trunk(top→bottom, reversed), 1-2=top pair(y16),
			//        3-4=mid-low(y78), 5-6=mid-high(y47), 7-8=bottom(y109)
			// Trunk draws bottom → top, then branch pairs bottom → top.
			draw(tl, paths[0], 0.8, 'power2.out');
			draw(tl, [paths[7], paths[8]], 0.35, 'power2.out', '-=0.2');
			draw(tl, [paths[3], paths[4]], 0.35, 'power2.out', '-=0.2');
			draw(tl, [paths[5], paths[6]], 0.35, 'power2.out', '-=0.2');
			draw(tl, [paths[1], paths[2]], 0.35, 'power2.out', '-=0.2');

		} else if (type === 'round' && paths.length >= 6) {
			// Paths: 0=canopy(circle), 1=trunk, 2-3=lower branches, 4-5=upper branches
			draw(tl, paths[1], 0.7, 'power2.out');
			draw(tl, [paths[2], paths[3]], 0.35, 'power2.out', '-=0.15');
			draw(tl, [paths[4], paths[5]], 0.35, 'power2.out', '-=0.2');
			draw(tl, paths[0], 0.9, 'power3.out', '-=0.1');

		} else if (type === 'triangle' && paths.length >= 5) {
			// Paths: 0=trunk, 1=triangle canopy, 2=branch-low-L, 3=branch-high-L, 4=branch-R
			draw(tl, paths[0], 0.7, 'power2.out');
			draw(tl, paths[2], 0.35, 'power2.out', '-=0.15');
			draw(tl, paths[4], 0.35, 'power2.out', '-=0.2');
			draw(tl, paths[3], 0.35, 'power2.out', '-=0.2');
			draw(tl, paths[1], 0.9, 'power3.out', '-=0.1');

		} else if (type === 'leaf' && paths.length >= 7) {
			// Paths: 0=stem, 1=left leaf half, 2=right leaf half,
			//        3-4=lower branch pair, 5-6=upper branch pair
			draw(tl, paths[0], 0.7, 'power2.out');
			draw(tl, [paths[3], paths[4]], 0.3, 'power2.out', '-=0.15');
			draw(tl, [paths[5], paths[6]], 0.3, 'power2.out', '-=0.2');
			draw(tl, [paths[1], paths[2]], 0.8, 'power3.out', '-=0.1');
		}
	});
}

/**
 * Accordion Section — toggle panels with full WCAG 2.1 keyboard + ARIA support.
 */
function initAccordions() {
	document.querySelectorAll('.accordion-section__trigger').forEach((trigger) => {
		trigger.addEventListener('click', () => {
			const expanded = trigger.getAttribute('aria-expanded') === 'true';
			const panel = document.getElementById(trigger.getAttribute('aria-controls'));
			if (!panel) return;

			trigger.setAttribute('aria-expanded', String(!expanded));

			const iconPlus = trigger.querySelector('.accordion-section__icon-plus');
			const iconMinus = trigger.querySelector('.accordion-section__icon-minus');

			if (expanded) {
				panel.hidden = true;
				if (iconPlus) iconPlus.classList.remove('hidden');
				if (iconMinus) iconMinus.classList.add('hidden');
			} else {
				panel.hidden = false;
				if (iconPlus) iconPlus.classList.add('hidden');
				if (iconMinus) iconMinus.classList.remove('hidden');
			}
		});
	});
}

/**
 * Initialization — runs non-GSAP code on DOMContentLoaded and GSAP code on load,
 * with fallbacks if those events have already fired.
 */
function initDOM() {
	initHeroCardCycle();
	initFancybox();
	initMediaSectionSlider();
	initMetricsGallerySlider();
	initAccordions();
	initCtaFormParallax();
	initVideoBlockParallax();
}

function initGSAP() {
	if (typeof gsap === 'undefined' || typeof ScrollTrigger === 'undefined') return;

	gsap.registerPlugin(ScrollTrigger);

	// Defer GSAP init by one frame so the browser has a
	// fully-settled layout (images, fonts, lazy elements).
	// This prevents ScrollTrigger from calculating trigger
	// positions against a partially-rendered page when the
	// user loads mid-scroll.
	requestAnimationFrame(() => {
		requestAnimationFrame(() => {
			initStaggerAnimations();
			initStepSectionScroll();
			initMetricsCountUp();
			initTreeGrowth();

			// Recalculate all trigger positions now that
			// every animation has been registered.
			ScrollTrigger.refresh();
		});
	});

	// Keep ScrollTrigger positions accurate after layout shifts.
	let resizeTimer;
	const refresh = () => {
		clearTimeout(resizeTimer);
		resizeTimer = setTimeout(() => ScrollTrigger.refresh(), 200);
	};
	window.addEventListener('resize', refresh);
	window.addEventListener('orientationchange', refresh);
}

// DOM-dependent inits (no GSAP needed).
if (document.readyState === 'loading') {
	document.addEventListener('DOMContentLoaded', initDOM);
} else {
	initDOM();
}

// GSAP-dependent inits (need images/fonts settled for accurate trigger positions).
if (document.readyState === 'complete') {
	initGSAP();
} else {
	window.addEventListener('load', initGSAP);
}
