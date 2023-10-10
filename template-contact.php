<?php /*** Template Name: Contact Page */?>
<?php require_once "header.php";?>
<?php
$social_icons = array(
    "email" => "📧",
    "twitter" => "❌",
    "linkedin" => "👨‍💼",
    "github" => "🧑‍💻",
    "codepen" => "✒️"
)
?>
<?php $components["landing_header"](get_the_title());?>
<div>
    <?php $components["copy_area"](get_the_content());?>
    <?php $social = wp_get_nav_menu_items("Social Media");?>
    <?php if($social && count($social)):?>
    <ul>
        <?php foreach($social as $s):?>
        <li><a href="<?=$s->url;?>" ><?= $social_icons[strtolower($s->title)]?><?= str_replace(["mailto://"],"",$s->url)?></a> </li>
        <?php endforeach;?>

    </ul>

    <?php endif;?>

</div>


<?php require_once "footer.php";?>