<?php
/**
 * Plugin Name: Forest Blocks
 * Description: Modern ACF blocks for ProjectForest, built with Tailwind CSS and Vite.
 * Version:     1.0.0
 * Author:      ProjectForest
 * Text Domain: forest-blocks
 * Requires PHP: 7.4
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

define( 'FOREST_BLOCKS_PATH', plugin_dir_path( __FILE__ ) );
define( 'FOREST_BLOCKS_URL', plugin_dir_url( __FILE__ ) );
define( 'FOREST_BLOCKS_VERSION', '1.0.0' );

/**
 * Register the "Forest Blocks" block category.
 */
add_filter( 'block_categories_all', function ( $categories ) {
	array_unshift( $categories, [
		'slug'  => 'forest-blocks',
		'title' => __( 'Forest Blocks', 'forest-blocks' ),
	] );
	return $categories;
} );

/**
 * Enqueue front-end assets from the Vite build.
 */
add_action( 'wp_enqueue_scripts', function () {
	$css = FOREST_BLOCKS_PATH . 'dist/forest-blocks.css';
	if ( file_exists( $css ) ) {
		wp_enqueue_style(
			'forest-blocks',
			FOREST_BLOCKS_URL . 'dist/forest-blocks.css',
			[],
			FOREST_BLOCKS_VERSION
		);
	}

	$js = FOREST_BLOCKS_PATH . 'dist/main.js';
	if ( file_exists( $js ) ) {
		wp_enqueue_script(
			'forest-blocks',
			FOREST_BLOCKS_URL . 'dist/main.js',
			[ 'gsap', 'gsap-scrolltrigger' ],
			FOREST_BLOCKS_VERSION,
			true
		);
	}

	// Fancybox — video lightbox (CDN).
	wp_enqueue_style(
		'fancybox',
		'https://cdn.jsdelivr.net/npm/@fancyapps/ui@5.0/dist/fancybox/fancybox.css',
		[],
		'5.0'
	);
	wp_enqueue_script(
		'fancybox',
		'https://cdn.jsdelivr.net/npm/@fancyapps/ui@5.0/dist/fancybox/fancybox.umd.js',
		[],
		'5.0',
		true
	);

	// GSAP + ScrollTrigger — scroll-driven animations (CDN).
	wp_enqueue_script(
		'gsap',
		'https://cdn.jsdelivr.net/npm/gsap@3/dist/gsap.min.js',
		[],
		'3.0',
		true
	);
	wp_enqueue_script(
		'gsap-scrolltrigger',
		'https://cdn.jsdelivr.net/npm/gsap@3/dist/ScrollTrigger.min.js',
		[ 'gsap' ],
		'3.0',
		true
	);
} );

/**
 * Enqueue block editor assets.
 */
add_action( 'enqueue_block_editor_assets', function () {
	$css = FOREST_BLOCKS_PATH . 'dist/forest-blocks.css';
	if ( file_exists( $css ) ) {
		wp_enqueue_style(
			'forest-blocks',
			FOREST_BLOCKS_URL . 'dist/forest-blocks.css',
			[],
			FOREST_BLOCKS_VERSION
		);
	}

	$editor_css = FOREST_BLOCKS_PATH . 'dist/editor.css';
	if ( file_exists( $editor_css ) ) {
		wp_enqueue_style(
			'forest-blocks-editor',
			FOREST_BLOCKS_URL . 'dist/editor.css',
			[],
			FOREST_BLOCKS_VERSION
		);
	}
} );

/**
 * Register ACF JSON save/load point for this plugin.
 */
add_filter( 'acf/settings/save_json', function ( $path ) {
	return FOREST_BLOCKS_PATH . 'acf-json';
} );

add_filter( 'acf/settings/load_json', function ( $paths ) {
	$paths[] = FOREST_BLOCKS_PATH . 'acf-json';
	return $paths;
} );

/**
 * Load block registration.
 */
require_once FOREST_BLOCKS_PATH . 'includes/register-blocks.php';
