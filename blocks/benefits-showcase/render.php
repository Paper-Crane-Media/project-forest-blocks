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

<div class="bg-air fb-section-sm">
	<div class="fb-container">

		<!-- Two-column layout: left sticky, right scrolls -->
		<div class="flex flex-col gap-10 lg:flex-row lg:items-start lg:gap-10">

			<!-- LEFT COLUMN: Sticky on desktop, visible above cards on mobile -->
			<div class="flex flex-col gap-10 lg:sticky lg:top-40 lg:flex-1 lg:max-w-[736px] lg:min-w-[480px]">

				<!-- Header group -->
				<div class="flex flex-col gap-4 pb-10 lg:pb-0">
					<?php if ( $heading ) : ?>
						<h4>
							<?php echo esc_html( $heading ); ?>
						</h4>
					<?php endif; ?>

					<?php if ( $subheading ) : ?>
						<h5>
							<?php echo esc_html( $subheading ); ?>
						</h5>
					<?php endif; ?>

					<?php if ( $body ) : ?>
						<div>
							<?php echo nl2br( esc_html( $body ) ); ?>
						</div>
					<?php endif; ?>
				</div>

				<!-- SDG Icons row -->
				<?php if ( ! empty( $icons ) ) : ?>
					<div data-stagger="true" data-stagger-early class="hidden flex-wrap gap-6 lg:flex">
						<?php foreach ( $icons as $icon ) : ?>
							<?php if ( ! empty( $icon['image']['url'] ) ) : ?>
								<div class="flex h-[88px] w-[88px] items-center justify-center overflow-hidden rounded-container-sm bg-[#fff] p-1">
									<img
										src="<?php echo esc_url( $icon['image']['url'] ); ?>"
										alt="<?php echo esc_attr( $icon['image']['alt'] ?? '' ); ?>"
										class="h-20 w-20 rounded-container-sm object-contain"
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
						$check_color      = $card['check_color'] ?? '';
						?>

						<!-- Outer card -->
						<div class="flex flex-col gap-2 rounded-container-md bg-[#fff] p-3 lg:p-4 shadow-sm">

							<!-- Card header: title left, SDG icon right -->
							<div class="flex items-center gap-6">
								<div class="flex flex-1 items-center pl-2 lg:pl-4">
									<?php if ( $card_title ) : ?>
										<h5 class="font-semibold">
											<?php echo esc_html( $card_title ); ?>
										</h5>
									<?php endif; ?>
								</div>

								<?php if ( ! empty( $card_image['url'] ) ) : ?>
									<div class="flex h-[60px] w-[60px] shrink-0 items-center justify-center overflow-hidden rounded-container-sm bg-[#fff] p-1 lg:h-[88px] lg:w-[88px]">
										<img
											src="<?php echo esc_url( $card_image['url'] ); ?>"
											alt="<?php echo esc_attr( $card_image['alt'] ?? '' ); ?>"
											class="h-[52px] w-[52px] rounded-container-sm object-contain lg:h-20 lg:w-20"
										/>
									</div>
								<?php endif; ?>
							</div>

							<!-- Inner content card -->
							<div class="flex flex-col gap-4 rounded-container-md bg-[#fff] px-3 lg:px-4 py-6 shadow-sm">

								<?php if ( $card_description ) : ?>
									<p class="text-body-md font-semibold">
										<?php echo esc_html( $card_description ); ?>
									</p>
								<?php endif; ?>

								<?php if ( ! empty( $card_benefits ) ) : ?>
									<!-- Benefits dark section -->
									<div class="flex flex-col gap-4 rounded-container-md bg-forest px-3 lg:px-4 pb-5 pt-4" style="color: <?php echo $check_color ? esc_attr( $check_color ) : '#4C9F38'; ?>">

										<!-- Benefits header with label and divider line -->
										<div class="flex items-center gap-4">
											<p class="whitespace-nowrap font-semibold text-[#fff]">
												<?php esc_html_e( 'Benefits for your event:', 'forest-blocks' ); ?>
											</p>
											<div class="flex-1 h-px bg-current"></div>
										</div>

										<!-- Benefits list -->
										<div class="flex flex-col gap-2" data-stagger="true">
											<?php foreach ( $card_benefits as $benefit ) : ?>
												<?php if ( ! empty( $benefit['text'] ) ) : ?>
													<div class="flex gap-2 items-start" data-stagger="true">
														<!-- Circle-check icon -->
														<svg class="h-[22px] w-[22px] shrink-0" xmlns="http://www.w3.org/2000/svg" width="22" height="22" viewBox="0 0 22 22" fill="none">
															<path d="M8 11L10 13L14.5 8.5M16.9012 3.99851C17.1071 4.49653 17.5024 4.8924 18.0001 5.09907L19.7452 5.82198C20.2433 6.02828 20.639 6.42399 20.8453 6.92206C21.0516 7.42012 21.0516 7.97974 20.8453 8.47781L20.1229 10.2218C19.9165 10.7201 19.9162 11.2803 20.1236 11.7783L20.8447 13.5218C20.9469 13.7685 20.9996 14.0329 20.9996 14.2999C20.9997 14.567 20.9471 14.8314 20.8449 15.0781C20.7427 15.3249 20.5929 15.549 20.4041 15.7378C20.2152 15.9266 19.991 16.0764 19.7443 16.1785L18.0004 16.9009C17.5023 17.1068 17.1065 17.5021 16.8998 17.9998L16.1769 19.745C15.9706 20.2431 15.575 20.6388 15.0769 20.8451C14.5789 21.0514 14.0193 21.0514 13.5212 20.8451L11.7773 20.1227C11.2792 19.9169 10.7198 19.9173 10.2221 20.1239L8.47689 20.8458C7.97912 21.0516 7.42001 21.0514 6.92237 20.8453C6.42473 20.6391 6.02925 20.2439 5.82281 19.7464L5.09972 18.0006C4.8938 17.5026 4.49854 17.1067 4.00085 16.9L2.25566 16.1771C1.75783 15.9709 1.36226 15.5754 1.15588 15.0777C0.949508 14.5799 0.949228 14.0205 1.1551 13.5225L1.87746 11.7786C2.08325 11.2805 2.08283 10.7211 1.8763 10.2233L1.15497 8.47678C1.0527 8.2301 1.00004 7.96568 1 7.69863C0.999957 7.43159 1.05253 7.16715 1.15472 6.92043C1.25691 6.67372 1.40671 6.44955 1.59557 6.26075C1.78442 6.07195 2.00862 5.92222 2.25537 5.8201L3.9993 5.09772C4.49687 4.89197 4.89248 4.4972 5.0993 4.00006L5.82218 2.25481C6.02848 1.75674 6.42418 1.36103 6.92222 1.15473C7.42027 0.948424 7.97987 0.948424 8.47792 1.15473L10.2218 1.87712C10.7199 2.08291 11.2793 2.08249 11.7771 1.87595L13.523 1.15585C14.021 0.94966 14.5804 0.949702 15.0784 1.15597C15.5763 1.36223 15.972 1.75783 16.1783 2.25576L16.9014 4.00153L16.9012 3.99851Z" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
														</svg>

														<p class="text-body-md text-[#fff]">
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
