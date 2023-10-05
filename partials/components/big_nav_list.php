
<nav class="big-nav-list <?= $nav_container_classes;?>">
    <?php
    foreach ($nav_items as $nav) {
        ?>
        <a class="button-base <?=$nav_button_classes?>" href="<?=$nav->url;?>"><?=$nav->title;?></a>

        <?php
    }
    ?>
</nav>