<?php
/**
 * Features Block — render template.
 *
 * Dark-background section with a two-column header (text + CTA) above a
 * flex-wrap grid of feature cards with circular images.
 *
 * @param array  $block      The block settings and attributes.
 * @param string $content    The block inner HTML (empty for ACF blocks).
 * @param bool   $is_preview True during block preview in the editor.
 * @param int    $post_id    The post ID the block is rendering on.
 * @param array  $context    The context passed to the block.
 */

$b = new FB_Block( $block, $is_preview, $post_id );

$eyebrow         = $b->field( 'eyebrow', '' );
$heading         = $b->field( 'heading', '' );
$subheading      = $b->field( 'subheading', '' );
$body            = $b->field( 'body', '' );
$cta_description = $b->field( 'cta_description', '' );
$cta             = $b->field( 'cta' );
$features        = $b->field( 'features', [] );
?>
<?php $b->open_tag( 'features-block' ); ?>

<div class="bg-forest-80 py-10 lg:py-16">
	<div class="mx-auto max-w-[1280px] px-6 lg:px-10">

		<!-- Header: two-column layout, bottom-aligned -->
		<div class="flex flex-col gap-6 lg:flex-row lg:items-end lg:gap-10">

			<!-- Left column: text content -->
			<div class="flex flex-1 flex-col gap-4 lg:pb-10">
				<div class="flex flex-col gap-3 lg:max-w-[768px]">
					<?php if ( $eyebrow ) : ?>
						<div class="inline-flex self-start rounded-full bg-forest px-4 py-2">
							<span class="font-body text-eyebrow-md font-semibold text-forest-5">
								<?php echo esc_html( $eyebrow ); ?>
							</span>
						</div>
					<?php endif; ?>

					<?php if ( $heading ) : ?>
						<h2 class="font-heading text-display-md font-semibold text-[#fff]">
							<?php echo esc_html( $heading ); ?>
						</h2>
					<?php endif; ?>
				</div>

				<?php if ( $subheading ) : ?>
					<p class="font-heading text-display-sm text-[#fff]">
						<?php echo esc_html( $subheading ); ?>
					</p>
				<?php endif; ?>

				<?php if ( $body ) : ?>
					<p class="font-body text-body-lg text-[#fff]">
						<?php echo esc_html( $body ); ?>
					</p>
				<?php endif; ?>
			</div>

			<!-- Right column: CTA description + button -->
			<?php if ( $cta_description || ! empty( $cta['url'] ) ) : ?>
				<div class="flex flex-1 flex-col items-start gap-4 lg:pb-10">
					<?php if ( $cta_description ) : ?>
						<p class="font-body text-body-lg text-[#fff]">
							<?php echo esc_html( $cta_description ); ?>
						</p>
					<?php endif; ?>

					<?php echo fb_button( $cta ); ?>
				</div>
			<?php endif; ?>

		</div>

		<!-- Feature cards grid -->
		<?php if ( ! empty( $features ) ) : ?>
			<div class="mt-10 lg:px-4">
				<div class="flex flex-wrap gap-10 lg:gap-x-8 lg:gap-y-16">

					<?php foreach ( $features as $feature ) : ?>
						<?php
						$feat_image       = $feature['image'] ?? [];
						$feat_heading     = $feature['heading'] ?? '';
						$feat_description = $feature['description'] ?? '';
						$feat_link        = $feature['link'] ?? [];
						?>

						<div class="flex w-full items-start gap-6 lg:w-[556px]">
							<!-- Circular image -->
							<?php if ( ! empty( $feat_image['url'] ) ) : ?>
								<div class="h-[100px] w-[100px] shrink-0 overflow-hidden rounded-full lg:h-[148px] lg:w-[148px]">
									<img
										src="<?php echo esc_url( $feat_image['url'] ); ?>"
										alt="<?php echo esc_attr( $feat_image['alt'] ?? '' ); ?>"
										class="h-full w-full object-cover"
									/>
								</div>
							<?php endif; ?>

							<!-- Text content -->
							<div class="flex flex-1 flex-col gap-6">
								<div class="flex flex-col gap-4 text-[#fff]">
									<?php if ( $feat_heading ) : ?>
										<p class="font-heading text-display-xs">
											<?php echo esc_html( $feat_heading ); ?>
										</p>
									<?php endif; ?>

									<?php if ( $feat_description ) : ?>
										<p class="font-body text-body-lg">
											<?php echo esc_html( $feat_description ); ?>
										</p>
									<?php endif; ?>
								</div>

								<?php if ( is_array( $feat_link ) && ! empty( $feat_link['url'] ) ) : ?>
								<?php echo fb_inline_link( $feat_link ); ?>
							<?php endif; ?>
							</div>
						</div>

					<?php endforeach; ?>

				</div>
			</div>
		<?php endif; ?>

	</div>
</div>

<?php $b->close_tag(); ?>
