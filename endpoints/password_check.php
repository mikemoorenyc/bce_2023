<?php

function password_check() {
    $key = get_option("password_key", "");
    if($key != trim($_POST['pw'])){
        http_response_code(401);
        die(); 
    } ;
    $post = get_post(intval($_POST["id"]));
   setup_postdata( $post );
	$content = apply_filters( 'the_content', $post->post_content );
	$content = str_replace( ']]>', ']]&gt;', $content ); 
    echo $content;
    die(); 
}

add_action('wp_ajax_nopriv_password_check','password_check');
add_action('wp_ajax_password_check','password_check');

?>