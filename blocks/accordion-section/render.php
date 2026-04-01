<?php
/**
 * Accordion Section — render template.
 *
 * Air background with a heading and a list of expandable accordion items.
 * Each item has a fire-colored heading, a toggle button, and WYSIWYG content.
 * Fully accessible under WCAG 2.1 (aria-expanded, aria-controls, role="region").
 *
 * @param array  $block      The block settings and attributes.
 * @param string $content    The block inner HTML (empty for ACF blocks).
 * @param bool   $is_preview True during block preview in the editor.
 * @param int    $post_id    The post ID the block is rendering on.
 * @param array  $context    The context passed to the block.
 */

$b = new FB_Block( $block, $is_preview, $post_id );

$heading = $b->field( 'heading', '' );
$items   = $b->field( 'items', [] );
$uid     = 'acc-' . uniqid();
?>
<?php $b->open_tag( 'accordion-section' ); ?>
<div class="bg-air py-10">
	<div class="mx-auto w-[94%] max-w-container">

		<?php if ( $heading ) : ?>
			<h2 class="text-display-lg font-heading font-semibold text-forest pb-10">
				<?php echo esc_html( $heading ); ?>
			</h2>
		<?php endif; ?>

		<?php if ( ! empty( $items ) ) : ?>
			<div class="flex flex-col gap-4">
				<?php foreach ( $items as $i => $item ) :
					$item_heading = $item['heading'] ?? '';
					$item_content = $item['content'] ?? '';
					$trigger_id   = esc_attr( $uid . '-trigger-' . $i );
					$panel_id     = esc_attr( $uid . '-panel-' . $i );
				?>
					<div class="accordion-section__item border-t-2 border-fire pt-6">

						<h3>
							<button
								type="button"
								class="accordion-section__trigger flex w-full items-start justify-between gap-4 text-left"
								id="<?php echo $trigger_id; ?>"
								aria-expanded="false"
								aria-controls="<?php echo $panel_id; ?>"
							>
								<span class="text-display-sm font-body font-semibold text-fire flex-1 max-w-[48rem]">
									<?php echo esc_html( $item_heading ); ?>
								</span>
								<span class="accordion-section__icon flex h-12 w-12 shrink-0 items-center justify-center rounded-container-xl bg-fire text-[#fff] transition-shadow focus-visible:shadow-[0_0_0_0.25rem_rgba(233,84,41,0.15)]" aria-hidden="true">
									<!-- Plus icon (shown when collapsed) -->
									<svg class="accordion-section__icon-plus h-6 w-6" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M12 5v14M5 12h14"/></svg>
									<!-- Minus icon (shown when expanded) -->
									<svg class="accordion-section__icon-minus hidden h-6 w-6" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M5 12h14"/></svg>
								</span>
							</button>
						</h3>

						<div
							id="<?php echo $panel_id; ?>"
							role="region"
							aria-labelledby="<?php echo $trigger_id; ?>"
							class="accordion-section__panel"
							hidden
						>
							<div class="wysiwyg text-body-lg text-forest pt-6">
								<?php echo wp_kses_post( $item_content ); ?>
							</div>
						</div>

					</div>
				<?php endforeach; ?>
			</div>
		<?php endif; ?>

	</div>
</div>
<?php $b->close_tag(); ?>
