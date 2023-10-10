<?php
$big_card_list = function($card_list) {
    global $components;
    ?>
    <div>
        <?php foreach($card_list as $c):?>
        <article>
            <?php $components["the_card"]($c)?>
        </article>
        <?php endforeach?>

    </div>
    <?php

}



?>