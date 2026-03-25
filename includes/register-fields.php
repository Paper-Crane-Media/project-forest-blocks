<?php
// Auto-load programmatic ACF field definitions from blocks.
//
// Globs blocks/{name}/fields.php and includes each file on the
// acf/include_fields hook, which fires before acf/init so
// field groups are ready when the block editor loads.

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

add_action( 'acf/include_fields', function () {
	$pattern = FOREST_BLOCKS_PATH . 'blocks/*/fields.php';
	$files   = glob( $pattern );

	if ( ! $files ) {
		return;
	}

	foreach ( $files as $file ) {
		require_once $file;
	}
} );
