<?php
  include_once('smarty/Smarty.class.php');
  include_once('classes/registration.class.php');
  include_once('classes/activation.class.php');

  $smarty = new Smarty();
  $smarty->template_dir = 'templates/';
  $smarty->compile_dir = 'smarty/templates_c/';
  $smarty->config_dir = 'smarty/configs/';
  $smarty->cache_dir = 'smarty/cache/';
  
  if(!array_key_exists('send', $_POST) == 1)
    $smarty->display('registration.tpl');
  else
  {
    $registration = new Registration();
    if($registration->register())
    {      
      // Tworzy aktywację
      $registration->commit();
      $activation = Activation::create($registration->user_id);

      // Wysyłanie email'a
      $content = 'Witaj ' . $_POST['first_name'] . '. Kliknij w link aby zakończyć proces rejestracji: zs1.jastrzebie.pl/uczen/banas/activate.php?code='. $activation->code;
      $headers  = 'MIME-Version: 1.0' . '\r\n';
      $headers .= 'Content-type: text/html; charset=utf-8' . '\r\n';

      if(!mail($_POST['email'], 'Potwierdzenie rejestracji', $content, $headers))
        throw new Exception('Wystąpił błąd. Email aktywacyjny nie został wysłany.');


      $smarty->assign('notification', 'Rejestracja powiodła się. W ciagu 24 godzin otrzymasz email aktywacyjny.');
      $smarty->display('registration.tpl');
    }
    else 
    {
      $smarty->assign('notice', $registration->GetErrors());
      $smarty->display('registration.tpl');
    }
  }
?>