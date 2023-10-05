<?php /*** Template Name: Home page */?>
<?php require_once "header.php";?>
<div class="homepage-container">
    <h1 style="background-image: url(<?=THEME_URL."./assets/logo.png"?>)" class="homepage-logo"><?= get_bloginfo("name")?></h1>
    <?php
    $nav_items = wp_get_nav_menu_items("homepage");
    $nav_button_classes = "homepage-nav-button";
    $nav_container_classes = "homepage-nav-container";
    include THEME_DIRECTORY."/partials/components/big_nav_list.php";
    ?>

    <div class="homepage-copy reading-section translucent-pane">
        <p><?=get_post_meta($post->ID,"homepage_copy",true);?></p>
    </div>  
</div>



<?php require_once "footer.php";?>