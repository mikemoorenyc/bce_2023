<?php
add_filter( 'allowed_block_types', 'misha_allowed_block_types' );
 
function misha_allowed_block_types( $allowed_blocks ) {
    $the_post = (get_post($_GET["post"]));

    $allowed_types = ["page","faq"];
    if(!$the_post || !in_array($the_post->post_type,$allowed_types) ) {
        return ;
    }
    $allowed = ['core/paragraph'];
    if($the_post->post_name == "why-to-order") {
      $allowed = array_merge($allowed, ["core/list","core/list-item","core/media-text","core/gallery","core/heading","core/image","core/video","core/pullquote","core/quote","core/cover","core/embed"]);
    }
    
    if($the_post->post_type == "faq") {
      $allowed = array_merge($allowed, ["core/list","core/list-item"]);
    }

    
  return $allowed;
  
 
}
?>