<?php /*** Template Name: Projects Landing */?>
<?php require_once "header.php";?>
<?php $components["landing_header"](get_the_title(), get_the_content());?>
<?php
$posts = get_posts(array(
    'posts_per_page' => -1,
    'orderby' => "menu_order",
    'post_type' => 'projects',
    
));

$p_cards = array_map(function ($p) {
   global $utility_functions;
   return array(
    "image_id" => get_post_thumbnail_id($p->ID),
    "title" => $p->post_title,
    "link" => get_permalink($p->ID),
    "cta_text" => "View case study",
    "tagline" => $utility_functions["truncate_string"](get_the_excerpt($p->ID),75)
   );

},$posts);

?>
<?php $components["big_card_list"]($p_cards)?>

<?php require_once "footer.php";?>