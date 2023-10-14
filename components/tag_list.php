<?php
$tag_list = function($list) {
    global $components;

    ?>
    <section class="tag-list">
    <?php $components["small_header"](3, "Tagged");?>
    <ul>
        <?php foreach($list as $l):?>
        
        <li class="tag-list-li">
            <? $components["small_button"](get_term_link($l->term_id),$l->name);?>
     
        </li>
        <?php endforeach?>
    </ul>
    </section>

    <?php
}
?>