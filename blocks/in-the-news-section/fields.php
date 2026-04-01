<?php
/**
 * In The News Section — ACF field group (programmatic).
 *
 * Key convention:
 *   group_fb_in_the_news_section
 *   field_fb_in_the_news_section_<field>
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

acf_add_local_field_group( [
	'key'      => 'group_fb_in_the_news_section',
	'title'    => 'In The News Section Fields',
	'fields'   => [
		[
			'key'         => 'field_fb_in_the_news_section_heading',
			'label'       => 'Heading',
			'name'        => 'heading',
			'type'        => 'text',
			'placeholder' => 'Media',
		],
		[
			'key'           => 'field_fb_in_the_news_section_variant',
			'label'         => 'Variant',
			'name'          => 'variant',
			'type'          => 'select',
			'choices'       => [
				'media'    => 'Media (Video lightbox cards)',
				'articles' => 'Articles (Linked article cards)',
			],
			'default_value' => 'media',
			'return_format' => 'value',
			'ui'            => 1,
		],

		// --- Media variant fields ---
		[
			'key'          => 'field_fb_in_the_news_section_media_items',
			'label'        => 'Media Items',
			'name'         => 'media_items',
			'type'         => 'repeater',
			'layout'       => 'block',
			'button_label' => 'Add Media Item',
			'min'          => 0,
			'max'          => 0,
			'instructions' => 'First item renders as the large featured card.',
			'conditional_logic' => [
				[
					[
						'field'    => 'field_fb_in_the_news_section_variant',
						'operator' => '==',
						'value'    => 'media',
					],
				],
			],
			'sub_fields' => [
				[
					'key'           => 'field_fb_in_the_news_section_media_image',
					'label'         => 'Image',
					'name'          => 'image',
					'type'          => 'image',
					'return_format' => 'array',
					'preview_size'  => 'medium',
					'instructions'  => 'Thumbnail image (only displayed on the first/featured card).',
				],
				[
					'key'         => 'field_fb_in_the_news_section_media_heading',
					'label'       => 'Heading',
					'name'        => 'heading',
					'type'        => 'text',
				],
				[
					'key'         => 'field_fb_in_the_news_section_media_subheading',
					'label'       => 'Subheading',
					'name'        => 'subheading',
					'type'        => 'textarea',
					'rows'        => 3,
				],
				[
					'key'          => 'field_fb_in_the_news_section_media_video_link',
					'label'        => 'Video Link',
					'name'         => 'video_link',
					'type'         => 'url',
					'placeholder'  => 'https://www.youtube.com/watch?v=...',
					'instructions' => 'YouTube or external video URL. Opens in a Fancybox lightbox.',
				],
			],
		],

		// --- Articles variant fields ---
		[
			'key'          => 'field_fb_in_the_news_section_articles',
			'label'        => 'Articles',
			'name'         => 'articles',
			'type'         => 'repeater',
			'layout'       => 'block',
			'button_label' => 'Add Article',
			'min'          => 0,
			'max'          => 0,
			'conditional_logic' => [
				[
					[
						'field'    => 'field_fb_in_the_news_section_variant',
						'operator' => '==',
						'value'    => 'articles',
					],
				],
			],
			'sub_fields' => [
				[
					'key'         => 'field_fb_in_the_news_section_article_heading',
					'label'       => 'Heading',
					'name'        => 'heading',
					'type'        => 'text',
				],
				[
					'key'         => 'field_fb_in_the_news_section_article_subheading',
					'label'       => 'Subheading',
					'name'        => 'subheading',
					'type'        => 'textarea',
					'rows'        => 4,
				],
				[
					'key'           => 'field_fb_in_the_news_section_article_link',
					'label'         => 'Link',
					'name'          => 'link',
					'type'          => 'link',
					'return_format' => 'array',
				],
				[
					'key'         => 'field_fb_in_the_news_section_article_attribution',
					'label'       => 'Attribution',
					'name'        => 'attribution',
					'type'        => 'text',
					'placeholder' => 'CBC News',
					'instructions' => 'Source name displayed at the top of the card.',
				],
				[
					'key'           => 'field_fb_in_the_news_section_article_logo',
					'label'         => 'Attributor Logo',
					'name'          => 'logo',
					'type'          => 'image',
					'return_format' => 'array',
					'preview_size'  => 'thumbnail',
					'instructions'  => 'Logo displayed beside the attribution name.',
				],
				[
					'key'           => 'field_fb_in_the_news_section_article_image',
					'label'         => 'Background Image',
					'name'          => 'image',
					'type'          => 'image',
					'return_format' => 'array',
					'preview_size'  => 'medium',
					'instructions'  => 'Background image for the card content area.',
				],
			],
		],
	],
	'location' => [
		[
			[
				'param'    => 'block',
				'operator' => '==',
				'value'    => 'acf/in-the-news-section',
			],
		],
	],
] );
