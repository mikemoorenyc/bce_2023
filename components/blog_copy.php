<?php extract($args)?>

    <h3><a class="no-underline" href="<?=$link;?>"><?=$title;?></a></h3>
    <div class="blog-item-meta">
        <?php if($excerpt):?>
            <div className="blog-item-excerpt type-tagline"> <?=$excerpt;?> </div>
            
        <?php endif;?> 
        <a class="blog-item-readmore font-sans" href="<?=$link?>">Continue reading</a>
    </div>
