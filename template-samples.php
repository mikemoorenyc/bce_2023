<?php /*** Template Name: Samples Page */?>
<?php require_once "header.php";?>
<?php
$posts = array_filter(get_posts([
    'post_type' => 'attachment',
    'numberposts' => -1,
]), function($p) {
    return get_the_terms($p->ID, "media_folder") != false; 
} );
$filter_options = [];
foreach($posts as $p) {
    $types = get_the_terms($p->ID,"sample-types");
    if(!$types) {
        continue;
    }
    foreach($types as $t) {
        if(!in_array($t->term_id, $filter_options)) {
            $filter_options[] = $t->term_id;
        }
    }
}


?>
    <button class="button-base button-base_sm filter-options-opener">
        <span class=filter-options-opener-icon>
            <?php include THEME_DIRECTORY."/assets/filter.svg";?>
        </span>
        <span class=filter-options-label-text>Filter <span class="filter-amt-selected"></span></span>
</button>
<nav class=filter-options>

<div class="filter-options-items-container-outer">
<ul class="filter-options-items-container">
<?php
foreach($filter_options as $f) {
    $name = get_term($f,"sample-types")->name;
    echo "<li class=filter-options-item data-id='{$f}'><button data-id='{$f}' class=' button-base  filter-options-button'>{$name}</button></li>";
}

?>
</ul>
</div>
</nav>
<ul class="sample-thumbnails">
<?php
foreach($posts as $i) {
    $srcset = wp_get_attachment_image_srcset($i->ID);
    $full = get_all_image_sizes($i->ID)["full"]["url"];
    if(!$srcset) {
        continue;
    }
    $all_terms = get_the_terms($i->ID,"sample-types");
    $all_terms = $all_terms ? array_map(fn($t)=>$t->term_id, $all_terms): [];
    $all_terms = implode(",",$all_terms);

    echo "<li class=sample-thumbnail data-terms='{$all_terms}'><img  class=sample-thumbnail-img src='{$full}' srcset='{$srcset}' /></li>";
}

?>

</ul>
<div class="pan-zoom-container"></div>
<?php require_once "footer.php";?>