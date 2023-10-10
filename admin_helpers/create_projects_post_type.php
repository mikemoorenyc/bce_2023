<?php
function project_post_init() {
    //PROPERTY
    $args = array(
      'label' => 'Projects',
      'public' => true,
      'labels' => array(
        'add_new_item' => 'Add New Project',
        'name' => 'Projects',
        'edit_item' => 'Edit Project',
        'search_items' => 'Search Projects',
        'not_found' => 'No Projects found.',
        'all_items' => 'All Projects'
      ),
      'show_ui' => true,
      'capability_type' => 'page',
      'hierarchical' =>true,
      'has_archive' => false,
      'graphql_single_name' => 'project',
      'graphql_plural_name' => "projects",
       'show_in_graphql' => true,
      'rewrite' => array('slug' => 'projects'),
      'query_var' => true,
      'menu_icon' =>'dashicons-hammer',
        'show_in_rest' => true,
     'taxonomies'          => array( 'category' ),
      'supports' => array(
          'title',
          'editor',
          'revisions',
          'page-attributes',
          'thumbnail',
          'excerpt',
          'custom-fields'
        )
      );
    register_post_type( 'projects', $args );
    register_taxonomy_for_object_type( 'post_tag', 'projects' );
        register_taxonomy_for_object_type( 'category', 'projects' );
    }
    add_action( 'init', 'project_post_init' );
 ?>