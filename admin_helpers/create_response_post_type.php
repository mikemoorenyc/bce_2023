<?php

function response_type_init() {
    $args = array(
        "post_type" => "Contact Form Responses",
        "public" => false,
        "show_in_nav_menus" => true,
        "show_ui" => true,
        'menu_icon' =>'dashicons-admin-comments',
        'rewrite' => array('slug' => 'contact-responses'),
        "labels" => array(
            'add_new_item' => 'Add New Response',
            'name' => 'Contact Form Responses',
            'edit_item' => 'Edit Response',
            'search_items' => 'Search Responses',
            'not_found' => 'No Responses found.',
            'all_items' => 'All Responses'
        ),
        "supports" => ["title","author","page-attributes"]
        );
    register_post_type( 'contact-responses', $args );
}
add_action( 'init', 'response_type_init' );
?>