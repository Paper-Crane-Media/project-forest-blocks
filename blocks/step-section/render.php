<?php
/**
 * Step Section Block — render template.
 *
 * Sticky scroll interaction: left column has a sticky image that swaps as the user
 * scrolls through numbered step cards on the right. Dark forest header with tree
 * silhouette overlay and optional parallax.
 *
 * @param array  $block      The block settings and attributes.
 * @param string $content    The block inner HTML (empty for ACF blocks).
 * @param bool   $is_preview True during block preview in the editor.
 * @param int    $post_id    The post ID the block is rendering on.
 * @param array  $context    The context passed to the block.
 */

$b = new FB_Block( $block, $is_preview, $post_id );

$eyebrow = $b->field( 'eyebrow', '' );
$heading = $b->field( 'heading', '' );
$steps   = $b->field( 'steps', [] );
?>
<?php $b->open_tag( 'step-section' ); ?>

<div>
	<!-- Tree header: dark forest bg with tree silhouette overlay -->
	<div class="relative overflow-hidden bg-forest-80 h-[clamp(180px,25vw,352px)]">
		<div class="w-[120%] -translate-x-[10%] h-full">
			<img
				src="<?php echo esc_url( FOREST_BLOCKS_URL . 'assets/images/tree-header.svg' ); ?>"
				alt=""
				class="step-section__trees pointer-events-none absolute inset-0 h-full w-full object-cover object-bottom"
				aria-hidden="true"
			/>

		</div>
	</div>
	<!-- Main content area -->
	<div class="bg-air -mt-[3px] z-10 px-6 pb-10 pt-6 lg:px-10 lg:pb-10">
		<div class="mx-auto max-w-[1280px]">

			<!-- Two-column layout -->
			<div class="flex flex-col gap-10 lg:flex-row lg:items-start lg:gap-10">

				<!-- LEFT COLUMN: Sticky on desktop -->
				<div class="flex flex-col lg:sticky lg:top-[5.5rem] lg:flex-1 lg:self-start">

					<!-- Header group -->
					<div class="flex flex-col gap-3 pb-4">
						<?php if ( $eyebrow ) : ?>
							<div class="self-start">
								<?php echo fb_eyebrow( $eyebrow ); ?>
							</div>
						<?php endif; ?>

						<?php if ( $heading ) : ?>
							<h5 class="font-semibold">
								<?php echo esc_html( $heading ); ?>
							</h5>
						<?php endif; ?>
					</div>

					<!-- Sticky image area (desktop only) -->
					<?php if ( ! empty( $steps ) ) : ?>
						<div class="hidden lg:block">
							<div class="step-section__visuals relative aspect-square w-full overflow-hidden rounded-container-md">
								<?php foreach ( $steps as $i => $step ) : ?>
									<?php if ( ! empty( $step['image']['ID'] ) ) : ?>
										<div
											class="step-section__image absolute inset-0 <?php echo 0 === $i ? 'opacity-100' : 'opacity-0'; ?>"
											data-step-index="<?php echo esc_attr( $i ); ?>"
										>
											<?php echo wp_get_attachment_image(
												$step['image']['ID'],
												'large',
												false,
												[ 'class' => 'h-full w-full object-cover' ]
											); ?>
										</div>
									<?php endif; ?>
								<?php endforeach; ?>
							</div>
						</div>
					<?php endif; ?>

				</div>

				<!-- RIGHT COLUMN: Step cards -->
				<?php if ( ! empty( $steps ) ) : ?>
					<div class="flex w-full flex-col gap-6 lg:w-[721px] lg:shrink-0 lg:gap-12 lg:pt-[40vh] lg:pb-[40vh]">
						<?php foreach ( $steps as $i => $step ) : ?>
							<?php
							$step_title = $step['title'] ?? '';
							$step_num   = str_pad( $i + 1, 2, '0', STR_PAD_LEFT );
							?>

							<!-- Step card -->
							<div
								class="step-section__card flex items-center gap-6 rounded-container-xl bg-[#fff] py-4 pl-4 pr-8 shadow-sm overflow-clip transition-transform duration-300 <?php echo 0 === $i ? 'scale-[1.01]' : ''; ?>"
								data-step-index="<?php echo esc_attr( $i ); ?>"
							>
								<!-- Numbered icon with decorative arc -->
								<div class="relative flex h-24 w-24 shrink-0 items-center justify-center">

									<!-- Number circle -->
									<div class="step-section__circle relative z-10 ml-3 flex h-16 w-16 shrink-0 items-center justify-center rounded-full bg-forest p-2 transition-opacity duration-300 <?php echo 0 !== $i ? 'opacity-30' : ''; ?>">
										<!-- Decorative arc (forest-80 curved line wrapping left side of circle) -->
										<svg
											class="step-section__arc half-circle absolute w-[150%] h-[130%] -ml-[75%] -rotate-90 -scale-y-100 transition-opacity duration-300 <?php echo 0 !== $i ? 'opacity-30' : ''; ?>"
											viewBox="0 0 93.4072 49.4072"
											fill="none"
											xmlns="http://www.w3.org/2000/svg"
											aria-hidden="true"
										>
											<path d="M2.50293 2.5C2.50262 2.56787 2.5 2.63616 2.5 2.7041C2.50021 27.117 22.2912 46.9072 46.7041 46.9072C71.1168 46.907 90.907 27.1168 90.9072 2.7041C90.9072 2.63616 90.9046 2.56787 90.9043 2.5" stroke="#0c606d" stroke-width="5" stroke-linecap="round"/>
										</svg>
										<span class="step-section__number flex font-display text-display-md font-semibold leading-none text-air transition-transform duration-300 <?php echo 0 === $i ? 'scale-[1.02]' : ''; ?>">
											<?php foreach ( str_split( $step_num ) as $d ) : ?>
												<span class="step-section__digit inline-block overflow-hidden h-[1.1em] leading-[1.1]">
													<span class="step-section__digit-track flex flex-col">
														<span class="block h-[1.1em] leading-[1.1]"><?php echo esc_html( $d ); ?></span>
														<span class="block h-[1.1em] leading-[1.1]"><?php echo esc_html( $d ); ?></span>
													</span>
												</span>
											<?php endforeach; ?>
										</span>
									</div>
								</div>

								<!-- Step title -->
								<div class="flex flex-1 items-center">
									<h6 class="step-section__card-text <?php echo 0 !== $i ? 'opacity-25' : ''; ?>">
										<?php echo esc_html( $step_title ); ?>
									</h6>
								</div>
							</div>

						<?php endforeach; ?>
					</div>
				<?php endif; ?>

			</div>

		</div>
	</div>
</div>

<?php $b->close_tag(); ?>
