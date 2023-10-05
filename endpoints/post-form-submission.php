<?php
function post_form_submission() {
//removeIf(development)
if($_SESSION["submission"] == "submitted") {
    http_response_code(403);
    die(); 
}
//endRemoveIf(development)

//removeIf(production)
$dead = rand(0,1);
if($dead > 0) {
    http_response_code(500);
    die(); 
}
//endRemoveIf(production)

    
    function sanitizer($string,$type="text") {
        if($type == "emailAddress") {
            return filter_var($string, FILTER_SANITIZE_EMAIL);
        }
        return htmlentities($string, ENT_QUOTES, 'UTF-8');
    }
    $data = [];
    foreach($_POST as $p) {
        $data[] = json_decode(stripslashes($p));
    }
    
    
    $post_content = "";
    foreach($data as $d) {
        $title = sanitizer($d->title);
        $content = $d->data ? sanitizer($d->data,$d->fieldType) : "No info entered";
        $post_content .= "<b>{$title}</b><p>{$content}</p><br/>";
    }
    $post_title = array_filter($data,function($d){
        return str_contains(strtolower($d->title),"name");
    });
    $post_title = (count($post_title)? $post_title[0]->data :"" )." - ".date('M d Y');
    $post_block = array(
        "post_content" => $post_content,
        "post_type" => 'contact-responses',
        "post_status" => "publish",
        "post_title" => $post_title
    );
    
    //echo $post_content;
    $insert_post = wp_insert_post($post_block);
    if($insert_post === 0 || !is_int($insert_post)) {
        http_response_code(500);
        die(); 
    }
    
    $_SESSION["submission"] = "submitted";
    $email_attachments = [];
    if(count($_FILES)) {
        $upload_folder = wp_upload_dir()["basedir"]."/submitted_docs";
    
        if(!is_dir($upload_folder)) {
            mkdir($upload_folder);
            copy(get_template_directory()."/upload_files_htaccess.txt",$upload_folder."/.htaccess");
        }
        //UPLOAD Files
        
        foreach($_FILES as $f) {
            if(round($f['size'] / 1024 / 1024, 1) > 10) {
                http_response_code(403);
                die(); 
            }
            if($f['error']>0) {
                http_response_code(500);
                die();
            }
            move_uploaded_file($f["tmp_name"], $upload_folder."/".$insert_post."_".basename($f["name"]));
            $email_attachments[] = $f["tmp_name"];
    
        }
        //var_dump($_FILES);
    }
    
    

    
    $to = get_option("email_users", "");
    if($to) {
       $send_mail =  wp_mail($to, "New Contact Form Response - ".$post_title,$post_content,array( 'Content-Type: text/html; charset=UTF-8' ),$email_attachments);
       
    }
    echo json_encode(array(
        "success" => true
    ));

    
    die(); 
}



add_action('wp_ajax_nopriv_post_form_submission','post_form_submission');
add_action('wp_ajax_post_form_submission','post_form_submission');
?>