<?php
$more_posts = function($posts,$title) {
    global $components; 
    
    ?>
    <section class="mp-container">
        <?php $components["small_header"](3, $title);?>
        <div class="mp-post-items-container">
            <?php foreach($posts as $p):?>
            <?php $components["the_card"](
                array(
                    "title" => $p["post_title"],
                    "tagline" => has_excerpt($p["ID"])? get_the_excerpt($p["ID"]):"",
                    "link" => get_permalink($p["ID"]),
                    "cta_text" => $p["cta_text"],
                    "style_mod" => "slim",
                    "extra_classes" => "mp-slim-card"
                )
            );?>
            <?php endforeach?>
        </div>

    </section>

    <?php
}

?>
