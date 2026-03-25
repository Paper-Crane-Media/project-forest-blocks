<?php
/**
 * CTA Form Block — render template.
 *
 * Dark forest background with decorative geo-wave banner at top (parallax)
 * and a two-column layout: heading on the left, white Gravity Form card on the right.
 *
 * @param array  $block      The block settings and attributes.
 * @param string $content    The block inner HTML (empty for ACF blocks).
 * @param bool   $is_preview True during block preview in the editor.
 * @param int    $post_id    The post ID the block is rendering on.
 * @param array  $context    The context passed to the block.
 */

$b = new FB_Block( $block, $is_preview, $post_id );

$heading = $b->field( 'heading', '' );
$form_id = (int) $b->field( 'gravity_form_id', 0 );

$geo_base = FOREST_BLOCKS_URL . 'assets/images/';
?>
<?php $b->open_tag( 'cta-form' ); ?>

<div class="relative overflow-hidden bg-forest py-10 lg:py-20">

	<!-- ── Geo-wave banner (parallax) ──────────────────────────────────── -->
	<div class="cta-form__geo pointer-events-none absolute inset-x-0 top-0 h-[150px] lg:h-[296px]"
		 aria-hidden="true"
		 style="transform: scaleY(-1);">
		<img
			src="<?php echo esc_url( $geo_base . 'geo-wave-1.svg' ); ?>"
			alt=""
			class="absolute inset-0 h-full w-full"
			data-parallax-speed="0.2"
		/>
		<img
			src="<?php echo esc_url( $geo_base . 'geo-wave-2.svg' ); ?>"
			alt=""
			class="absolute bottom-0 left-0 right-0 w-full"
			style="height: 87.62%;"
			data-parallax-speed="0.15"
		/>
		<img
			src="<?php echo esc_url( $geo_base . 'geo-wave-3.svg' ); ?>"
			alt=""
			class="absolute bottom-0 left-0 right-0 w-full"
			style="height: 70.93%;"
			data-parallax-speed="0.1"
		/>
		<img
			src="<?php echo esc_url( $geo_base . 'geo-wave-4.svg' ); ?>"
			alt=""
			class="absolute bottom-0 left-0 right-0 w-full"
			style="height: 54.87%;"
			data-parallax-speed="0.05"
		/>
	</div>

	<!-- ── Content ─────────────────────────────────────────────────────── -->
	<div class="relative z-10 mx-auto max-w-[1280px] px-6 lg:px-0">
		<div class="flex flex-col gap-6 overflow-hidden rounded-container-lg p-6 shadow-sm lg:flex-row lg:items-center lg:p-8">

			<!-- Left: heading -->
			<?php if ( $heading ) : ?>
				<div class="flex flex-1 items-center px-0 lg:px-6">
					<h2 class="max-w-[768px] font-heading text-display-lg font-semibold text-[#fff]">
						<?php echo esc_html( $heading ); ?>
					</h2>
				</div>
			<?php endif; ?>

			<!-- Right: Gravity Form card -->
			<div class="w-full shrink-0 rounded-container-md bg-[#fff] p-6 shadow-sm lg:w-[600px]">
				<?php if ( function_exists( 'gravity_form' ) && $form_id ) : ?>
					<?php gravity_form( $form_id, false, false, false, null, true ); ?>
				<?php elseif ( $b->is_preview() ) : ?>
					<div class="flex flex-col gap-6 p-4">
						<p class="font-body text-body-md text-grey-40">
							<?php if ( ! function_exists( 'gravity_form' ) ) : ?>
								Gravity Forms plugin is not active. Please install and activate it.
							<?php elseif ( ! $form_id ) : ?>
								Please enter a Gravity Form ID in the block settings.
							<?php endif; ?>
						</p>
					</div>
				<?php endif; ?>
			</div>

		</div>
	</div>

</div>

<?php $b->close_tag(); ?>
