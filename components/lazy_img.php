<?php

$lazy_img = function($id) {
    $data = wp_get_attachment_metadata($id);
    
    ?>
<img 
        alt="<?=get_post_meta($id, '_wp_attachment_image_alt', TRUE);?>" 
        src="<?=THEME_URL."/assets/blank.svg"?>"
        
        data-srcset="<?= wp_get_attachment_image_srcset($id);?>" />

    <?php
}

?>




    
<?php
/*
width=<?=$data["width"]?>
        height=<?=$data["height"]?>
        */
?>

