<?php
$copy_area_pullquote = function($block_content,$block) {
    $dom = new IvoPetkov\HTML5DOMDocument();
    $dom->loadHTML("<html><body>".$block["innerHTML"]."</body></html");
    $blockHTML = $dom->querySelector("blockquote")->innerHTML; 
    ob_start();
    ?>
    <div class="pull-quote-container">
        <div aria-hidden="true" role="presentation" class="pull-quote-border before-block after-block top">
            <div class="quote-icon"><? include get_template_directory()."/assets/svgs/quote.svg" ?></div>
        </div>
        <blockquote class="pullquote"><?=$blockHTML?></blockquote>

        <div aria-hidden="true" role="presentation" class="pull-quote-border before-block after-block bottom">
            <div class="quote-icon"><? include get_template_directory()."/assets/svgs/quote.svg" ?></div>
        </div>


    </div>

    <?php
    return ob_get_clean(); 
}


?>