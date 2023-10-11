<?php require_once "header.php";?>
<?php $tag = get_queried_object();?>
<?php $components["landing_header"]("Things tagged to: ".$tag->name);?>
<?php



$posts = get_posts(array(
    'posts_per_page' => -1,
    'orderby' => "date",
    "order" => "DESC",
    "post_type" => ["post","projects"],
    'tax_query' => array(
        array(
            'taxonomy' => 'post_tag',
            'field'    => 'slug',
            'terms'    => $tag->slug
        )
    )

));

function card_maker($p) {
    global $utility_functions;
    $id = $p->ID;
    $type = $p->post_type;
    return array(
        "title" => $p->post_title,
        "image_id" => get_post_thumbnail_id($id),
        "link" => get_permalink($id),
        "cta_text" => ($type == "post") ? "Read post" :"View case study",
        "kicker" => ($type=="post") ? "Post from ".get_the_date("M Y",$id)  : "Case study",
        "tagline" => has_excerpt() ? get_the_excerpt($id):NULL
    );
}
$posts = array_map("card_maker",$posts);
$components["big_card_list"]($posts)

?>

<?php require_once "footer.php";?>