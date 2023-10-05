<?php 

if(!function_exists("get_temp_token")){include_once get_template_directory()."/admin_helpers/spotify/get_temp_token.php";}


?>

<?php
function get_now_playing(){
//removeIf(development)
  $token = get_temp_token(get_option("spotify_refresh",""), get_option("spotify_app_id",""), get_option("spotify_app_secret",""));
  $ch = curl_init();
curl_setopt($ch, CURLOPT_URL, "https://api.spotify.com/v1/me/player/currently-playing?additional_types=episode");
curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
curl_setopt($ch, CURLOPT_HEADER, FALSE);
curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
curl_setopt($ch, CURLOPT_HTTPHEADER, array(
  "Content-Type: application/json",
  'Authorization: Bearer '.$token
));
$output = curl_exec($ch);
if ($output === FALSE) {
  echo "cURL Error: " . curl_error($ch);
  
}
curl_close($ch);
$data = json_decode($output);
//endRemoveIf(development)
//removeIf(production)
$options = [null, json_decode(file_get_contents(get_template_directory()."/spotify_episode.json")),json_decode(file_get_contents(get_template_directory()."/spotify_track.json"))];
$data = $options[rand(0, count($options)-1)];


//endRemoveIf(production)
$returnData = array();
$images = [];
if(!$data) {
  echo json_encode($data);
  die(); 
}
if($data->currently_playing_type == "episode") {
  //echo json_encode(array("episode" =>true));
  $img = $data->item->images;
  $title = $data->item->show->name;
  $type = "podcast";
  $artist = null;

}
if($data->currently_playing_type == "track") {
  $img = $data->item->album->images;
  $title = $data->item->name;
  $artist = $data->item->artists;
  $type = "track";
  
}
echo json_encode(array(
  "imgurl" => $img[count($img) - 1],
  "title" => $title,
  "type" => $type,
  "artist" => $artist
));
die();




die();

}


add_action('wp_ajax_nopriv_get_now_playing','get_now_playing');
add_action('wp_ajax_get_now_playing','get_now_playing');
?>