<?php
/**
 * Benefits Showcase Block — render template.
 *
 * Two-column layout:
 *   - Left (sticky on desktop): Heading, subheading, body text, SDG icon badges.
 *   - Right (scrolls): Feature cards with title, description, and benefits list.
 *
 * @param array  $block      The block settings and attributes.
 * @param string $content    The block inner HTML (empty for ACF blocks).
 * @param bool   $is_preview True during block preview in the editor.
 * @param int    $post_id    The post ID the block is rendering on.
 * @param array  $context    The context passed to the block.
 */

$b = new FB_Block( $block, $is_preview, $post_id );

$heading     = $b->field( 'heading', '' );
$subheading  = $b->field( 'subheading', '' );
$body        = $b->field( 'body', '' );
$icons       = $b->field( 'icons', [] );
$cards       = $b->field( 'cards', [] );
?>
<?php $b->open_tag( 'benefits-showcase' ); ?>

<div class="bg-air px-6 py-10 lg:px-20 lg:py-16">
	<div class="mx-auto max-w-container">

		<!-- Two-column layout: left sticky, right scrolls -->
		<div class="flex flex-col gap-10 lg:flex-row lg:items-start lg:gap-10">

			<!-- LEFT COLUMN: Sticky on desktop, visible above cards on mobile -->
			<div class="flex flex-col gap-10 lg:sticky lg:top-40 lg:flex-1 lg:max-w-[736px] lg:min-w-[480px]">

				<!-- Header group -->
				<div class="flex flex-col gap-4 pb-10 lg:pb-0">
					<?php if ( $heading ) : ?>
						<h2 class="font-heading text-display-md font-semibold text-forest">
							<?php echo esc_html( $heading ); ?>
						</h2>
					<?php endif; ?>

					<?php if ( $subheading ) : ?>
						<p class="font-heading text-display-sm text-forest">
							<?php echo esc_html( $subheading ); ?>
						</p>
					<?php endif; ?>

					<?php if ( $body ) : ?>
						<div class="font-body text-body-lg text-forest">
							<?php echo nl2br( esc_html( $body ) ); ?>
						</div>
					<?php endif; ?>
				</div>

				<!-- SDG Icons row -->
				<?php if ( ! empty( $icons ) ) : ?>
					<div data-stagger="true" class="flex flex-wrap gap-6">
						<?php foreach ( $icons as $icon ) : ?>
							<?php if ( ! empty( $icon['image']['url'] ) ) : ?>
								<div class="flex h-[88px] w-[88px] items-center justify-center overflow-hidden rounded-container-sm bg-[#fff] p-1">
									<img
										src="<?php echo esc_url( $icon['image']['url'] ); ?>"
										alt="<?php echo esc_attr( $icon['image']['alt'] ?? '' ); ?>"
										class="h-20 w-20 object-contain"
									/>
								</div>
							<?php endif; ?>
						<?php endforeach; ?>
					</div>
				<?php endif; ?>

			</div>

			<!-- RIGHT COLUMN: Scrolling cards -->
			<div class="w-full lg:w-[504px] lg:shrink-0">

				<!-- Feature cards stack -->
				<div class="flex flex-col gap-8" data-stagger="true">
					<?php foreach ( $cards as $card ) : ?>
						<?php
						$card_image       = $card['image'] ?? [];
						$card_title       = $card['title'] ?? '';
						$card_description = $card['description'] ?? '';
						$card_benefits    = $card['benefits'] ?? [];
						?>

						<!-- Outer card -->
						<div class="flex flex-col gap-4 rounded-container-md bg-[#fff] p-4 shadow-sm">

							<!-- Card header: title left, SDG icon right -->
							<div class="flex items-center gap-6">
								<div class="flex flex-1 items-center pl-4">
									<?php if ( $card_title ) : ?>
										<h3 class="font-heading text-display-sm font-semibold text-forest">
											<?php echo esc_html( $card_title ); ?>
										</h3>
									<?php endif; ?>
								</div>

								<?php if ( ! empty( $card_image['url'] ) ) : ?>
									<div class="flex h-[88px] w-[88px] shrink-0 items-center justify-center overflow-hidden rounded-container-sm bg-[#fff] p-1">
										<img
											src="<?php echo esc_url( $card_image['url'] ); ?>"
											alt="<?php echo esc_attr( $card_image['alt'] ?? '' ); ?>"
											class="h-20 w-20 object-contain"
										/>
									</div>
								<?php endif; ?>
							</div>

							<!-- Inner content card -->
							<div class="flex flex-col gap-4 rounded-container-md bg-[#fff] p-4 shadow-sm">

								<?php if ( $card_description ) : ?>
									<p class="font-body text-body-md font-semibold text-forest">
										<?php echo esc_html( $card_description ); ?>
									</p>
								<?php endif; ?>

								<?php if ( ! empty( $card_benefits ) ) : ?>
									<!-- Benefits dark section -->
									<div class="flex flex-col gap-4 rounded-container-md bg-forest px-4 pb-5 pt-4">

										<!-- Benefits header with label and divider line -->
										<div class="flex items-center gap-4">
											<p class="whitespace-nowrap font-body text-body-lg font-semibold text-[#fff]">
												<?php esc_html_e( 'Benefits for your event:', 'forest-blocks' ); ?>
											</p>
											<div class="flex-1 border-b border-forest-60"></div>
										</div>

										<!-- Benefits list -->
										<div class="flex flex-col gap-2" data-stagger="true">
											<?php foreach ( $card_benefits as $benefit ) : ?>
												<?php if ( ! empty( $benefit['text'] ) ) : ?>
													<div class="flex gap-2 items-start" data-stagger="true">
														<!-- Circle-check icon -->
														<svg class="h-6 w-6 shrink-0 text-forest-60" fill="currentColor" viewBox="0 0 24 24">
															<path fill-rule="evenodd" d="M2.25 12c0-5.385 4.365-9.75 9.75-9.75s9.75 4.365 9.75 9.75-4.365 9.75-9.75 9.75S2.25 17.385 2.25 12zm13.36-1.814a.75.75 0 10-1.22-.872l-3.236 4.53L9.53 12.22a.75.75 0 00-1.06 1.06l2.25 2.25a.75.75 0 001.14-.094l3.75-5.25z" clip-rule="evenodd" />
														</svg>

														<p class="font-body text-body-md text-[#fff]">
															<?php echo esc_html( $benefit['text'] ); ?>
														</p>
													</div>
												<?php endif; ?>
											<?php endforeach; ?>
										</div>

									</div>
								<?php endif; ?>

							</div>

						</div>

					<?php endforeach; ?>
				</div>

			</div>

		</div>

	</div>
</div>

<?php $b->close_tag(); ?>
