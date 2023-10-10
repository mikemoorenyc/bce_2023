<?php /*** Template Name: About Page */?>
<?php require_once "header.php";?>

<?php $components["landing_header"](get_the_title());?>
<div>
    <?php $portait_svg = get_post_meta(get_the_ID(),"portrait_svg",TRUE);?>
    <?php if($portait_svg):?>
    <div>
    <?= $portait_svg;?>
    </div>
    <?php endif?>
    <?php $components["copy_area"](get_the_content());?>
    <?php
        $like = get_post_meta(get_the_ID(), "thingsilike",TRUE);
        $dlike = get_post_meta(get_the_ID(), "thingsidontlike",true); 
        $like_section = function($title, $item_string) {
            if(!$item_string) {
                return; 
            }
            $items = explode(PHP_EOL, $item_string);
        ?>
        <section>
            <h3><?=$title;?></h3>

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
    <div>
        <?php $like_section("Things I like", $like) ?>
        <?php $like_section("Things I don't like", $dlike) ?>

    </div>
    <?php endif;?>


</div>


<?php require_once "footer.php";?>