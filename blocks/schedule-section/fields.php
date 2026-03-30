<?php
/**
 * Schedule Section — ACF field group (programmatic).
 *
 * Key convention:
 *   group_fb_schedule_section
 *   field_fb_schedule_section_<field>
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

acf_add_local_field_group( [
	'key'      => 'group_fb_schedule_section',
	'title'    => 'Schedule Section Fields',
	'fields'   => [
		[
			'key'         => 'field_fb_schedule_section_heading',
			'label'       => 'Heading',
			'name'        => 'heading',
			'type'        => 'text',
			'placeholder' => 'Celebrate with us!',
		],
		[
			'key'         => 'field_fb_schedule_section_subheading',
			'label'       => 'Subheading',
			'name'        => 'subheading',
			'type'        => 'textarea',
			'rows'        => 2,
			'placeholder' => 'Join us and celebrate at our The 1 Millionth Tree Celebration!',
		],
		[
			'key'          => 'field_fb_schedule_section_columns',
			'label'        => 'Columns',
			'name'         => 'columns',
			'type'         => 'repeater',
			'min'          => 1,
			'max'          => 4,
			'layout'       => 'block',
			'button_label' => 'Add Column',
			'sub_fields'   => [
				[
					'key'           => 'field_fb_schedule_section_column_icon',
					'label'         => 'Icon',
					'name'          => 'icon',
					'type'          => 'image',
					'return_format' => 'array',
					'preview_size'  => 'thumbnail',
					'instructions'  => 'Icon displayed in a forest-colored circle (e.g. clock, calendar). SVG or small image recommended.',
				],
				[
					'key'          => 'field_fb_schedule_section_column_agenda',
					'label'        => 'Agenda',
					'name'         => 'agenda',
					'type'         => 'wysiwyg',
					'tabs'         => 'all',
					'toolbar'      => 'basic',
					'media_upload' => 0,
					'instructions' => 'Main content — use bold for labels (e.g. Date:, Time:, Schedule:).',
				],
				[
					'key'          => 'field_fb_schedule_section_column_description',
					'label'        => 'Description',
					'name'         => 'description',
					'type'         => 'wysiwyg',
					'tabs'         => 'all',
					'toolbar'      => 'basic',
					'media_upload' => 0,
					'instructions' => 'Optional supporting text below the agenda.',
				],
			],
		],
	],
	'location' => [
		[
			[
				'param'    => 'block',
				'operator' => '==',
				'value'    => 'acf/schedule-section',
			],
		],
	],
] );
