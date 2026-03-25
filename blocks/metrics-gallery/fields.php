<?php
/**
 * Metrics & Gallery Block — ACF field group (programmatic).
 *
 * Key convention:
 *   group_fb_metrics_gallery
 *   field_fb_metrics_gallery_<field>
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

acf_add_local_field_group( [
	'key'      => 'group_fb_metrics_gallery',
	'title'    => 'Metrics & Gallery Fields',
	'fields'   => [
		[
			'key'          => 'field_fb_metrics_gallery_eyebrow',
			'label'        => 'Eyebrow',
			'name'         => 'eyebrow',
			'type'         => 'text',
			'placeholder'  => 'e.g., Case Study',
		],
		[
			'key'          => 'field_fb_metrics_gallery_heading',
			'label'        => 'Heading',
			'name'         => 'heading',
			'type'         => 'text',
			'placeholder'  => 'Main heading text',
			'required'     => 1,
		],
		[
			'key'          => 'field_fb_metrics_gallery_subheading',
			'label'        => 'Subheading',
			'name'         => 'subheading',
			'type'         => 'textarea',
			'rows'         => 2,
			'placeholder'  => 'Supporting text',
		],
		[
			'key'          => 'field_fb_metrics_gallery_metrics',
			'label'        => 'Metrics',
			'name'         => 'metrics',
			'type'         => 'repeater',
			'min'          => 1,
			'max'          => 10,
			'layout'       => 'block',
			'button_label' => 'Add Metric',
			'sub_fields'   => [
				[
					'key'         => 'field_fb_metrics_gallery_metric_number',
					'label'       => 'Number',
					'name'        => 'number',
					'type'        => 'text',
					'placeholder' => 'e.g., 400+',
					'required'    => 1,
				],
				[
					'key'         => 'field_fb_metrics_gallery_metric_label',
					'label'       => 'Label',
					'name'        => 'label',
					'type'        => 'textarea',
					'rows'        => 2,
					'placeholder' => 'e.g., Projects completed',
					'required'    => 1,
				],
			],
		],
		[
			'key'          => 'field_fb_metrics_gallery_images',
			'label'        => 'Gallery Images',
			'name'         => 'images',
			'type'         => 'repeater',
			'min'          => 1,
			'max'          => 20,
			'layout'       => 'block',
			'button_label' => 'Add Image',
			'sub_fields'   => [
				[
					'key'            => 'field_fb_metrics_gallery_image_image',
					'label'          => 'Image',
					'name'           => 'image',
					'type'           => 'image',
					'return_format'  => 'array',
					'required'       => 1,
				],
				[
					'key'         => 'field_fb_metrics_gallery_image_alt',
					'label'       => 'Alt Text',
					'name'        => 'alt',
					'type'        => 'text',
					'placeholder' => 'Description of image',
				],
			],
		],
	],
	'location' => [
		[
			[
				'param'    => 'block',
				'operator' => '==',
				'value'    => 'acf/metrics-gallery',
			],
		],
	],
] );
