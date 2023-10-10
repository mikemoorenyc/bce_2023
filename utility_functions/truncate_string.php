<?php
$truncate_string = function($str,$length) {
    if (strlen($str) <= $length) {
      return $str;
    }
    return substr($str,0, $length) . '...';
};
?>