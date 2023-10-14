<?php
//VALUES: cta_text, image_id, link, title, tagline, kicker, extra_classes, style_mod
$the_card = function($card) {
    global $components;
    extract($card);

$class_maker = function($class_name) use($style_mod) {
    if(!$style_mod) {
        return $class_name;
    }
    return $class_name." ".$class_name."--".$style_mod;
};

    ?>
<article class="<?=$class_maker("the-card")?> <?=$extra_classes?>">
    <link rel="prefetch" href="<?=$link;?>" />  
    <?php if($image_id): ?>
    <div class="<?=$class_maker("the-card-img-container")?>">
    <?=$components["lazy_img"](array("id"=>$image_id,"is_poster"=>true));?>
    </div>
    <?php endif;?>
    <div class="<?=$class_maker("the-card-text-area")?>">
        <?php if($kicker):?>
        <div class="<?=$class_maker("the-card-kicker")?> font-sans"><?=$kicker?></div>
        <?php endif?>
        <h2 class="<?=$class_maker("the-card-h2")?>">
            <a class=" the-card-url no-underline normal-hover" href="<?=$link?>"><?=$title?></a>
        </h2>
        <?php if($tagline):?>
        <div class="type-tagline"><?=$tagline?></div>
        <?php endif?>
    </div>
    <div>
        <a href="<?=$link?>" class="<?= $class_maker("the-card-cta")?> font-sans no-underline normal-hover">
            <span><?= $cta_text ?: "View post" ?></span>
            <?php include THEME_DIRECTORY."/assets/svgs/arrow-right-circle.svg" ?>
        </a>
    </div>

</article>

    <?php
}
?>