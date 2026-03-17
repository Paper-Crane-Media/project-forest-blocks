<?php
/**
 * Step Section Block — ACF field group (programmatic).
 *
 * Key convention:
 *   group_fb_step_section
 *   field_fb_step_section_<field>
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

acf_add_local_field_group( [
	'key'      => 'group_fb_step_section',
	'title'    => 'Step Section Fields',
	'fields'   => [
		[
			'key'         => 'field_fb_step_section_eyebrow',
			'label'       => 'Eyebrow',
			'name'        => 'eyebrow',
			'type'        => 'text',
			'placeholder' => 'Project Forest',
		],
		[
			'key'         => 'field_fb_step_section_heading',
			'label'       => 'Heading',
			'name'        => 'heading',
			'type'        => 'text',
			'required'    => 1,
			'placeholder' => 'How does it work to fund a forest?',
		],
		[
			'key'      => 'field_fb_step_section_steps',
			'label'    => 'Steps',
			'name'     => 'steps',
			'type'     => 'repeater',
			'min'      => 1,
			'max'      => 12,
			'layout'   => 'block',
			'sub_fields' => [
				[
					'key'         => 'field_fb_step_section_step_title',
					'label'       => 'Step Title',
					'name'        => 'title',
					'type'        => 'text',
					'required'    => 1,
					'placeholder' => 'Contact us.',
				],
				[
					'key'           => 'field_fb_step_section_step_image',
					'label'         => 'Step Image',
					'name'          => 'image',
					'type'          => 'image',
					'return_format' => 'array',
					'preview_size'  => 'medium',
					'required'      => 1,
					'instructions'  => 'Square image shown in the sticky left column when this step is active.',
				],
			],
		],
	],
	'location' => [
		[
			[
				'param'    => 'block',
				'operator' => '==',
				'value'    => 'acf/step-section',
			],
		],
	],
] );
