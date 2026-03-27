<?php
/**
 * Partners Section Block — ACF field group (programmatic).
 *
 * Key convention:
 *   group_fb_partners_section
 *   field_fb_partners_section_<field>
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

acf_add_local_field_group( [
	'key'      => 'group_fb_partners_section',
	'title'    => 'Partners Section Fields',
	'fields'   => [
		[
			'key'           => 'field_fb_partners_section_variant',
			'label'         => 'Variant',
			'name'          => 'variant',
			'type'          => 'select',
			'choices'       => [
				'small_logos' => 'Small Logos',
				'large_logos' => 'Large Logos',
			],
			'default_value' => 'small_logos',
			'instructions'  => 'Small logos: 8-column grid with compact logos. Large logos: 4-column grid with larger logos.',
		],
		[
			'key'         => 'field_fb_partners_section_heading',
			'label'       => 'Heading',
			'name'        => 'heading',
			'type'        => 'text',
			'placeholder' => 'Platinum Partners',
		],
		[
			'key'          => 'field_fb_partners_section_logos',
			'label'        => 'Logos',
			'name'         => 'logos',
			'type'         => 'repeater',
			'layout'       => 'table',
			'button_label' => 'Add Logo',
			'min'          => 1,
			'sub_fields'   => [
				[
					'key'           => 'field_fb_partners_section_logo',
					'label'         => 'Logo',
					'name'          => 'logo',
					'type'          => 'image',
					'return_format' => 'array',
					'preview_size'  => 'medium',
					'instructions'  => 'Partner logo image (SVG or PNG recommended).',
				],
				[
					'key'         => 'field_fb_partners_section_name',
					'label'       => 'Name',
					'name'        => 'name',
					'type'        => 'text',
					'placeholder' => 'Company Name',
					'instructions' => 'Used as alt text for the logo.',
				],
				[
					'key'           => 'field_fb_partners_section_link',
					'label'         => 'Link',
					'name'          => 'link',
					'type'          => 'url',
					'placeholder'   => 'https://',
					'instructions'  => 'Optional link to partner website.',
				],
			],
		],
	],
	'location' => [
		[
			[
				'param'    => 'block',
				'operator' => '==',
				'value'    => 'acf/partners-section',
			],
		],
	],
] );
