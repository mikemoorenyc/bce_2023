<?php 
function add_email_settings() {
  register_setting("general","email_users","esc_attr");
  add_settings_field("email_users", "<label>Contact Emails</label>", function($args){
    $value = get_option("email_users", "");
?>
<textarea id="email_users" name="email_users" rows="4" class="large-text code"><?=$value?></textarea>
<p class="description" >Put every email address you want contact form responses in a comma seperated list</p>            
<?php
    },"general", );


}
add_filter('admin_init', 'add_email_settings');

?>
