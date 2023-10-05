<?php
function contact_form_layout(){
    
    if($_SERVER['REQUEST_METHOD'] == "GET" && $_GET["id"]) {
        $id = $_GET["id"];
       
        $data = json_decode(get_post_custom_values( "contact_form_layout", $id )[0] ?: '[]');
       echo json_encode(
            array(
                 "contact_form_layout" => $data
            )
        );
        die();
    }
    if($_SERVER['REQUEST_METHOD'] == "POST") {
        if(!is_user_logged_in()) {
            http_response_code(401);
            die(); 
        }
        $package = json_decode(file_get_contents('php://input'));
        if(!get_post($package->id)) {
            http_response_code(404);
            die();
        }
        $posted_meta = update_post_meta($package->id,"contact_form_layout",json_encode($package->formData));
        if(!$posted_meta) {
            http_response_code(404);
            die(); 
        }
        $good_post = json_decode(
            get_post_meta($package->id, "contact_form_layout",true)
        );
        echo json_encode(array(
            "success" => true,
            "layout" => $good_post
        ));
    }
	

	exit;
}
add_action('wp_ajax_nopriv_contact_form_layout','contact_form_layout');
add_action('wp_ajax_contact_form_layout','contact_form_layout');
?>