<?php
extract($args);
?>

<section class="mp-container">
    <?php get_template_part("components/small_header","",array(
        "size" => 3,
        "copy" => $title
    ));?>
        
    <div class="mp-post-items-container">
        <?php foreach($posts as $p):?>
            <?php get_template_part("components/the_card","",
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
