<?php /*** Template Name: Contact Page */?>
<?php require_once "header.php";?>
<?php

?>
<?php get_template_part("components/landing_header","",array("title" => get_the_title()) )?>
<div class="content-centerer grid-layout">
    <div class="contact-copy-layout">
        <div class="copy-area copy-area-reading-sectioncopy-area copy-area-reading-section">
        <?php the_content()?>
        </div>
        
        <?php $social = wp_get_nav_menu_items("Social Media");?>
    <?php if($social && count($social)):?>
    <ul class="contact-social-links">
        <?php foreach($social as $s):?>
        <li>
            
            <a class="font-sans no-underline" href="<?=$s->url;?>" ><?php include "assets/svgs/".strtolower($s->title).".svg";?> <?= str_replace(["mailto://","https://"],"",$s->url)?></a> 
        </li>
        <?php endforeach;?>

    </ul>

    <?php endif;?>
    </div>
    

</div>
<div>
    
    

</div>


<?php require_once "footer.php";?>