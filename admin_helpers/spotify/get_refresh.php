<?php
$api_id = get_option("spotify_app_id","");
$api_secret = get_option("spotify_app_secret","");
$headers = array(
    "Accept: */*",
    "Content-Type: application/x-www-form-urlencoded",
    "User-Agent: runscope/0.1",
    "Authorization: Basic " . base64_encode($api_id.':'.$api_secret));

$data = 'grant_type=authorization_code&code='.$_GET["code"].'&redirect_uri='.urlencode(admin_url( "options-general.php" )).'&client_id='.$api_id.'&client_secret='.$api_secret;

$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, 'https://accounts.spotify.com/api/token');
curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
curl_setopt($ch, CURLOPT_POST, 1);
curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
$output = curl_exec($ch);
if ($output === FALSE) {
 echo "cURL Error: " . curl_error($ch);

} else {
    $response = json_decode($output, true);
    if($response['refresh_token']) {
        update_option('spotify_refresh',$response['refresh_token']);
    }
}
?>
