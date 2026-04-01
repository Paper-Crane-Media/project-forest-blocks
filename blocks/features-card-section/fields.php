<?php
/**
 * Features Card Section — ACF field group (programmatic).
 *
 * Key convention:
 *   group_fb_features_card_section
 *   field_fb_features_card_section_<field>
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

acf_add_local_field_group( [
	'key'      => 'group_fb_features_card_section',
	'title'    => 'Features Card Section Fields',
	'fields'   => [
		[
			'key'         => 'field_fb_features_card_section_heading',
			'label'       => 'Heading',
			'name'        => 'heading',
			'type'        => 'text',
			'placeholder' => 'Become a Partner',
		],
		[
			'key'         => 'field_fb_features_card_section_subheading',
			'label'       => 'Subheading',
			'name'        => 'subheading',
			'type'        => 'text',
			'placeholder' => 'None of our forests would have been planted without the support of our dedicated partners.',
		],
		[
			'key'          => 'field_fb_features_card_section_content',
			'label'        => 'Content',
			'name'         => 'content',
			'type'         => 'wysiwyg',
			'tabs'         => 'all',
			'toolbar'      => 'basic',
			'media_upload' => 0,
		],
		[
			'key'         => 'field_fb_features_card_section_card_area_heading',
			'label'       => 'Card Area Heading',
			'name'        => 'card_area_heading',
			'type'        => 'text',
			'placeholder' => 'Why Partner With Us',
		],
		[
			'key'          => 'field_fb_features_card_section_cards',
			'label'        => 'Feature Cards',
			'name'         => 'cards',
			'type'         => 'repeater',
			'layout'       => 'block',
			'button_label' => 'Add Feature Card',
			'min'          => 0,
			'max'          => 0,
			'sub_fields'   => [
				[
					'key'         => 'field_fb_features_card_section_card_heading',
					'label'       => 'Heading',
					'name'        => 'heading',
					'type'        => 'text',
					'placeholder' => 'Team Building',
				],
				[
					'key'         => 'field_fb_features_card_section_card_content',
					'label'       => 'Content',
					'name'        => 'content',
					'type'        => 'textarea',
					'rows'        => 3,
					'placeholder' => 'Engage your employees while doing something that truly matters.',
				],
				[
					'key'           => 'field_fb_features_card_section_card_image',
					'label'         => 'Image',
					'name'          => 'image',
					'type'          => 'image',
					'return_format' => 'array',
					'preview_size'  => 'medium',
					'instructions'  => 'Displayed as a circular icon (148×148px).',
				],
			],
		],
	],
	'location' => [
		[
			[
				'param'    => 'block',
				'operator' => '==',
				'value'    => 'acf/features-card-section',
			],
		],
	],
] );
