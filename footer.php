</main>

<footer class="footer">
<?php $nav = wp_get_nav_menu_items("Main Menu");?>
<?php if ($nav):?>
<nav>
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
<div>
  Social media
  <ul>
  <?php foreach($social as $s):?>
 
    <li><a target="<?=$s->target;?>" href="<?=$s->url?>"><?= $s->title?></a></li>

  <?php endforeach?>

  </ul>

</div>

<?php endif?>
  



</footer>

</div>

<!-- removeIf(production) -->
<div id="grid-lines" style="display:none;">
  <hr/>
  <hr/>
  <hr/>
  <hr/>
  <hr/>
  <hr/>
  <hr/>
  <hr/>
  <hr/>
  <hr/>
  <hr/>
  <hr/>
</div>
<!-- removeIf(production) -->


<script src="<?= THEME_URL;?>/js/front-end-entry.js?v=<?=CACHE_BREAK;?>"></script>
</body>
</html>
