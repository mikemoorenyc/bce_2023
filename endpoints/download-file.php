<?php
function download_file() {
    if(!is_user_logged_in()) {
        http_response_code(403);
        die(); 
    }
    // Locate.
$file_name = $_GET['id'];
$file_url = wp_upload_dir()["basedir"]."/submitted_docs"."/" . $file_name;

// Configure.
header("Pragma: public"); // required
header("Expires: 0");
header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
header("Cache-Control: private",false);
header('Content-Type: '.mime_content_type($file_url));
header("Content-Transfer-Encoding: Binary"); 
header("Content-disposition: attachment; filename=\"".$file_name."\"");
header("Content-Length: ".filesize($file_url));

// Actual download.
ob_get_clean();
readfile($file_url);
ob_end_flush();

// Finally, just to be sure that remaining script does not output anything.

    die(); 
}

add_action('wp_ajax_download_file','download_file');
?>
