<?php
$landing_header = function($title) {
    ?>
<div>
    <h1><?=$title?> </h1>
    <?php if($copy):?>
    <div><?=$copy;?>
    <?php endif;?>

</div>
<hr />

<?php
}
?>

