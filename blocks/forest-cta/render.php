<?php
/**
 * Forest CTA Block — render template.
 *
 * Display heading with decorative forest silhouette, followed by a dark
 * forest-colored card with content and CTA buttons on an air background.
 *
 * @param array  $block      The block settings and attributes.
 * @param string $content    The block inner HTML (empty for ACF blocks).
 * @param bool   $is_preview True during block preview in the editor.
 * @param int    $post_id    The post ID the block is rendering on.
 * @param array  $context    The context passed to the block.
 */

$b = new FB_Block( $block, $is_preview, $post_id );

$heading      = $b->field( 'heading', '' );
$card_heading = $b->field( 'card_heading', '' );
$card_body    = $b->field( 'card_body', '' );
$caption      = $b->field( 'caption', '' );
$buttons      = $b->field( 'buttons', [] );

$silhouette_url = FOREST_BLOCKS_URL . 'assets/images/forest-silhouette.svg';
?>
<?php $b->open_tag( 'forest-cta' ); ?>

<div class="relative overflow-hidden">

	<!-- ── Heading area ─────────────────────────────────────────────── -->
	<div class="relative z-10 fb-container pt-16">
		<?php if ( $heading ) : ?>
			<div class="max-w-[980px] pb-10">
				<h2 class="font-display">
					<?php echo esc_html( $heading ); ?>
				</h2>
			</div>
		<?php endif; ?>
	</div>

	<!-- ── Forest silhouette (decorative) ───────────────────────────── -->
	<div class="pointer-events-none relative z-0 -mt-10 lg:-mt-20 min-h-[120px] lg:min-h-[280px]" aria-hidden="true">
		<img
			src="<?php echo esc_url( $silhouette_url ); ?>"
			alt=""
			loading="eager"
			fetchpriority="high"
			class="block w-[120%] max-w-[120%] -translate-x-[10%] translate-y-12 object-contain"
		/>
	</div>

	<!-- ── Air background section ───────────────────────────────────── -->
	<div class="bg-air">
		<div class="relative fb-container pb-10">

			<!-- Decorative vector trees (positioned above the card) -->
			<div class="pointer-events-none relative h-0 text-forest" aria-hidden="true" data-tree-grow-group>
				<!-- Simple tree (left) -->
				<div class="absolute bottom-0 left-[3%] h-[110px] w-[49px]" data-tree-grow="simple">
					<?php include FOREST_BLOCKS_PATH . 'assets/images/tree-simple.svg'; ?>
				</div>

				<!-- Right tree group -->
				<div class="absolute bottom-0 right-[6%] flex items-end gap-6">
					<!-- Round tree -->
					<div class="h-[90px] w-[62px]" data-tree-grow="round" data-tree-delay="0.2">
						<?php include FOREST_BLOCKS_PATH . 'assets/images/tree-round.svg'; ?>
					</div>
					<!-- Pine tree -->
					<div class="h-[137px] w-[62px]" data-tree-grow="pine" data-tree-delay="0.4">
						<?php include FOREST_BLOCKS_PATH . 'assets/images/tree-pine.svg'; ?>
					</div>
				</div>
			</div>

			<!-- ── Dark CTA card ────────────────────────────────────────── -->
			<div class="flex flex-col gap-10 rounded-container-md bg-forest p-6 shadow-sm lg:flex-row lg:items-end lg:p-10">

				<!-- Left: heading + body -->
				<div class="flex flex-1 flex-col gap-4 lg:pb-10">
					<?php if ( $card_heading ) : ?>
						<h3 class="text-[#fff]">
							<?php echo esc_html( $card_heading ); ?>
						</h3>
					<?php endif; ?>

					<?php if ( $card_body ) : ?>
						<p class="text-[#fff]">
							<?php echo esc_html( $card_body ); ?>
						</p>
					<?php endif; ?>
				</div>

				<!-- Right: caption + buttons -->
				<?php if ( $caption || ! empty( $buttons ) ) : ?>
					<div class="flex shrink-0 flex-col justify-center gap-4 p-6 lg:w-[328px] lg:rounded-container-lg">
						<?php if ( $caption ) : ?>
							<p class="font-semibold text-[#fff]">
								<?php echo esc_html( $caption ); ?>
							</p>
						<?php endif; ?>

						<?php if ( ! empty( $buttons ) ) : ?>
							<div class="flex flex-wrap gap-4">
								<?php foreach ( $buttons as $btn ) : ?>
									<?php echo fb_button( $btn['link'] ?? [] ); ?>
								<?php endforeach; ?>
							</div>
						<?php endif; ?>
					</div>
				<?php endif; ?>

			</div>

		</div>
	</div>

</div>

<?php $b->close_tag(); ?>
