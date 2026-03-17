<?php
/**
 * Video Block — ACF field group (programmatic).
 *
 * Key convention:
 *   group_fb_video_block
 *   field_fb_video_block_<field>
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

acf_add_local_field_group( [
	'key'      => 'group_fb_video_block',
	'title'    => 'Video Block Fields',
	'fields'   => [
		[
			'key'         => 'field_fb_video_block_heading',
			'label'       => 'Heading',
			'name'        => 'heading',
			'type'        => 'text',
			'placeholder' => 'Get a unique opportunity for your attendees and sponsors.',
		],
		[
			'key'         => 'field_fb_video_block_body',
			'label'       => 'Body Text',
			'name'        => 'body',
			'type'        => 'textarea',
			'rows'        => 3,
			'placeholder' => 'When your event partners with us, we plant trees near your host city.',
		],
		[
			'key'           => 'field_fb_video_block_button',
			'label'         => 'Button',
			'name'          => 'button',
			'type'          => 'link',
			'return_format' => 'array',
		],
		[
			'key'           => 'field_fb_video_block_background_image',
			'label'         => 'Card Background Image',
			'name'          => 'background_image',
			'type'          => 'image',
			'return_format' => 'array',
			'preview_size'  => 'large',
			'instructions'  => 'Image visible behind the content card (e.g. a forest treeline). Displayed with a faded luminosity blend.',
		],
		[
			'key'           => 'field_fb_video_block_video_thumbnail',
			'label'         => 'Video Thumbnail',
			'name'          => 'video_thumbnail',
			'type'          => 'image',
			'return_format' => 'array',
			'preview_size'  => 'large',
			'instructions'  => 'Thumbnail image for the video area. Clicking the play button opens the YouTube video in a lightbox.',
		],
		[
			'key'          => 'field_fb_video_block_video_url',
			'label'        => 'Video URL',
			'name'         => 'video_url',
			'type'         => 'url',
			'placeholder'  => 'https://example.com/video.mp4',
			'instructions' => 'Optional. Direct video file URL (mp4/webm). When set, replaces the thumbnail with an autoplaying looped video.',
		],
		[
			'key'          => 'field_fb_video_block_youtube_url',
			'label'        => 'YouTube URL',
			'name'         => 'youtube_url',
			'type'         => 'url',
			'placeholder'  => 'https://www.youtube.com/watch?v=...',
			'instructions' => 'Full YouTube video URL. Opens in a Fancybox lightbox when the play button is clicked.',
		],
	],
	'location' => [
		[
			[
				'param'    => 'block',
				'operator' => '==',
				'value'    => 'acf/video-block',
			],
		],
	],
] );
