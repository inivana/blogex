<?php
  include_once('classes/activation.class.php');
  
  // Definiuje nowy system wyświetlania wyjątków.
  include_once('classes/exception_handler.class.php');
  set_exception_handler(array('Exception_Handler', 'handle_exception'));
  
  $activation = new Activation($_GET['code']);
    
  if($activation->activate())
    throw new Exception('Konto zostało aktywowane. Możesz się zalogować.');
?>