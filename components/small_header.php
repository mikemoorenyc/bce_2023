<?php
$small_header = function($size = 3, $copy, $extra_classes="") {
    $classes = "small-header font-sans type-smaller {$extra_classes}";
    
    echo "<h{$size} class='{$classes}'>";
    
    
    echo $copy;
    
    echo "</h{$size}>";
}

?>