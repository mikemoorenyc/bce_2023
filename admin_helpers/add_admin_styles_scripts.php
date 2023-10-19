<?php /*
function admin_style() {
    $cache = false;
    //removeIf(production)
    $cache = time();
 //endRemoveIf(production)
    wp_enqueue_style(
        'admin-styles', 
        get_template_directory_uri().'/css/back-end.css',
        [],$cache);
    wp_enqueue_script(
        'admin-scripts',
        get_template_directory_uri().'/js/back-end-entry.js',
        ['wp-element'],
        $cache,
        true
    );

    wp_add_inline_script( 'admin-scripts', 'const post_data = ' . json_encode( get_post($_GET["post"]) ), 'before' );
    $theme_data = array(
      "theme_directory" => get_template_directory_uri(),
      "ajax_url" => admin_url("admin-ajax.php")
    );
    wp_add_inline_script( 'admin-scripts', 'const theme_data = ' . json_encode( $theme_data ), 'before' );

  }*/
  //add_action('admin_enqueue_scripts', 'admin_style');
  ?>
