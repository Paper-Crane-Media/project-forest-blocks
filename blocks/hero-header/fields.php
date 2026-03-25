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
			'key'          => 'field_fb_hero_header_background_image',
			'label'        => 'Background Image',
			'name'         => 'background_image',
			'type'         => 'image',
			'return_format' => 'array',
			'preview_size' => 'large',
			'instructions' => 'Full-width hero background image. Recommended minimum 1920×1080.',
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
			'key'          => 'field_fb_hero_header_subheading',
			'label'        => 'Subheading',
			'name'         => 'subheading',
			'type'         => 'text',
			'placeholder'  => 'Offset your event\'s footprint by dazzling your attendees with a tree planting event.',
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
