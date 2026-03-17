<?php
/**
 * Full-width Link Block — ACF field group (programmatic).
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

acf_add_local_field_group( [
	'key'      => 'group_fb_full_width_link',
	'title'    => 'Full-width Link Fields',
	'fields'   => [
		[
			'key'           => 'field_fb_full_width_link_link',
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
				'value'    => 'acf/full-width-link',
			],
		],
	],
] );
