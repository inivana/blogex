<?php
  include_once('smarty/Smarty.class.php');
  include_once('classes/session.class.php');

  class Exception_Handler
  {
    static function print_exception(Exception $e)
    {
      $smarty = new Smarty();
      $smarty->template_dir = 'templates/';
      $smarty->compile_dir = 'smarty/templates_c/';
      $smarty->config_dir = 'smarty/configs/';
      $smarty->cache_dir = 'smarty/cache/';
      
      // Usuwa sesję
      if(Session::exists())
      {
        $session = new Session();
        $session->destroy();
      }
      
      $smarty->assign('error', $e->getMessage());
      $smarty->display('index.tpl');
    }
  
    static function handle_exception(Exception $e)
    {
         self::print_exception($e);
    }
  }
?>