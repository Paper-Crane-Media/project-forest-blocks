<?php
/**
 * CTA Block — ACF field group (programmatic).
 *
 * Key convention:
 *   group_fb_cta_block
 *   field_fb_cta_block_<field>
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

acf_add_local_field_group( [
	'key'      => 'group_fb_cta_block',
	'title'    => 'CTA Block Fields',
	'fields'   => [
		[
			'key'           => 'field_fb_cta_block_variant',
			'label'         => 'Variant',
			'name'          => 'variant',
			'type'          => 'select',
			'choices'       => [
				'default'        => 'Default (Forest card with image)',
				'white-centered' => 'White Centered',
				'image-grid'     => 'Image Grid',
			],
			'default_value' => 'default',
			'return_format' => 'value',
			'ui'            => 1,
		],
		[
			'key'           => 'field_fb_cta_block_image',
			'label'         => 'Image',
			'name'          => 'image',
			'type'          => 'image',
			'return_format' => 'array',
			'preview_size'  => 'large',
			'instructions'  => 'Image displayed on the left (desktop) or top (mobile) of the card.',
			'conditional_logic' => [
				[
					[
						'field'    => 'field_fb_cta_block_variant',
						'operator' => '==',
						'value'    => 'default',
					],
				],
			],
		],
		[
			'key'         => 'field_fb_cta_block_title',
			'label'       => 'Title',
			'name'        => 'title',
			'type'        => 'text',
			'placeholder' => '"There is magic happening on Siksika Nation!"',
		],
		[
			'key'          => 'field_fb_cta_block_content',
			'label'        => 'Content',
			'name'         => 'content',
			'type'         => 'wysiwyg',
			'tabs'         => 'all',
			'toolbar'      => 'basic',
			'media_upload' => 0,
		],
		[
			'key'           => 'field_fb_cta_block_link',
			'label'         => 'Link',
			'name'          => 'link',
			'type'          => 'link',
			'return_format' => 'array',
		],
		[
			'key'           => 'field_fb_cta_block_gallery',
			'label'         => 'Image Gallery',
			'name'          => 'gallery',
			'type'          => 'gallery',
			'return_format' => 'array',
			'preview_size'  => 'medium',
			'library'       => 'all',
			'min'           => 0,
			'max'           => 4,
			'instructions'  => '4 images for the masonry grid layout.',
			'conditional_logic' => [
				[
					[
						'field'    => 'field_fb_cta_block_variant',
						'operator' => '==',
						'value'    => 'image-grid',
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
				'value'    => 'acf/cta-block',
			],
		],
	],
] );
