<?php
/**
 * Features Block — ACF field group (programmatic).
 *
 * Key convention:
 *   group_fb_features_block
 *   field_fb_features_block_<field>
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

acf_add_local_field_group( [
	'key'      => 'group_fb_features_block',
	'title'    => 'Features Block Fields',
	'fields'   => [
		[
			'key'         => 'field_fb_features_block_eyebrow',
			'label'       => 'Eyebrow',
			'name'        => 'eyebrow',
			'type'        => 'text',
			'placeholder' => 'Eyebrow label',
		],
		[
			'key'         => 'field_fb_features_block_heading',
			'label'       => 'Heading',
			'name'        => 'heading',
			'type'        => 'text',
			'required'    => 1,
			'placeholder' => 'Enhance your Sponsorship',
		],
		[
			'key'         => 'field_fb_features_block_subheading',
			'label'       => 'Subheading',
			'name'        => 'subheading',
			'type'        => 'textarea',
			'rows'        => 3,
			'placeholder' => 'In addition to your forest, your sponsorship gives you the opportunity...',
		],
		[
			'key'         => 'field_fb_features_block_body',
			'label'       => 'Body Text',
			'name'        => 'body',
			'type'        => 'textarea',
			'rows'        => 3,
			'placeholder' => 'Pre- and post-event activities, tours and special events...',
		],
		[
			'key'         => 'field_fb_features_block_cta_description',
			'label'       => 'CTA Description',
			'name'        => 'cta_description',
			'type'        => 'textarea',
			'rows'        => 2,
			'placeholder' => 'Contact us to curate an unforgettable experience...',
		],
		[
			'key'           => 'field_fb_features_block_cta',
			'label'         => 'CTA Button',
			'name'          => 'cta',
			'type'          => 'link',
			'return_format' => 'array',
		],
		[
			'key'          => 'field_fb_features_block_features',
			'label'        => 'Feature Cards',
			'name'         => 'features',
			'type'         => 'repeater',
			'min'          => 1,
			'max'          => 12,
			'layout'       => 'block',
			'button_label' => 'Add Feature',
			'sub_fields'   => [
				[
					'key'           => 'field_fb_features_block_feature_image',
					'label'         => 'Image',
					'name'          => 'image',
					'type'          => 'image',
					'return_format' => 'array',
					'preview_size'  => 'medium',
					'required'      => 1,
				],
				[
					'key'         => 'field_fb_features_block_feature_heading',
					'label'       => 'Heading',
					'name'        => 'heading',
					'type'        => 'textarea',
					'rows'        => 3,
					'required'    => 1,
					'placeholder' => 'Witness engaging storytelling through captivating tales...',
				],
				[
					'key'         => 'field_fb_features_block_feature_description',
					'label'       => 'Description',
					'name'        => 'description',
					'type'        => 'textarea',
					'rows'        => 3,
					'placeholder' => 'Additional details about this feature...',
				],
				[
					'key'           => 'field_fb_features_block_feature_link',
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
				'value'    => 'acf/features-block',
			],
		],
	],
] );
