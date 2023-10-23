<?php /*** Template Name: Projects Landing */?>
<?php require_once "header.php";?>
<?php get_template_part("components/landing_header","",array("title" => get_the_title(), "copy"=>get_the_content()) )?>

<?php
$posts = get_posts(array(
    'posts_per_page' => -1,
    'orderby' => "menu_order",
    "order" => "ASC",
    'post_type' => 'projects',
    
));

$p_cards = array_map(function ($p) {
   global $utility_functions;
   return array(
    "image_id" => get_post_thumbnail_id($p->ID),
    "title" => $p->post_title,
    "link" => get_permalink($p->ID),
    "cta_text" => "View case study",
    "tagline" => has_excerpt($p->ID)?$utility_functions["truncate_string"](get_the_excerpt($p->ID),75):null
   );

},$posts);
get_template_part("components/big_card_list","",array("card_list"=>$p_cards));
?>


<?php require_once "footer.php";?>