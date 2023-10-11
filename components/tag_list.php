<?php
$tag_list = function($list) {
    global $components;
   
    ?>
    <?php $components["small_header"](3, "Tagged");?>
    <ul>
        <?php foreach($list as $l):?>
        
        <li>
            <a href="<?= get_term_link($l->term_id)?>"><?= $l->name?></a>
        </li>
        <?php endforeach?>
    </ul>

    <?php
}
?>