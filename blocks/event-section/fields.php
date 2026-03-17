<?php
/**
 * Event Section Block — ACF field group (programmatic).
 *
 * Key convention:
 *   group_fb_event_section
 *   field_fb_event_section_<field>
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

acf_add_local_field_group( [
	'key'      => 'group_fb_event_section',
	'title'    => 'Event Section Fields',
	'fields'   => [
		[
			'key'         => 'field_fb_event_section_eyebrow',
			'label'       => 'Eyebrow',
			'name'        => 'eyebrow',
			'type'        => 'text',
			'placeholder' => 'Programs',
		],
		[
			'key'         => 'field_fb_event_section_heading',
			'label'       => 'Heading',
			'name'        => 'heading',
			'type'        => 'text',
			'required'    => 1,
			'placeholder' => 'Donec ex justo',
		],
		[
			'key'         => 'field_fb_event_section_subheading',
			'label'       => 'Subheading',
			'name'        => 'subheading',
			'type'        => 'textarea',
			'rows'        => 3,
			'placeholder' => 'Fermentum quis congue sit amet...',
		],
		[
			'key'         => 'field_fb_event_section_body',
			'label'       => 'Body Text',
			'name'        => 'body',
			'type'        => 'textarea',
			'rows'        => 4,
			'placeholder' => 'Donec ex justo, fermentum quis...',
		],
		[
			'key'           => 'field_fb_event_section_features_label',
			'label'         => 'Features Label',
			'name'          => 'features_label',
			'type'          => 'text',
			'default_value' => 'Your contribution includes:',
		],
		[
			'key'          => 'field_fb_event_section_features',
			'label'        => 'Feature Items',
			'name'         => 'features',
			'type'         => 'repeater',
			'min'          => 0,
			'layout'       => 'table',
			'button_label' => 'Add Feature',
			'sub_fields'   => [
				[
					'key'         => 'field_fb_event_section_feature_text',
					'label'       => 'Feature Text',
					'name'        => 'text',
					'type'        => 'text',
					'placeholder' => 'Feature item description',
				],
			],
		],
		[
			'key'          => 'field_fb_event_section_images',
			'label'        => 'Gallery Images',
			'name'         => 'images',
			'type'         => 'repeater',
			'min'          => 0,
			'max'          => 4,
			'layout'       => 'block',
			'button_label' => 'Add Image',
			'instructions' => 'Up to 4 images for the mosaic grid. Order: top-left (tall), bottom-left (short), top-right (short), bottom-right (tall).',
			'sub_fields'   => [
				[
					'key'           => 'field_fb_event_section_image',
					'label'         => 'Image',
					'name'          => 'image',
					'type'          => 'image',
					'return_format' => 'array',
					'preview_size'  => 'medium',
				],
			],
		],
		[
			'key'          => 'field_fb_event_section_cta_links',
			'label'        => 'CTA Links',
			'name'         => 'cta_links',
			'type'         => 'repeater',
			'min'          => 0,
			'max'          => 4,
			'layout'       => 'block',
			'button_label' => 'Add CTA Link',
			'sub_fields'   => [
				[
					'key'         => 'field_fb_event_section_cta_heading',
					'label'       => 'Heading',
					'name'        => 'heading',
					'type'        => 'text',
					'placeholder' => 'Discover more about...',
				],
				[
					'key'           => 'field_fb_event_section_cta_link',
					'label'         => 'Link',
					'name'          => 'link',
					'type'          => 'link',
					'return_format' => 'array',
				],
			],
		],
	],
	'location' => [
		[
			[
				'param'    => 'block',
				'operator' => '==',
				'value'    => 'acf/event-section',
			],
		],
	],
] );
