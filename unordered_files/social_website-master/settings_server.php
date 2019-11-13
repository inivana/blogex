<?php
  DEFINE('PHOTOS_DIR', 'photos/');

  ob_start();

  include_once('classes/session.class.php');
  include_once('classes/settings.class.php');
  include_once('classes/formvalidator.class.php');

  function my_return($content)
  // Stosuje się ją do "odesłania" wiadomości do Ajax'a 
  {
    print $content; exit();
  }

  // Sprawdza czy użytkownik jest zalogowany
  try {$session = new Session();}
  catch(Exception $e) {my_return('login');} 

  if(!(array_key_exists('setting', $_POST) OR array_key_exists('new_photo', $_FILES)))
    my_return('error');
  
  $setting = $_POST['setting'][0];
  $value = $_POST['setting'][1];
  
  $settings = new Settings($session->user_id);
  $user = new User($session->user_id);
  
  try {$settings = new Settings($session->user_id);}
  catch(Exception $e) {my_return('error');}
  
  // Najpierw zdjęcia, które są przesyłanie asynchronicznie.
  if(array_key_exists('new_photo', $_FILES))
  {
    $photo_name = $_FILES['new_photo']['tmp_name'];
    if(mime_content_type($photo_name) == 'image/gif' || mime_content_type($photo_name) == 'image/jpeg')
    {
      $image_size = getimagesize($photo_name);
      if(($image_size[0] <= 200 AND $image_size[0] > 0 AND $image_size[1] <= 250 AND $image_size[1] > 0))
      {
        $new_photo_name = md5($user->login);
        move_uploaded_file($photo_name, PHOTOS_DIR . $new_photo_name);
        $settings->photo_name = $new_photo_name;
      }
    }
    header('Location: panel.php');
  }

  // Dopasowanie odpowiedniego działania do żądanej akcji
  switch($setting)
  {
    case 'phone_number':
    {
      $value = intval($value);

      if((is_int($value) && strlen($value) == 9))
      {
        try {$settings->$setting = $value;}
        catch(Exception $e) {my_return('error');}
        my_return('true');
      }
      else {
        my_return('false');
      }

      break;
    }
    case 'phone_number_visibility':
    {
      if($value == 'checked')
      {
        try {$settings->$setting = 'true';}
        catch(Exception $e) {my_return('error');}
      }
      else
      {
        try {$settings->$setting = 'false';}
        catch(Exception $e) {my_return('error');}
      }
      
      break;
    }
    case 'photo_visibility':
    {
      if($value == 'checked')
      {
        try {$settings->$setting = 'true';}
          catch(Exception $e) {my_return('error');}
      }
      else
      {
        try {$settings->$setting = 'false';}
        catch(Exception $e) {my_return('error');}
      }
      break;
    }
    case 'email':
    {
      if(!$settings->change_email($value))
        my_return('error');

      break;
    }
    case 'password':
    {
      if((strlen($value) <= 60) && (strlen($value) >= 8) && ($_POST['setting'][2] == $value))
      {
        $settings->change_password($value);
      }
      else
        my_return('error');

      break;
    }
    default:
    {
      my_return('error');
    }
  }

  ob_end_flush();
?>