<?php
function faq_post_init() {
//PROPERTY
$args = array(
  'label' => 'FAQs',
  'public' => true,
  'labels' => array(
    'add_new_item' => 'Add New Question',
    'name' => 'FAQs',
    'edit_item' => 'Edit Question',
    'search_items' => 'Search FAQs',
    'not_found' => 'No FAQs found.',
    'all_items' => 'All FAQs'
  ),
  'show_ui' => true,
  'show_in_rest' => true,
  "taxonomies" => ["subjects"],
  'capability_type' => 'page',
  'hierarchical' =>true,
  'has_archive' => false,
  'rewrite' => array('slug' => 'faq'),
  'query_var' => true,
  'menu_icon' =>'dashicons-editor-help',
  'supports' => array(
      'title',
      'editor',
      'revisions',
      'page-attributes',
      'custom-fields',
      "order"
    )
  );
register_post_type( 'faq', $args );

}
add_action( 'init', 'faq_post_init' );
 ?>