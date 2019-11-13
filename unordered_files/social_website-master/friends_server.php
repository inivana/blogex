<?php
  include_once('classes/session.class.php');
  include_once('classes/database.php');
  include_once('classes/sharings.class.php');

  function my_return($content)
  // Stosuje się ją do "odesłania" wiadomości do Ajax'a 
  {
    print $content; exit();
  }

  // Sprawdza czy użytkownik jest zalogowany
  try {$session = new Session();}
  catch(Exception $e) {my_return('login');} 

  if(!(array_key_exists('friend', $_POST)))
    my_return('error');
  
  $friend = $_POST['friend'][1];
 
  $db_handler = new Database;
  $sharings = new Sharings($session->user_id);
  
  $results = $db_handler->query('SELECT id FROM users_data WHERE CONCAT(first_name, " ", last_name) = "'. $friend .'"');
  
  if($results->num_rows)
  {
    $result = $results->fetch_assoc();
    $sharings->add($result['id']);
  }
  else
    my_return('error');
?>