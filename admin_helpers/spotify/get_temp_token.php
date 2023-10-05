<?php
function get_temp_token($refresh, $id, $secret) {
    $headers = array(
        "Accept: */*",
        "Content-Type: application/x-www-form-urlencoded",
        "User-Agent: runscope/0.1",
        "Authorization: Basic " . base64_encode($id.':'.$secret));
    
    $data = 'grant_type=refresh_token&refresh_token='.$refresh;
    
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
     die();
    }
    
    $response = json_decode($output, true);
    
    curl_close($ch);
    
    
    
    $token = $response['access_token'];
    return $token;

}
?>