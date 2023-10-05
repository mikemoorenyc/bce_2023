<?php
$settings = [
    array(
        "id" => "spotify_app_id",
        "title" => "App Id"
    ),
    array(
        "id" => "spotify_app_secret",
        "title" => "Spotify App Secret"
)];
foreach($settings as $s) {
    $id = $s["id"];
    register_setting("general", $id, "esc_attr");
    add_settings_field("$id", '<label>'.$s["title"]."</label>",function($args){
        $id = $args["id"];
        $value = get_option($id, '' );
       ?>
       <textarea id="<?=$id?>" name="<?=$id?>" rows="4" class="large-text code"><?=$value?></textarea>
       <?php
    },"general","spotify_section", array("label_for"=>$id, "id" => $id));
}
/*
add_filter('admin_init', 'api_keys_option');
function api_keys_option() {
  register_setting('general', 'api_keys', 'esc_attr');
   add_settings_field('api_keys', '<label for="api_keys">'.__('API Keys' , 'api_keys' ).'</label>' , "api_keys_editor", 'general');
}
function api_keys_editor()
{
    $value = get_option( 'api_keys', '' );
    echo '<textarea id="api_keys" name="api_keys" rows="10" class="large-text code">'. $value.'</textarea>';
}
*/
 ?>