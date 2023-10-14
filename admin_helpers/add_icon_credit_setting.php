<?php 
function add_icon_credit_setting() {
  register_setting("general","icon_credit_setting","esc_attr");
  add_settings_field("icon_credit_setting", "<label>Icon Credit</label>", function($args){
    $value = get_option("icon_credit_setting", "");
?>
<textarea id="icon_credit_setting" name="icon_credit_setting" rows="4" class="large-text code"><?=$value?></textarea>
            
<?php
    },"general", );


}
add_filter('admin_init', 'add_icon_credit_setting');

?>
