<?php
extract($args);?>


<article class="blog-item <?=$extra_classes?>">
    <? get_template_part("components/blog_copy","",array(
        "title" => $title,
        "link" => $link,
        "excerpt" => $copy
    ));?>
</article>