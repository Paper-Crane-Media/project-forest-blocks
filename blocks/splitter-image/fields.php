<?php
/**
 * Splitter Image Block — ACF field group (programmatic).
 *
 * Key convention:
 *   group_fb_splitter_image
 *   field_fb_splitter_image_<field>
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

acf_add_local_field_group( [
	'key'      => 'group_fb_splitter_image',
	'title'    => 'Splitter Image Fields',
	'fields'   => [
		[
			'key'           => 'field_fb_splitter_image_variant',
			'label'         => 'Variant',
			'name'          => 'variant',
			'type'          => 'select',
			'choices'       => [
				'default'  => 'Default',
				'cta_card' => 'CTA Card',
			],
			'default_value' => 'default',
			'instructions'  => 'Default: white background, text left / image right. CTA Card: forest background with pattern, image left / text right inside a card.',
		],
		[
			'key'         => 'field_fb_splitter_image_eyebrow',
			'label'       => 'Eyebrow',
			'name'        => 'eyebrow',
			'type'        => 'text',
			'placeholder' => 'Eyebrow',
		],
		[
			'key'         => 'field_fb_splitter_image_heading',
			'label'       => 'Heading',
			'name'        => 'heading',
			'type'        => 'textarea',
			'rows'        => 3,
			'placeholder' => 'Think about the last time you sat under the shade of a tree.',
		],
		[
			'key'         => 'field_fb_splitter_image_subheading',
			'label'       => 'Subheading',
			'name'        => 'subheading',
			'type'        => 'textarea',
			'rows'        => 3,
			'placeholder' => 'Project Forest believes access to nature is a human right.',
		],
		[
			'key'         => 'field_fb_splitter_image_body',
			'label'       => 'Body',
			'name'        => 'body',
			'type'        => 'textarea',
			'rows'        => 3,
			'placeholder' => 'We partner with conservation groups, First Nations, Métis and funding partners to enrich communities by planting forests.',
		],
		[
			'key'           => 'field_fb_splitter_image_cta',
			'label'         => 'Call to Action',
			'name'          => 'cta',
			'type'          => 'link',
			'return_format' => 'array',
		],
		[
			'key'           => 'field_fb_splitter_image_image',
			'label'         => 'Image',
			'name'          => 'image',
			'type'          => 'image',
			'return_format' => 'array',
			'preview_size'  => 'large',
			'instructions'  => 'Recommended minimum 636×636. Will be displayed with rounded corners.',
		],
	],
	'location' => [
		[
			[
				'param'    => 'block',
				'operator' => '==',
				'value'    => 'acf/splitter-image',
			],
		],
	],
] );
