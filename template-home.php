<?php /*** Template Name: Home page */?>
<?php require_once "header.php";?>


<div>
    <?= $utility_functions["copy_parse"]($post->post_content) ?>
</div>
<?php
$hp_projects = get_posts(array(
    'posts_per_page' => -1,
    'orderby' => "menu_order",
    'post_type' => 'projects',
    'tax_query' => array(
        array(
            'taxonomy' => 'category',
            'field'    => 'slug',
            'terms'    => "home-page"
        )
    )
));
?>
<?php if(count($hp_projects)):?>
<?php
$section_title = "Projects";
$see_all_url = get_permalink(get_page_by_path("projects"));
$see_all_text = "projects";
include THEME_DIRECTORY."/partials/hp-section-top.php";
?>

    <?php foreach($hp_projects as $p):?> 
    
    <?php $link = get_permalink($p->ID);?>
    <article>
        <link rel="prefetch" href="<?=$link;?>" />  
        <?php if(get_the_post_thumbnail($p->ID)):?>
        <a href="<?=$link?>">
            <?php $components["lazy_img"](get_post_thumbnail_id($p->ID));?>
        </a>  
        <?php endif;?>
        <div>
            <h3><a href="<?=$link;?>"><?=$p->post_title?></a></h3>
            <div>
                <?=$utility_functions["truncate_string"](get_the_excerpt($p->ID),75);?>
            </div>
            <a href="<?=$link?>">
                <span>View case study</span>
                <span>
                    <?include THEME_DIRECTORY."/assets/svgs/arrow-right-circle.svg";?>
                </span>
            </a>

        </div>

    </article>
    <?php endforeach;?>
<?php include THEME_DIRECTORY."/partials/hp-section-bottom.php"?>
<?php endif;?>

<?php $hp_posts  = get_posts(array(
    'posts_per_page' => -1,
    'orderby' => "date",
    "order" => "DESC",
    'post_type' => 'post',
    'tax_query' => array(
        array(
            'taxonomy' => 'category',
            'field'    => 'slug',
            'terms'    => "home-page"
        )
    )
));
?>
<?php if(count($hp_posts)):?>
<?php
$section_title = "Writing";
$see_all_url = get_permalink(get_page_by_path("blog"));
$see_all_text = "my writing";
include THEME_DIRECTORY."/partials/hp-section-top.php";
?>
<?php foreach($hp_posts as $p):?>
<?php $link = get_permalink($p->ID);?>

    <article>
    <link rel="prefetch" href="<?=$link;?>" /> 
    <?php $components["blog_copy"]($p->post_title,$link,$utility_functions["truncate_string"](get_the_excerpt($p->ID),140)) ?>
      

    </article>

<?php endforeach;?>

<?php include THEME_DIRECTORY."/partials/hp-section-bottom.php";?>

<?php endif;?>

<?php require_once "footer.php";?>