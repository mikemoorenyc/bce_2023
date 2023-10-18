<?php
$copy_area_video = function($block_content,$block) {
//return $block_content;
   $id = $block['attrs']['id'];
    $attrs = wp_get_attachment_metadata($block['attrs']['id']);
    $width = $attrs["width"];
    
    $dom = new IvoPetkov\HTML5DOMDocument();
    $dom->loadHTML("<html><body>".$block["innerHTML"]."</body></html");
    $video = $dom->querySelector("video");
    $fig = $dom->querySelector("figure");
    $attr_string = "";
    foreach ($video->attributes as $attr) {

        $attr_string .= $attr->nodeName.($attr->nodeValue? "=". $attr->nodeValue." ": " "); 
    }
    if(str_contains($fig->getAttribute("class"),"mw-")) {
        $sp = explode(" ",$fig->getAttribute("class"));

        $sp =array_values( array_filter($sp, function($c){
            return str_contains($c,"mw-");
        }));
        
        $width = explode("-",$sp[0])[1];
    
    }
    $blank_src = get_bloginfo('template_url')."/assets/blank.svg";
    $padding_percent = ($attrs["height"]/$attrs["width"]) * 100;

    $type = $attrs["mime_type"];

    //GET CAPTION
    $caption = $dom->querySelector("figcaption") ?: "";
    if($caption) {
        $caption->classList->add("font-sans");
        $caption->classList->add("figcaption");
    }
    $dun = $dom->saveHTML();
    $dom->loadHTML($dun);
    $caption = $dom->querySelector("figcaption");
    $caption = ($caption) ? (string) $caption : "";

    return "
    <figure class='cai-std-img cai-video lazy-video' data-id='{$id}' data-state='not-initialized'>
        <span  class='cai-video-shim'  {$attr_string} style='width:100%; max-width: {$width}px' ></span>
        <div class='layout-thin-box lazy-gradient cai-video-container' style='max-width:{$width}px; position:relative;margin:0 auto;'>
            <img class='cai-video-placeholder' src='{$blank_src}' style='width: 100%; height: 0; padding-top: {$padding_percent}%'/>
        </div>
        {$caption}
    </figure>
    ";
}


?>