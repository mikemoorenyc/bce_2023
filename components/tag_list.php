<?php
$tag_list = function($list) {
    global $components;
    ?>
    <?php $components["small_header"](3, "Tagged");?>
    <ul>
        <?php foreach($list as $l):?>

        <?php endforeach?>
    </ul>

    <?php
}
?>