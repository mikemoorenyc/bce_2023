<?php
//removeIf(production)
$output = '{ "display_name" : "Mike Moore", "email" : "tigerhollowpoint@gmail.com", "external_urls" : { "spotify" : "https://open.spotify.com/user/mikeyfrecks" }, "followers" : { "href" : null, "total" : 28 }, "href" : "https://api.spotify.com/v1/users/mikeyfrecks", "id" : "mikeyfrecks", "images" : [ { "height" : null, "url" : "https://scontent-atl3-1.xx.fbcdn.net/v/t1.6435-1/57056119_10156475609548195_7236821994551902208_n.jpg?stp=dst-jpg_p320x320&_nc_cat=105&ccb=1-7&_nc_sid=0c64ff&_nc_ohc=PfldaBqlb0YAX9uJe0c&_nc_ht=scontent-atl3-1.xx&edm=AP4hL3IEAAAA&oh=00_AfDDORO4uVxZPF3yLnPxwV1EYDxrnxXfvXwt1TabBNqkaw&oe=6426A028", "width" : null } ], "type" : "user", "uri" : "spotify:user:mikeyfrecks" }';
 //endRemoveIf(production)
 //removeIf(development)
$api_id = get_option("spotify_app_id","");
$api_secret = get_option("spotify_app_secret","");
$token = get_option("spotify_refresh", '' );
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, "https://api.spotify.com/v1/me");
curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
curl_setopt($ch, CURLOPT_HEADER, FALSE);
curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
curl_setopt($ch, CURLOPT_HTTPHEADER, array(
  "Content-Type: application/json",
  'Authorization: Bearer '.$access_token
));
$output = curl_exec($ch);
if ($output === FALSE) {
  echo "cURL Error: " . curl_error($ch);
  
}
curl_close($ch);
 //endRemoveIf(development)
$user_data = json_decode($output);

?>