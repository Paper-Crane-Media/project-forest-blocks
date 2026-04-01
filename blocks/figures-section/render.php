<?php
/**
 * Figures Section — render template.
 *
 * Two animated figure cards (left) beside a forest content card (right),
 * with a centered CTA button below. Numbers count up on scroll.
 *
 * @param array  $block      The block settings and attributes.
 * @param string $content    The block inner HTML (empty for ACF blocks).
 * @param bool   $is_preview True during block preview in the editor.
 * @param int    $post_id    The post ID the block is rendering on.
 * @param array  $context    The context passed to the block.
 */

$b = new FB_Block( $block, $is_preview, $post_id );

$figure_1         = (int) $b->field( 'figure_1', 0 );
$figure_1_heading = $b->field( 'figure_1_heading', '' );
$figure_2         = (int) $b->field( 'figure_2', 0 );
$figure_2_heading = $b->field( 'figure_2_heading', '' );
$content          = $b->field( 'content', '' );
$link             = $b->field( 'link' );
?>
<?php $b->open_tag( 'figures-section' ); ?>
<div class="bg-[#fff] py-10">
	<div class="mx-auto w-[94%] max-w-container flex flex-col items-center gap-10">

		<!-- Two-column layout -->
		<div class="flex flex-col lg:flex-row gap-6 lg:gap-20 w-full">

			<!-- Left: figure cards -->
			<div class="flex flex-col gap-6 shrink-0 lg:w-[26.3125rem]">

				<!-- Figure 1: white bg, fire border -->
				<div class="flex flex-1 flex-col items-center justify-center rounded-container-lg border-2 border-fire bg-[#fff] px-6 py-8 shadow-[0_0.25rem_1rem_0_rgba(0,0,0,0.16)] text-center">
					<div class="flex flex-col gap-4 w-full items-center">
						<span
							class="figures-section__number text-display-lg font-heading font-semibold text-forest"
							data-count-to="<?php echo esc_attr( $figure_1 ); ?>"
							data-count-commas="true"
						>0</span>
						<?php if ( $figure_1_heading ) : ?>
							<span class="text-display-md font-heading font-semibold text-water">
								<?php echo esc_html( $figure_1_heading ); ?>
							</span>
						<?php endif; ?>
					</div>
				</div>

				<!-- Figure 2: air bg, no border -->
				<div class="flex flex-1 flex-col items-center justify-center rounded-container-lg bg-air px-6 py-8 shadow-[0_0.25rem_1rem_0_rgba(0,0,0,0.16)] text-center">
					<div class="flex flex-col gap-4 w-full items-center">
						<span
							class="figures-section__number text-display-lg font-heading font-semibold text-forest"
							data-count-to="<?php echo esc_attr( $figure_2 ); ?>"
							data-count-commas="true"
						>0</span>
						<?php if ( $figure_2_heading ) : ?>
							<span class="text-display-md font-heading font-semibold text-water">
								<?php echo esc_html( $figure_2_heading ); ?>
							</span>
						<?php endif; ?>
					</div>
				</div>

			</div>

			<!-- Right: forest content card -->
			<?php if ( $content ) : ?>
				<div class="flex flex-1 flex-col items-start rounded-container-lg bg-forest py-8 px-8">
					<div class="wysiwyg text-[#fff]">
						<?php echo wp_kses_post( $content ); ?>
					</div>
				</div>
			<?php endif; ?>

		</div>

		<!-- CTA button -->
		<?php echo fb_button( $link ?: [] ); ?>

	</div>
</div>
<?php $b->close_tag(); ?>
