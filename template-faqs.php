<?php /*** Template Name: FAQs page */?>
<?php require_once "header.php";?>
<div class="copy-section">
    <?= get_the_content();?>
</div>
<?php
//Get all categories
$posts = get_posts([
    'post_type' => 'faq',
    'post_status' => 'publish',
    'numberposts' => -1,
     'order'    => 'ASC',
     "order_by" => "menu_order"
  ]);
$categories = [];
foreach($posts as $p) {
    $terms = get_the_terms($p->ID, "subjects");
    if(!$terms) {
        continue;
    }
    foreach($terms as $t) {
        if(!in_array($t->slug, $categories)) {
            $categories[] = $t->slug;
        }
    }
}
//var_dump($categories);
  ?>


<?php 

foreach($categories as $c) {
    
    ?>
    <div class="faq-section-block">
    <div class="copy-section"><h2><?= get_term_by("slug",$c,"subjects")->name; ?></h2></div>
    <?php
    foreach($posts as $p) {
        $p_id = null;
      
        $terms = array_map(fn($e)=>$e->slug, get_the_terms($p->ID,"subjects")?:[]);
     
        if(in_array($c, $terms)) {
      
            $p_id = $p->ID;
         
        }
        if($p_id !== null) {
            ?>
            
            <div class="faq-section"><div class="faq-header-container copy-section" role="button"><h3 class="faq-header"><?=get_the_title($p_id); ?></h3> <span class="svg-container"><?php include THEME_DIRECTORY."/assets/page-down.svg"; ?></svg></div>
            <div class="faq-section-copy-container copy-section">    <?= get_the_content(null,false,$p_id);?></div>
            
            </div>
        
                <?php
        }
        
    }
?></div><?php
}

?>




<?php require_once "footer.php";?>