<?php
function change_image_html( $block_content, $block ) {
    
return "asdfasf";
    
   
}


foreach(["image","video","buttons","pullquote"] as $b) {
 
    add_filter( 'render_block_core/'.$b, $components["copy_area_".$b], 10, 2 );
}
add_filter( 'render_block_visionboard/visionboard', $components["copy_area_vision_board"], 10, 2 );
//visionboard/visionboard
?>