<?php extract($args);?>
<div>
    <div class="content-centerer grid-layout">
        <h1 class="landing-header-title  type-article-heading"><?=$title?> </h1>
        <?php if($copy):?>
        <div class="landing-header-excerpt type-tagline"><?=$copy;?></div>
        <?php endif;?>
    </div>
</div>
<hr class="landing-header-rule"/>
