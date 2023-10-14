<?php

$hp_section = function($section_title,$children, $see_all_url,$see_all_text) {
?>
<section class="home-section">
    <h2 class="home-section-heading" >
        <span class="content-centerer">
            <?=$section_title;?>
        </span>
     </h2>
    <div class="content-centerer">
        <?= $children ?>
    
    </div>
    <div class="home-see-all-container content-centerer" >
        <a class="font-sans" href="<?=$see_all_url;?>">See all <?=$see_all_text;?></a>
    </div>
</section>

<?php
};

?>