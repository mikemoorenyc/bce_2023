<?php 
function add_password_setting() {
  register_setting("general","password_key","esc_attr");
  add_settings_field("password_key", "<label>Password Key</label>", function($args){
    $value = get_option("password_key", "");
?>
<input value="<?=$value?>" id="password_key" name="password_key" rows="4" class="regular-text" />
            
<?php
    },"general", );


}
add_filter('admin_init', 'add_password_setting');

function add_color_setting() {
  register_setting("general","colors","esc_attr");
  add_settings_field("colors", "<label>Colors</label>", function($args){
    $value = get_option("colors", "");
?>
<input value="<?=$value?>" id="colors" name="colors" rows="4" class="regular-text" />
            
<?php
    },"general", );


}
add_filter('admin_init', 'add_color_setting');

?>
