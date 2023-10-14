<?php
//$id, $extra_classes, $is_poster, $optional_alt,$optional_width


$lazy_img = function($options) {
extract($options);
$data = wp_get_attachment_metadata($id);

if(!$data){return "";};    

$spacer_padding = (($data["height"]/$data["width"]) * 100)."%";      
$max_width_style = $is_poster?"": "max-width:".($optional_width||$data["width"])."px;"
    
?>

    <div 
    data-state="not-initialized"
    class="lazy-img <?= $is_poster? "layout-poster-img" : "lazy-img-fake ".$extra_classes ?> lazy-gradient" 
    style="<?=$max_width_style?>"
    >

        <img 
        alt="<?=get_post_meta($id, '_wp_attachment_image_alt', TRUE);?>" 
        src="<?=THEME_URL."/assets/blank.svg"?>"
        width=<?=$data["width"]?>
        height=<?=$data["height"]?>
        data-src="<?=wp_get_attachment_image_src($id)[0];?>"
        data-srcset="<?= wp_get_attachment_image_srcset($id);?>" 
        data-state="not-initialized"
        style= "width: 100%; height: 0; <?= $is_poster?"": "padding-top:".$spacer_padding ?>"
        
        />
        
    </div>


    <?php
}

?>




    
<?php
/*
width=<?=$data["width"]?>
        height=<?=$data["height"]?>
        */
?>

