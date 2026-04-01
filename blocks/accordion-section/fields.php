<?php
/**
 * Accordion Section — ACF field group (programmatic).
 *
 * Key convention:
 *   group_fb_accordion_section
 *   field_fb_accordion_section_<field>
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

acf_add_local_field_group( [
	'key'      => 'group_fb_accordion_section',
	'title'    => 'Accordion Section Fields',
	'fields'   => [
		[
			'key'         => 'field_fb_accordion_section_heading',
			'label'       => 'Heading',
			'name'        => 'heading',
			'type'        => 'text',
			'placeholder' => 'Seed Kit Planting Instructions',
		],
		[
			'key'          => 'field_fb_accordion_section_items',
			'label'        => 'Accordion Items',
			'name'         => 'items',
			'type'         => 'repeater',
			'layout'       => 'block',
			'button_label' => 'Add Accordion Item',
			'min'          => 0,
			'max'          => 0,
			'sub_fields'   => [
				[
					'key'         => 'field_fb_accordion_section_item_heading',
					'label'       => 'Heading',
					'name'        => 'heading',
					'type'        => 'text',
				],
				[
					'key'          => 'field_fb_accordion_section_item_content',
					'label'        => 'Content',
					'name'         => 'content',
					'type'         => 'wysiwyg',
					'tabs'         => 'all',
					'toolbar'      => 'full',
					'media_upload' => 0,
				],
			],
		],
	],
	'location' => [
		[
			[
				'param'    => 'block',
				'operator' => '==',
				'value'    => 'acf/accordion-section',
			],
		],
	],
] );
