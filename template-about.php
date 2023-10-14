<?php /*** Template Name: About Page */?>
<?php require_once "header.php";?>

<?php $components["landing_header"](get_the_title());?>
<div class="about-layout content-centerer grid-layout">
    <?php $portait_svg = get_post_meta(get_the_ID(),"portrait_svg",TRUE);?>
    <?php if($portait_svg):?>
    <div class="about-picture layout-bottom-margin">
    <?= $portait_svg;?>
    </div>
    <?php endif?>
    <?php $components["copy_area"](get_the_content(),"about-copy-block");?>
    <?php
        $like = get_post_meta(get_the_ID(), "thingsilike",TRUE);
        $dlike = get_post_meta(get_the_ID(), "thingsidontlike",true); 
        $like_section = function($title, $item_string,$svg) {
            if(!$item_string) {
                return; 
            }
            $items = explode(PHP_EOL, $item_string);
        ?>
        <section class="about-like-block font-sans">
            <h2><?php include THEME_DIRECTORY."/assets/svgs/".$svg.".svg"?><span><?=$title;?></span></h2>

            <ul>
                <?php foreach($items as $i):?>
                <li><?=$i;?></li>
                <?php endforeach?>

            </ul>
        </section>

        <?php
        }
    ?>
    <?php if($like || $dlike): ?>
    <div class="about-like-section">
        <?php $like_section("Things I like", $like,"thumbs-up") ?>
        <?php $like_section("Things I don't like", $dlike,"thumbs-down") ?>

    </div>
    <?php endif;?>


</div>


<?php require_once "footer.php";?>