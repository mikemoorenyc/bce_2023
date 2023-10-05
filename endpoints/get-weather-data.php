
<?php
function get_weather_data(){
    
    $api = get_option("weather_api_key","");
    $lat_lon = array_map(fn($l)=>trim($l),explode(",",get_option("weather_lat_lon"))); 
    $json_path = get_template_directory()."/weather_data.json";
    $modified = file_exists($json_path)? filemtime($json_path) : 0;
    //Check if the file is older than an hour
   
    if(time() - $modified > 3600) {
    
   
        $json_data = file_get_contents("https://api.openweathermap.org/data/2.5/weather?lat={$lat_lon[0]}&lon={$lat_lon[1]}&appid={$api}&units=imperial");
     
        file_put_contents($json_path, $json_data);
        echo $json_data;
        die(); 
    }

    $data = file_get_contents(get_template_directory()."/weather_data.json");
    echo $data;
    die(); 

}


add_action('wp_ajax_nopriv_get_weather_data','get_weather_data');
add_action('wp_ajax_get_weather_data','get_weather_data');
?>