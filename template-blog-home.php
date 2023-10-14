<?php /*** Template Name: Blog Landing */?>
<?php require_once "header.php";?>
<?php $components["landing_header"](get_the_title(), get_the_content());?>
<?php
$posts  = get_posts(array(
    'posts_per_page' => -1,
    'orderby' => "date",
    "order" => "DESC",
    'post_type' => 'post'
));

?>
<div>
<?php foreach($posts as $p):?>
<?php 
    $link = get_permalink($p->ID);
    $excerpt = has_excerpt($p->ID) ? $utility_functions["truncate_string"](get_the_excerpt($p->ID),140) : null;
    $img_id = get_post_thumbnail_id($p->ID);
?>
    <article class="blog-item blog-item-padding">
    <link rel="prefetch" href="<?=$link;?>" />  
        <div class="blog-item-inner">
            <div class="blog-landing-copy <?=!$img_id?" blog-landing-copy-full-width":""?>">
                <?php $components["blog_copy"]($p->post_title,$link,$excerpt) ?>
            </div>
            <?php if($img_id):?>
            <a class="blog-landing-image layout-thin-box layout-poster-container" style="padding-top: 56.25%" href="<?=$link?>">
                <?php $components["lazy_img"](array(
                    "id" => $img_id,
                    "is_poster" => true,
                    "extra_classes" => "layout-poster-img"
                ));?>
            </a>  
            <?php endif?>
        </div>
        
        
            
        


    </article>

<?php endforeach;?>

</div>


<?php require_once "footer.php";?>