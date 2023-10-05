<?php
function spotify_section_callback() {
    
}
function create_spotify_integration() {
    add_settings_section(
        'spotify_section',
        'Spotify Integration',
        'spotify_section_callback',
        'general'
    );
    include get_template_directory()."/admin_helpers/spotify/refresh_setting.php";
    include get_template_directory()."/admin_helpers/spotify/api_setting.php";
}



add_filter('admin_init', 'create_spotify_integration');

?>