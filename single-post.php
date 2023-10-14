<?php require_once "header.php";?>

<article>
    <div class="copy-area copy-area-reading-section">
        <h1 class="blog-single-headline type-article-heading"><?=get_the_title()?></h1>
        <?php if(has_excerpt()):?>
        <div class="blog-tagline type-tagline"><?= get_the_excerpt();?></div>
        <?php endif?>
        <?php if(has_post_thumbnail()):?>
        <div>
            <div class="blog-hero layout-thin-box layout-poster-container" style="padding-top:56.25%">
                <?php $components["lazy_img"](array(
                    "id" => get_post_thumbnail_id(),
                    "is_poster" => true,
                    "extra_classes" => "layout-poster-img"
                ));?>
            </div>
        </div>
        <?php endif?>

    </div>
    <div class="blog-copy">
        <? $components["copy_area"](get_the_content(),"",true);?>
        <? $components["end_bullet"]();?>
    </div>
    <div class="layout-bottom-reading-section">
        <?php if(!empty(get_the_tags())):?>
        <?php $components["tag_list"](get_the_tags());?>
        <?php endif?>
        <?php $more_posts = $utility_functions["create_more_posts"]($post->ID, "post");?>
        <?php $components["more_posts"](array_map(function($p){
            $p["cta_text"] = "Continue reading";
            return $p; 
        },$more_posts), "More writing") ?>

    </div>

</article>


    
    

<?php require_once "footer.php";?>