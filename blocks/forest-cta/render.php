<?php
/**
 * Forest CTA Block — render template.
 *
 * Display heading with decorative forest silhouette, followed by a dark
 * forest-colored card with content and CTA buttons on an air background.
 *
 * @param array  $block      The block settings and attributes.
 * @param string $content    The block inner HTML (empty for ACF blocks).
 * @param bool   $is_preview True during block preview in the editor.
 * @param int    $post_id    The post ID the block is rendering on.
 * @param array  $context    The context passed to the block.
 */

$b = new FB_Block( $block, $is_preview, $post_id );

$heading      = $b->field( 'heading', '' );
$card_heading = $b->field( 'card_heading', '' );
$card_body    = $b->field( 'card_body', '' );
$caption      = $b->field( 'caption', '' );
$buttons      = $b->field( 'buttons', [] );

$silhouette_url = FOREST_BLOCKS_URL . 'assets/images/forest-silhouette.svg';
?>
<?php $b->open_tag( 'forest-cta' ); ?>

<div class="relative overflow-hidden">

	<!-- ── Heading area ─────────────────────────────────────────────── -->
	<div class="relative z-10 mx-auto max-w-[1280px] px-6 pt-16 lg:px-10">
		<?php if ( $heading ) : ?>
			<div class="max-w-[768px] pb-10">
				<h2 class="font-display text-display-xl font-semibold text-forest">
					<?php echo esc_html( $heading ); ?>
				</h2>
			</div>
		<?php endif; ?>
	</div>

	<!-- ── Forest silhouette (decorative) ───────────────────────────── -->
	<div class="pointer-events-none relative z-0 -mt-10 lg:-mt-20" aria-hidden="true">
		<img
			src="<?php echo esc_url( $silhouette_url ); ?>"
			alt=""
			class="mx-auto block w-full max-w-[1576px]"
		/>
	</div>

	<!-- ── Air background section ───────────────────────────────────── -->
	<div class="bg-air">
		<div class="relative mx-auto max-w-[1280px] px-6 pb-10 lg:px-10">

			<!-- Decorative vector trees (positioned above the card) -->
			<div class="pointer-events-none relative hidden h-0 lg:block" aria-hidden="true">
				<!-- Left tree -->
				<div class="absolute bottom-0 left-[3%] h-[170px] w-[53px]">
					<svg class="h-full w-auto" viewBox="0 0 53.0375 114" fill="none" xmlns="http://www.w3.org/2000/svg">
						<path d="M26.5159 112V18.0636" stroke="#003B45" stroke-width="4" stroke-linecap="round" stroke-linejoin="round"/>
						<path d="M26.5159 65.4532L16.8585 53.6867" stroke="#003B45" stroke-width="4" stroke-linecap="round" stroke-linejoin="round"/>
						<path d="M26.5159 34.7362L16.8585 22.9697" stroke="#003B45" stroke-width="4" stroke-linecap="round" stroke-linejoin="round"/>
						<path d="M26.5159 49.9212L36.1818 38.1462" stroke="#003B45" stroke-width="4" stroke-linecap="round" stroke-linejoin="round"/>
						<path d="M43.7986 28.7592C44.9575 26.0811 45.5285 23.08 45.3438 19.9258C44.7811 10.4378 37.2231 2.70111 27.8512 2.04647C16.8333 1.2813 7.65448 10.1062 7.65448 21.099C7.65448 23.8536 8.23396 26.4722 9.26689 28.8357C10.6189 31.9134 10.0059 35.5266 7.84766 38.0942C4.12744 42.5066 1.9104 48.2539 2.00278 54.5282C2.18753 68.1141 13.4322 79.175 26.8519 78.9964C40.2379 78.8179 51.0375 67.774 51.0375 54.1796C51.0375 48.0328 48.8289 42.4131 45.1758 38.0772C42.9924 35.4926 42.455 31.8709 43.807 28.7592H43.7986Z" stroke="#003B45" stroke-width="4" stroke-linecap="round" stroke-linejoin="round"/>
					</svg>
				</div>

				<!-- Right tree group -->
				<div class="absolute bottom-0 right-[10%] flex items-end gap-6">
					<!-- Round tree -->
					<div class="h-[140px] w-[66px]">
						<svg class="h-full w-auto" viewBox="0 0 65.6873 94" fill="none" xmlns="http://www.w3.org/2000/svg">
							<path d="M32.8437 63.2954C49.8782 63.2954 63.6873 49.574 63.6873 32.6477C63.6873 15.7215 49.8782 2 32.8437 2C15.8092 2 2 15.7215 2 32.6477C2 49.574 15.8092 63.2954 32.8437 63.2954Z" stroke="#003B45" stroke-width="4" stroke-linecap="round" stroke-linejoin="round"/>
							<path d="M32.8437 92.0001V18.576" stroke="#003B45" stroke-width="4" stroke-linecap="round" stroke-linejoin="round"/>
							<path d="M32.8437 50.8087L18.915 36.6177" stroke="#003B45" stroke-width="4" stroke-linecap="round" stroke-linejoin="round"/>
							<path d="M32.8437 50.8087L46.7653 36.6177" stroke="#003B45" stroke-width="4" stroke-linecap="round" stroke-linejoin="round"/>
							<path d="M32.8436 35.4538L22.9248 25.3455" stroke="#003B45" stroke-width="4" stroke-linecap="round" stroke-linejoin="round"/>
							<path d="M32.8436 35.4537L42.7554 25.3453" stroke="#003B45" stroke-width="4" stroke-linecap="round" stroke-linejoin="round"/>
						</svg>
					</div>
					<!-- Pine tree -->
					<div class="h-[200px] w-[87px]">
						<svg class="h-full w-auto" viewBox="0 0 87.3949 208" fill="none" xmlns="http://www.w3.org/2000/svg">
							<path d="M43.6973 2V69.7637V206" stroke="#003B45" stroke-width="4" stroke-linecap="round" stroke-linejoin="round"/>
							<path d="M43.6976 16.2123L2 57.9092" stroke="#003B45" stroke-width="4" stroke-linecap="round" stroke-linejoin="round"/>
							<path d="M43.6973 16.2125L85.3949 57.9094" stroke="#003B45" stroke-width="4" stroke-linecap="round" stroke-linejoin="round"/>
							<path d="M43.6976 78.2558L2 119.953" stroke="#003B45" stroke-width="4" stroke-linecap="round" stroke-linejoin="round"/>
							<path d="M43.6973 78.2558L85.3949 119.953" stroke="#003B45" stroke-width="4" stroke-linecap="round" stroke-linejoin="round"/>
							<path d="M43.6977 47.2247L2.00001 88.9216" stroke="#003B45" stroke-width="4" stroke-linecap="round" stroke-linejoin="round"/>
							<path d="M43.6973 47.2247L85.3949 88.9216" stroke="#003B45" stroke-width="4" stroke-linecap="round" stroke-linejoin="round"/>
							<path d="M43.6976 109.265L2 150.961" stroke="#003B45" stroke-width="4" stroke-linecap="round" stroke-linejoin="round"/>
							<path d="M43.6973 109.264L85.3949 150.961" stroke="#003B45" stroke-width="4" stroke-linecap="round" stroke-linejoin="round"/>
						</svg>
					</div>
				</div>
			</div>

			<!-- ── Dark CTA card ────────────────────────────────────────── -->
			<div class="flex flex-col gap-10 rounded-container-md bg-forest p-6 shadow-sm lg:flex-row lg:items-end lg:p-10">

				<!-- Left: heading + body -->
				<div class="flex flex-1 flex-col gap-4 lg:pb-10">
					<?php if ( $card_heading ) : ?>
						<h3 class="font-heading text-display-lg font-semibold text-[#fff]">
							<?php echo esc_html( $card_heading ); ?>
						</h3>
					<?php endif; ?>

					<?php if ( $card_body ) : ?>
						<p class="font-body text-body-lg text-[#fff]">
							<?php echo esc_html( $card_body ); ?>
						</p>
					<?php endif; ?>
				</div>

				<!-- Right: caption + buttons -->
				<?php if ( $caption || ! empty( $buttons ) ) : ?>
					<div class="flex shrink-0 flex-col gap-4">
						<?php if ( $caption ) : ?>
							<p class="font-body text-body-lg text-[#fff]">
								<?php echo esc_html( $caption ); ?>
							</p>
						<?php endif; ?>

						<?php if ( ! empty( $buttons ) ) : ?>
							<div class="flex flex-wrap gap-4">
								<?php foreach ( $buttons as $btn ) : ?>
									<?php echo fb_button( $btn['link'] ?? [] ); ?>
								<?php endforeach; ?>
							</div>
						<?php endif; ?>
					</div>
				<?php endif; ?>

			</div>

		</div>
	</div>

</div>

<?php $b->close_tag(); ?>
