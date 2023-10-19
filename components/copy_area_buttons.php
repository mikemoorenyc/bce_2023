<?php
$copy_area_buttons= function($block_content,$block) {

    $btn_string = "";
    $dom = new IvoPetkov\HTML5DOMDocument();
    foreach($block["innerBlocks"] as $b) {   
        $dom->loadHTML("<html><body>".$b["innerHTML"]."</body></html");
        $btn = $dom->querySelector(".wp-element-button");
        $container = $dom->querySelector(".wp-block-button");
        $href = $btn->getAttribute("href");
        if(!$href){
            continue;
        }
        $is_download = str_contains(strtolower($container->getAttribute("class")),"download");
        $text = $btn->innerHTML;
        $is_external = $btn->hasAttribute("target") && strtolower($btn->getAttribute("target")) == "_blank"; 
        $svg = $is_external && !$is_download ? get_template_directory()."/assets/svgs/open-new-window.svg" : "";
        $svg = $is_external && $is_download ? get_template_directory()."/assets/svgs/download.svg" : "";
        ob_start();
        echo "<span>{$text}</span>";
        if($svg) {
            include $svg;
        }
        $children = ob_get_clean();
        ob_start(); 
        get_template_part("components/small_button","",array(
            "children"=>$children,
            "is_external" => $is_external,
            "href" => $href,
            "extra_classes" => "copy-area-dl-button"
        ));
    
        $btn_string .= ob_get_clean(); 
        

    }

    return "<div>{$btn_string}</div>";
}


?>