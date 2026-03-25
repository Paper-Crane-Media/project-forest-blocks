<?php
/**
 * Reusable UI component functions for Forest Blocks templates.
 *
 * All functions return HTML strings (not echo) so callers can
 * concatenate, wrap in conditions, or echo at the call site.
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Solid fire CTA button (pill shape, white text on fire background).
 *
 * Accepts an ACF link array. Returns empty string if URL is missing.
 *
 * @param array  $link          ACF link array with url, title, target keys.
 * @param string $default_label Fallback label when title is empty.
 * @param string $extra_classes Additional Tailwind classes to append.
 * @return string HTML anchor element or empty string.
 */
function fb_button( array $link, string $default_label = 'Learn More', string $extra_classes = '' ): string {
	if ( empty( $link['url'] ) ) {
		return '';
	}

	$url    = esc_url( $link['url'] );
	$target = esc_attr( $link['target'] ?? '_self' );
	$title  = esc_html( $link['title'] ?? $default_label );

	$classes = 'inline-flex h-12 min-w-[156px] items-center justify-center gap-2 rounded-container-xl bg-fire px-4 font-display text-button-md font-semibold text-[#fff] transition-opacity hover:opacity-90';
	if ( $extra_classes ) {
		$classes .= ' ' . $extra_classes;
	}

	$chevron = '<svg class="h-4 w-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7"/></svg>';

	return '<a href="' . $url . '" target="' . $target . '" class="' . esc_attr( $classes ) . '">'
		. $title . $chevron . '</a>';
}

/**
 * Text-only link with chevron arrow (no background, typically white or fire text).
 *
 * @param array  $link          ACF link array.
 * @param string $default_label Fallback label.
 * @param string $color_class   Text color class (e.g. 'text-[#fff]' or 'text-fire').
 * @param string $extra_classes Additional Tailwind classes.
 * @return string HTML anchor element or empty string.
 */
function fb_text_link( array $link, string $default_label = '', string $color_class = 'text-[#fff]', string $extra_classes = '' ): string {
	if ( empty( $link['url'] ) ) {
		return '';
	}

	$url    = esc_url( $link['url'] );
	$target = esc_attr( $link['target'] ?? '_self' );
	$title  = esc_html( $link['title'] ?? $default_label );

	$classes = 'inline-flex items-center gap-2 pr-4 py-3 font-display text-button-md font-semibold ' . $color_class . ' transition-opacity hover:opacity-80';
	if ( $extra_classes ) {
		$classes .= ' ' . $extra_classes;
	}

	$chevron = '<svg class="h-6 w-6 shrink-0" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24" aria-hidden="true"><path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7"/></svg>';

	return '<a href="' . $url . '" target="' . $target . '" class="' . esc_attr( $classes ) . '">'
		. $title . $chevron . '</a>';
}

/**
 * Inline fire-colored text link with chevron (used in feature cards, etc.).
 *
 * @param array  $link          ACF link array.
 * @param string $default_label Fallback label.
 * @param string $extra_classes Additional Tailwind classes.
 * @return string HTML anchor element or empty string.
 */
function fb_inline_link( array $link, string $default_label = 'Learn More', string $extra_classes = '' ): string {
	if ( empty( $link['url'] ) ) {
		return '';
	}

	$url    = esc_url( $link['url'] );
	$target = esc_attr( $link['target'] ?? '_self' );
	$title  = esc_html( $link['title'] ?? $default_label );

	$classes = 'inline-flex items-center gap-2 font-display text-button-md font-semibold text-fire';
	if ( $extra_classes ) {
		$classes .= ' ' . $extra_classes;
	}

	$chevron = '<svg class="h-6 w-6" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7"/></svg>';

	return '<a href="' . $url . '" target="' . $target . '" class="' . esc_attr( $classes ) . '">'
		. $title . $chevron . '</a>';
}

/**
 * Eyebrow pill badge.
 *
 * @param string $text          Badge text.
 * @param string $size_class    Text size class (default 'text-eyebrow-md').
 * @param string $bg_class      Background class (default 'bg-forest').
 * @param string $extra_classes Additional Tailwind classes.
 * @return string HTML span element or empty string.
 */
function fb_eyebrow( string $text, string $size_class = 'text-eyebrow-md', string $bg_class = 'bg-forest', string $extra_classes = '' ): string {
	if ( ! $text ) {
		return '';
	}

	$classes = 'inline-flex items-center rounded-full ' . $bg_class . ' px-4 py-2 font-body ' . $size_class . ' font-semibold text-forest-5';
	if ( $extra_classes ) {
		$classes .= ' ' . $extra_classes;
	}

	return '<span class="' . esc_attr( $classes ) . '">' . esc_html( $text ) . '</span>';
}
