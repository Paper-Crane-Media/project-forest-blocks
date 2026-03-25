<?php
/**
 * Event Section Block — render template.
 *
 * Three-zone layout:
 *   1. Dark forest hero — left text/features checklist, right image mosaic.
 *   2. Decorative trees overlapping the section boundary.
 *   3. Fire CTA bar with heading + link button groups.
 *
 * @param array  $block      The block settings and attributes.
 * @param string $content    The block inner HTML (empty for ACF blocks).
 * @param bool   $is_preview True during block preview in the editor.
 * @param int    $post_id    The post ID the block is rendering on.
 * @param array  $context    The context passed to the block.
 */

$b = new FB_Block( $block, $is_preview, $post_id );

$eyebrow        = $b->field( 'eyebrow', '' );
$heading        = $b->field( 'heading', '' );
$subheading     = $b->field( 'subheading', '' );
$body           = $b->field( 'body', '' );
$features_label = $b->field( 'features_label', 'Your contribution includes:' );
$features       = $b->field( 'features', [] );
$images         = $b->field( 'images', [] );
$cta_links      = $b->field( 'cta_links', [] );
?>
<?php $b->open_tag( 'event-section' ); ?>

<!-- Zone 1: Dark forest hero -->
<div class="bg-forest relative overflow-hidden">
	<div class="fb-container py-6 lg:pb-12 lg:pt-10">
		<div class="flex flex-col gap-6 lg:flex-row lg:items-start">

			<!-- Left column: text + features -->
			<div class="flex flex-1 flex-col">

				<!-- Header group -->
				<div class="flex flex-col gap-4 pb-10" data-stagger="true">
					<div class="flex max-w-[768px] flex-col gap-3">
						<?php if ( $eyebrow ) : ?>
							<div>
								<?php echo fb_eyebrow( $eyebrow, 'text-eyebrow-md', 'bg-forest-80' ); ?>
							</div>
						<?php endif; ?>

						<?php if ( $heading ) : ?>
							<h4 class="text-[#fff]">
								<?php echo esc_html( $heading ); ?>
							</h4>
						<?php endif; ?>
					</div>

					<?php if ( $subheading ) : ?>
						<h5 class="text-[#fff]">
							<?php echo esc_html( $subheading ); ?>
						</h5>
					<?php endif; ?>

					<?php if ( $body ) : ?>
						<p class="text-[#fff]">
							<?php echo esc_html( $body ); ?>
						</p>
					<?php endif; ?>
				</div>

				<!-- Features checklist -->
				<?php if ( ! empty( $features ) ) : ?>
					<div class="flex flex-col gap-3">
						<?php if ( $features_label ) : ?>
							<p class="text-body-md font-semibold text-[#fff]">
								<?php echo esc_html( $features_label ); ?>
							</p>
						<?php endif; ?>

						<div class="columns-1 gap-3 lg:columns-2" data-stagger="true">
							<?php foreach ( $features as $feature ) : ?>
								<?php if ( ! empty( $feature['text'] ) ) : ?>
									<div class="mb-2 flex break-inside-avoid items-start gap-2">
										<svg class="h-6 w-6 shrink-0 text-fire" fill="currentColor" viewBox="0 0 24 24" aria-hidden="true">
											<path fill-rule="evenodd" d="M2.25 12c0-5.385 4.365-9.75 9.75-9.75s9.75 4.365 9.75 9.75-4.365 9.75-9.75 9.75S2.25 17.385 2.25 12zm13.36-1.814a.75.75 0 10-1.22-.872l-3.236 4.53L9.53 12.22a.75.75 0 00-1.06 1.06l2.25 2.25a.75.75 0 001.14-.094l3.75-5.25z" clip-rule="evenodd" />
										</svg>
										<p class="text-body-md text-[#fff]">
											<?php echo esc_html( $feature['text'] ); ?>
										</p>
									</div>
								<?php endif; ?>
							<?php endforeach; ?>
						</div>
					</div>
				<?php endif; ?>

			</div>

			<!-- Right column: image mosaic (2x2 asymmetric grid) -->
			<?php if ( ! empty( $images ) ) : ?>
				<div class="w-full lg:w-[636px] lg:shrink-0">
					<div class="flex h-[375px] gap-1 lg:h-[564px]">
						<!-- Column 1: tall top, short bottom -->
						<div class="flex flex-1 flex-col gap-1" data-stagger="true">
							<?php if ( ! empty( $images[0]['image'] ) ) : ?>
								<div class="flex-[1.58] min-h-0 overflow-hidden rounded-container-md">
									<?php echo wp_get_attachment_image(
										$images[0]['image']['ID'],
										'large',
										false,
										[ 'class' => 'h-full w-full object-cover' ]
									); ?>
								</div>
							<?php endif; ?>
							<?php if ( ! empty( $images[1]['image'] ) ) : ?>
								<div class="flex-1 min-h-0 overflow-hidden rounded-container-md">
									<?php echo wp_get_attachment_image(
										$images[1]['image']['ID'],
										'medium_large',
										false,
										[ 'class' => 'h-full w-full object-cover' ]
									); ?>
								</div>
							<?php endif; ?>
						</div>
						<!-- Column 2: short top, tall bottom -->
						<div class="flex flex-1 flex-col gap-1" data-stagger="true">
							<?php if ( ! empty( $images[2]['image'] ) ) : ?>
								<div class="flex-1 min-h-0 overflow-hidden rounded-container-md">
									<?php echo wp_get_attachment_image(
										$images[2]['image']['ID'],
										'medium_large',
										false,
										[ 'class' => 'h-full w-full object-cover' ]
									); ?>
								</div>
							<?php endif; ?>
							<?php if ( ! empty( $images[3]['image'] ) ) : ?>
								<div class="flex-[1.58] min-h-0 overflow-hidden rounded-container-md">
									<?php echo wp_get_attachment_image(
										$images[3]['image']['ID'],
										'large',
										false,
										[ 'class' => 'h-full w-full object-cover' ]
									); ?>
								</div>
							<?php endif; ?>
						</div>
					</div>
				</div>
			<?php endif; ?>

		</div>
	</div>

	<!-- Decorative trees (mobile) -->
	<div class="flex items-end justify-end gap-6 px-4 pb-6 text-forest-5 lg:hidden" aria-hidden="true" data-stagger="true" data-tree-grow-group>
		<div class="h-[90px] w-auto" data-tree-grow="round">
			<?php include FOREST_BLOCKS_PATH . 'assets/images/tree-round.svg'; ?>
		</div>
		<div class="h-[137px] w-auto" data-tree-grow="simple" data-tree-delay="0.2">
			<?php include FOREST_BLOCKS_PATH . 'assets/images/tree-simple.svg'; ?>
		</div>
	</div>

	<!-- Decorative trees (desktop) -->
	<div class="pointer-events-none absolute bottom-0 right-[18%] hidden items-end gap-6 text-[#fff] lg:flex" aria-hidden="true" data-stagger="true" data-tree-grow-group>
		<div class="h-[90px]" data-tree-grow="round">
			<?php include FOREST_BLOCKS_PATH . 'assets/images/tree-round.svg'; ?>
		</div>
		<div class="h-[138px]" data-tree-grow="simple" data-tree-delay="0.2">
			<?php include FOREST_BLOCKS_PATH . 'assets/images/tree-simple.svg'; ?>
		</div>
	</div>
</div>

<!-- Zone 2: Fire CTA bar -->
<?php if ( ! empty( $cta_links ) ) : ?>
	<div class="bg-fire px-4 py-4 lg:px-10 lg:py-6">
		<div class="fb-container rounded-container-md bg-fire-60 p-6">
			<div class="flex flex-col gap-6">
				<?php foreach ( $cta_links as $cta ) : ?>
					<?php
					$cta_heading = $cta['heading'] ?? '';
					$cta_link    = $cta['link'] ?? [];
					?>
					<?php if ( $cta_heading || ! empty( $cta_link['url'] ) ) : ?>
						<div class="flex flex-col gap-4">
							<?php if ( $cta_heading ) : ?>
								<h6 class="text-[#fff]">
									<?php echo esc_html( $cta_heading ); ?>
								</h6>
							<?php endif; ?>

							<?php echo fb_text_link( $cta_link ); ?>
						</div>
					<?php endif; ?>
				<?php endforeach; ?>
			</div>
		</div>
	</div>
<?php endif; ?>

<?php $b->close_tag(); ?>
