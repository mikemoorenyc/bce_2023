<?php
register_setting('general', 'spotify_refresh', 'esc_attr');
add_settings_field('spotify_refresh', '<label >Spotify User</label>' , "spotify_user_html", 'general', 'spotify_section');


function spotify_user_html() {
    
    if($_GET["remove_spotify_user"] == "true") {
        
        update_option("spotify_refresh","");
    }
    $refresh = get_option("spotify_refresh","");
    if(!$refresh && $_GET["code"]) {
      //  update_option("spotify_refresh", $_GET["access_token"]);    
      include get_template_directory()."/admin_helpers/spotify/get_refresh.php";
    }
    //$value = get_option("spotify_refresh", '' );
    $api_id = get_option("spotify_app_id","");
    $api_secret = get_option("spotify_app_secret","");
    echo "<div id=spotify-user>";
    if(!$refresh) {
        $url = 'https://accounts.spotify.com/authorize?client_id='.$api_id.'&redirect_uri=' . urlencode(admin_url( "options-general.php" )).'&scope='.urlencode(join(" ", ["user-read-email","user-read-currently-playing"]))."&response_type=code";
        
        
        ?>
            <a href="<?=$url;?>" class="button">Login to Spotiy</a>
        <?
        
    } else {
        if(!function_exists("get_temp_token")){include_once get_template_directory()."/admin_helpers/spotify/get_temp_token.php";}
        $access_token = get_temp_token($refresh, get_option("spotify_app_id",""),get_option("spotify_app_secret","") );
        include get_template_directory()."/admin_helpers/spotify/get_user_profile.php";
        
        ?>
<div class="spotify-user-container">
    <img src="<?=$user_data->images[0]->url?>" />
    <div class="info">
        <h3><?=$user_data->display_name?></h3>
        <a href="<?=$user_data->href?>" target="_blank">View Profile</a>
    </div>
</div>
<a href="<?=admin_url( "options-general.php" ).'?remove_spotify_user=true';?>" class="button">Remove User</a>
        <?php
    }
    
    echo "</div>";
}
?>