<?php
$copy_area = function($copy, $extra_classes="", $is_reading_section=false) {

    ?>
<div class="copy-area <?= $is_reading_section ? "copy-area-reading-section":""?> <?=$extra_classes?>">
    <?=$copy?>
</div>
    <?php
}


?>