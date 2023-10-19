<?php
extract($args);


    $size = $size ?:3;
    $classes = "small-header font-sans type-smaller {$extra_classes}";
    
    echo "<h{$size} class='{$classes}'>";
    
    
    echo $copy;
    
    echo "</h{$size}>";

?>