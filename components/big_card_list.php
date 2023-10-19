<?php

extract($args);

?>
<div class="big-card-list-container content-centerer grid-layout">
        <?php foreach($card_list as $c):?>

        <?php
        get_template_part("components/the_card","",array_merge($c, array("extra_classes"=> "big-card-list-card-extra-class")))

        ?>
       
           
  
        <?php endforeach?>

    </div>