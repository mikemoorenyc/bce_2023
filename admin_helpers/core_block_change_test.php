<?php
function change_image_html( $block_content, $block ) {

    //var_dump($block);
}

add_filter( 'render_block_core/image', 'change_image_html', 10, 2 );
?>