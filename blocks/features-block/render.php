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

$variant         = $b->field( 'variant', 'default' );
$heading         = $b->field( 'heading', '' );
?>
<?php $b->open_tag( 'features-block' ); ?>

<?php if ( 'checkmarks' === $variant ) : ?>

	<?php
	$checkmarks_description = $b->field( 'checkmarks_description', '' );
	$checkmarks             = $b->field( 'checkmarks', [] );
	?>

	<div class="bg-forest-80 fb-section-sm">
		<div class="fb-container">
			<div class="flex flex-col gap-10 lg:flex-row lg:items-start lg:gap-10">
				<?php if ( $heading ) : ?>
					<div class="flex-1 w-full lg:pb-10">
						<h4 class="text-[#fff] font-heading font-semibold">
							<?php echo esc_html( $heading ); ?>
						</h4>
					</div>
				<?php endif; ?>

				<div class="w-full flex-1 lg:max-w-[40%]">
					<div class="px-0 lg:px-4">

						<?php if ( $checkmarks_description ) : ?>
							<div class="pb-10">
								<p class="text-display-xs font-semibold text-[#fff]">
									<?php echo esc_html( $checkmarks_description ); ?>
								</p>
							</div>
						<?php endif; ?>

						<?php if ( ! empty( $checkmarks ) ) : ?>
							<div class="flex flex-col gap-6 lg:gap-8" data-stagger="true">
								<?php foreach ( $checkmarks as $item ) : ?>
									<?php $label = $item['label'] ?? ''; ?>
									<?php if ( $label ) : ?>
										<div class="flex items-center gap-6">
											<div class="flex h-12 w-12 shrink-0 items-center justify-center rounded-full bg-fire">
												<div class="h-8 w-8 text-[#fff]">
													<?php include FOREST_BLOCKS_PATH . 'assets/images/icon-check-verified.svg'; ?>
												</div>
											</div>
											<p class="text-display-xs text-[#fff]">
												<?php echo esc_html( $label ); ?>
											</p>
										</div>
									<?php endif; ?>
								<?php endforeach; ?>
							</div>
						<?php endif; ?>

					</div>
				</div>

			</div>
		</div>
	</div>

<?php else : ?>

<?php
$eyebrow         = $b->field( 'eyebrow', '' );
$subheading      = $b->field( 'subheading', '' );
$body            = $b->field( 'body', '' );
$cta_description = $b->field( 'cta_description', '' );
$cta             = $b->field( 'cta' );
$features        = $b->field( 'features', [] );
?>

<div class="bg-forest-80 fb-section-sm">
	<div class="fb-container">

		<!-- Header: two-column layout, bottom-aligned -->
		<div class="flex flex-col gap-6 lg:flex-row lg:items-end lg:gap-10">

			<!-- Left column: text content -->
			<div class="flex flex-1 flex-col gap-4 lg:pb-10">
				<div class="flex flex-col gap-3 lg:max-w-[768px]">
					<?php if ( $eyebrow ) : ?>
						<div class="inline-flex self-start">
							<?php echo fb_eyebrow( $eyebrow, 'text-eyebrow-md', 'bg-forest' ); ?>
						</div>
					<?php endif; ?>

					<?php if ( $heading ) : ?>
						<h4 class="text-[#fff]">
							<?php echo esc_html( $heading ); ?>
						</h4>
					<?php endif; ?>
				</div>

				<?php if ( $subheading ) : ?>
					<h5 class="text-[#fff]">
						<?php echo esc_html( $subheading ); ?>
					</h5>
				<?php endif; ?>

				<?php if ( $body ) : ?>
					<div class="wysiwyg text-[#fff]">
						<?php echo wp_kses_post( $body ); ?>
					</div>
				<?php endif; ?>
			</div>

			<!-- Right column: CTA description + button -->
			<?php if ( $cta_description || ! empty( $cta['url'] ) ) : ?>
				<div class="flex flex-1 flex-col items-start gap-4 lg:pb-10">
					<?php if ( $cta_description ) : ?>
						<p class="text-[#fff]">
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
				<div class="grid grid-cols-1 gap-10 sm:grid-cols-2 lg:gap-x-8 lg:gap-y-16" data-stagger="true">

					<?php foreach ( $features as $feature ) : ?>
						<?php
						$feat_image       = $feature['image'] ?? [];
						$feat_heading     = $feature['heading'] ?? '';
						$feat_description = $feature['description'] ?? '';
						$feat_link        = is_array( $feature['link'] ?? null ) ? $feature['link'] : [];
						?>

						<div class="flex flex-col items-start gap-6 sm:flex-row" data-stagger="true">
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
										<h6 class="text-[#fff]">
											<?php echo esc_html( $feat_heading ); ?>
										</h6>
									<?php endif; ?>

									<?php if ( $feat_description ) : ?>
										<p>
											<?php echo esc_html( $feat_description ); ?>
										</p>
									<?php endif; ?>
								</div>

								<?php echo fb_inline_link( $feat_link ); ?>
							</div>
						</div>

					<?php endforeach; ?>

				</div>
			</div>
		<?php endif; ?>

	</div>
</div>

<?php endif; ?>

<?php $b->close_tag(); ?>
