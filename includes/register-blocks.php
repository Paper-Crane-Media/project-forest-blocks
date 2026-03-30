<?php
/**
 * Auto-discover and register all ACF blocks from the blocks/ directory.
 *
 * Each block folder must contain a block.json file.
 * ACF 6.x reads acf-specific fields (mode, renderTemplate, etc.) from block.json.
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

require_once __DIR__ . '/class-fb-block.php';
require_once __DIR__ . '/components.php';
require_once __DIR__ . '/register-fields.php';

add_action( 'acf/init', function () {
	$blocks_dir = FOREST_BLOCKS_PATH . 'blocks';

	if ( ! is_dir( $blocks_dir ) ) {
		return;
	}

	$block_files = glob( $blocks_dir . '/*/block.json' );

	foreach ( $block_files as $block_json_path ) {
		$config = json_decode( file_get_contents( $block_json_path ), true );

		if ( empty( $config['name'] ) ) {
			continue;
		}

		$block_args = [
			'name'        => str_replace( 'acf/', '', $config['name'] ),
			'title'       => $config['title'] ?? '',
			'description' => $config['description'] ?? '',
			'category'    => $config['category'] ?? 'forest-blocks',
			'icon'        => $config['icon'] ?? 'admin-generic',
			'keywords'    => $config['keywords'] ?? [],
			'supports'    => $config['supports'] ?? [],
		];

		if ( ! empty( $config['acf'] ) ) {
			if ( ! empty( $config['acf']['mode'] ) ) {
				$block_args['mode'] = $config['acf']['mode'];
			}

			// ACF resolves renderTemplate via locate_template() which only
			// checks the theme directory. Convert to an absolute path so
			// plugin-based templates are found.
			if ( ! empty( $config['acf']['renderTemplate'] ) ) {
				$block_args['render_template'] = FOREST_BLOCKS_PATH . $config['acf']['renderTemplate'];
			}
		}

		acf_register_block_type( $block_args );
	}
} );
