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

	$classes = 'inline-flex h-12 min-w-[156px] items-center justify-center gap-2 rounded-container-xl bg-fire px-4 font-display text-button-md font-semibold text-[#fff] no-underline hover:no-underline border !border-transparent hover:border-fire-80 hover:shadow-[0_0_0_4px_rgba(233,84,41,0.15)] transition-[border-color,box-shadow] duration-200';
	if ( $extra_classes ) {
		$classes .= ' ' . $extra_classes;
	}

	$chevron = '<svg class="h-4 w-4 transition-transform duration-200 group-hover:translate-x-0.5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7"/></svg>';

	return '<a href="' . $url . '" target="' . $target . '" class="group ' . esc_attr( $classes ) . '">'
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

	$classes = 'group inline-flex items-center gap-2 pr-4 py-3 font-display text-button-md font-semibold no-underline hover:no-underline ' . $color_class . ' transition-opacity hover:opacity-80';
	if ( $extra_classes ) {
		$classes .= ' ' . $extra_classes;
	}

	$chevron = '<svg class="h-6 w-6 shrink-0 transition-transform duration-200 group-hover:translate-x-[3px]" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24" aria-hidden="true"><path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7"/></svg>';

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

/**
 * Decorative leaf icon (stroke-based, inherits color via currentColor).
 *
 * @param string $extra_classes Additional Tailwind classes.
 * @return string SVG markup.
 */
function fb_leaf_icon( string $extra_classes = '' ): string {
	$classes = 'shrink-0';
	if ( $extra_classes ) {
		$classes .= ' ' . $extra_classes;
	}

	return '<svg class="' . esc_attr( $classes ) . '" xmlns="http://www.w3.org/2000/svg" width="25" height="58" viewBox="0 0 25 58" fill="none" aria-hidden="true">'
		. '<path d="M12.4865 56.3637V11.1968" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>'
		. '<path d="M12.4865 1C12.4865 1 6.06075 11.2313 2.26666 17.6436C-1.52744 24.0516 3.58893 34.1362 12.4865 38.8699" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>'
		. '<path d="M12.4822 1C12.4822 1 18.9079 11.2313 22.702 17.6436C25.7356 22.7657 23.0737 30.2396 17.3394 35.448" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>'
		. '<path d="M12.4865 29.6658L6.5923 23.6289" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>'
		. '<path d="M12.4864 29.6658L18.3764 23.6289" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>'
		. '<path d="M12.4865 21.5875L8.28621 17.2896" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>'
		. '<path d="M12.4865 21.5875L16.6825 17.2896" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>'
		. '</svg>';
}
