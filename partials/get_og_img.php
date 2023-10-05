<?php
function get_og_img() {
   global $post;
    $img_id =  get_post_thumbnail_id($post->ID) ?: get_option('page_on_front');
    
    if(!$img_id) {
        return null; 
    }
    return get_all_image_sizes($img_id)["full"];
}

?>  