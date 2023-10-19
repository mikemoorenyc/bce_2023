<?php extract($args); ?>
<section class="tag-list">
    <?php get_template_part("components/small_header","",array(
        "size" => 3,
        "copy" => "Tagged",

    ))?>
    <ul>
        <?php foreach($list as $l):?>
        
        <li class="tag-list-li">
            <? get_template_part("components/small_button","",array(
                "href" => get_term_link($l->term_id),
                "children" => $l->name
            ))?>
     
        </li>
        <?php endforeach?>
    </ul>
    </section>