<?php require_once "header.php";?>
<?php


?>
<article>
<section class="ps-top-section">
    <?php if(get_post_thumbnail_id()):?>
    <div class="ps-top-hero layout-poster-container">
        <?php get_template_part("components/lazy_img","",array(
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
//return $c->slug == "password-protected"
$filtered_for_pw = array_filter(get_the_category(),function($f){
    return $f->slug == "password-protected";
});

if(count($filtered_for_pw)){ 

    get_template_part("components/pw_check","",array("post_id"=>$post->ID));

} else {
the_content() ;
}


?>
 
</section>
<? get_template_part("components/end_bullet")?>
<div class="layout-bottom-reading-section">
    <?php  $learn = get_post_meta($post->ID,"whatilearned",true)?>
    <?php if($learn):?>
    <section class="ps-what-i-learned font-sans">
        <? get_template_part("components/small_header","",array("size"=>3, "copy"=>"What I learned"))?>
       
        <ul class="type-smaller">
            <?php foreach(explode(",",$learn) as $l):?>
                <li><?= trim($l)?></li>
            <?php endforeach?>
        </ul>
    </section>
    <?php endif?>
    <?php
    if(get_the_tags()) {
        get_template_part("components/tag_list","",array("list"=>get_the_tags()));
        
    }
    ?>
    <?php 
$more_posts = $utility_functions["create_more_posts"]($post->ID, "projects");

get_template_part("components/more_posts","",array(
    "title" => "More case studies",
    "posts" => array_map(function($p){
    $p["cta_text"] = "View case study";
    return $p; 
}, $more_posts)
));
?>

</div>







</article>

<?php require_once "footer.php";?>