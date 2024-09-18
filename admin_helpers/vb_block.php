<?php

function visionboard_visionboard_block_init() {
	$vb = register_block_type( get_template_directory().'/assets/vb_block.json' );


wp_enqueue_script(
        'admin-scripts',
        get_template_directory_uri().'/js/vbBlock.js',
        ['react', 'wp-block-editor', 'wp-blocks', 'wp-element',"wp-tinymce",'react-jsx-runtime'],
        time()
);

	
}


add_action( 'init', 'visionboard_visionboard_block_init' );
