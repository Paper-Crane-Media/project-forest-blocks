<?php
/**
 * Full-width Link Block — render template.
 *
 * @param array  $block      The block settings and attributes.
 * @param string $content    The block inner HTML (empty for ACF blocks).
 * @param bool   $is_preview True during block preview in the editor.
 * @param int    $post_id    The post ID the block is rendering on.
 * @param array  $context    The context passed to the block.
 */

$b    = new FB_Block( $block, $is_preview, $post_id );
$link = $b->field( 'link' );
?>
<?php $b->open_tag( 'full-width-link' ); ?>
<div class="bg-fire py-10">
	<div class="mx-auto w-[94%] max-w-container">
	<?php if ( ! empty( $link['url'] ) ) : ?>
		<?php echo fb_text_link( $link ); ?>
	<?php else : ?>
		<span class="inline-flex items-center gap-2 pr-4 py-3 font-display text-button-md font-semibold text-[#fff]">
			Link text
			<svg class="h-6 w-6 shrink-0" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24" aria-hidden="true">
				<path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7"/>
			</svg>
		</span>
	<?php endif; ?>
	</div>
</div>
<?php $b->close_tag(); ?>
