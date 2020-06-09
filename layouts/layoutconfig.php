<!-- Debugging Complete -->
<?php
  // load Smarty library
  require('/opt/lampp/smarty/libs/Smarty.class.php');
  $smarty = new Smarty;
  $smarty->template_dir = '/opt/lampp/htdocs/smarty/templates';
  $smarty->config_dir = '/opt/lampp/htdocs/smarty/config';
  $smarty->cache_dir = '/opt/lampp/smarty/cache';
  $smarty->compile_dir = '/opt/lampp/smarty/templates_c';
?>