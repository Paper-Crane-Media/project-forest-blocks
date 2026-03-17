<?php
/**
 * Testimonial Stack Block — ACF field group (programmatic).
 *
 * Key convention:
 *   group_fb_testimonial_stack
 *   field_fb_testimonial_stack_<field>
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

acf_add_local_field_group( [
	'key'      => 'group_fb_testimonial_stack',
	'title'    => 'Testimonial Stack Fields',
	'fields'   => [
		[
			'key'          => 'field_fb_testimonial_stack_cards',
			'label'        => 'Testimonial Cards',
			'name'         => 'cards',
			'type'         => 'repeater',
			'min'          => 1,
			'max'          => 6,
			'layout'       => 'block',
			'button_label' => 'Add Card',
			'sub_fields'   => [
				[
					'key'         => 'field_fb_testimonial_stack_card_heading',
					'label'       => 'Heading',
					'name'        => 'heading',
					'type'        => 'text',
					'placeholder' => 'Card heading',
					'required'    => 1,
				],
				[
					'key'         => 'field_fb_testimonial_stack_card_subheading',
					'label'       => 'Subheading',
					'name'        => 'subheading',
					'type'        => 'textarea',
					'rows'        => 2,
					'placeholder' => 'Subheading or lead text',
				],
				[
					'key'         => 'field_fb_testimonial_stack_card_body',
					'label'       => 'Body Text',
					'name'        => 'body',
					'type'        => 'textarea',
					'rows'        => 3,
					'placeholder' => 'Main content text',
				],
				[
					'key'         => 'field_fb_testimonial_stack_card_caption',
					'label'       => 'Caption',
					'name'        => 'caption',
					'type'        => 'text',
					'placeholder' => 'Caption or label',
				],
				[
					'key'           => 'field_fb_testimonial_stack_card_cta',
					'label'         => 'Call to Action',
					'name'          => 'cta',
					'type'          => 'link',
					'return_format' => 'array',
				],
				[
					'key'         => 'field_fb_testimonial_stack_card_quote',
					'label'       => 'Quote Text',
					'name'        => 'quote',
					'type'        => 'textarea',
					'rows'        => 3,
					'placeholder' => 'Testimonial quote',
					'required'    => 1,
				],
				[
					'key'         => 'field_fb_testimonial_stack_card_author',
					'label'       => 'Author Name',
					'name'        => 'author',
					'type'        => 'text',
					'placeholder' => 'Attribution name',
					'required'    => 1,
				],
				[
					'key'         => 'field_fb_testimonial_stack_card_author_source',
					'label'       => 'Author Source',
					'name'        => 'author_source',
					'type'        => 'text',
					'placeholder' => 'e.g., Book title or role',
				],
				[
					'key'           => 'field_fb_testimonial_stack_card_color',
					'label'         => 'Circle Color',
					'name'          => 'color',
					'type'          => 'select',
					'choices'       => [
						'forest' => 'Forest (Dark Blue)',
						'water'  => 'Water (Ocean Blue)',
						'earth'  => 'Earth (Bronze)',
						'tree'   => 'Tree (Green)',
					],
					'default_value' => 'forest',
					'instructions'  => 'Color of the quote circle background',
				],
			],
		],
	],
	'location' => [
		[
			[
				'param'    => 'block',
				'operator' => '==',
				'value'    => 'acf/testimonial-stack',
			],
		],
	],
] );
