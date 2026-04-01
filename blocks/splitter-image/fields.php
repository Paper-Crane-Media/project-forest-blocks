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
				'default'         => 'Default',
				'cta_card'        => 'CTA Card',
				'full_background' => 'Full Background',
				'image_grid'      => 'Image Grid',
			],
			'default_value' => 'default',
			'instructions'  => 'Default: white background, text left / image right. CTA Card: forest background with pattern, image left / text right inside a card. Full Background: forest background with full-bleed image and overlaid content card.',
		],
		[
			'key'               => 'field_fb_splitter_image_container_position',
			'label'             => 'Container Position',
			'name'              => 'container_position',
			'type'              => 'select',
			'choices'           => [
				'bottom_left'  => 'Bottom Left',
				'bottom_right' => 'Bottom Right',
			],
			'default_value'     => 'bottom_left',
			'instructions'      => 'Position of the content card overlay on the image.',
			'conditional_logic' => [
				[
					[
						'field'    => 'field_fb_splitter_image_variant',
						'operator' => '==',
						'value'    => 'full_background',
					],
				],
			],
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
			'key'          => 'field_fb_splitter_image_body',
			'label'        => 'Body',
			'name'         => 'body',
			'type'         => 'wysiwyg',
			'tabs'         => 'all',
			'toolbar'      => 'basic',
			'media_upload' => 0,
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
			'conditional_logic' => [
				[
					[
						'field'    => 'field_fb_splitter_image_variant',
						'operator' => '!=',
						'value'    => 'image_grid',
					],
				],
			],
		],
		[
			'key'           => 'field_fb_splitter_image_gallery',
			'label'         => 'Image Gallery',
			'name'          => 'gallery',
			'type'          => 'gallery',
			'return_format' => 'array',
			'preview_size'  => 'medium',
			'library'       => 'all',
			'min'           => 0,
			'max'           => 4,
			'instructions'  => 'Exactly 4 images for the masonry grid layout.',
			'conditional_logic' => [
				[
					[
						'field'    => 'field_fb_splitter_image_variant',
						'operator' => '==',
						'value'    => 'image_grid',
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
				'value'    => 'acf/splitter-image',
			],
		],
	],
] );
