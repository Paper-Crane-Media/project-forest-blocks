<?php
/**
 * In The News Section — render template.
 *
 * Two variants:
 * - Media: video lightbox cards with a featured first item.
 * - Articles: linked article cards in a 2-column grid.
 *
 * @param array  $block      The block settings and attributes.
 * @param string $content    The block inner HTML (empty for ACF blocks).
 * @param bool   $is_preview True during block preview in the editor.
 * @param int    $post_id    The post ID the block is rendering on.
 * @param array  $context    The context passed to the block.
 */

$b = new FB_Block( $block, $is_preview, $post_id );

$heading = $b->field( 'heading', '' );
$variant = $b->field( 'variant', 'media' );
?>
<?php $b->open_tag( 'in-the-news-section' ); ?>
<div class="bg-air py-10">
	<div class="mx-auto w-[94%] max-w-container flex flex-col gap-6">

		<!-- Header -->
		<div class="flex flex-col gap-3">
			<?php echo fb_eyebrow( 'In The News' ); ?>
			<?php if ( $heading ) : ?>
				<h3 class="text-display-md font-heading font-semibold text-forest">
					<?php echo esc_html( $heading ); ?>
				</h3>
			<?php endif; ?>
		</div>

		<?php if ( 'media' === $variant ) : ?>
			<?php
			$items = $b->field( 'media_items', [] );
			if ( ! empty( $items ) ) :
				$featured = $items[0];
				$rest     = array_slice( $items, 1 );
			?>

			<!-- Featured row: large card left, 2 small cards right -->
			<div class="flex flex-col lg:flex-row gap-6">

				<!-- Featured card -->
				<?php
				$feat_link  = $featured['video_link'] ?? '';
				$feat_image = $featured['image'] ?? null;
				$feat_tag   = $feat_link ? 'a' : 'div';
				$feat_attrs = $feat_link ? ' href="' . esc_url( $feat_link ) . '" data-fancybox' : '';
				?>
				<<?php echo $feat_tag . $feat_attrs; ?> class="group flex flex-col overflow-hidden rounded-container-md bg-[#fff] lg:flex-[2]">
					<!-- Label -->
					<div class="px-6 py-3">
						<span class="text-eyebrow-md font-body font-semibold text-forest">In the Media</span>
					</div>

					<!-- Image area -->
					<?php if ( ! empty( $feat_image['url'] ) ) : ?>
						<div class="relative flex flex-1 items-center justify-center">
							<img
								src="<?php echo esc_url( $feat_image['url'] ); ?>"
								alt="<?php echo esc_attr( $feat_image['alt'] ?? '' ); ?>"
								class="absolute inset-0 h-full w-full object-cover"
							/>
							<?php if ( $feat_link ) : ?>
								<div class="relative flex h-16 w-16 items-center justify-center rounded-container-xl bg-fire text-[#fff]">
									<?php include FOREST_BLOCKS_PATH . 'assets/images/play-circle.svg'; ?>
								</div>
							<?php endif; ?>
						</div>
					<?php endif; ?>

					<!-- Content area -->
					<div class="flex flex-col gap-4 bg-forest px-6 pt-8 pb-10">
						<div class="flex flex-col lg:flex-row gap-4">
							<?php if ( ! empty( $featured['heading'] ) ) : ?>
								<h4 class="text-display-md font-heading font-semibold text-[#fff] flex-1 min-w-[21.4375rem]">
									<?php echo esc_html( $featured['heading'] ); ?>
								</h4>
							<?php endif; ?>
							<?php if ( ! empty( $featured['subheading'] ) ) : ?>
								<p class="text-body-md text-[#fff] flex-1">
									<?php echo esc_html( $featured['subheading'] ); ?>
								</p>
							<?php endif; ?>
						</div>
					</div>
				</<?php echo $feat_tag; ?>>

				<!-- Two smaller cards stacked on the right -->
				<?php if ( ! empty( $rest ) ) : ?>
					<div class="flex flex-col gap-6 lg:flex-1">
						<?php
						$side_cards = array_slice( $rest, 0, 2 );
						foreach ( $side_cards as $item ) :
							$link = $item['video_link'] ?? '';
							$tag  = $link ? 'a' : 'div';
							$attr = $link ? ' href="' . esc_url( $link ) . '" data-fancybox' : '';
						?>
							<<?php echo $tag . $attr; ?> class="group flex flex-1 flex-col overflow-hidden rounded-container-md bg-[#fff] h-[26.5rem]">
								<div class="px-6 py-3">
									<span class="text-eyebrow-md font-body font-semibold text-forest">In the Media</span>
								</div>
								<div class="flex flex-1 flex-col justify-between bg-forest px-6 pt-8 pb-10">
									<div class="flex flex-col gap-4">
										<?php if ( ! empty( $item['heading'] ) ) : ?>
											<h5 class="text-display-sm font-body font-semibold text-[#fff]">
												<?php echo esc_html( $item['heading'] ); ?>
											</h5>
										<?php endif; ?>
										<?php if ( ! empty( $item['subheading'] ) ) : ?>
											<p class="text-body-md text-[#fff]">
												<?php echo esc_html( $item['subheading'] ); ?>
											</p>
										<?php endif; ?>
									</div>
									<?php if ( $link ) : ?>
										<div class="flex h-16 w-16 items-center justify-center rounded-container-xl bg-fire text-[#fff]">
											<?php include FOREST_BLOCKS_PATH . 'assets/images/play-circle.svg'; ?>
										</div>
									<?php endif; ?>
								</div>
							</<?php echo $tag; ?>>
						<?php endforeach; ?>
					</div>
				<?php endif; ?>

			</div>

			<!-- Remaining cards in 3-col grid -->
			<?php
			$remaining = array_slice( $rest, 2 );
			if ( ! empty( $remaining ) ) :
			?>
				<div class="flex flex-wrap gap-4">
					<?php foreach ( $remaining as $item ) :
						$link = $item['video_link'] ?? '';
						$tag  = $link ? 'a' : 'div';
						$attr = $link ? ' href="' . esc_url( $link ) . '" data-fancybox' : '';
					?>
						<<?php echo $tag . $attr; ?> class="group flex flex-col overflow-hidden rounded-container-md bg-[#fff] w-full lg:w-[calc(33.333%-0.6875rem)] h-[26.5rem]">
							<div class="px-6 py-3">
								<span class="text-eyebrow-md font-body font-semibold text-forest">In the Media</span>
							</div>
							<div class="flex flex-1 flex-col justify-between bg-forest px-6 pt-8 pb-10">
								<div class="flex flex-col gap-4">
									<?php if ( ! empty( $item['heading'] ) ) : ?>
										<h5 class="text-display-sm font-body font-semibold text-[#fff]">
											<?php echo esc_html( $item['heading'] ); ?>
										</h5>
									<?php endif; ?>
									<?php if ( ! empty( $item['subheading'] ) ) : ?>
										<p class="text-body-md text-[#fff]">
											<?php echo esc_html( $item['subheading'] ); ?>
										</p>
									<?php endif; ?>
								</div>
								<?php if ( $link ) : ?>
									<div class="flex h-16 w-16 items-center justify-center rounded-container-xl bg-fire text-[#fff]">
										<?php include FOREST_BLOCKS_PATH . 'assets/images/play-circle.svg'; ?>
									</div>
								<?php endif; ?>
							</div>
						</<?php echo $tag; ?>>
					<?php endforeach; ?>
				</div>
			<?php endif; ?>

			<?php endif; // end media items check ?>

		<?php else : ?>
			<?php
			// --- Articles variant ---
			$articles = $b->field( 'articles', [] );
			if ( ! empty( $articles ) ) :
			?>
				<div class="flex flex-wrap gap-4">
					<?php foreach ( $articles as $article ) :
						$art_link    = $article['link'] ?? [];
						$art_url     = $art_link['url'] ?? '';
						$art_target  = $art_link['target'] ?? '';
						$art_heading = $article['heading'] ?? '';
						$art_sub     = $article['subheading'] ?? '';
						$art_attr    = $article['attribution'] ?? '';
						$art_logo    = $article['logo'] ?? null;
						$art_image   = $article['image'] ?? null;
						$tag         = $art_url ? 'a' : 'div';
						$link_attrs  = $art_url ? ' href="' . esc_url( $art_url ) . '"' : '';
						if ( $art_url && $art_target ) {
							$link_attrs .= ' target="' . esc_attr( $art_target ) . '" rel="noopener noreferrer"';
						}
					?>
						<<?php echo $tag . $link_attrs; ?> class="group flex flex-col overflow-hidden rounded-container-md bg-[#fff] shadow-[0_0.25rem_1rem_0.125rem_rgba(0,0,0,0.16)] w-full lg:w-[calc(50%-0.5rem)] h-[32.75rem]">

							<!-- Attribution header -->
							<div class="flex items-center justify-between px-6 py-3">
								<?php if ( $art_attr ) : ?>
									<span class="text-eyebrow-md font-body font-semibold text-forest"><?php echo esc_html( $art_attr ); ?></span>
								<?php endif; ?>
								<?php if ( ! empty( $art_logo['url'] ) ) : ?>
									<img
										src="<?php echo esc_url( $art_logo['url'] ); ?>"
										alt="<?php echo esc_attr( $art_logo['alt'] ?? $art_attr ); ?>"
										class="h-12 w-auto object-contain"
									/>
								<?php endif; ?>
							</div>

							<!-- Content area with background image -->
							<div class="relative flex flex-1 flex-col gap-4 px-6 pt-8 pb-10">
								<?php if ( ! empty( $art_image['url'] ) ) : ?>
									<div class="pointer-events-none absolute inset-0" aria-hidden="true">
										<img
											src="<?php echo esc_url( $art_image['url'] ); ?>"
											alt=""
											class="absolute inset-0 h-full w-full object-cover"
										/>
										<div class="absolute inset-0 bg-forest/80"></div>
									</div>
								<?php else : ?>
									<div class="pointer-events-none absolute inset-0 bg-forest" aria-hidden="true"></div>
								<?php endif; ?>

								<div class="relative flex flex-1 flex-col gap-4">
									<?php if ( $art_heading ) : ?>
										<h4 class="text-display-md font-heading font-semibold text-[#fff]">
											<?php echo esc_html( $art_heading ); ?>
										</h4>
									<?php endif; ?>
									<?php if ( $art_sub ) : ?>
										<div class="text-body-md text-[#fff]">
											<?php echo wp_kses_post( $art_sub ); ?>
										</div>
									<?php endif; ?>
								</div>

								<?php if ( $art_url ) : ?>
									<span class="relative inline-flex items-center gap-2 font-display text-button-md font-semibold text-air">
										Read More
										<svg class="h-6 w-6" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24" aria-hidden="true"><path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7"/></svg>
									</span>
								<?php endif; ?>
							</div>

						</<?php echo $tag; ?>>
					<?php endforeach; ?>
				</div>
			<?php endif; ?>
		<?php endif; ?>

	</div>
</div>
<?php $b->close_tag(); ?>
