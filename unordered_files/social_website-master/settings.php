<?php
  include_once('smarty/Smarty.class.php');
  include_once('classes/session.class.php');
  include_once('classes/user.class.php');
  include_once('classes/settings.class.php');
  
  // Nie pozwala pobrać strony przy niezalogowaniu
  if(!Session::exists())
  {
    print 'login'; exit();
  }
  
  $smarty = new Smarty();
  $smarty->template_dir = 'templates/';
  $smarty->compile_dir = 'smarty/templates_c/';
  $smarty->config_dir = 'smarty/configs/';
  $smarty->cache_dir = 'smarty/cache/';

  $session = new Session();

  $user = new User($session->user_id);
  $settings = new Settings($session->user_id);

  $smarty->assign('settings', $settings);
  $smarty->assign('user', $user);

  $smarty->display('settings.tpl');
?>