<?php
$blog_item = function($title,$link,$copy=null,$extra_classes=null) {
    GLOBAL $components
    ?>
    <article class="blog-item <?=$extra_classes?>">
        <?php $components["blog_copy"]($title,$link,$copy);?>
    </article>
        <!--<h3><a href="<?=$link;?>"><?=$title;?></a></h3>
        <?php if($copy):?>
        <div>
            <?=$copy?> <a href="<?=$link?>">Continue reading</a>
        </div>   
        <?php endif?>
    -->
    <?php
}
?>