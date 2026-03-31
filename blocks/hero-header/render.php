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

$variant    = $b->field( 'variant', 'default' );
$heading    = $b->field( 'heading', 'Connect your event to nature.' );
$subheading = $b->field( 'subheading', 'Offset your event\'s footprint by dazzling your attendees with a tree planting event.' );
$cta        = $b->field( 'cta' );
$cards      = $b->field( 'feature_cards', [] );
$bg_image   = $b->field( 'background_image' );
?>
<?php $b->open_tag( 'hero-header' ); ?>

<?php if ( 'secondary' === $variant ) : ?>

	<?php
	$eyebrow              = $b->field( 'eyebrow', '' );
	$secondary_subheading = $b->field( 'secondary_subheading', '' );
	$body                 = $b->field( 'body', '' );
	?>

	<div class="bg-[#fff]">
		<div class="flex flex-col lg:flex-row lg:items-center">

			<!-- Content -->
			<div class="flex-1 px-4 py-10 lg:py-0 lg:px-8 lg:max-w-[1280px]">
				<div class="lg:pl-8 lg:pr-8">
					<div data-stagger="true" class="flex flex-col items-start gap-4 max-w-[768px]">

						<?php if ( $eyebrow ) : ?>
							<?php echo fb_eyebrow( $eyebrow, 'text-eyebrow-lg' ); ?>
						<?php endif; ?>

						<?php if ( $heading ) : ?>
							<h3><?php echo esc_html( $heading ); ?></h3>
						<?php endif; ?>

						<?php if ( $secondary_subheading ) : ?>
							<div class="wysiwyg text-display-sm">
								<?php echo wp_kses_post( $secondary_subheading ); ?>
							</div>
						<?php endif; ?>

						<?php if ( $body ) : ?>
							<p><?php echo esc_html( $body ); ?></p>
						<?php endif; ?>

					</div>

					<!-- Scroll indicator -->
					<div class="pt-10 pb-10">
						<svg class="h-6 w-6 text-fire" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24" aria-hidden="true">
							<path stroke-linecap="round" stroke-linejoin="round" d="M7 7l5 5 5-5M7 13l5 5 5-5"/>
						</svg>
					</div>
				</div>
			</div>

			<!-- Image -->
			<?php if ( ! empty( $bg_image['url'] ) ) : ?>
				<div class="shrink-0 p-4 lg:p-6 lg:w-[636px] lg:h-[636px]">
					<div class="relative w-full h-full overflow-hidden rounded-container-md aspect-square lg:aspect-auto">
						<img
							src="<?php echo esc_url( $bg_image['url'] ); ?>"
							alt="<?php echo esc_attr( $bg_image['alt'] ?? '' ); ?>"
							class="absolute inset-0 h-full w-full object-cover"
						/>
					</div>
				</div>
			<?php endif; ?>

		</div>
	</div>

<?php elseif ( 'solid-green' === $variant ) : ?>

	<div class="bg-forest">
		<div class="fb-container flex flex-col lg:flex-row lg:items-center">

			<!-- Content -->
			<div class="flex-1 px-4 py-10 lg:py-16 lg:pl-20 lg:pr-8">
				<div class="flex flex-col gap-4">

					<?php if ( $heading ) : ?>
						<h3 class="text-white">
							<?php echo esc_html( $heading ); ?>
						</h3>
					<?php endif; ?>

					<?php if ( $subheading ) : ?>
						<p class="text-display-sm text-white">
							<?php echo esc_html( $subheading ); ?>
						</p>
					<?php endif; ?>

					<?php if ( ! empty( $cta['url'] ) ) : ?>
						<div class="pt-2">
							<?php echo fb_button( $cta ); ?>
						</div>
					<?php endif; ?>

				</div>
			</div>

			<!-- Image -->
			<?php if ( ! empty( $bg_image['url'] ) ) : ?>
				<div class="shrink-0 p-4 lg:p-6 lg:w-[636px] lg:h-[636px]">
					<div class="relative w-full h-full overflow-hidden rounded-container-lg aspect-square lg:aspect-auto">
						<img
							src="<?php echo esc_url( $bg_image['url'] ); ?>"
							alt="<?php echo esc_attr( $bg_image['alt'] ?? '' ); ?>"
							class="absolute inset-0 h-full w-full object-cover"
						/>
					</div>
				</div>
			<?php endif; ?>

		</div>
	</div>

<?php else : ?>

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
									<div class="fb-tree-semibold h-[62px] w-auto lg:h-[74px]" data-tree-grow="pine" data-tree-delay="0.2"><?php include FOREST_BLOCKS_PATH . 'assets/images/tree-pine.svg'; ?></div>
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

<?php endif; ?>

<?php $b->close_tag(); ?>
