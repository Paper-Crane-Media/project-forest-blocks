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
$video_url        = $b->field( 'video_url', '' );
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
	<div class="relative pt-10 lg:pt-20">
		<div class="mx-auto w-[94%] max-w-container">

			<!-- Outer card frame — bg image peeks through top + sides -->
			<div class="relative overflow-hidden rounded-t-container-lg shadow-card-elevated">

				<?php if ( ! empty( $background_image['url'] ) ) : ?>
					<img
						src="<?php echo esc_url( $background_image['url'] ); ?>"
						alt=""
						class="pointer-events-none absolute inset-0 h-full w-full object-cover mix-blend-luminosity"
					/>
				<?php endif; ?>

				<!-- Padding wrapper so bg-image shows around the content card -->
				<div class="relative px-6 pt-6 lg:px-32 lg:pt-16">
					<!-- White content panel -->
					<div class="rounded-t-container-lg bg-white shadow-card">
						<div class="px-4 py-4 lg:px-16 lg:py-10">
							<div class="mx-auto flex max-w-[736px] flex-col items-center text-center" data-stagger="true">

								<!-- Header group -->
								<div class="flex w-full flex-col gap-4 pb-6 lg:pb-10" data-stagger="true">
									<?php if ( $heading ) : ?>
										<h4>
											<?php echo esc_html( $heading ); ?>
										</h4>
									<?php endif; ?>

									<?php if ( $body ) : ?>
										<p>
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
	</div>

	<!-- Video section -->
	<div class="relative">
		<?php if ( $youtube_url ) : ?>
			<a
				href="<?php echo esc_url( $youtube_url ); ?>"
				data-fancybox
				class="group relative block aspect-[25/18] lg:aspect-video w-full cursor-pointer overflow-hidden rounded-t-container-md"
				aria-label="<?php esc_attr_e( 'Play video', 'forest-blocks' ); ?>"
			>
		<?php else : ?>
			<div class="group relative aspect-[25/18] lg:aspect-video w-full overflow-hidden rounded-t-container-md">
		<?php endif; ?>

			<?php if ( $video_url ) : ?>
				<video
					src="<?php echo esc_url( $video_url ); ?>"
					autoplay loop muted playsinline
					class="h-full w-full object-cover transition-transform duration-500 group-hover:scale-105"
				></video>
			<?php elseif ( ! empty( $video_thumbnail['url'] ) ) : ?>
				<img
					src="<?php echo esc_url( $video_thumbnail['url'] ); ?>"
					alt="<?php echo esc_attr( $video_thumbnail['alt'] ?? '' ); ?>"
					class="h-full w-full object-cover transition-transform duration-500 group-hover:scale-105"
				/>
			<?php endif; ?>

			<?php if ( $youtube_url ) : ?>
				<!-- Play icon (visual only — entire area is the click target) -->
				<div class="pointer-events-none absolute left-1/2 top-1/2 -translate-x-1/2 -translate-y-1/2 text-white transition-transform duration-300 group-hover:scale-110 h-10 w-10 lg:h-[131px] lg:w-[131px]">
					<?php include FOREST_BLOCKS_PATH . 'assets/images/play-circle.svg'; ?>
				</div>
			<?php endif; ?>

		<?php if ( $youtube_url ) : ?>
			</a>
		<?php else : ?>
			</div>
		<?php endif; ?>
	</div>

	<!-- Geo-banner wave parallax layers — overlaps bottom of video -->
	<div class="video-block__geo pointer-events-none relative w-full" aria-hidden="true"
		style="height: clamp(60px, 8vw, 120px);">
		<!-- Fire — furthest back, slowest -->
		<div class="absolute inset-x-0 bottom-0 text-fire" data-parallax-speed="0.03"
			style="height: 200%;">
			<?php include FOREST_BLOCKS_PATH . 'assets/images/geo-wave-fire.svg'; ?>
		</div>
		<!-- Fire-40 -->
		<div class="absolute inset-x-0 bottom-0 text-fire-40" data-parallax-speed="0.06"
			style="height: 200%;">
			<?php include FOREST_BLOCKS_PATH . 'assets/images/geo-wave-fire-40.svg'; ?>
		</div>
		<!-- Fire-20 -->
		<div class="absolute inset-x-0 bottom-0 text-fire-20" data-parallax-speed="0.09"
			style="height: 200%;">
			<?php include FOREST_BLOCKS_PATH . 'assets/images/geo-wave-fire-20.svg'; ?>
		</div>
		<!-- Air — closest to viewer, fastest -->
		<div class="absolute inset-x-0 bottom-0 text-air" data-parallax-speed="0.12"
			style="height: 200%;">
			<?php include FOREST_BLOCKS_PATH . 'assets/images/geo-wave-air.svg'; ?>
		</div>
	</div>

</div>
<?php $b->close_tag(); ?>
