<?php require_once "header.php";?>
<?php


?>
<article>
<section class=topsection>
    <?php if(get_post_thumbnail_id()):?>
    <div>
        <?php $components["lazy_img"](get_post_thumbnail_id()) ?>
    </div>
    <?php endif?>
    <div>
        <div>
            <h1><?= get_the_title()?></h1> 
            <?php if(has_excerpt()):?>
            <h2><?= get_the_excerpt() ?></h2>
            <?php endif?>
        </div>
    </div>

</section>

<section>
    <?= get_the_content();?>
</section>
<hr class="endbullet" />
<?php  $learn = get_post_meta($post->ID,"whatilearned",true)?>
<?php if($learn):?>
<section>
    <?php $components["small_header"](3, "What I learned")?>
    <ul>
        <?php foreach(explode(",",$learn) as $l):?>
            <li><?= trim($l)?></li>
        <?php endforeach?>
    </ul>
</section>
<?php endif?>
<?php
if(get_the_tags()) {
    
    $components["tag_list"](get_the_tags());
}
?>
<?php 
$more_posts = $utility_functions["create_more_posts"]($post->ID, "projects");
$components["more_posts"](array_map(function($p){
    $p["cta_text"] = "View case study";
    return $p; 
}, $more_posts), "More case studies");
?>

</article>

<?php require_once "footer.php";?>