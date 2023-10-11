<?php

$create_more_posts = function($post_id,$post_type) {
    $posts = get_posts(array(
        'posts_per_page' => -1,
        'orderby' => "date",
        'post_type' => $post_type,
        
    ));
    
    $mp = [];
    if($posts < 2) {
        return NULL; 
    }
    $end = count($posts) - 1; 
    $current_key;
    foreach($posts as $k => $p) {
        if($post_id === $p->ID) {
            $current_key = $k;
            break; 
        }
    }
    $prev_key = ($current_key - 1 > -1) ? $current_key - 1 : $end; 
    $next_key = ($current_key + 1 <= $end) ? $current_key + 1 : 0;
    $mp = [$posts[$prev_key], $posts[$next_key]]; 
    
    
    if (count($posts) < 3) {
        $mp = array_filter($posts, function($p) use($post_id){
            return $p->ID !== $post_id;
        });
    };
    return array_map(function($p){
        return (array) $p; 
    }, $mp);
    
}

?>