<?php require_once "header.php";?>

<article>
    
    <h1><?=get_the_title()?></h1>
    <?php if(has_excerpt()):?>
    <div><?= get_the_excerpt();?>
    <?php endif?>
    <?php if(has_post_thumbnail()):?>
    <div>
        <div>
            <?php $components["lazy_img"](get_post_thumbnail_id());?>
        </div>
    </div>
    <?php endif?>
    <div>
        <?=the_content();?>
    </div>
    <?php if(!empty(get_the_tags())):?>
    <section>
        <?php $components["tag_list"](get_the_tags());?>
    </section>
    <?php endif?>
    <?php $more_posts = $utility_functions["create_more_posts"]($post->ID, "post");?>
    <section>
        <?php $components["more_posts"](array_map(function($p){
            $p["cta_text"] = "Continue reading";
            return $p; 
        },$more_posts), "More writing") ?>
        
    </section>


</article>

<?php require_once "footer.php";?>