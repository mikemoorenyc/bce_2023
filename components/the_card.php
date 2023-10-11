<?php
//VALUES: cta_text, image_id, link, title, tagline, kicker
$the_card = function($card) {
    global $components;
    extract($card);

    ?>
<div>
    <?php if($image_id){$components["lazy_img"]($image_id);} ?>
    <div>
        <?php if($kicker):?><div><?=$kicker?></div><?php endif?>
        <h2><a href="<?=$link?>"><?=$title?></a></h2>
        <?php if($tagline):?><div><?=$tagline?></div><?php endif?>
    </div>
    <div>
        <a href="<?=$link?>">
            <span><?= $cta_text ?: "View post" ?></span>
            <?php include THEME_DIRECTORY."/assets/svgs/arrow-right-circle.svg" ?>
        </a>
    </div>

</div>

    <?php
}
?>