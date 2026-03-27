<?php
/**
 * Testimonial Slider Block — ACF field group (programmatic).
 *
 * Key convention:
 *   group_fb_testimonial_slider
 *   field_fb_testimonial_slider_<field>
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

acf_add_local_field_group( [
	'key'      => 'group_fb_testimonial_slider',
	'title'    => 'Testimonial Slider Fields',
	'fields'   => [
		[
			'key'          => 'field_fb_testimonial_slider_testimonials',
			'label'        => 'Testimonials',
			'name'         => 'testimonials',
			'type'         => 'repeater',
			'layout'       => 'block',
			'button_label' => 'Add Testimonial',
			'min'          => 1,
			'sub_fields'   => [
				[
					'key'         => 'field_fb_testimonial_slider_attribution',
					'label'       => 'Attribution',
					'name'        => 'attribution',
					'type'        => 'text',
					'placeholder' => 'Name Title',
					'instructions' => 'Name of the person giving the testimonial.',
				],
				[
					'key'         => 'field_fb_testimonial_slider_title',
					'label'       => 'Title',
					'name'        => 'title',
					'type'        => 'text',
					'placeholder' => 'Position Title',
					'instructions' => 'Position or role of the person.',
				],
				[
					'key'          => 'field_fb_testimonial_slider_testimonial',
					'label'        => 'Testimonial',
					'name'         => 'testimonial',
					'type'         => 'wysiwyg',
					'tabs'         => 'all',
					'toolbar'      => 'basic',
					'media_upload' => 0,
				],
				[
					'key'           => 'field_fb_testimonial_slider_avatar',
					'label'         => 'Avatar',
					'name'          => 'avatar',
					'type'          => 'image',
					'return_format' => 'array',
					'preview_size'  => 'thumbnail',
					'instructions'  => 'Optional headshot. Displayed as a 112px circle.',
				],
			],
		],
	],
	'location' => [
		[
			[
				'param'    => 'block',
				'operator' => '==',
				'value'    => 'acf/testimonial-slider',
			],
		],
	],
] );
