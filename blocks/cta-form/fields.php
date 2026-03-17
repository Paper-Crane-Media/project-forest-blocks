<?php
if ( ! defined( 'ABSPATH' ) ) { exit; }

acf_add_local_field_group( [
	'key'      => 'group_fb_cta_form',
	'title'    => 'CTA Form Fields',
	'fields'   => [
		[
			'key'            => 'field_fb_cta_form_heading',
			'label'          => 'Heading',
			'name'           => 'heading',
			'type'           => 'text',
			'required'       => 1,
			'default_value'  => 'Donec ex justo',
		],
		[
			'key'            => 'field_fb_cta_form_gravity_form_id',
			'label'          => 'Gravity Form ID',
			'name'           => 'gravity_form_id',
			'type'           => 'number',
			'required'       => 1,
			'instructions'   => 'Enter the ID of the Gravity Form to display. Find form IDs under Forms in the admin sidebar.',
			'default_value'  => '',
			'min'            => 1,
		],
	],
	'location' => [
		[[ 'param' => 'block', 'operator' => '==', 'value' => 'acf/cta-form' ]],
	],
] );
