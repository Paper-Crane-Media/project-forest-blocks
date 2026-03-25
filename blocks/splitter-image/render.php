<?php
/**
 * Splitter Image Block — render template.
 *
 * Two variants:
 *   - Default: white bg, text left / image right.
 *   - CTA Card: forest bg with pattern overlay, image left / text right inside a card.
 *
 * @param array  $block      The block settings and attributes.
 * @param string $content    The block inner HTML (empty for ACF blocks).
 * @param bool   $is_preview True during block preview in the editor.
 * @param int    $post_id    The post ID the block is rendering on.
 * @param array  $context    The context passed to the block.
 */

$b = new FB_Block( $block, $is_preview, $post_id );

$variant    = $b->field( 'variant', 'default' );
$eyebrow    = $b->field( 'eyebrow', '' );
$heading    = $b->field( 'heading', 'Think about the last time you sat under the shade of a tree.' );
$subheading = $b->field( 'subheading', '' );
$body       = $b->field( 'body', '' );
$cta        = $b->field( 'cta' );
$image      = $b->field( 'image' );
?>
<?php $b->open_tag( 'splitter-image' ); ?>

<?php if ( 'cta_card' === $variant ) : ?>

	<?php $pattern_url = FOREST_BLOCKS_URL . 'assets/images/pattern-forest.png'; ?>
	<div class="relative">

		<!-- Forest bg + repeating pattern -->
		<div class="pointer-events-none absolute inset-0" aria-hidden="true">
			<div class="absolute inset-0 bg-forest"></div>
			<div
				class="absolute inset-0 mix-blend-overlay opacity-[0.16]"
				style="background-image: url('<?php echo esc_url( $pattern_url ); ?>'); background-size: 86px 90px;"
			></div>
		</div>

		<!-- Card -->
		<div class="relative px-6 py-10 lg:px-8 lg:py-16">
			<div class="mx-auto max-w-container overflow-hidden rounded-container-md bg-forest shadow-card-elevated">
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
					<div data-stagger="true" class="flex flex-1 flex-col items-start justify-center p-6 lg:gap-16 lg:py-16 lg:pl-16 lg:pr-20">

						<?php if ( $heading ) : ?>
							<h2 class="pb-10 font-heading text-display-md font-semibold text-[#fff] lg:pb-0">
								<?php echo esc_html( $heading ); ?>
							</h2>
						<?php endif; ?>

						<?php echo fb_button( $cta ); ?>

					</div>

				</div>
			</div>
		</div>

	</div>

<?php else : ?>

	<div class="bg-[#fff] py-10 lg:py-16">

		<div class="mx-auto max-w-container px-6 lg:px-20">
			<div class="flex flex-col items-center gap-10 lg:flex-row lg:items-center lg:justify-between lg:gap-16">

				<!-- Content -->
				<div data-stagger="true" class="flex w-full flex-col items-start gap-4 lg:min-w-[480px] lg:flex-1">

					<?php if ( $eyebrow ) : ?>
						<div class="max-w-[768px]">
							<?php echo fb_eyebrow( $eyebrow ); ?>
						</div>
					<?php endif; ?>

					<?php if ( $heading ) : ?>
						<h2 class="max-w-[768px] font-heading text-display-md font-semibold text-forest">
							<?php echo esc_html( $heading ); ?>
						</h2>
					<?php endif; ?>

					<?php if ( $subheading ) : ?>
						<p class="font-heading text-display-sm text-forest">
							<?php echo esc_html( $subheading ); ?>
						</p>
					<?php endif; ?>

					<?php if ( $body ) : ?>
						<p class="font-body text-body-lg text-forest">
							<?php echo esc_html( $body ); ?>
						</p>
					<?php endif; ?>

					<?php echo fb_button( $cta, 'Learn More', 'mt-6' ); ?>

				</div>

				<!-- Image -->
				<div class="w-full shrink-0 lg:w-auto">
					<?php if ( ! empty( $image['url'] ) ) : ?>
						<div class="aspect-square w-full overflow-hidden rounded-container-md lg:size-[636px]">
							<img
								src="<?php echo esc_url( $image['url'] ); ?>"
								alt="<?php echo esc_attr( $image['alt'] ?? '' ); ?>"
								class="h-full w-full object-cover"
							/>
						</div>
					<?php endif; ?>
				</div>

			</div>
		</div>

	</div>

<?php endif; ?>

<?php $b->close_tag(); ?>
