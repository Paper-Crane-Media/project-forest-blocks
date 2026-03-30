<?php
/**
 * CTA Block — render template.
 *
 * Forest background with pattern overlay containing an elevated card.
 * Desktop: image left, content right.
 * Mobile: image top, content below.
 *
 * @param array  $block      The block settings and attributes.
 * @param string $content    The block inner HTML (empty for ACF blocks).
 * @param bool   $is_preview True during block preview in the editor.
 * @param int    $post_id    The post ID the block is rendering on.
 * @param array  $context    The context passed to the block.
 */

$b = new FB_Block( $block, $is_preview, $post_id );

$image       = $b->field( 'image' );
$title       = $b->field( 'title', '' );
$content     = $b->field( 'content', '' );
$link        = $b->field( 'link' );
$pattern_url = FOREST_BLOCKS_URL . 'assets/images/pattern-forest.png';
?>
<?php $b->open_tag( 'cta-block' ); ?>
<div class="relative fb-section-lg px-4 lg:px-8">

	<!-- Forest background + repeating pattern -->
	<div class="pointer-events-none absolute inset-0" aria-hidden="true">
		<div class="absolute inset-0 bg-forest"></div>
		<div
			class="absolute inset-0 mix-blend-overlay opacity-[0.16]"
			style="background-image: url('<?php echo esc_url( $pattern_url ); ?>'); background-size: var(--fb-pattern-size);"
		></div>
	</div>

	<!-- Card -->
	<div class="relative mx-auto max-w-container-lg overflow-hidden rounded-container-md bg-forest shadow-card-elevated">
		<div class="flex flex-col lg:flex-row lg:items-stretch">

			<!-- Image (left on desktop, top on mobile) -->
			<?php if ( ! empty( $image['url'] ) ) : ?>
				<div class="relative aspect-[4/3] w-full shrink-0 lg:aspect-auto lg:w-[500px]">
					<img
						src="<?php echo esc_url( $image['url'] ); ?>"
						alt="<?php echo esc_attr( $image['alt'] ?? '' ); ?>"
						class="absolute inset-0 h-full w-full object-cover"
					/>
				</div>
			<?php endif; ?>

			<!-- Content (right on desktop, below on mobile) -->
			<div data-stagger="true" class="flex flex-1 flex-col items-start justify-center gap-4 px-6 pb-10 pt-6 lg:py-16 lg:pl-16 lg:pr-20">

				<?php if ( $title ) : ?>
					<h4 class="text-[#fff]">
						<?php echo esc_html( $title ); ?>
					</h4>
				<?php endif; ?>

				<?php if ( $content ) : ?>
					<div class="wysiwyg text-body-lg text-[#fff]">
						<?php echo wp_kses_post( $content ); ?>
					</div>
				<?php endif; ?>

				<?php if ( ! empty( $link['url'] ) ) : ?>
					<a
						href="<?php echo esc_url( $link['url'] ); ?>"
						<?php echo ! empty( $link['target'] ) ? 'target="' . esc_attr( $link['target'] ) . '" rel="noopener noreferrer"' : ''; ?>
						class="inline-flex items-center gap-2 rounded-container-xl bg-fire px-4 py-3 font-display text-button-md font-semibold text-[#fff] transition-shadow hover:shadow-card"
					>
						<?php echo esc_html( $link['title'] ?: 'Learn More' ); ?>
						<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" aria-hidden="true">
							<path d="M21 9L21 3M21 3H15M21 3L13 11M10 5H7.8C6.11984 5 5.27976 5 4.63803 5.32698C4.07354 5.6146 3.6146 6.07354 3.32698 6.63803C3 7.27976 3 8.11984 3 9.8V16.2C3 17.8802 3 18.7202 3.32698 19.362C3.6146 19.9265 4.07354 20.3854 4.63803 20.673C5.27976 21 6.11984 21 7.8 21H14.2C15.8802 21 16.7202 21 17.362 20.673C17.9265 20.3854 18.3854 19.9265 18.673 19.362C19 18.7202 19 17.8802 19 16.2V14" stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
						</svg>
					</a>
				<?php endif; ?>

			</div>

		</div>
	</div>

</div>
<?php $b->close_tag(); ?>
