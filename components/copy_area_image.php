<?php
$copy_area_image = function($block_content, $block) {
    global $components;

    $img_id = $block['attrs']['id'];
    $dom = new IvoPetkov\HTML5DOMDocument();
    $dom->loadHTML("<html><body>".$block["innerHTML"]."</body></html");
    $par = $dom->querySelector("figure");
    $caption = $dom->querySelector("figcaption") ?: "";
    if($caption) {
        $caption->classList->add("font-sans");
        $caption->classList->add("figcaption");
    }
    $dun = $dom->saveHTML();
    $dom->loadHTML($dun);
    $caption = $dom->querySelector("figcaption");
    $caption = ($caption) ? (string) $caption : "";
    $par_classes = $par->getAttribute("class");
 
    $attrs = wp_get_attachment_metadata($img_id);
    $width = intval(str_replace("px","",$block['attrs']['width']))?:$attrs['width'];

    $screenshot_classes = str_contains($par_classes,"screenshot") ? "before-block after-block" : "";
   
    $con_max_width = $screenshot_classes ? "max-width:{$width}px;":"";
    $par_classes = implode(" ",array_map(function($c){
        $cai_classes= ["desktop","phone"];
        if(in_array($c,$cai_classes)) {
            return "cai-".$c;
        } 
        return $c;
    },explode(" ",$par_classes)));
   
    
    ob_start();
    
    get_template_part("components/lazy_img","",array(
            "optional_alt" => $par->querySelector("img")->getAttribute("alt"),
            "id" => $img_id,
            "optional_width" => $width,
            "extra_classes" => !$screenshot_classes ? "layout-thin-box" : "cai-screenshot cai-fake-img"
        ));


    $lazy_img = ob_get_clean();
    
    return "<figure class='cai-std-img'> 
        <div
        class='{$par_classes} {$screenshot_classes}'
        style='{$con_max_width}'
        >
        {$lazy_img}
        </div>
        {$caption}
    </figure>";

/*
    $dun = $dom->saveHTML();
    $dom->loadHTML($dun);
    $par = $dom->querySelector("figure");
    var_dump((string)$par);

    */
    
}


?>