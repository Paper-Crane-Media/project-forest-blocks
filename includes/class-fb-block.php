<?php
/**
 * FB_Block — lightweight helper for ACF block render templates.
 *
 * Usage inside any render.php:
 *   $b = new FB_Block( $block, $is_preview, $post_id );
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

class FB_Block {

	/** @var array Raw block settings passed by ACF. */
	private $block;

	/** @var bool True when rendering inside the editor preview. */
	private $is_preview;

	/** @var int Post ID the block is rendered on. */
	private $post_id;

	/**
	 * @param array $block      Block settings from ACF.
	 * @param bool  $is_preview Whether this is an editor preview.
	 * @param int   $post_id    The current post ID.
	 */
	public function __construct( array $block, bool $is_preview = false, int $post_id = 0 ) {
		$this->block      = $block;
		$this->is_preview = $is_preview;
		$this->post_id    = $post_id;
	}

	/**
	 * Build the root-element class list.
	 *
	 * Always includes 'fb' for Tailwind scoping. Appends the editor's
	 * custom className and alignment class when present.
	 *
	 * @param string|string[] $extra Additional classes to include.
	 * @return string[]
	 */
	public function classes( $extra = [] ): array {
		$classes = [ 'fb' ];

		if ( ! empty( $this->block['className'] ) ) {
			$classes[] = $this->block['className'];
		}

		if ( ! empty( $this->block['align'] ) ) {
			$classes[] = 'align' . $this->block['align'];
		}

		if ( is_string( $extra ) ) {
			$extra = array_filter( explode( ' ', $extra ) );
		}

		return array_merge( $classes, $extra );
	}

	/**
	 * Return an escaped class-attribute string.
	 *
	 * @param string|string[] $extra Additional classes.
	 * @return string
	 */
	public function class_attr( $extra = [] ): string {
		return esc_attr( implode( ' ', $this->classes( $extra ) ) );
	}

	/**
	 * Return the block's anchor/id attribute value, or empty string.
	 *
	 * @return string
	 */
	public function anchor(): string {
		return ! empty( $this->block['anchor'] ) ? esc_attr( $this->block['anchor'] ) : '';
	}

	/**
	 * Print the opening <section> tag with class, optional id, and section-name attributes.
	 *
	 * @param string|string[] $extra Additional classes.
	 */
	public function open_tag( $extra = [] ): void {
		$anchor       = $this->anchor();
		$id           = $anchor ? ' id="' . $anchor . '"' : '';
		$section_name = str_replace( 'acf/', '', $this->block['name'] ?? '' );

		echo '<section class="' . $this->class_attr( $extra ) . '"' . $id . ' section-name="' . esc_attr( $section_name ) . '">';
	}

	/**
	 * Print the closing </section> tag.
	 */
	public function close_tag(): void {
		echo '</section>';
	}

	/**
	 * Get an ACF field value with a fallback default.
	 *
	 * @param string $name    Field name.
	 * @param mixed  $default Value returned when the field is empty.
	 * @return mixed
	 */
	public function field( string $name, $default = '' ) {
		$value = get_field( $name );

		return $value ? $value : $default;
	}

	/**
	 * Echo an escaped text field.
	 *
	 * @param string $name    Field name.
	 * @param string $default Fallback text.
	 */
	public function text( string $name, string $default = '' ): void {
		echo esc_html( $this->field( $name, $default ) );
	}

	/**
	 * Return wp_get_attachment_image() HTML from an ACF image field (array format).
	 *
	 * @param string $name  Field name.
	 * @param string $size  WordPress image size.
	 * @param string $class CSS class(es) for the <img> tag.
	 * @return string HTML or empty string.
	 */
	public function image( string $name, string $size = 'large', string $class = '' ): string {
		$image = get_field( $name );

		if ( empty( $image['ID'] ) ) {
			return '';
		}

		$attr = $class ? [ 'class' => $class ] : [];

		return wp_get_attachment_image( $image['ID'], $size, false, $attr );
	}

	/**
	 * Whether we are inside the block editor preview.
	 *
	 * @return bool
	 */
	public function is_preview(): bool {
		return $this->is_preview;
	}

	/**
	 * The post ID this block is rendering on.
	 *
	 * @return int
	 */
	public function post_id(): int {
		return $this->post_id;
	}

	/**
	 * The block name (e.g. 'acf/example').
	 *
	 * @return string
	 */
	public function name(): string {
		return $this->block['name'] ?? '';
	}
}
