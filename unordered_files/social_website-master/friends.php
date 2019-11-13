<?php
  include_once('smarty/Smarty.class.php');
  include_once('classes/session.class.php');
  include_once('classes/user.class.php');
  include_once('classes/sharings.class.php');
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

  $sharings = new Sharings($session->user_id);
  
  $friends = array();
  
  foreach($sharings->get_sharings() as $sharing)
  {
    $user = new User($sharing->user_id);
    $name = $user->first_name. ' '. $user->last_name;
    
    $settings = new Settings($sharing->user_id);
    $photo_name = $settings->photo_name;
    
    $friends[] = array('name' => $name, 'photo_name' => $photo_name);
  }

  $smarty->assign('friends', $friends);

  $smarty->display('friends.tpl');
?>