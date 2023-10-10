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
        
        ?>
        <link rel="prefetch" href="<?=get_permalink($p->ID);?>" />
        <?php
        
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
<a href="#main">Skip to content</a>
<div id="header-test"></div>
<header>
    <a href="<?= get_home_url()?>" class="lockup">
        <span class="spinner" aria-hidden="true"></span>
        <span class="lockup_title"><?= get_bloginfo("")?></span>
        <span class="lock_tagline"><?= get_bloginfo("description")?></span>
    </div>
    <?php $nav = wp_get_nav_menu_items('Main Menu');?>
    <?php if($nav) {
        ?>
    <nav class="header_nav">
        <ul class="header_nav_ul">
        <?php
        foreach($nav as $n) {
            
            ?>
            <li class="header_nav_ul_li <?= (get_permalink($post->ID) == $n->url)? "header_nav_ul--active": ""?>"><a href="<?=$n->url?>"><span><?=$n->title?></span></a></li>
            <?php
        }

        ?>

        </ul>
    </nav>

        <?php
    }?>
    

</header>


<div id="footer-grid-wrap">
    <main id="main-content-container">

