<?php 
  ob_start();

  include_once('smarty/Smarty.class.php');
  include_once('classes/session.class.php');
  include_once('classes/user.class.php');
  include_once('classes/settings.class.php');

  // Definiuje inny system wyświetlania wyjątków.
  include_once('classes/exception_handler.class.php');
  set_exception_handler(array('Exception_Handler', 'handle_exception'));

  // Zainicjowanie Smarty i ustawienie katalogów
  $smarty = new Smarty();
  $smarty->template_dir = 'templates/';
  $smarty->compile_dir = 'smarty/templates_c/';
  $smarty->config_dir = 'smarty/configs/';
  $smarty->cache_dir = 'smarty/cache/';
  
  $session = new Session();
    
  if(array_key_exists('logout', $_GET))
    throw new Exception('Zostałeś wylogowany.');
  
  $user = new User($session->user_id);
  
   // Mogłoby się to znaleźć w index.php, ale ciasteczka nie są wtedy gotowe przez buforowanie.
  if($user->active != 1)
    throw new Exception('Nie aktywowałeś swojego konta. Wejdź na swoją skrzynkę i go aktywuj.');

  $smarty->display('panel.tpl');
  
  ob_end_flush();
?>