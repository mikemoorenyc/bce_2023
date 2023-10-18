<?php
$small_button = function($href="",$children="",$extra_classes="",$is_external=false) {

    $external = $is_external ? 'target="_blank" rel="noreferrer noopener"' : "";
    ?>
    <a href="<?=$href?>" class="small-button-tag-link font-sans  no-underline normal-hover font-weight-normal <?=$extra_classes;?>" <?=$external;?>><?=$children?></a>

    <?
}



?>