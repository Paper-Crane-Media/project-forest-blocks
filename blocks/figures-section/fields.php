<?php
/**
 * Figures Section — ACF field group (programmatic).
 *
 * Key convention:
 *   group_fb_figures_section
 *   field_fb_figures_section_<field>
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

acf_add_local_field_group( [
	'key'      => 'group_fb_figures_section',
	'title'    => 'Figures Section Fields',
	'fields'   => [
		[
			'key'         => 'field_fb_figures_section_figure_1',
			'label'       => 'Figure 1',
			'name'        => 'figure_1',
			'type'        => 'number',
			'placeholder' => '41',
			'instructions' => 'Number that counts up on scroll.',
		],
		[
			'key'         => 'field_fb_figures_section_figure_1_heading',
			'label'       => 'Figure 1 Heading',
			'name'        => 'figure_1_heading',
			'type'        => 'text',
			'placeholder' => 'hectares',
		],
		[
			'key'         => 'field_fb_figures_section_figure_2',
			'label'       => 'Figure 2',
			'name'        => 'figure_2',
			'type'        => 'number',
			'placeholder' => '82440',
			'instructions' => 'Number that counts up on scroll.',
		],
		[
			'key'         => 'field_fb_figures_section_figure_2_heading',
			'label'       => 'Figure 2 Heading',
			'name'        => 'figure_2_heading',
			'type'        => 'text',
			'placeholder' => 'Seedlings',
		],
		[
			'key'          => 'field_fb_figures_section_content',
			'label'        => 'Content',
			'name'         => 'content',
			'type'         => 'wysiwyg',
			'tabs'         => 'all',
			'toolbar'      => 'basic',
			'media_upload' => 0,
		],
		[
			'key'           => 'field_fb_figures_section_link',
			'label'         => 'Link',
			'name'          => 'link',
			'type'          => 'link',
			'return_format' => 'array',
		],
	],
	'location' => [
		[
			[
				'param'    => 'block',
				'operator' => '==',
				'value'    => 'acf/figures-section',
			],
		],
	],
] );
