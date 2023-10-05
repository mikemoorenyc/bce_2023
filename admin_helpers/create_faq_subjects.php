<?php
add_action( 'init', 'create_subjects_hierarchical_taxonomy', 0 );
  
//create a custom taxonomy name it subjects for your posts
  
function create_subjects_hierarchical_taxonomy() {
  
// Add new taxonomy, make it hierarchical like categories
//first do the translations part for GUI
  
  $labels = array(
    'name' => _x( 'Subjects', 'taxonomy general name' ),
    'singular_name' => _x( 'Subject', 'taxonomy singular name' ),
    'search_items' =>  __( 'Search Subjects' ),
    'all_items' => __( 'All Subjects' ),
    'parent_item' => __( 'Parent Subject' ),
    'parent_item_colon' => __( 'Parent Subject:' ),
    'edit_item' => __( 'Edit Subject' ), 
    'update_item' => __( 'Update Subject' ),
    'add_new_item' => __( 'Add New Subject' ),
    'new_item_name' => __( 'New Subject Name' ),
    'menu_name' => __( 'Subjects' ),
  );    
  
// Now register the taxonomy
  register_taxonomy('subjects',array('books'), array(
    'hierarchical' => true,
    'labels' => $labels,
    'show_ui' => true,
    'show_in_rest' => true,
    'show_admin_column' => true,
    'query_var' => true,
    'rewrite' => array( 'slug' => 'subject' ),
  ));
  
}

?>