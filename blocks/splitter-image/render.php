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

$variant            = $b->field( 'variant', 'default' );
$container_position = $b->field( 'container_position', 'bottom_left' );
$eyebrow            = $b->field( 'eyebrow', '' );
$heading            = $b->field( 'heading', 'Think about the last time you sat under the shade of a tree.' );
$subheading         = $b->field( 'subheading', '' );
$body               = $b->field( 'body', '' );
$cta                = $b->field( 'cta' );
$image              = $b->field( 'image' );
?>
<?php $b->open_tag( 'splitter-image' ); ?>

<?php if ( 'full_background' === $variant ) : ?>

	<?php $pattern_url = FOREST_BLOCKS_URL . 'assets/images/pattern-forest.png'; ?>
	<div class="relative px-6 py-8 lg:px-8">

		<!-- Forest bg + repeating pattern -->
		<div class="pointer-events-none absolute inset-0" aria-hidden="true">
			<div class="absolute inset-0 bg-forest"></div>
			<div
				class="absolute inset-0 mix-blend-overlay opacity-[0.16]"
				style="background-image: url('<?php echo esc_url( $pattern_url ); ?>'); background-size: var(--fb-pattern-size);"
			></div>
		</div>

		<!-- Image frame -->
		<div class="relative mx-auto w-full rounded-container-lg overflow-hidden p-6">

			<!-- Full-bleed background image -->
			<?php if ( ! empty( $image['url'] ) ) : ?>
				<img
					src="<?php echo esc_url( $image['url'] ); ?>"
					alt="<?php echo esc_attr( $image['alt'] ?? '' ); ?>"
					class="absolute inset-0 h-full w-full object-cover pointer-events-none"
				/>
			<?php endif; ?>

			<!-- Content card -->
			<?php $card_align = 'bottom_right' === $container_position ? 'items-end' : 'items-start'; ?>
			<div class="relative mt-auto flex flex-col justify-end <?php echo esc_attr( $card_align ); ?> h-full">
				<div class="w-full lg:max-w-[736px] rounded-container-lg bg-[rgba(255,255,255,0.95)] pl-6 pr-6 pt-6 lg:pl-10 lg:pr-8 lg:pt-10">
					<div data-stagger="true" class="flex flex-col items-start gap-4 max-w-[936px] pb-6 lg:pb-10">

						<?php if ( $eyebrow ) : ?>
							<?php echo fb_eyebrow( $eyebrow ); ?>
						<?php endif; ?>

						<?php if ( $heading ) : ?>
							<h4 class="max-w-[768px]">
								<?php echo esc_html( $heading ); ?>
							</h4>
						<?php endif; ?>

						<?php if ( $body ) : ?>
							<div class="wysiwyg">
								<?php echo wp_kses_post( $body ); ?>
							</div>
						<?php endif; ?>

						<?php echo fb_button( $cta, 'Learn More', 'mt-2' ); ?>

					</div>
				</div>
			</div>

		</div>

	</div>

<?php elseif ( 'cta_card' === $variant ) : ?>

	<?php $pattern_url = FOREST_BLOCKS_URL . 'assets/images/pattern-forest.png'; ?>
	<div class="relative">

		<!-- Forest bg + repeating pattern -->
		<div class="pointer-events-none absolute inset-0" aria-hidden="true">
			<div class="absolute inset-0 bg-forest"></div>
			<div
				class="absolute inset-0 mix-blend-overlay opacity-[0.16]"
				style="background-image: url('<?php echo esc_url( $pattern_url ); ?>'); background-size: var(--fb-pattern-size);"
			></div>
		</div>

		<!-- Card -->
		<div class="relative px-6 fb-section-sm lg:px-8">
			<div class="fb-container overflow-hidden rounded-container-md bg-forest shadow-card-elevated">
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
					<div data-stagger="true" class="flex flex-1 flex-col items-start justify-center gap-4 p-6 lg:py-16 lg:pl-16 lg:pr-20">

						<?php if ( $heading ) : ?>
							<h4 class="text-[#fff]">
								<?php echo esc_html( $heading ); ?>
							</h4>
						<?php endif; ?>

						<?php if ( $subheading ) : ?>
							<h5 class="text-[#fff]">
								<?php echo esc_html( $subheading ); ?>
							</h5>
						<?php endif; ?>

						<?php if ( $body ) : ?>
							<div class="wysiwyg text-[#fff]">
								<?php echo wp_kses_post( $body ); ?>
							</div>
						<?php endif; ?>

						<?php echo fb_button( $cta ); ?>

					</div>

				</div>
			</div>
		</div>

	</div>

<?php else : ?>

	<div class="relative bg-[#fff] fb-section-sm">

		<!-- Decorative trees (bottom-left, desktop only) -->
		<div class="pointer-events-none absolute bottom-0 left-20 hidden items-end gap-7 text-forest lg:flex" aria-hidden="true" data-tree-grow-group>
			<div class="h-[114px] w-[52px]" data-tree-grow="pine" data-tree-delay="0.4">
				<?php include FOREST_BLOCKS_PATH . 'assets/images/tree-pine.svg'; ?>
			</div>
			<div class="h-[83px] w-[37px]" data-tree-grow="simple">
				<?php include FOREST_BLOCKS_PATH . 'assets/images/tree-simple.svg'; ?>
			</div>
			<div class="ml-20 h-[61px] w-[42px]" data-tree-grow="round" data-tree-delay="0.2">
				<?php include FOREST_BLOCKS_PATH . 'assets/images/tree-round.svg'; ?>
			</div>
		</div>

		<div class="fb-container">
			<div class="flex flex-col items-center gap-10 lg:flex-row lg:items-center lg:justify-between lg:gap-16">

				<!-- Content -->
				<div data-stagger="true" class="flex w-full flex-col items-start gap-4 lg:min-w-[480px] lg:flex-1">

					<?php if ( $eyebrow ) : ?>
						<div class="max-w-[768px]">
							<?php echo fb_eyebrow( $eyebrow ); ?>
						</div>
					<?php endif; ?>

					<?php if ( $heading ) : ?>
						<h4 class="max-w-[768px]">
							<?php echo esc_html( $heading ); ?>
						</h4>
					<?php endif; ?>

					<?php if ( $subheading ) : ?>
						<h5>
							<?php echo esc_html( $subheading ); ?>
						</h5>
					<?php endif; ?>

					<?php if ( $body ) : ?>
						<div class="wysiwyg">
							<?php echo wp_kses_post( $body ); ?>
						</div>
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
