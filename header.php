<?php
define("THEME_URL", get_bloginfo('template_url'));
define("THEME_DIRECTORY",get_template_directory());
define("CACHE_BREAK",time());

$js_globals = array(
    "theme_url" => THEME_URL,
    "ajax_url" => admin_url("admin-ajax.php"),
    "post_id" => $post->ID,
    "colors" => explode(" ",get_option("colors", ""))
);
include_once THEME_DIRECTORY."/partials/get_all_image_sizes.php";
include_once THEME_DIRECTORY."/partials/get_og_img.php";
$card_url = get_og_img();



?><!DOCTYPE html>
<html lang="en">
<head>
<?
$pages = get_pages();

if($pages){
    foreach($pages as $p) {
        
        ?>
        <link rel="prefetch" href="<?=get_permalink($p->ID);?>" />
        <?php
        
    }
}
?>
<link rel='stylesheet' href="<?= THEME_URL;?>/css/front-end.css?v=<?= CACHE_BREAK;?>" type="text/css" />
<?php //removeIf(production) 
?>
<link rel='stylesheet' href="<?= THEME_URL;?>/css/grid-lines.css?v=<?= CACHE_BREAK;?>" type="text/css" />
<?php
 //endRemoveIf(production)
?>



<script>
var WP_GLOBALS = <?= json_encode($js_globals);?>
</script>
<meta name="robots" content="max-image-preview:large, NOODP, NOYDIR" />

<meta name="viewport" content="width=device-width, initial-scale=1.0">

<?php $page_header = (is_front_page()? "": get_the_title()." - ").get_bloginfo("name")." - ".get_bloginfo("description");?>
<?php $page_title = is_front_page()? get_bloginfo("name"): get_the_title();?>
<?php
if(is_archive()) {
    
    $page_header = "Things tagged: ". get_queried_object()->name ." - ".get_bloginfo("name")." - ".get_bloginfo("description");
}

?>
<?php $excerpt = is_front_page()? get_post_custom($post->ID)["homepage_copy"][0] : str_replace("[&hellip;]","",get_the_excerpt()); ?>

<link rel="canonical" href="<?= wp_get_canonical_url();?>" />
<title><?=  $page_header;?></title>
<meta name="description" content="<?=$excerpt;?>" itemprop="description">  
<!-- Facebook Open Graph Tags -->
<meta property="og:type" content="website" />
<meta property="og:site_name" content="<?= get_bloginfo("name");?>" />
<meta property="og:url" content="<?= wp_get_canonical_url();?>" />
<meta property="og:title" content="<?= $page_title;?>" />
<meta property="og:description" content="<?=$excerpt;?>" />
<?php
if($card_url) {
    ?>
<meta property="og:image" content="<?=$card_url['url'];?>" />
<meta property="og:image:width" content="<?=$card_url['width'];?>" />
<meta property="og:image:height" content="<?=$card_url['height'];?>" />
    <?php
}
?>
<meta property="article:author" content="<?=get_bloginfo("url");?>" />  
<!-- Twitter Cards -->
<meta name="twitter:card" content="<?=($card_url && $card_url["width"]>500)?"summary_large_image" : "summary";  ?>" />
<meta name="twitter:title" content="<?php $page_title;?>" />
<meta name="twitter:description" content="<?=$excerpt?>" />
<?php if($card_url) {
?>
<meta name="twitter:image" content="<?=$card_url['url'];?>" />
<?php
}
?>


<link rel="icon" href="<?= get_site_icon_url( 32 );?>" sizes="32x32" />
<link rel="icon" href="<?= get_site_icon_url( 192 );?>" sizes="192x192" />
<link rel="apple-touch-icon" href="<?= get_site_icon_url( 180 );?>" />
<meta name="msapplication-TileImage" content="<?= get_site_icon_url( 270 );?>" />

</head>
<body>
<script>

var color = WP_GLOBALS.colors[Math.floor(Math.random() * WP_GLOBALS.colors.length)]
var st = document.createElement("style");
st.innerText = `:root{--the-color: ${color}}`;

document.querySelector("head").appendChild(st);

</script>
<style>
@import "<?= THEME_URL;?>/css/dark-mode.css?v=<?= CACHE_BREAK;?>";
</style>
<a href="#main" class="skip-content no-underline font-sans after-block">Skip to content</a>

<header class="header">
    <a href="<?=get_home_url();?>" class="header-spinner before-block header__center normal-hover" aria-hidden=true></a>
    

    <?php $nav = wp_get_nav_menu_items('Main Menu');?>
    <?php if($nav): ?>
        <div class="header-nav-container">
        <div class="header-lockup">
            <a href="<?=get_home_url()?>" class="header-lockup-title no-underline font-sans normal-hover">
                <span><?=get_bloginfo("title")?></span>
            </a>
            <div class="header-lockup-tagline"><?= get_bloginfo("description")?></div>

        </div>
            <nav class="header-nav">
                <ul class="header-nav-ul">
<?php

$active_slug = $post->post_name;
$type = $post->post_type;

if($type == "projects") {
    $active_slug ="projects";
}
if($type == "post") {
    $active_slug = "blog";
}
function set_active_state($n,$c) {
    global $active_slug;
    // $n->ID, '_menu_item_object_id', true )
    $page = get_post($n->object_id);

    if($page->post_name == $active_slug){
        return " ".$c."--active";
    }
    return "";
} 

?>
        <?php foreach($nav as $n):?>
       


            <?php $active_state =  (get_permalink($post->ID) == $n->url)?>
            <li data-slug=<?=$post->post_name?> class="header-nav-ul-li <?= set_active_state($n,"header-nav-ul-li");?>"><a class="header-nav-ul-li-a <?=set_active_state($n,"header-nav-ul-li-a")?>"  href="<?=$n->url?>"><span><?=$n->title?></span></a></li>
            <?php
        ?>

        <?php endforeach?>

                </ul>
            </nav>
        </div>

    <?php endif?>
    
    
    
    <button aria-hidden=true class="header-mob-toggle header__center before-block after-block"> 
        <span data-state="closed" class="header-mob-toggle-icon header-mob-toggle-icon--active middle-center">
            <?php include "assets/svgs/menu.svg" ?>
        </span>
        <span data-state="opened" class="header-mob-toggle-icon  middle-center ">
            <?php include "assets/svgs/cancel.svg"?>
        </span>
    </button>

</header>


<div id="footer-grid-wrap">
    <main id="main" class="main-content-container">
    <div id="header-test" aria-hidden=true></div>

