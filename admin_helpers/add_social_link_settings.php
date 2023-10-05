<?php 
function add_social_link_settings() {
  register_setting("general","social_link_settings","esc_attr");
  add_settings_field("social_link_settings", "<label>Social Links</label>", function($args){
    $value = get_option("social_link_settings", "");
?>
<textarea id="social_link_settings" name="social_link_settings" rows="4" class="large-text code"><?=$value?></textarea>
<p class="description" >Put each social media link on a seperate link in <i>Name of social media, URL</i> format.</p>            
<?php
    },"general", );


}
add_filter('admin_init', 'add_social_link_settings');

?>
