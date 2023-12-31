<?php
//$id, $extra_classes, $is_poster, $optional_alt,$optional_width
extract($args);
$data = wp_get_attachment_metadata($id);
$mx =$optional_width ? strval(intval($optional_width)) : strval($data["width"]);
$spacer_padding = (($data["height"]/$data["width"]) * 100)."%";      
$max_width_style = $is_poster?"": "max-width:".$mx."px;";

?>
<div 
    data-state="not-initialized"
    class="lazy-img <?= $is_poster? "layout-poster-img" : "lazy-img-fake ".$extra_classes ?> lazy-gradient" 
    style="<?=$max_width_style?>"
    >

        <img 
        alt="<?=$optional_alt?:get_post_meta($id, '_wp_attachment_image_alt', TRUE);?>" 
        src="<?=get_bloginfo('template_url')."/assets/blank.svg"?>"
        width=<?=$data["width"]?>
        height=<?=$data["height"]?>
        data-extra_classes="<?=$extra_classes;?>"
        data-src="<?=wp_get_attachment_image_src($id)[0];?>"
        data-srcset="<?= wp_get_attachment_image_srcset($id);?>" 
        data-state="not-initialized"
        style= "width: 100%; height: 0; <?= $is_poster?"": "padding-top:".$spacer_padding ?>"
        
        />
        
    </div>
