<?php
/**
 * Partners Section Block — render template.
 *
 * Logo grid on an air background with a centred heading.
 * Two variants: small_logos (8-col) and large_logos (4-col).
 *
 * @param array  $block      The block settings and attributes.
 * @param string $content    The block inner HTML (empty for ACF blocks).
 * @param bool   $is_preview True during block preview in the editor.
 * @param int    $post_id    The post ID the block is rendering on.
 * @param array  $context    The context passed to the block.
 */

$b = new FB_Block( $block, $is_preview, $post_id );

$variant = $b->field( 'variant', 'small_logos' );
$heading = $b->field( 'heading', '' );
$logos   = $b->field( 'logos', [] );

$is_large = 'large_logos' === $variant;
?>
<?php $b->open_tag( 'partners-section' ); ?>

	<div class="bg-air py-10">
		<div class="fb-container flex flex-col items-center gap-6">

			<?php if ( $heading ) : ?>
				<div class="pb-6 w-full text-center">
					<h4 class="font-heading font-normal">
						<?php echo esc_html( $heading ); ?>
					</h4>
				</div>
			<?php endif; ?>

			<?php if ( ! empty( $logos ) ) : ?>
				<div class="w-full rounded-container-md bg-[#fff] p-6">
					<div class="grid gap-6 items-center justify-items-center <?php echo $is_large
						? 'grid-cols-2 lg:grid-cols-4'
						: 'grid-cols-4 lg:grid-cols-8'; ?>">

						<?php foreach ( $logos as $item ) :
							$logo = $item['logo'] ?? [];
							$name = $item['name'] ?? '';
							$link = $item['link'] ?? '';

							if ( empty( $logo['url'] ) ) {
								continue;
							}
						?>

							<?php if ( $link ) : ?>
								<a href="<?php echo esc_url( $link ); ?>" target="_blank" rel="noopener noreferrer" class="flex items-center justify-center no-underline hover:opacity-80 transition-opacity">
							<?php else : ?>
								<div class="flex items-center justify-center">
							<?php endif; ?>

								<img
									src="<?php echo esc_url( $logo['url'] ); ?>"
									alt="<?php echo esc_attr( $name ?: ( $logo['alt'] ?? '' ) ); ?>"
									class="<?php echo $is_large
										? 'max-h-[80px] lg:max-h-[120px] w-auto object-contain'
										: 'max-h-[36px] lg:max-h-[48px] w-auto object-contain'; ?>"
								/>

							<?php if ( $link ) : ?>
								</a>
							<?php else : ?>
								</div>
							<?php endif; ?>

						<?php endforeach; ?>

					</div>
				</div>
			<?php endif; ?>

		</div>
	</div>

<?php $b->close_tag(); ?>
