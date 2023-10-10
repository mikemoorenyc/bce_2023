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
<?php $link = get_permalink($p->ID);?>
<article>
    <?php $components["blog_copy"]($p->post_title,$link,$utility_functions["truncate_string"](get_the_excerpt($p->ID),140)) ?>
    <?php if(get_the_post_thumbnail($p->ID)):?>
        <a href="<?=$link?>">
            <?php $components["lazy_img"](get_post_thumbnail_id($p->ID));?>
        </a>  
    <?php endif?>


</article>

<?php endforeach;?>

</div>


<?php require_once "footer.php";?>