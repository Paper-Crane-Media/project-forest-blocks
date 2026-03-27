<?php
/**
 * Hero Header Block — ACF field group (programmatic).
 *
 * Key convention:
 *   group_fb_hero_header
 *   field_fb_hero_header_<field>
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

acf_add_local_field_group( [
	'key'      => 'group_fb_hero_header',
	'title'    => 'Hero Header Fields',
	'fields'   => [
		[
			'key'           => 'field_fb_hero_header_variant',
			'label'         => 'Variant',
			'name'          => 'variant',
			'type'          => 'select',
			'choices'       => [
				'default'   => 'Default',
				'secondary' => 'Secondary',
			],
			'default_value' => 'default',
			'instructions'  => 'Default: full-width background image with feature cards. Secondary: white background, content left / image right.',
		],
		[
			'key'          => 'field_fb_hero_header_background_image',
			'label'        => 'Background Image',
			'name'         => 'background_image',
			'type'         => 'image',
			'return_format' => 'array',
			'preview_size' => 'large',
			'instructions' => 'Default: full-width hero background (min 1920×1080). Secondary: right-side image (min 636×636).',
		],
		[
			'key'               => 'field_fb_hero_header_eyebrow',
			'label'             => 'Eyebrow',
			'name'              => 'eyebrow',
			'type'              => 'text',
			'placeholder'       => 'Leadership',
			'conditional_logic' => [
				[
					[
						'field'    => 'field_fb_hero_header_variant',
						'operator' => '==',
						'value'    => 'secondary',
					],
				],
			],
		],
		[
			'key'          => 'field_fb_hero_header_heading',
			'label'        => 'Heading',
			'name'         => 'heading',
			'type'         => 'text',
			'placeholder'  => 'Connect your event to nature.',
		],
		[
			'key'          => 'field_fb_hero_header_feature_cards',
			'label'        => 'Feature Cards',
			'name'         => 'feature_cards',
			'type'         => 'repeater',
			'min'          => 1,
			'max'          => 6,
			'layout'       => 'block',
			'button_label' => 'Add Card',
			'conditional_logic' => [
				[
					[
						'field'    => 'field_fb_hero_header_variant',
						'operator' => '==',
						'value'    => 'default',
					],
				],
			],
			'sub_fields'   => [
				[
					'key'   => 'field_fb_hero_header_card_title',
					'label' => 'Title',
					'name'  => 'title',
					'type'  => 'text',
				],
				[
					'key'   => 'field_fb_hero_header_card_description',
					'label' => 'Description',
					'name'  => 'description',
					'type'  => 'text',
				],
			],
		],
		[
			'key'               => 'field_fb_hero_header_subheading',
			'label'             => 'Subheading',
			'name'              => 'subheading',
			'type'              => 'text',
			'placeholder'       => 'Offset your event\'s footprint by dazzling your attendees with a tree planting event.',
			'conditional_logic' => [
				[
					[
						'field'    => 'field_fb_hero_header_variant',
						'operator' => '==',
						'value'    => 'default',
					],
				],
			],
		],
		[
			'key'               => 'field_fb_hero_header_secondary_subheading',
			'label'             => 'Subheading',
			'name'              => 'secondary_subheading',
			'type'              => 'wysiwyg',
			'tabs'              => 'all',
			'toolbar'           => 'basic',
			'media_upload'      => 0,
			'instructions'      => 'Supports bold for emphasis (e.g. a person\'s name).',
			'conditional_logic' => [
				[
					[
						'field'    => 'field_fb_hero_header_variant',
						'operator' => '==',
						'value'    => 'secondary',
					],
				],
			],
		],
		[
			'key'               => 'field_fb_hero_header_body',
			'label'             => 'Body',
			'name'              => 'body',
			'type'              => 'textarea',
			'rows'              => 3,
			'conditional_logic' => [
				[
					[
						'field'    => 'field_fb_hero_header_variant',
						'operator' => '==',
						'value'    => 'secondary',
					],
				],
			],
		],
		[
			'key'           => 'field_fb_hero_header_cta',
			'label'         => 'Call to Action',
			'name'          => 'cta',
			'type'          => 'link',
			'return_format' => 'array',
		],
	],
	'location' => [
		[
			[
				'param'    => 'block',
				'operator' => '==',
				'value'    => 'acf/hero-header',
			],
		],
	],
] );
