<?php
$blog_copy = function($title,$link,$copy) {
    ?>
        <h3><a href="<?=$link;?>"><?=$title;?></a></h3>
        <?php if($copy):?>
        <div>
            <?=$copy?> <a href="<?=$link?>">Continue reading</a>
        </div>   
        <?php endif?>

    <?php
}
?>