<?php
add_action( 'init', 'create_topics_nonhierarchical_taxonomy', 0 );
  
function create_topics_nonhierarchical_taxonomy() {
  
// Labels part for the GUI
  
  $labels = array(
    'name' => _x( 'Sample Types', 'taxonomy general name' ),
    'singular_name' => _x( 'Sample Type', 'taxonomy singular name' ),
    'search_items' =>  __( 'Search Sample Types' ),
    'popular_items' => __( 'Popular Sample Types' ),
    'all_items' => __( 'All Sample Types' ),
    'parent_item' => null,
    'parent_item_colon' => null,
    'edit_item' => __( 'Edit Sample Type' ), 
    'update_item' => __( 'Update Sample Type' ),
    'add_new_item' => __( 'Add New Sample Type' ),
    'new_item_name' => __( 'New Sample Types' ),
    'separate_items_with_commas' => __( 'Separate sample types with commas' ),
    'add_or_remove_items' => __( 'Add or remove sample types' ),
    'choose_from_most_used' => __( 'Choose from the most used sample types' ),
    'menu_name' => __( 'Sample Types' ),
  ); 
  
// Now register the non-hierarchical taxonomy like tag
  
  register_taxonomy('sample-types','attachment',array(
    'hierarchical' => false,
    'labels' => $labels,
    'show_ui' => true,
    'show_in_rest' => true,
    'show_admin_column' => true,
    'update_count_callback' => '_update_post_term_count',
    'query_var' => true,
    'rewrite' => array( 'slug' => 'sample-type' ),
  ));
}
?>