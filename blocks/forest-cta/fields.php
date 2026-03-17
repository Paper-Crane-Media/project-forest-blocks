<?php
if ( ! defined( 'ABSPATH' ) ) { exit; }

acf_add_local_field_group( [
	'key'      => 'group_fb_forest_cta',
	'title'    => 'Forest CTA Fields',
	'fields'   => [
		[
			'key'          => 'field_fb_forest_cta_heading',
			'label'        => 'Heading',
			'name'         => 'heading',
			'type'         => 'text',
			'required'     => 1,
			'default_value' => 'Our Forests are Accessible for Your Attendees',
		],
		[
			'key'   => 'field_fb_forest_cta_card_heading',
			'label' => 'Card Heading',
			'name'  => 'card_heading',
			'type'  => 'text',
		],
		[
			'key'   => 'field_fb_forest_cta_card_body',
			'label' => 'Card Body',
			'name'  => 'card_body',
			'type'  => 'textarea',
			'rows'  => 3,
		],
		[
			'key'   => 'field_fb_forest_cta_caption',
			'label' => 'Caption',
			'name'  => 'caption',
			'type'  => 'text',
		],
		[
			'key'          => 'field_fb_forest_cta_buttons',
			'label'        => 'Buttons',
			'name'         => 'buttons',
			'type'         => 'repeater',
			'min'          => 0,
			'max'          => 2,
			'layout'       => 'block',
			'button_label' => 'Add Button',
			'sub_fields'   => [
				[
					'key'           => 'field_fb_forest_cta_buttons_link',
					'label'         => 'Link',
					'name'          => 'link',
					'type'          => 'link',
					'return_format' => 'array',
				],
			],
		],
	],
	'location' => [
		[[ 'param' => 'block', 'operator' => '==', 'value' => 'acf/forest-cta' ]],
	],
] );
