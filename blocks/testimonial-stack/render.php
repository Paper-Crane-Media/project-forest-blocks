<?php
/**
 * Testimonial Stack Block — render template.
 *
 * Stacked testimonial cards with sticky scroll effect on desktop.
 * Each card has a left content area and right circular quote.
 *
 * @param array  $block      The block settings and attributes.
 * @param string $content    The block inner HTML (empty for ACF blocks).
 * @param bool   $is_preview True during block preview in the editor.
 * @param int    $post_id    The post ID the block is rendering on.
 * @param array  $context    The context passed to the block.
 */

$b = new FB_Block( $block, $is_preview, $post_id );

$cards = $b->field( 'cards', [] );
?>

<?php $b->open_tag( 'testimonial-stack' ); ?>

	<?php if ( ! empty( $cards ) ) : ?>

		<div class="relative py-10 lg:py-20">

			<?php foreach ( $cards as $index => $card ) : ?>

				<?php
				$heading        = $card['heading'] ?? '';
				$subheading     = $card['subheading'] ?? '';
				$body           = $card['body'] ?? '';
				$caption        = $card['caption'] ?? '';
				$cta            = $card['cta'] ?? [];
				$quote          = $card['quote'] ?? '';
				$author         = $card['author'] ?? '';
				$author_source  = $card['author_source'] ?? '';
				$color          = $card['color'] ?? 'forest';

				// Map color to CSS class and pattern
				$color_classes = [
					'forest' => 'bg-forest border-air',
					'water'  => 'bg-water border-air',
					'earth'  => 'bg-earth border-air',
					'tree'   => 'bg-tree border-air',
				];

				$pattern_file = match ( $color ) {
					'forest' => 'pattern-forest.png',
					'water'  => 'pattern-water.png',
					'earth'  => 'pattern-earth.png',
					'tree'   => 'pattern-tree.png',
					default  => 'pattern-forest.png',
				};

				$pattern_url = FOREST_BLOCKS_URL . 'assets/images/' . $pattern_file;
				?>

				<!-- Testimonial Card -->
				<div class="sticky lg:top-0 lg:pt-10" style="z-index: <?php echo esc_attr( 1 + $index ); ?>;">
					<div class="bg-[#fff] border-forest border-b pb-10 pt-10 px-6 rounded-tl-container-lg rounded-tr-container-lg lg:px-10 lg:pb-16 lg:pt-10">

						<!-- Desktop: flex row, Mobile: flex col -->
						<div class="flex flex-col lg:flex-row lg:gap-10 lg:items-start" data-stagger="true">

							<!-- Left Content Column -->
							<div class="flex-1 lg:max-w-[600px]">

								<!-- Header Groups -->
								<div class="flex flex-col gap-4 pb-10 mb-10 border-b border-grey-20" data-stagger="true">

									<!-- Heading -->
									<?php if ( $heading ) : ?>
										<h2 class="font-heading text-display-sm font-semibold text-forest">
											<?php echo esc_html( $heading ); ?>
										</h2>
									<?php endif; ?>

									<!-- Subheading -->
									<?php if ( $subheading ) : ?>
										<p class="font-heading text-display-sm font-semibold text-forest">
											<?php echo esc_html( $subheading ); ?>
										</p>
									<?php endif; ?>

									<!-- Body -->
									<?php if ( $body ) : ?>
										<p class="font-body text-body-lg text-forest">
											<?php echo esc_html( $body ); ?>
										</p>
									<?php endif; ?>

								</div>

								<!-- CTA Button Group -->
								<?php if ( ! empty( $cta['url'] ) || $caption ) : ?>
									<div class="flex flex-col gap-4">
										<?php if ( $caption ) : ?>
											<p class="font-body text-body-lg text-forest">
												<?php echo esc_html( $caption ); ?>
											</p>
										<?php endif; ?>

										<?php echo fb_button( $cta, 'Learn More', 'w-fit' ); ?>
									</div>
								<?php endif; ?>

							</div>

							<!-- Right Circle/Quote Column -->
							<?php if ( $quote && $author ) : ?>
								<div class="flex-shrink-0 mt-10 lg:mt-0">

									<!-- Outer Circle Container -->
									<div class="relative inline-flex items-center justify-center rounded-full size-[340px] lg:size-[380px]">

										<!-- Background pattern overlay -->
										<div aria-hidden="true" class="absolute inset-0 rounded-full pointer-events-none">
											<div class="absolute inset-0 rounded-full <?php echo esc_attr( $color_classes[ $color ] ); ?>"></div>
											<div
												class="absolute inset-0 rounded-full mix-blend-overlay opacity-16"
												style="background-image: url('<?php echo esc_url( $pattern_url ); ?>'); background-size: 86px 90px;"
												aria-hidden="true"
											></div>
										</div>

										<!-- Inner Quote Circle -->
										<div class="relative z-10 inline-flex items-center justify-center rounded-full <?php echo esc_attr( $color_classes[ $color ] ); ?> border-2 border-air shadow-card p-8 size-[280px] lg:size-[320px] flex-col gap-6">

											<!-- Quote Mark Icon -->
											<svg class="h-8 w-8 lg:h-10 lg:w-10 text-[#fff] flex-shrink-0" fill="currentColor" viewBox="0 0 24 24">
												<path d="M3 21c3 0 7-1 7-8V5c0-1.25-4.25-2-7-2s-7 .75-7 2v10c0 1 0 7 7 7z"/>
											</svg>

											<!-- Quote Text -->
											<p class="font-body text-body-lg font-semibold text-[#fff] text-center">
												<?php echo esc_html( $quote ); ?>
											</p>

											<!-- Author Attribution -->
											<div class="flex flex-col gap-1 text-center">
												<p class="font-heading text-display-xs font-semibold text-[#fff]">
													<?php echo esc_html( $author ); ?>
												</p>
												<?php if ( $author_source ) : ?>
													<p class="font-body text-body-lg text-[#fff] opacity-80">
														<?php echo esc_html( $author_source ); ?>
													</p>
												<?php endif; ?>
											</div>

											<!-- Decorative Tree Icon -->
											<svg class="h-6 w-6 text-[#fff] flex-shrink-0 opacity-60" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
												<path stroke-linecap="round" stroke-linejoin="round" d="M12 6v12m0 0L6 18m6-6l6 6"/>
											</svg>

										</div>

									</div>

								</div>
							<?php endif; ?>

						</div>

					</div>
				</div>

			<?php endforeach; ?>

		</div>

	<?php endif; ?>

<?php $b->close_tag(); ?>
