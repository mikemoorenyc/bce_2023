<?php /*** Template Name: Contact Page */?>
<?php require_once "header.php";?>
<?php

?>
<?php $components["landing_header"](get_the_title());?>
<div class="content-centerer grid-layout">
    <div class="contact-copy-layout">
        <?php $components["copy_area"](get_the_content());?>
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