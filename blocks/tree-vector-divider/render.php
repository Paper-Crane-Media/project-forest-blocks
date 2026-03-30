<?php
/**
 * Tree Vector Divider — render template.
 *
 * Decorative forest-coloured bar with animated SVG trees.
 * Left cluster: pine, simple, round.
 * Right cluster: simple, simple, round, triangle.
 * Trees use stroke-draw animation via data-tree-grow / data-tree-grow-group.
 *
 * @param array  $block      The block settings and attributes.
 * @param string $content    The block inner HTML (empty for ACF blocks).
 * @param bool   $is_preview True during block preview in the editor.
 * @param int    $post_id    The post ID the block is rendering on.
 * @param array  $context    The context passed to the block.
 */

$b           = new FB_Block( $block, $is_preview, $post_id );
$pattern_url = FOREST_BLOCKS_URL . 'assets/images/pattern-forest.png';
?>
<?php $b->open_tag( 'tree-vector-divider' ); ?>
<div class="relative overflow-hidden pt-6 lg:pt-10 pb-0">

	<!-- Forest background + repeating pattern -->
	<div class="pointer-events-none absolute inset-0" aria-hidden="true">
		<div class="absolute inset-0 bg-forest"></div>
		<!-- <div
			class="absolute inset-0 mix-blend-overlay opacity-[0.16]"
			style="background-image: url('<?php echo esc_url( $pattern_url ); ?>'); background-size: var(--fb-pattern-size);"
		></div> -->
	</div>

	<!-- Trees -->
	<div class="h-16 lg:h-24 relative mx-auto flex w-full max-w-container items-end justify-between px-6 text-fire lg:px-10" aria-hidden="true" data-tree-grow-group>

		<!-- Left cluster -->
		<div class="hidden lg:flex items-end gap-9 lg:gap-5 lg:absolute left-0">
			<div class="h-16 lg:h-24 relative -left-3" data-tree-grow="simple" data-tree-delay="0.2">
				<?php include FOREST_BLOCKS_PATH . 'assets/images/tree-simple.svg'; ?>
			</div>
			<div class="h-16 lg:h-24" data-tree-grow="pine">
				<?php include FOREST_BLOCKS_PATH . 'assets/images/tree-pine.svg'; ?>
			</div>
			<div class="h-16 lg:h-24" data-tree-grow="round" data-tree-delay="0.4">
				<?php include FOREST_BLOCKS_PATH . 'assets/images/tree-round.svg'; ?>
			</div>
		</div>

		<!-- Right cluster -->
		<div class="flex items-end gap-[9rem] lg:absolute right-0">
			<div class="flex gap-8">
				<div class="h-16 lg:h-24" data-tree-grow="simple" data-tree-delay="0.3">
					<?php include FOREST_BLOCKS_PATH . 'assets/images/tree-simple.svg'; ?>
				</div>
				<div class="h-16 lg:h-24" data-tree-grow="round" data-tree-delay="0.5">
					<?php include FOREST_BLOCKS_PATH . 'assets/images/tree-round.svg'; ?>
				</div>
			</div>
			<div class="h-16 lg:h-24" data-tree-grow="triangle" data-tree-delay="0.6">
				<?php include FOREST_BLOCKS_PATH . 'assets/images/tree-triangle.svg'; ?>
			</div>
		</div>

	</div>

</div>
<?php $b->close_tag(); ?>
