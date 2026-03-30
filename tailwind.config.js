/** @type {import('tailwindcss').Config} */
export default {
	content: [
		'./blocks/**/*.php',
		'./includes/**/*.php',
		'./src/**/*.js',
	],
	important: '.fb',
	theme: {
		extend: {
			fontFamily: {
				display: ['var(--fb-font-display)'],
				heading: ['var(--fb-font-heading)'],
				body: ['var(--fb-font-body)'],
			},
			fontSize: {
				/* Display — sizes & line-heights are responsive via CSS vars */
				'display-xxl': ['var(--fb-text-display-xxl)', { lineHeight: 'var(--fb-leading-display-xxl)' }],
				'display-xl': ['var(--fb-text-display-xl)', { lineHeight: 'var(--fb-leading-display-xl)' }],
				'display-lg': ['var(--fb-text-display-lg)', { lineHeight: 'var(--fb-leading-display-lg)' }],
				'display-md': ['var(--fb-text-display-md)', { lineHeight: 'var(--fb-leading-display-md)' }],
				'display-sm': ['var(--fb-text-display-sm)', { lineHeight: 'var(--fb-leading-display-sm)' }],
				'display-xs': ['var(--fb-text-display-xs)', { lineHeight: 'var(--fb-leading-display-xs)' }],
				/* Body — responsive via CSS vars */
				'body-lg': ['var(--fb-text-body-lg)', { lineHeight: 'var(--fb-leading-body-lg)' }],
				'body-md': ['var(--fb-text-body-md)', { lineHeight: 'var(--fb-leading-body-md)' }],
				'body-sm': ['var(--fb-text-body-sm)', { lineHeight: 'var(--fb-leading-body-sm)' }],
				'body-xs': ['var(--fb-text-body-xs)', { lineHeight: 'var(--fb-leading-body-xs)' }],
				/* Eyebrow — same across breakpoints */
				'eyebrow-lg': ['var(--fb-text-eyebrow-lg)', { lineHeight: '1.4' }],
				'eyebrow-md': ['var(--fb-text-eyebrow-md)', { lineHeight: '1.4' }],
				'eyebrow-sm': ['var(--fb-text-eyebrow-sm)', { lineHeight: '1.4' }],
				/* Buttons — same across breakpoints */
				'button-md': ['var(--fb-text-button-md)', { lineHeight: '1' }],
				'button-sm': ['var(--fb-text-button-sm)', { lineHeight: '1' }],
			},
			colors: {
				/* Brand */
				forest: {
					DEFAULT: 'var(--fb-color-forest)',
					80: 'var(--fb-color-forest-80)',
					60: 'var(--fb-color-forest-60)',
					5: 'var(--fb-color-forest-5)',
				},
				fire: {
					DEFAULT: 'var(--fb-color-fire)',
					80: 'var(--fb-color-fire-80)',
					60: 'var(--fb-color-fire-60)',
					40: 'var(--fb-color-fire-40)',
					20: 'var(--fb-color-fire-20)',
				},
				water: {
					DEFAULT: 'var(--fb-color-water)',
					60: 'var(--fb-color-water-60)',
				},
				air: 'var(--fb-color-air)',
				earth: {
					DEFAULT: 'var(--fb-color-earth)',
					40: 'var(--fb-color-earth-40)',
				},
				tree: {
					DEFAULT: 'var(--fb-color-tree)',
					40: 'var(--fb-color-tree-40)',
				},
				/* Grey scale */
				grey: {
					5: 'var(--fb-color-grey-5)',
					10: 'var(--fb-color-grey-10)',
					20: 'var(--fb-color-grey-20)',
					40: 'var(--fb-color-grey-40)',
					60: 'var(--fb-color-grey-60)',
					80: 'var(--fb-color-grey-80)',
					90: 'var(--fb-color-grey-90)',
				},
			},
			borderRadius: {
				'container-sm': 'var(--fb-radius-sm)',
				'container-md': 'var(--fb-radius-md)',
				'container-lg': 'var(--fb-radius-lg)',
				'container-xl': 'var(--fb-radius-xl)',
				'container-xxl': 'var(--fb-radius-xxl)',
				curve: 'var(--fb-radius-curve)',
			},
			boxShadow: {
				sm: 'var(--fb-shadow-sm)',
				card: 'var(--fb-shadow-card)',
				'card-elevated': 'var(--fb-shadow-card-elevated)',
			},
			maxWidth: {
				container: '1260px',
				'container-lg': '1376px',
				content: '1024px',
			},
		},
	},
	corePlugins: {
		preflight: false,
	},
	plugins: [],
};
