<?php
/**
 * Schedule Section — render template.
 *
 * White background section with heading/subheading and a two-column
 * layout of schedule cards, each with an icon, agenda, and description.
 *
 * Desktop: icon + content side by side, columns in a row.
 * Mobile: icon on top, content below, columns stacked.
 *
 * @param array  $block      The block settings and attributes.
 * @param string $content    The block inner HTML (empty for ACF blocks).
 * @param bool   $is_preview True during block preview in the editor.
 * @param int    $post_id    The post ID the block is rendering on.
 * @param array  $context    The context passed to the block.
 */

$b = new FB_Block( $block, $is_preview, $post_id );

$heading    = $b->field( 'heading', '' );
$subheading = $b->field( 'subheading', '' );
$columns    = $b->field( 'columns', [] );
?>
<?php $b->open_tag( 'schedule-section' ); ?>
<div class="bg-[#fff] fb-section-lg">
	<div class="fb-container">

		<!-- Header -->
		<?php if ( $heading || $subheading ) : ?>
			<div class="flex flex-col gap-4 pb-10 lg:max-w-[936px]" data-stagger="true">
				<?php if ( $heading ) : ?>
					<h3 class="text-forest">
						<?php echo esc_html( $heading ); ?>
					</h3>
				<?php endif; ?>

				<?php if ( $subheading ) : ?>
					<p class="text-display-sm text-forest">
						<?php echo esc_html( $subheading ); ?>
					</p>
				<?php endif; ?>
			</div>
		<?php endif; ?>

		<!-- Columns -->
		<?php if ( ! empty( $columns ) ) : ?>
			<div class="flex flex-col gap-16 lg:flex-row lg:gap-8" data-stagger="true">

				<?php foreach ( $columns as $col ) : ?>
					<?php
					$icon        = $col['icon'] ?? [];
					$agenda      = $col['agenda'] ?? '';
					$description = $col['description'] ?? '';
					?>

					<div class="flex flex-1 flex-col gap-6 lg:flex-row lg:min-w-[343px]">

						<!-- Icon -->
						<?php if ( ! empty( $icon['url'] ) ) : ?>
							<div class="flex h-12 w-12 shrink-0 items-center justify-center rounded-full bg-forest">
								<img
									src="<?php echo esc_url( $icon['url'] ); ?>"
									alt="<?php echo esc_attr( $icon['alt'] ?? '' ); ?>"
									class="h-8 w-8 object-contain"
								/>
							</div>
						<?php endif; ?>

						<!-- Content -->
						<div class="flex flex-1 flex-col gap-4">
							<?php if ( $agenda ) : ?>
								<div class="wysiwyg text-display-xs text-forest [&_p]:text-[1.5rem]">
									<?php echo wp_kses_post( $agenda ); ?>
								</div>
							<?php endif; ?>

							<?php if ( $description ) : ?>
								<div class="wysiwyg text-body-lg text-forest [&_p]:text-[1.125rem]">
									<?php echo wp_kses_post( $description ); ?>
								</div>
							<?php endif; ?>
						</div>

					</div>

				<?php endforeach; ?>

			</div>
		<?php endif; ?>

	</div>
</div>
<?php $b->close_tag(); ?>
