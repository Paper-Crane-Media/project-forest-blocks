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
			'key'           => 'field_fb_cta_block_image',
			'label'         => 'Image',
			'name'          => 'image',
			'type'          => 'image',
			'return_format' => 'array',
			'preview_size'  => 'large',
			'instructions'  => 'Image displayed on the left (desktop) or top (mobile) of the card.',
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
