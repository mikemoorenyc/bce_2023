<?php
define("THEME_URL", get_bloginfo('template_url'));
define("THEME_DIRECTORY",get_template_directory());
define("CACHE_BREAK",time());

$js_globals = array(
    "theme_url" => THEME_URL,
    "ajax_url" => admin_url("admin-ajax.php"),
    "post_id" => $post->ID
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
        //removeIf(development)
        ?>
        
        <link rel="prefetch" href="<?=get_permalink($p->ID);?>" />
        <?php
        //endRemoveIf(development)
    }
}
?>
<link rel='stylesheet' href="<?= THEME_URL;?>/css/front-end.css?v=<?= CACHE_BREAK;?>" type="text/css" />
<script>
var WP_GLOBALS = <?= json_encode($js_globals);?>
</script>
<meta name="robots" content="max-image-preview:large, NOODP, NOYDIR" />

<meta name="viewport" content="width=device-width, initial-scale=1.0">

<?php $page_header = (is_front_page()? "": get_the_title()." - ").get_bloginfo("name")." - ".get_bloginfo("description");?>
<?php $page_title = is_front_page()? get_bloginfo("name"): get_the_title();?>
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
<?php
if(!is_front_page()) {
    ?>
<header>
    <a class="header-logo" href="<?=get_home_url();?>">
        <img src="<?=THEME_URL."/assets/interior_logo.svg"?>" title="<?=get_bloginfo('name');?>" alt="Logo for <?=get_bloginfo('name');?>"/><span class="is-hidden"><?=get_bloginfo('name');?></span>
    </a>
    <?php
    $btn_attributes = 'class="menu-opener" data-open-text="Menu" data-close-text="Close"';
    $btn_initial_text = "Menu";
    ?>
    
    <button class="menu-opener" data-open-text="Menu" data-close-text="Close">
        <span class="button-base button-base_x-sm menu-opener-inner ">
            <span aria-hidden="true" role="none" class="menu-opener-icon menu-opener-open"><? include "assets/menu.svg";?></span>
            <span aria-hidden="true" role="none" class="menu-opener-icon menu-opener-close"><? include "assets/cancel.svg";?></span>
            <span class="menu-opener-text">Menu</span>
        </span>
    </button> 
    <div class="main-menu-nav-container">
    <? 
    $nav_container_classes = "main-menu-nav"; 
    $nav_button_classes = "homepage-nav-button";
    $nav_items = wp_get_nav_menu_items("main_menu");
    include "partials/components/big_nav_list.php";?></div> 
</header>
    <?php
}

?>
<main>
<?php 
if(!is_front_page()) {
    ?>

    <h1 class="page_title"><?=get_the_title();?></h1><?php
}
?>

