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

		<div
			class="relative px-4 py-6 lg:px-0 lg:py-20 bg-fixed bg-cover bg-center"
			style="background-image: url('<?php echo esc_url( FOREST_BLOCKS_URL . 'assets/images/wood_grain_bg.png' ); ?>');"
		>

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


				// Tailwind safelist: text-forest text-water text-earth text-tree
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
				<?php $sticky_pt = 8 + ( $index * 2 ); ?>
				<div class="testimonial-stack__card lg:sticky lg:top-0" style="z-index: <?php echo esc_attr( 1 + $index ); ?>; padding-top: <?php echo esc_attr( $sticky_pt ); ?>rem;">
					<div class="relative bg-white border border-[lightgrey] lg:border-b lg:border-forest py-6 px-4 rounded-tl-[24px] rounded-tr-[24px] lg:rounded-tl-container-lg lg:rounded-tr-container-lg max-w-[1340px] mx-auto lg:px-10 lg:pb-16 lg:pt-10">

						<!-- Desktop: flex row, Mobile: flex col -->
						<div class="flex flex-col lg:flex-row lg:gap-10 lg:items-center" data-stagger="true">

							<!-- Left Content Column -->
							<div class="flex-1 lg:max-w-[600px]">

								<!-- Header Groups -->
								<div class="flex flex-col gap-4 pb-10" data-stagger="true">

									<!-- Heading -->
									<?php if ( $heading ) : ?>
										<h5 class="font-semibold">
											<?php echo esc_html( $heading ); ?>
										</h5>
									<?php endif; ?>

									<!-- Subheading -->
									<?php if ( $subheading ) : ?>
										<h5>
											<?php echo esc_html( $subheading ); ?>
										</h5>
									<?php endif; ?>

									<!-- Body -->
									<?php if ( $body ) : ?>
										<div class="wysiwyg">
											<?php echo wp_kses_post( $body ); ?>
										</div>
									<?php endif; ?>

								</div>

								<!-- CTA Button Group -->
								<?php if ( ! empty( $cta['url'] ) || $caption ) : ?>
									<div class="flex flex-col gap-4">
										<?php if ( $caption ) : ?>
											<p>
												<?php echo esc_html( $caption ); ?>
											</p>
										<?php endif; ?>

										<?php echo fb_button( $cta, 'Learn More', 'w-fit' ); ?>
									</div>
								<?php endif; ?>

							</div>

							<!-- Right Circle/Quote Column -->
							<?php if ( $quote && $author ) : ?>
								<div class="flex-shrink-0 mt-10 self-center lg:mt-0 lg:self-auto">

									<!-- Outer Circle Container -->
									<div class="relative flex items-center justify-center rounded-full w-full max-w-[311px] p-4 lg:max-w-none lg:size-[514px] lg:p-[42px]">

										<!-- Background pattern overlay -->
										<div aria-hidden="true" class="absolute inset-0 rounded-full pointer-events-none">
											<div class="absolute inset-0 rounded-full <?php echo esc_attr( $color_classes[ $color ] ); ?>"></div>
											<div
												class="absolute inset-0 rounded-full opacity-[0.16]"
												style="background-image: url('<?php echo esc_url( $pattern_url ); ?>'); background-size: 86px 90px;"
												aria-hidden="true"
											></div>
										</div>

										<!-- Inner Quote Circle (oval on mobile, circle on desktop) -->
										<div class="relative z-10 flex items-center justify-end rounded-full <?php echo esc_attr( $color_classes[ $color ] ); ?> border-2 border-solid border-air shadow-card px-8 pb-6 w-[279px] h-[430px] lg:size-[430px] flex-col gap-6">

											<!-- Quote Mark Icon -->
											<div class="text-air flex-shrink-0">
												<?php include FOREST_BLOCKS_PATH . 'assets/images/icon-quote.svg'; ?>
											</div>

											<!-- Quote Text -->
											<p class="font-semibold text-[#fff] text-center">
												<?php echo esc_html( $quote ); ?>
											</p>

											<!-- Author Attribution -->
											<div class="flex flex-col gap-1 text-center">
												<h6 class="text-[#fff]">
													<?php echo esc_html( $author ); ?>
												</h6>
												<?php if ( $author_source ) : ?>
													<p class="text-[#fff] opacity-80">
														<?php echo esc_html( $author_source ); ?>
													</p>
												<?php endif; ?>
											</div>

											<!-- Decorative Leaf Icon -->
											<div data-tree-grow="leaf" class="lg:translate-y-[25px]"><?php echo fb_leaf_icon( 'text-air' ); ?></div>

										</div>

									</div>

								</div>
							<?php endif; ?>

						</div>

						<!-- Bottom Decorative Trees (desktop only) -->
						<div class="hidden lg:flex items-end justify-center gap-2 absolute bottom-0 left-1/2 -translate-x-1/2 text-<?php echo esc_attr( $color ); ?>" aria-hidden="true" data-tree-grow-group>
							<div class="h-[56px] lg:h-[124px]" data-tree-grow="simple">
								<?php include FOREST_BLOCKS_PATH . 'assets/images/tree-simple.svg'; ?>
							</div>
							<div class="h-[54px] lg:h-[126px]" data-tree-grow="triangle" data-tree-delay="0.5">
								<?php include FOREST_BLOCKS_PATH . 'assets/images/tree-triangle.svg'; ?>
							</div>
						</div>

					</div>
				</div>

			<?php endforeach; ?>

		</div>

	<?php endif; ?>

<?php $b->close_tag(); ?>
