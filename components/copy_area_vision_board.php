<?php
$copy_area_vision_board = function($block_content,$block) {
  $sections = [
    ["Product Vision", "eye"],
    ["Target Group", "group"],
    ["Needs", "heart"],
    ["Product","app-window"],
    ["Business Goals", "flag"]
] ;
    $dom = new IvoPetkov\HTML5DOMDocument();
    $dom->loadHTML("<html><body>".$block["innerHTML"]."</body></html");
    $con = $dom->querySelector(".wp-vision-board-container");
    $interior_string;
    //var_dump($con->childNodes);

    ob_start();

    ?>
    <table class="vision-board-style">
    <tr>
        <td colspan="4"> 
            <div>
                <h4><? include get_template_directory()."/assets/svgs/".$sections[0][1].".svg"?><span><?=$sections[0][0]?></span></h4>
                <?= $con->childNodes[0]->innerHTML ?>
            </div>
        </td>
    </tr>
    <tr>
    <?php
    foreach($con->childNodes as $k=>$r) {
        if($k === 0) {
            continue;
        }
        ?>
        <td style="width:25%">
            <div>
               <h4><? include get_template_directory()."/assets/svgs/".$sections[$k][1].".svg"?><span><?=$sections[$k][0]?></span></h4>
                <?= $r->innerHTML ?> 
            </div>
        </td>
        <?php

    }

    ?>
    </tr>


    </table>


    <?php



    return ob_get_clean(); 
}
?>