<?php require_once "header.php";?>
<?php


?>
<article>
<section class="ps-top-section">
    <?php if(get_post_thumbnail_id()):?>
    <div class="ps-top-hero layout-poster-container">
        <?php $components["lazy_img"](array(
            "id" => get_post_thumbnail_id(),
            "is_poster" => true, 
            "extra_classes" => "layout-poster-img"
        )) ?>
    </div>
    <?php endif?>
    <div class="ps-top-info-container">
        <div class="ps-top-info">
            <h1 class="type-article-heading"><?= get_the_title()?></h1> 
            <?php if(has_excerpt()):?>
            <h2 class="type-tagline ps-project-tag "><?= get_the_excerpt() ?></h2>
            <?php endif?>
        </div>
    </div>

</section>
<section class="copy-area copy-area-reading-section">

<?php
if(count(array_map(function($c){
    return $c->slug == "password-protected";
},get_the_category()))) {
    $components["pw_check"]($post->ID);
} else {
the_content() ;
}


?>
 
</section>
<? $components["end_bullet"]()?>
<div class="layout-bottom-reading-section">
    <?php  $learn = get_post_meta($post->ID,"whatilearned",true)?>
    <?php if($learn):?>
    <section class="ps-what-i-learned font-sans">
        <?php $components["small_header"](3, "What I learned")?>
        <ul class="type-smaller">
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

</div>







</article>

<?php require_once "footer.php";?>