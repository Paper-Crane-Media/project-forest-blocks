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

	<div class="relative bg-[#fff]">

		<!-- Image — relative block on mobile; absolute background on desktop -->
		<?php if ( ! empty( $bg_image['url'] ) ) : ?>
			<div class="relative h-[356px] overflow-hidden lg:absolute lg:inset-0 lg:h-auto">
				<img
					src="<?php echo esc_url( $bg_image['url'] ); ?>"
					alt="<?php echo esc_attr( $bg_image['alt'] ?? '' ); ?>"
					class="absolute inset-0 h-full w-full object-cover"
				/>
				<div class="absolute inset-0 bg-black/25 mix-blend-multiply lg:bg-black/50" aria-hidden="true"></div>
			</div>
		<?php endif; ?>

		<!-- Content -->
		<div class="relative z-10 -mt-16 rounded-tl-curve rounded-tr-curve bg-[#fff] pt-6 lg:mt-0 lg:rounded-none lg:bg-transparent">

			<!-- Heading + Cards -->
			<div class="px-4 lg:mx-auto lg:w-[94%] lg:max-w-container lg:flex lg:items-start lg:gap-10 lg:px-0 lg:pb-20 lg:pt-40">

				<!-- Heading -->
				<div class="lg:flex-1">
					<h1 class="lg:max-w-[722px] lg:text-white">
						<?php echo esc_html( $heading ); ?>
					</h1>
				</div>

				<!-- Feature Cards -->
				<?php if ( ! empty( $cards ) ) : ?>
					<div class="hero-header__cards flex w-full relative flex-col gap-3 lg:-mt-[4rem] lg:w-[459px] lg:shrink-0 lg:gap-6 lg:-mr-[5vw]">

						<?php foreach ( $cards as $i => $card ) : ?>
							<?php if ( 0 === $i ) : ?>
								<!-- Decorative tree icons attached to top card -->
								<div class="flex items-end justify-end px-6 text-forest lg:text-white lg:absolute lg:-top-16 lg:right-0" aria-hidden="true" data-tree-grow-group>
									<div class="mr-1 h-[40px] w-auto lg:h-[50px]" data-tree-grow="round"><?php include FOREST_BLOCKS_PATH . 'assets/images/tree-round.svg'; ?></div>
									<div class="h-[62px] w-auto lg:h-[74px]" data-tree-grow="pine" data-tree-delay="0.2"><?php include FOREST_BLOCKS_PATH . 'assets/images/tree-pine.svg'; ?></div>
								</div>
							<?php endif; ?>

							<div class="hero-header__card relative rounded-container-md outline outline-2 outline-grey-20 p-4">
								<div class="hero-header__card-glass pointer-events-none absolute inset-0 rounded-container-md bg-grey-5 lg:bg-transparent lg:backdrop-blur-[20px]" aria-hidden="true"></div>
								<div class="relative flex flex-col gap-1.5">
									<h6 class="lg:text-white">
										<?php echo esc_html( $card['title'] ?? '' ); ?>
									</h6>
									<p class="lg:text-white">
										<?php echo esc_html( $card['description'] ?? '' ); ?>
									</p>
								</div>
							</div>
						<?php endforeach; ?>

					</div>
				<?php endif; ?>

			</div>

			<!-- Subhead + CTA -->
			<div class="bg-[#fff] px-4 pb-6 pt-10 lg:max-w-[60%] lg:-mt-[16rem] lg:text-balance lg:rounded-tr-curve lg:!pl-[max(3%,calc((100vw-1260px)/2))] lg:pr-10">
				<?php if ( $subheading ) : ?>
					<h5 class="pb-6 font-semibold lg:pb-10">
						<?php echo esc_html( $subheading ); ?>
					</h5>
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
