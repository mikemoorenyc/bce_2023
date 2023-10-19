<?php /*** Template Name: Home page */?>
<?php require_once "header.php";?>


<div class="home-header grid-layout content-centerer">
    <div>
        <?= $utility_functions["copy_parse"]($post->post_content) ?>
    </div>
    
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

ob_start();
?>

    <?php foreach($hp_projects as $p):?> 
    
    <?php $link = get_permalink($p->ID);?>
    <article class="home-project-item">
        <link rel="prefetch" href="<?=$link;?>" />  
        <?php if(get_the_post_thumbnail($p->ID)):?>
        <a class="home-project-thumb layout-poster-container normal-hover"href="<?=$link?>">
            <?php get_template_part("components/lazy_img","" ,array(
                "id" => get_post_thumbnail_id($p->ID),
                "is_poster" => true
            ));?>
        </a>  
        <?php endif;?>
        <div class="home-project-copy">
            <h3><a href="<?=$link;?>"><?=$p->post_title?></a></h3>
            <div class="home-tag type-tagline">
                <?=$utility_functions["truncate_string"](get_the_excerpt($p->ID),75);?>
            </div>
            <a class="home-project-btn btn-styling font-sans no-underline" href="<?=$link?>">
                <span>View case study</span>
                <span>
                    <?include THEME_DIRECTORY."/assets/svgs/arrow-right-circle.svg";?>
                </span>
            </a>

        </div>

    </article>
    <?php endforeach;?>
    <?php
    $children = ob_get_clean();
    get_template_part("components/hp_section","",array(
        "section_title" => "My work",
        "children" => $children,
        "see_all_url" => get_permalink(get_page_by_path("projects")),
        "see_all_text" => "my projects"
    ));
    

    ?>
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
<?php ob_start(); ?>

<?php foreach($hp_posts as $p):?>
<?php
$excerpt = has_excerpt($p->ID)?$utility_functions["truncate_string"](get_the_excerpt($p->ID),140):null
?>
<?php $link = get_permalink($p->ID);?>

    <article>
    <link rel="prefetch" href="<?=$link;?>" /> 
    <?
    get_template_part("components/blog_item","",array(
        "title" => $p->post_title,
        "link"=> $link,
        "copy" => $excerpt
    ));

    ?>

      

    </article>

<?php endforeach;?>

<?php 
$children = ob_get_clean();
get_template_part("components/hp_section","",array(
        "section_title" => "Writing",
        "children" => $children,
        "see_all_url" => get_permalink(get_page_by_path("blog")),
        "see_all_text" => "my writing"
    ));
?>

<?php endif;?>

<?php require_once "footer.php";?>