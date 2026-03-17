<?php
/**
 * Benefits Showcase Block — ACF field group (programmatic).
 *
 * Key convention:
 *   group_fb_benefits_showcase
 *   field_fb_benefits_showcase_<field>
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

acf_add_local_field_group( [
	'key'      => 'group_fb_benefits_showcase',
	'title'    => 'Benefits Showcase Fields',
	'fields'   => [
		[
			'key'         => 'field_fb_benefits_showcase_heading',
			'label'       => 'Heading',
			'name'        => 'heading',
			'type'        => 'textarea',
			'rows'        => 2,
			'placeholder' => 'Benefits for your event',
		],
		[
			'key'         => 'field_fb_benefits_showcase_subheading',
			'label'       => 'Subheading',
			'name'        => 'subheading',
			'type'        => 'textarea',
			'rows'        => 3,
			'placeholder' => 'We focus on the things that matter most...',
		],
		[
			'key'         => 'field_fb_benefits_showcase_body',
			'label'       => 'Body Text',
			'name'        => 'body',
			'type'        => 'textarea',
			'rows'        => 4,
			'placeholder' => 'These priorities naturally align with...',
		],
		[
			'key'      => 'field_fb_benefits_showcase_icons',
			'label'    => 'SDG Icons',
			'name'     => 'icons',
			'type'     => 'repeater',
			'min'      => 0,
			'max'      => 6,
			'sub_fields' => [
				[
					'key'           => 'field_fb_benefits_showcase_icon_image',
					'label'         => 'Icon Image',
					'name'          => 'image',
					'type'          => 'image',
					'return_format' => 'array',
					'preview_size'  => 'thumbnail',
				],
			],
		],
		[
			'key'      => 'field_fb_benefits_showcase_cards',
			'label'    => 'Feature Cards',
			'name'     => 'cards',
			'type'     => 'repeater',
			'min'      => 1,
			'sub_fields' => [
				[
					'key'           => 'field_fb_benefits_showcase_card_image',
					'label'         => 'SDG Icon Image',
					'name'          => 'image',
					'type'          => 'image',
					'return_format' => 'array',
					'preview_size'  => 'thumbnail',
					'required'      => 1,
				],
				[
					'key'         => 'field_fb_benefits_showcase_card_title',
					'label'       => 'Card Title',
					'name'        => 'title',
					'type'        => 'text',
					'required'    => 1,
					'placeholder' => 'Life on Land',
				],
				[
					'key'         => 'field_fb_benefits_showcase_card_description',
					'label'       => 'Description',
					'name'        => 'description',
					'type'        => 'textarea',
					'rows'        => 3,
					'placeholder' => 'We restore degraded landscapes...',
				],
				[
					'key'            => 'field_fb_benefits_showcase_card_check_color',
					'label'          => 'Checkmark Color',
					'name'           => 'check_color',
					'type'           => 'color_picker',
					'instructions'   => 'Optional. Sets the color of the checkmark icons in this card.',
					'default_value'  => '',
					'enable_opacity' => 0,
				],
				[
					'key'      => 'field_fb_benefits_showcase_card_benefits',
					'label'    => 'Benefits',
					'name'     => 'benefits',
					'type'     => 'repeater',
					'min'      => 1,
					'sub_fields' => [
						[
							'key'         => 'field_fb_benefits_showcase_benefit_text',
							'label'       => 'Benefit Text',
							'name'        => 'text',
							'type'        => 'textarea',
							'rows'        => 2,
							'placeholder' => 'Demonstrate a tangible, long-term environmental legacy.',
						],
					],
				],
			],
		],
	],
	'location' => [
		[
			[
				'param'    => 'block',
				'operator' => '==',
				'value'    => 'acf/benefits-showcase',
			],
		],
	],
] );
