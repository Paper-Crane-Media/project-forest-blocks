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
			<div class="mx-auto w-[94%] max-w-container pb-10 lg:pb-16">

				<!-- Header Groups -->
				<div class="flex flex-col gap-4 pb-10 lg:pb-16">

					<?php if ( $eyebrow ) : ?>
						<div class="inline-flex">
							<?php echo fb_eyebrow( $eyebrow ); ?>
						</div>
					<?php endif; ?>

					<?php if ( $heading ) : ?>
						<h4 class="max-w-[768px]">
							<?php echo esc_html( $heading ); ?>
						</h4>
					<?php endif; ?>

					<?php if ( $subheading ) : ?>
						<h5 class="max-w-[768px]">
							<?php echo esc_html( $subheading ); ?>
						</h5>
					<?php endif; ?>

				</div>

			</div>

		<?php endif; ?>

		<?php if ( ! empty( $metrics ) || ! empty( $images ) ) : ?>

			<!-- Main Content: Metrics + Gallery -->
			<div class="mx-auto w-[94%] max-w-container">

				<div class="flex flex-col lg:flex-row lg:gap-10 lg:items-start">

					<!-- Left: Metrics Grid -->
					<?php if ( ! empty( $metrics ) ) : ?>

						<div class="grid grid-cols-1 lg:grid-cols-2 gap-6 flex-1">

							<?php
							$metric_count = count( $metrics );
							$index        = 0;
							?>

							<?php foreach ( $metrics as $metric ) : ?>

								<?php
								$number  = $metric['number'] ?? '';
								$label   = $metric['label'] ?? '';
								$is_last = ( $index === $metric_count - 1 );
								$spans   = ( $is_last && $metric_count % 2 === 1 ) ? ' lg:col-span-2' : '';
								$index++;
								?>

								<?php if ( $number && $label ) : ?>

									<?php
									// Parse the metric number: extract prefix, numeric value, and suffix.
									// Handles formats like "92,000+", "$1,500", "13", "356,000 ", etc.
									preg_match( '/^([^0-9]*)([0-9][0-9,]*)(.*)$/', trim( $number ), $parts );
									$prefix    = isset( $parts[1] ) ? $parts[1] : '';
									$raw       = isset( $parts[2] ) ? str_replace( ',', '', $parts[2] ) : '0';
									$suffix    = isset( $parts[3] ) ? trim( $parts[3] ) : '';
									$end_value = intval( $raw );
									$use_commas = ( strpos( $parts[2] ?? '', ',' ) !== false ) ? 'true' : 'false';
									?>

									<div class="bg-[#fff] px-6 py-8 rounded-container-sm shadow-sm flex flex-col items-center justify-center text-center min-h-[224px]<?php echo $spans; ?>">

										<div class="flex flex-col gap-4 w-full">

											<!-- Number -->
											<p class="font-heading text-display-lg font-semibold text-forest metrics-gallery__number"
												data-count-to="<?php echo esc_attr( $end_value ); ?>"
												data-count-prefix="<?php echo esc_attr( $prefix ); ?>"
												data-count-suffix="<?php echo esc_attr( $suffix ); ?>"
												data-count-commas="<?php echo esc_attr( $use_commas ); ?>"
											>
												<?php echo esc_html( $prefix ); ?>0<?php echo esc_html( $suffix ); ?>
											</p>

											<!-- Label -->
											<p class="font-semibold text-water">
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
							<div class="swiper metrics-gallery__swiper w-full h-[280px] lg:h-[436px] rounded-container-md overflow-hidden" data-swiper-init="true">

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

											<div class="swiper-slide relative h-full">
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
							<div class="relative flex items-center justify-between p-4 rounded-[128px] overflow-hidden">
								<div class="absolute inset-0 backdrop-blur-[12px] bg-forest/10 mix-blend-lighten pointer-events-none rounded-[128px]" aria-hidden="true"></div>

								<!-- Label -->
								<h6 class="relative text-display-xs font-semibold text-forest">
									<?php esc_html_e( 'Project photos', 'forest-blocks' ); ?>
								</h6>

								<!-- Navigation Buttons -->
								<div class="relative flex gap-10 items-center">

									<!-- Prev Button -->
									<button
										class="metrics-gallery__prev-btn bg-fire rounded-container-xl p-3 flex items-center justify-center border-0 hover:opacity-90 transition-opacity"
										aria-label="<?php esc_attr_e( 'Previous image', 'forest-blocks' ); ?>"
									>
										<svg class="h-6 w-6 text-white" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
											<path stroke-linecap="round" stroke-linejoin="round" d="M19 12H5M5 12l6-6M5 12l6 6"></path>
										</svg>
									</button>

									<!-- Next Button -->
									<button
										class="metrics-gallery__next-btn bg-fire rounded-container-xl p-3 flex items-center justify-center border-0 hover:opacity-90 transition-opacity"
										aria-label="<?php esc_attr_e( 'Next image', 'forest-blocks' ); ?>"
									>
										<svg class="h-6 w-6 text-white" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
											<path stroke-linecap="round" stroke-linejoin="round" d="M5 12h14M19 12l-6-6M19 12l-6 6"></path>
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
