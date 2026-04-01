<?php
/**
 * Features Card Section — render template.
 *
 * Dark forest section with a header area (heading, subheading, body content)
 * followed by a card-area heading and a 2-column grid of feature cards,
 * each with a circular image and text.
 *
 * @param array  $block      The block settings and attributes.
 * @param string $content    The block inner HTML (empty for ACF blocks).
 * @param bool   $is_preview True during block preview in the editor.
 * @param int    $post_id    The post ID the block is rendering on.
 * @param array  $context    The context passed to the block.
 */

$b = new FB_Block( $block, $is_preview, $post_id );

$heading           = $b->field( 'heading', '' );
$subheading        = $b->field( 'subheading', '' );
$content           = $b->field( 'content', '' );
$card_area_heading = $b->field( 'card_area_heading', '' );
$cards             = $b->field( 'cards', [] );
?>
<?php $b->open_tag( 'features-card-section' ); ?>
<div class="bg-forest py-16">
	<div class="mx-auto w-[94%] max-w-container">

		<!-- Header area -->
		<div data-stagger="true" class="flex flex-col gap-4 max-w-[58.5rem] pb-10">

			<?php if ( $heading ) : ?>
				<h3 class="text-display-md font-heading font-semibold text-[#fff]">
					<?php echo esc_html( $heading ); ?>
				</h3>
			<?php endif; ?>

			<?php if ( $subheading ) : ?>
				<p class="text-display-sm font-body text-[#fff]">
					<?php echo esc_html( $subheading ); ?>
				</p>
			<?php endif; ?>

			<?php if ( $content ) : ?>
				<div class="wysiwyg text-body-lg text-[#fff]">
					<?php echo wp_kses_post( $content ); ?>
				</div>
			<?php endif; ?>

		</div>

		<!-- Card area -->
		<div class="flex flex-col gap-10">

			<?php if ( $card_area_heading ) : ?>
				<h4 class="text-display-sm font-body font-semibold text-[#fff]">
					<?php echo esc_html( $card_area_heading ); ?>
				</h4>
			<?php endif; ?>

			<?php if ( ! empty( $cards ) ) : ?>
				<div class="flex flex-wrap gap-x-8 gap-y-16">

					<?php foreach ( $cards as $card ) :
						$card_image   = $card['image'] ?? null;
						$card_heading = $card['heading'] ?? '';
						$card_content = $card['content'] ?? '';
					?>
						<div class="flex gap-6 items-start min-w-[18.75rem] w-full lg:w-[calc(50%-1rem)]">

							<?php if ( ! empty( $card_image['url'] ) ) : ?>
								<div class="shrink-0 size-[9.25rem] rounded-full overflow-hidden">
									<img
										src="<?php echo esc_url( $card_image['url'] ); ?>"
										alt="<?php echo esc_attr( $card_image['alt'] ?? '' ); ?>"
										class="h-full w-full object-cover"
									/>
								</div>
							<?php endif; ?>

							<div class="flex flex-1 flex-col gap-4 justify-center">
								<?php if ( $card_heading ) : ?>
									<h5 class="text-display-xs font-body text-[#fff]">
										<?php echo esc_html( $card_heading ); ?>
									</h5>
								<?php endif; ?>

								<?php if ( $card_content ) : ?>
									<p class="text-body-lg text-[#fff]">
										<?php echo esc_html( $card_content ); ?>
									</p>
								<?php endif; ?>
							</div>

						</div>
					<?php endforeach; ?>

				</div>
			<?php endif; ?>

		</div>

	</div>
</div>
<?php $b->close_tag(); ?>
