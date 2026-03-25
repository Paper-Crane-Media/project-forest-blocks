<?php
/**
 * Hero Header Block — render template.
 *
 * @param array  $block      The block settings and attributes.
 * @param string $content    The block inner HTML (empty for ACF blocks).
 * @param bool   $is_preview True during block preview in the editor.
 * @param int    $post_id    The post ID the block is rendering on.
 * @param array  $context    The context passed to the block.
 */

$b = new FB_Block( $block, $is_preview, $post_id );

$heading    = $b->field( 'heading', 'Connect your event to nature.' );
$subheading = $b->field( 'subheading', 'Offset your event\'s footprint by dazzling your attendees with a tree planting event.' );
$cta        = $b->field( 'cta' );
$cards      = $b->field( 'feature_cards', [] );
$bg_image   = $b->field( 'background_image' );
?>
<?php $b->open_tag( 'hero-header' ); ?>

	<div class="relative">

		<!-- Background image — fills entire hero; on mobile the white content area covers the lower portion -->
		<div class="absolute inset-0 overflow-hidden">
			<?php if ( ! empty( $bg_image['url'] ) ) : ?>
				<img
					src="<?php echo esc_url( $bg_image['url'] ); ?>"
					alt="<?php echo esc_attr( $bg_image['alt'] ?? '' ); ?>"
					class="absolute inset-0 h-full w-full object-cover"
				/>
			<?php endif; ?>
			<div class="absolute inset-0 bg-black/25 mix-blend-multiply lg:bg-black/50" aria-hidden="true"></div>
		</div>

		<!-- Content -->
		<div class="relative">

			<!-- Mobile spacer: pushes content below the short image, minus overlap for rounded corners -->
			<div class="h-[316px] lg:hidden"></div>

			<!-- Main content area -->
			<!-- Mobile: white bg + rounded top | Desktop: transparent, flex row over the image -->
			<div class="rounded-tl-curve rounded-tr-curve bg-[#fff] px-4 pt-6 lg:flex lg:items-start lg:gap-10 lg:rounded-none lg:bg-transparent lg:px-20 lg:pb-20 lg:pt-40">

				<!-- Heading -->
				<div class="lg:flex-1">
					<h1 class="font-display text-display-xxl font-semibold text-forest lg:max-w-[722px] lg:text-[#fff]">
						<?php echo esc_html( $heading ); ?>
					</h1>
				</div>

				<!-- Feature Cards -->
				<?php if ( ! empty( $cards ) ) : ?>
					<div class="hero-header__cards mt-3 flex w-full flex-col gap-3 lg:mt-0 lg:w-[459px] lg:shrink-0 lg:gap-6">

						<?php foreach ( $cards as $i => $card ) : ?>
							<?php if ( 0 === $i ) : ?>
								<!-- Decorative tree icons attached to top card -->
								<div class="flex items-end justify-end px-6 text-forest lg:text-[#fff]" aria-hidden="true">
									<div class="mr-1 h-[40px] w-[27px] lg:h-[74px] lg:w-[51px]"><?php include FOREST_BLOCKS_PATH . 'assets/images/tree-round.svg'; ?></div>
									<div class="h-[62px] w-[28px] lg:h-[74px] lg:w-[34px]"><?php include FOREST_BLOCKS_PATH . 'assets/images/tree-pine.svg'; ?></div>
								</div>
							<?php endif; ?>

							<div class="hero-header__card relative rounded-container-md border border-[#fff] p-4">
								<div class="hero-header__card-glass pointer-events-none absolute inset-0 rounded-container-md bg-grey-5 lg:bg-forest/40 lg:backdrop-blur-[20px]" aria-hidden="true"></div>
								<div class="relative flex flex-col gap-1.5">
									<p class="font-heading text-display-xs font-semibold text-forest lg:text-[#fff]">
										<?php echo esc_html( $card['title'] ?? '' ); ?>
									</p>
									<p class="font-body text-body-lg text-forest lg:text-[#fff]">
										<?php echo esc_html( $card['description'] ?? '' ); ?>
									</p>
								</div>
							</div>
						<?php endforeach; ?>

					</div>
				<?php endif; ?>

			</div>

			<!-- Subhead + CTA -->
			<div class="bg-[#fff] px-4 pb-6 pt-10 lg:max-w-[60%] lg:-mt-[16rem] lg:rounded-tr-curve lg:pl-20 lg:pr-10">
				<?php if ( $subheading ) : ?>
					<p class="pb-6 font-heading text-display-sm font-semibold text-forest lg:pb-10">
						<?php echo esc_html( $subheading ); ?>
					</p>
				<?php endif; ?>

				<?php if ( ! empty( $cta['url'] ) ) : ?>
					<div class="pb-10">
						<?php echo fb_button( $cta ); ?>
					</div>
				<?php endif; ?>
			</div>

		</div>

	</div>

<?php $b->close_tag(); ?>
