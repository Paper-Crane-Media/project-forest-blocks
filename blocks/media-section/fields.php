<?php
/**
 * Media Section — ACF field group (programmatic).
 *
 * Key convention:
 *   group_fb_media_section
 *   field_fb_media_section_<field>
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

acf_add_local_field_group( [
	'key'      => 'group_fb_media_section',
	'title'    => 'Media Section Fields',
	'fields'   => [
		[
			'key'           => 'field_fb_media_section_variant',
			'label'         => 'Variant',
			'name'          => 'variant',
			'type'          => 'select',
			'choices'       => [
				'default' => 'Default (Single image / video)',
				'slider'  => 'Slider (Image gallery)',
			],
			'default_value' => 'default',
			'return_format' => 'value',
			'ui'            => 1,
		],
		[
			'key'           => 'field_fb_media_section_image',
			'label'         => 'Image',
			'name'          => 'image',
			'type'          => 'image',
			'return_format' => 'array',
			'preview_size'  => 'large',
			'instructions'  => 'Main image displayed in the media section. Also used as the video thumbnail when a YouTube URL is provided.',
			'conditional_logic' => [
				[
					[
						'field'    => 'field_fb_media_section_variant',
						'operator' => '!=',
						'value'    => 'slider',
					],
				],
			],
		],
		[
			'key'          => 'field_fb_media_section_youtube_url',
			'label'        => 'YouTube URL',
			'name'         => 'youtube_url',
			'type'         => 'url',
			'placeholder'  => 'https://www.youtube.com/watch?v=...',
			'instructions' => 'Optional. When set, the image becomes a clickable video thumbnail with a play button overlay. Opens in a Fancybox lightbox.',
			'conditional_logic' => [
				[
					[
						'field'    => 'field_fb_media_section_variant',
						'operator' => '!=',
						'value'    => 'slider',
					],
				],
			],
		],
		[
			'key'           => 'field_fb_media_section_gallery',
			'label'         => 'Gallery Images',
			'name'          => 'gallery',
			'type'          => 'gallery',
			'return_format' => 'array',
			'preview_size'  => 'medium',
			'library'       => 'all',
			'min'           => 0,
			'max'           => 0,
			'instructions'  => 'Images for the slider carousel.',
			'conditional_logic' => [
				[
					[
						'field'    => 'field_fb_media_section_variant',
						'operator' => '==',
						'value'    => 'slider',
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
				'value'    => 'acf/media-section',
			],
		],
	],
] );
