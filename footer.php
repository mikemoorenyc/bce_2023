</main>
<div id="live-data-container"></div>
<footer>

<?php

(function($links) {
  if(!$links) {
    return; 
  }
  $split = array_map(function($s) {
    $cut = explode(",",$s);
    if(count($cut) < 2) {
     return ;  
    }
    
    return array_map(fn($i) => trim($i) , $cut); 
  },preg_split("/\\r\\n|\\r|\\n/", $links));
  
  if(!count($split)) {
    return; 
  }
  
  ?>

  <div class="footer-social-links-container">
  <?php
  foreach($split as $s) {
    ?>
    <a class="footer-social-links" href="<?= $s[1];?>" target="_blank"><?=$s[0];?></a>
  <?php
  }
  ?>
  </div>


  <?
 
  
})(get_option("social_link_settings",""));?>
</footer>
<script src="<?= THEME_URL;?>/js/front-end-entry.js?v=<?=CACHE_BREAK;?>"></script>
</body>
</html>
