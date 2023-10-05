<?php
function create_weather_integration() {
    add_settings_section(
        'weather_section',
        'Weather Integration',
        fn()=>"",
        'general'
    );
    $fields = [
        array(
            "title" => "API Key",
            "slug" => "weather_api_key",
            "description" => null
        ),
        array(
            "title" => "Latitude & Longitude",
            "slug" => "weather_lat_lon",
            "description" => "Only to 2 decimal points. Comma seperate them i.e., 23.22,45.56"
        )
        ];
    foreach($fields as $f) {
        $id = $f["slug"];
        register_setting("general",$id,"esc_attr");
        add_settings_field($id, "<label>{$f['title']}</label>", function($args){
         
            $id = $args["field"]["slug"];
            $value = get_option($id, "");
           
            ?>
                <input name="<?=$id;?>" type="text" id="<?=$id;?>" value="<?=$value;?>" class="regular-text ltr">
            <?php
            if($args['field']['description']) {
                ?>
                    <p class="description" ><?=$args['field']['description'];?></p>
                <?php
            }
        },"general", "weather_section",array("label_for"=>$id,"field"=>$f));
    }
}


add_filter('admin_init', 'create_weather_integration');
?>