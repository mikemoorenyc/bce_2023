</main>

<footer id="footer" class="footer font-sans lazy-gradient">
<?php $nav = wp_get_nav_menu_items("Main Menu");?>
  <div class="footer-inner content-centerer">
    
    <?php if ($nav):?>
    <div class="footer-inner-nav">
      <nav class="footer-inner-nav-section">
        Site navigation
        <ul>
          <?php foreach($nav as $n):?>
              <li><a href="<?= $n->url?>"><?=$n->title;?></a></li>
          <?php endforeach;?>

        </ul>
      </nav>
      <?php endif?>
<?php $social = wp_get_nav_menu_items("Social Media");?>
<?php if($social):?>
      <div class="footer-inner-nav-section">
        Other places
        <ul>
           <?php foreach($social as $s):?>
           <li><a target="<?=$s->target;?>" href="<?=$s->url?>"><?= $s->title?></a></li>
           <?php endforeach?>
        </ul>
      </div>
<?php endif?>
    </div>
    <?php $credit = get_option("icon_credit_setting","")?>
    <?php if($credit):?>
    <div class="footer-credit-line"><?=html_entity_decode($credit)?></div>
    <?php endif?>
  </div>
</footer>

</div>

<!-- removeIf(production) -->
<div id="grid-lines" style="display:none;">
<?php
for($i = 0; $i < 12; $i++) {
  echo "<hr />";
}


?>
</div>
<!--endRemoveIf(production)-->


<script src="<?= THEME_URL;?>/js/front-end-entry.js?v=<?=CACHE_BREAK;?>"></script>
</body>
</html>
