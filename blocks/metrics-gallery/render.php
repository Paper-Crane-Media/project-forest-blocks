<?php
/**
 * Metrics & Gallery Block — render template.
 *
 * Side-by-side metrics grid (left) and image gallery slider (right).
 * Gallery uses Swiperjs for carousel functionality.
 *
 * @param array  $block      The block settings and attributes.
 * @param string $content    The block inner HTML (empty for ACF blocks).
 * @param bool   $is_preview True during block preview in the editor.
 * @param int    $post_id    The post ID the block is rendering on.
 * @param array  $context    The context passed to the block.
 */

$b = new FB_Block( $block, $is_preview, $post_id );

$eyebrow     = $b->field( 'eyebrow', '' );
$heading     = $b->field( 'heading', '' );
$subheading  = $b->field( 'subheading', '' );
$metrics     = $b->field( 'metrics', [] );
$images      = $b->field( 'images', [] );
?>

<?php $b->open_tag( 'metrics-gallery' ); ?>

	<div class="bg-[#fff] py-10 lg:py-20">

		<?php if ( $eyebrow || $heading || $subheading ) : ?>

			<!-- Header Section -->
			<div class="mx-auto max-w-container px-6 lg:px-20 pb-10 lg:pb-16">

				<!-- Header Groups -->
				<div class="flex flex-col gap-4 pb-10 lg:pb-16">

					<?php if ( $eyebrow ) : ?>
						<div class="inline-flex">
							<?php echo fb_eyebrow( $eyebrow ); ?>
						</div>
					<?php endif; ?>

					<?php if ( $heading ) : ?>
						<h2 class="font-heading text-display-md font-semibold text-forest max-w-[768px]">
							<?php echo esc_html( $heading ); ?>
						</h2>
					<?php endif; ?>

					<?php if ( $subheading ) : ?>
						<p class="font-heading text-display-sm text-forest max-w-[768px]">
							<?php echo esc_html( $subheading ); ?>
						</p>
					<?php endif; ?>

				</div>

			</div>

		<?php endif; ?>

		<?php if ( ! empty( $metrics ) || ! empty( $images ) ) : ?>

			<!-- Main Content: Metrics + Gallery -->
			<div class="px-6 lg:px-20">

				<div class="flex flex-col lg:flex-row lg:gap-10 lg:items-start">

					<!-- Left: Metrics Grid -->
					<?php if ( ! empty( $metrics ) ) : ?>

						<div class="flex flex-wrap gap-6 flex-1">

							<?php foreach ( $metrics as $metric ) : ?>

								<?php
								$number = $metric['number'] ?? '';
								$label  = $metric['label'] ?? '';
								?>

								<?php if ( $number && $label ) : ?>

									<div class="bg-[#fff] px-6 py-8 rounded-container-sm shadow-sm flex flex-col items-center justify-center text-center min-h-[224px] min-w-[240px] max-w-[400px] flex-1">

										<div class="flex flex-col gap-4 w-full">

											<!-- Number -->
											<p class="font-heading text-display-lg font-semibold text-forest">
												<?php echo esc_html( $number ); ?>
											</p>

											<!-- Label -->
											<p class="font-body text-body-lg font-semibold text-water">
												<?php echo esc_html( $label ); ?>
											</p>

										</div>

									</div>

								<?php endif; ?>

							<?php endforeach; ?>

						</div>

					<?php endif; ?>

					<!-- Right: Gallery Slider -->
					<?php if ( ! empty( $images ) ) : ?>

						<div class="flex flex-col gap-6 w-full lg:w-[621px] lg:flex-shrink-0 mt-10 lg:mt-0">

							<!-- Swiper Container -->
							<div class="swiper metrics-gallery__swiper h-[280px] lg:h-[436px] rounded-container-md overflow-hidden" data-swiper-init="true">

								<div class="swiper-wrapper">

									<?php foreach ( $images as $slide ) : ?>

										<?php
										$image_array = $slide['image'] ?? [];
										$alt_text    = $slide['alt'] ?? '';

										if ( is_array( $image_array ) ) {
											$image_url = $image_array['url'] ?? '';
										} else {
											$image_url = wp_get_attachment_url( $image_array );
										}
										?>

										<?php if ( $image_url ) : ?>

											<div class="swiper-slide relative">
												<img
													src="<?php echo esc_url( $image_url ); ?>"
													alt="<?php echo esc_attr( $alt_text ); ?>"
													class="absolute inset-0 h-full w-full object-cover"
												/>
											</div>

										<?php endif; ?>

									<?php endforeach; ?>

								</div>

							</div>

							<!-- Gallery Controls -->
							<div class="border border-[#fff] border-solid backdrop-blur-3xl bg-forest bg-opacity-30 flex items-center justify-between p-4 rounded-container-xxl">

								<!-- Label -->
								<p class="font-heading text-display-xs font-semibold text-forest">
									<?php esc_html_e( 'Project photos', 'forest-blocks' ); ?>
								</p>

								<!-- Navigation Buttons -->
								<div class="flex gap-10 items-center">

									<!-- Prev Button -->
									<button
										class="metrics-gallery__prev-btn bg-fire rounded-container-xl p-3 flex items-center justify-center hover:opacity-90 transition-opacity"
										aria-label="<?php esc_attr_e( 'Previous image', 'forest-blocks' ); ?>"
									>
										<svg class="h-6 w-6 text-[#fff]" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
											<path stroke-linecap="round" stroke-linejoin="round" d="M15 19l-7-7 7-7"></path>
										</svg>
									</button>

									<!-- Next Button -->
									<button
										class="metrics-gallery__next-btn bg-fire rounded-container-xl p-3 flex items-center justify-center hover:opacity-90 transition-opacity"
										aria-label="<?php esc_attr_e( 'Next image', 'forest-blocks' ); ?>"
									>
										<svg class="h-6 w-6 text-[#fff]" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
											<path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7"></path>
										</svg>
									</button>

								</div>

							</div>

						</div>

					<?php endif; ?>

				</div>

			</div>

		<?php endif; ?>

	</div>

<?php $b->close_tag(); ?>
