<?php
$new_img = $doc->createElement("img");
$old_img = $n->getElementsByTagName("img")[0];
$prior_classes = $old_img->getAttribute("class");
$id = explode("-",$prior_classes);
$id = $id[count($id) - 1];
var_dump($id);
?>