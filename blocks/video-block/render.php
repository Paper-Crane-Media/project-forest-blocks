<?php
/**
 * Video Block — render template.
 *
 * Hero card with heading, body, CTA over a forest background.
 * Below: a video thumbnail with a Fancybox-powered YouTube lightbox.
 * Decorative geo-banner waves at the bottom.
 *
 * @param array  $block      The block settings and attributes.
 * @param string $content    The block inner HTML (empty for ACF blocks).
 * @param bool   $is_preview True during block preview in the editor.
 * @param int    $post_id    The post ID the block is rendering on.
 * @param array  $context    The context passed to the block.
 */

$b = new FB_Block( $block, $is_preview, $post_id );

$heading          = $b->field( 'heading', 'Get a unique opportunity for your attendees and sponsors.' );
$body             = $b->field( 'body', '' );
$button           = $b->field( 'button' );
$background_image = $b->field( 'background_image' );
$video_thumbnail  = $b->field( 'video_thumbnail' );
$youtube_url      = $b->field( 'youtube_url', '' );

$pattern_url = FOREST_BLOCKS_URL . 'assets/images/pattern-forest.png';
?>
<?php $b->open_tag( 'video-block' ); ?>
<div class="relative">

	<!-- Full-block background: forest + repeating pattern -->
	<div class="pointer-events-none absolute inset-0" aria-hidden="true">
		<div class="absolute inset-0 bg-forest"></div>
		<div
			class="absolute inset-0 mix-blend-overlay opacity-[0.16]"
			style="background-image: url('<?php echo esc_url( $pattern_url ); ?>'); background-size: 86px 90px;"
		></div>
	</div>

	<!-- Card section -->
	<div class="relative px-4 pt-10 lg:px-8 lg:pt-20">
		<div class="mx-auto max-w-[1290px]">

			<!-- Outer card frame — bg image peeks through the top gap -->
			<div class="relative overflow-hidden rounded-t-container-lg shadow-card">

				<?php if ( ! empty( $background_image['url'] ) ) : ?>
					<img
						src="<?php echo esc_url( $background_image['url'] ); ?>"
						alt=""
						class="pointer-events-none absolute inset-0 h-full w-full object-cover mix-blend-luminosity"
					/>
				<?php endif; ?>

				<!-- White content panel -->
				<div class="relative mt-16 rounded-t-container-lg bg-[#fff] shadow-card">
					<div class="px-6 py-10 lg:px-16">
						<div class="mx-auto flex max-w-[736px] flex-col items-center text-center">

							<!-- Header group -->
							<div class="flex w-full flex-col gap-4 pb-10">
								<?php if ( $heading ) : ?>
									<h2 class="font-heading text-display-md font-semibold text-forest">
										<?php echo esc_html( $heading ); ?>
									</h2>
								<?php endif; ?>

								<?php if ( $body ) : ?>
									<p class="font-body text-body-lg text-forest">
										<?php echo esc_html( $body ); ?>
									</p>
								<?php endif; ?>
							</div>

							<!-- CTA button -->
							<?php echo fb_button( $button ); ?>

						</div>
					</div>
				</div>

			</div>
		</div>
	</div>

	<!-- Video section -->
	<div class="relative">
		<div class="group relative aspect-video w-full overflow-hidden cursor-pointer">
			<?php if ( ! empty( $video_thumbnail['url'] ) ) : ?>
				<img
					src="<?php echo esc_url( $video_thumbnail['url'] ); ?>"
					alt="<?php echo esc_attr( $video_thumbnail['alt'] ?? '' ); ?>"
					class="h-full w-full object-cover transition-transform duration-500 group-hover:scale-105"
				/>
			<?php endif; ?>

			<!-- Dark overlay for play button contrast -->
			<div class="pointer-events-none absolute inset-0 bg-black/30 transition-colors duration-500 group-hover:bg-black/20"></div>

			<?php if ( $youtube_url ) : ?>
				<a
					href="<?php echo esc_url( $youtube_url ); ?>"
					data-fancybox
					class="absolute left-1/2 top-1/2 -translate-x-1/2 -translate-y-1/2 flex items-center justify-center transition-transform duration-300 hover:scale-110"
					aria-label="<?php esc_attr_e( 'Play video', 'forest-blocks' ); ?>"
				>
					<svg class="h-12 w-12 lg:h-16 lg:w-16" viewBox="0 0 48 48" fill="none" xmlns="http://www.w3.org/2000/svg">
						<circle cx="24" cy="24" r="22" stroke="white" stroke-width="2"/>
						<path d="M20 14l14 10-14 10V14z" fill="white"/>
					</svg>
				</a>
			<?php endif; ?>
		</div>
	</div>

	<!-- Geo-banner wave decoration -->
	<div class="relative w-full overflow-hidden" aria-hidden="true">
		<svg class="block w-full" viewBox="0 0 2217 160" fill="none" preserveAspectRatio="none" xmlns="http://www.w3.org/2000/svg" style="height: clamp(60px, 8vw, 120px);">
			<path d="M0 30C180 70 450 10 700 40S1100 80 1400 30S1800 60 2217 25V160H0Z" fill="var(--fb-color-fire-20, #f8cab0)"/>
			<path d="M0 70C300 40 500 90 800 60S1200 30 1500 70S1900 45 2217 65V160H0Z" fill="var(--fb-color-fire-40, #ed754a)"/>
			<path d="M0 95C250 75 550 110 850 85S1250 65 1550 100S1850 80 2217 90V160H0Z" fill="var(--fb-color-fire, #e95429)"/>
			<path d="M0 120C200 110 500 130 800 115S1200 100 1500 125S1900 110 2217 120V160H0Z" fill="var(--fb-color-fire-60, #da3a1c)"/>
		</svg>
	</div>

</div>
<?php $b->close_tag(); ?>
