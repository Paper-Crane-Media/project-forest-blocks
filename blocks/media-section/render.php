<?php
/**
 * Media Section — render template.
 *
 * Forest background with a large rounded image or video thumbnail.
 * If a YouTube URL is provided, the image becomes a clickable lightbox
 * trigger with a dark overlay and centered play button.
 *
 * @param array  $block      The block settings and attributes.
 * @param string $content    The block inner HTML (empty for ACF blocks).
 * @param bool   $is_preview True during block preview in the editor.
 * @param int    $post_id    The post ID the block is rendering on.
 * @param array  $context    The context passed to the block.
 */

$b = new FB_Block( $block, $is_preview, $post_id );

$variant = $b->field( 'variant', 'default' );
?>
<?php $b->open_tag( 'media-section' ); ?>

<?php if ( 'slider' === $variant ) : ?>
	<?php $gallery = $b->field( 'gallery', [] ); ?>
	<!-- Slider variant -->
	<div class="py-10">
		<div class="mx-auto w-[94%] max-w-container">
			<?php if ( ! empty( $gallery ) ) : ?>
				<div class="relative">
					<div class="media-section__swiper swiper overflow-hidden rounded-container-md">
						<div class="swiper-wrapper">
							<?php foreach ( $gallery as $img ) : ?>
								<div class="swiper-slide">
									<img
										src="<?php echo esc_url( $img['url'] ); ?>"
										alt="<?php echo esc_attr( $img['alt'] ?? '' ); ?>"
										class="w-full h-[39.75rem] object-cover"
									/>
								</div>
							<?php endforeach; ?>
						</div>

						<!-- Pagination dots -->
						<div class="media-section__pagination absolute bottom-[1.875rem] left-1/2 z-10 -translate-x-1/2 flex gap-4"></div>
					</div>

					<!-- Navigation arrows -->
					<button type="button" class="media-section__prev-btn absolute left-8 top-1/2 z-10 -translate-y-1/2 flex h-12 w-12 items-center justify-center rounded-container-xl bg-fire text-[#fff] transition-opacity" aria-label="<?php esc_attr_e( 'Previous slide', 'forest-blocks' ); ?>">
						<svg class="h-6 w-6" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24" aria-hidden="true"><path stroke-linecap="round" stroke-linejoin="round" d="M15 19l-7-7 7-7"/></svg>
					</button>
					<button type="button" class="media-section__next-btn absolute right-8 top-1/2 z-10 -translate-y-1/2 flex h-12 w-12 items-center justify-center rounded-container-xl bg-fire text-[#fff] transition-opacity" aria-label="<?php esc_attr_e( 'Next slide', 'forest-blocks' ); ?>">
						<svg class="h-6 w-6" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24" aria-hidden="true"><path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7"/></svg>
					</button>
				</div>
			<?php endif; ?>
		</div>
	</div>

<?php else : ?>
	<?php
	$image       = $b->field( 'image' );
	$youtube_url = $b->field( 'youtube_url', '' );
	$pattern_url = FOREST_BLOCKS_URL . 'assets/images/pattern-forest.png';
	?>
	<!-- Default variant -->
	<div class="relative py-10">

		<!-- Forest background + repeating pattern -->
		<div class="pointer-events-none absolute inset-0" aria-hidden="true">
			<div class="absolute inset-0 bg-forest"></div>
			<!-- <div
				class="absolute inset-0 mix-blend-overlay opacity-[0.16]"
				style="background-image: url('<?php echo esc_url( $pattern_url ); ?>'); background-size: var(--fb-pattern-size);"
			></div> -->
		</div>

		<div class="relative fb-container">

			<?php if ( $youtube_url ) : ?>
				<a
					href="<?php echo esc_url( $youtube_url ); ?>"
					data-fancybox
					class="group relative block w-full overflow-hidden rounded-container-md cursor-pointer"
					aria-label="<?php esc_attr_e( 'Play video', 'forest-blocks' ); ?>"
				>
			<?php elseif ( ! empty( $image['url'] ) ) : ?>
				<a
					href="<?php echo esc_url( $image['url'] ); ?>"
					data-fancybox
					class="group relative block w-full overflow-hidden rounded-container-md cursor-pointer"
					aria-label="<?php echo esc_attr( $image['alt'] ?? '' ); ?>"
				>
			<?php else : ?>
				<div class="relative w-full overflow-hidden rounded-container-md">
			<?php endif; ?>

				<?php if ( ! empty( $image['url'] ) ) : ?>
					<img
						src="<?php echo esc_url( $image['url'] ); ?>"
						alt="<?php echo esc_attr( $image['alt'] ?? '' ); ?>"
						class="w-full h-auto max-h-[39.75rem] object-cover transition-transform duration-500 group-hover:scale-105"
					/>
				<?php endif; ?>

				<?php if ( $youtube_url ) : ?>
					<!-- Dark overlay for video -->
					<div class="absolute inset-0 bg-black/[.33] transition-colors duration-300 group-hover:bg-black/40"></div>

					<!-- Play button -->
					<div class="pointer-events-none absolute left-1/2 top-1/2 -translate-x-1/2 -translate-y-1/2 text-white transition-transform duration-300 group-hover:scale-110 h-10 w-10 lg:h-[131px] lg:w-[131px]">
						<?php include FOREST_BLOCKS_PATH . 'assets/images/play-circle.svg'; ?>
					</div>
				<?php endif; ?>

			<?php if ( $youtube_url || ! empty( $image['url'] ) ) : ?>
				</a>
			<?php else : ?>
				</div>
			<?php endif; ?>

		</div>

	</div>
<?php endif; ?>

<?php $b->close_tag(); ?>
