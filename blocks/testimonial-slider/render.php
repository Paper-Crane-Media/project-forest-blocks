<?php
/**
 * Testimonial Slider Block — render template.
 *
 * Horizontal Swiper carousel of testimonial cards on an air background
 * with decorative animated tree SVGs.
 *
 * @param array  $block      The block settings and attributes.
 * @param string $content    The block inner HTML (empty for ACF blocks).
 * @param bool   $is_preview True during block preview in the editor.
 * @param int    $post_id    The post ID the block is rendering on.
 * @param array  $context    The context passed to the block.
 */

$b = new FB_Block( $block, $is_preview, $post_id );

$testimonials = $b->field( 'testimonials', [] );
?>
<?php $b->open_tag( 'testimonial-slider' ); ?>

	<div class="bg-air py-10">

		<!-- Decorative trees -->
		<div class="px-4 lg:px-0 lg:mx-auto lg:w-[94%] lg:max-w-container">
			<div class="flex items-end justify-end gap-4 pb-2 text-forest" aria-hidden="true" data-tree-grow-group>
				<div class="h-[60px] w-[36px] lg:h-[89px] lg:w-[54px]" data-tree-grow="simple">
					<?php include FOREST_BLOCKS_PATH . 'assets/images/tree-simple.svg'; ?>
				</div>
				<div class="h-[70px] w-[38px] lg:h-[104px] lg:w-[56px]" data-tree-grow="triangle" data-tree-delay="0.2">
					<?php include FOREST_BLOCKS_PATH . 'assets/images/tree-triangle.svg'; ?>
				</div>
			</div>
		</div>

		<?php if ( ! empty( $testimonials ) ) : ?>

			<!-- Slider -->
			<div class="flex flex-col gap-3 lg:gap-6">

				<!-- Swiper -->
				<div class="swiper testimonial-slider__swiper pl-0 lg:pl-[calc((100%-1260px)/2)]">
					<div class="swiper-wrapper">

						<?php foreach ( $testimonials as $item ) :
							$attribution = $item['attribution'] ?? '';
							$title       = $item['title'] ?? '';
							$testimonial = $item['testimonial'] ?? '';
							$avatar      = $item['avatar'] ?? [];
						?>

							<div class="swiper-slide" style="width: auto;">
								<div class="w-[100vw] lg:w-[1280px] rounded-tl-container-lg rounded-tr-container-lg rounded-bl-container-md rounded-br-container-md bg-forest p-4 lg:p-10 overflow-hidden">

									<!-- Mobile layout: stacked -->
									<div class="flex flex-col gap-6 lg:hidden">

										<!-- Top row: avatar + quote mark -->
										<div class="flex items-start justify-between gap-6">
											<?php if ( ! empty( $avatar['url'] ) ) : ?>
												<div class="size-[80px] rounded-full overflow-hidden shrink-0">
													<img
														src="<?php echo esc_url( $avatar['url'] ); ?>"
														alt="<?php echo esc_attr( $avatar['alt'] ?? '' ); ?>"
														class="h-full w-full object-cover"
													/>
												</div>
											<?php endif; ?>
											<span class="shrink-0 font-heading text-[96px] leading-[89px] text-forest-80 select-none" aria-hidden="true">&ldquo;</span>
										</div>

										<!-- Attribution -->
										<div class="flex flex-col gap-2">
											<?php if ( $attribution ) : ?>
												<h6 class="text-air"><?php echo esc_html( $attribution ); ?></h6>
											<?php endif; ?>
											<?php if ( $title ) : ?>
												<p class="text-body-lg text-[#fff]"><?php echo esc_html( $title ); ?></p>
											<?php endif; ?>
										</div>

										<!-- Testimonial -->
										<?php if ( $testimonial ) : ?>
											<div class="wysiwyg text-[#fff] text-body-md pb-6">
												<?php echo wp_kses_post( $testimonial ); ?>
											</div>
										<?php endif; ?>

									</div>

									<!-- Desktop layout: side by side -->
									<div class="hidden lg:flex lg:flex-row lg:gap-6 lg:items-center">

										<!-- Attribution column -->
										<div class="flex flex-col gap-4 items-start shrink-0 w-[230px]">
											<?php if ( ! empty( $avatar['url'] ) ) : ?>
												<div class="size-[112px] rounded-full overflow-hidden shrink-0">
													<img
														src="<?php echo esc_url( $avatar['url'] ); ?>"
														alt="<?php echo esc_attr( $avatar['alt'] ?? '' ); ?>"
														class="h-full w-full object-cover"
													/>
												</div>
											<?php endif; ?>
											<div class="flex flex-col gap-2 text-[#fff]">
												<?php if ( $attribution ) : ?>
													<h6><?php echo esc_html( $attribution ); ?></h6>
												<?php endif; ?>
												<?php if ( $title ) : ?>
													<p class="text-body-lg"><?php echo esc_html( $title ); ?></p>
												<?php endif; ?>
											</div>
										</div>

										<!-- Quote column -->
										<div class="flex flex-1 gap-6 items-start">
											<span class="shrink-0 font-heading text-[96px] leading-[89px] text-forest-80 select-none" aria-hidden="true">&ldquo;</span>
											<?php if ( $testimonial ) : ?>
												<div class="wysiwyg text-[#fff] text-body-md pb-6">
													<?php echo wp_kses_post( $testimonial ); ?>
												</div>
											<?php endif; ?>
										</div>

									</div>

								</div>
							</div>

						<?php endforeach; ?>

					</div>
				</div>

				<!-- Navigation -->
				<div class="px-4 lg:px-0 lg:mx-auto lg:w-[94%] lg:max-w-container">
					<div class="flex items-center gap-6">
						<button
							class="testimonial-slider__prev-btn bg-fire rounded-container-xl p-3 flex items-center justify-center border-0 hover:opacity-90 transition-opacity focus:outline-none focus-visible:ring-2 focus-visible:ring-fire focus-visible:ring-offset-2"
							aria-label="<?php esc_attr_e( 'Previous testimonial', 'forest-blocks' ); ?>"
						>
							<svg class="h-6 w-6 text-white" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
								<path stroke-linecap="round" stroke-linejoin="round" d="M15 19l-7-7 7-7"></path>
							</svg>
						</button>
						<button
							class="testimonial-slider__next-btn bg-fire rounded-container-xl p-3 flex items-center justify-center border-0 hover:opacity-90 transition-opacity focus:outline-none focus-visible:ring-2 focus-visible:ring-fire focus-visible:ring-offset-2"
							aria-label="<?php esc_attr_e( 'Next testimonial', 'forest-blocks' ); ?>"
						>
							<svg class="h-6 w-6 text-white" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
								<path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7"></path>
							</svg>
						</button>
					</div>
				</div>

			</div>

		<?php endif; ?>

	</div>

<?php $b->close_tag(); ?>
