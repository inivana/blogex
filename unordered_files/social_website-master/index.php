<?php
  ob_start();
  
  // Sprawdza czy user jest zalogowany. Jeśli tak przenosi go do panelu.
  include_once('classes/session.class.php');
  if(Session::exists())
    header('Location: panel.php');
  
  // Definiuje inny system wyświetlania wyjątków.
  include_once('classes/exception_handler.class.php');
  set_exception_handler(array('Exception_Handler', 'handle_exception'));

  include_once('smarty/Smarty.class.php');
  include_once('classes/auth.class.php');

  $auth = new Auth();

  // Zainicjowanie Smarty i ustawienie katalogów
  $smarty = new Smarty();
  $smarty->template_dir = 'templates/';
  $smarty->compile_dir = 'smarty/templates_c/';
  $smarty->config_dir = 'smarty/configs/';
  $smarty->cache_dir = 'smarty/cache/';
  
  if(array_key_exists('send', $_POST) == 1)
  {
    if(!$auth->login($_POST['login'], $_POST['password']))
      throw new Exception('Login lub hasło jest nieprawidłowe. Spróbuj ponownie.');
    else 
      header('Location: panel.php');
  }
  else
    $smarty->display('index.tpl');

  ob_end_flush();
?>