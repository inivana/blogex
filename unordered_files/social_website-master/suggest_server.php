<?php
  exit();
  include_once('classes/database.class.php');
  
  $db_handler = new Database;
  
  $keyword =  $_POST['keyword'];

  $results = $db_handler->query('SELECT CONCAT(first_name, " ", last_name) as name FROM users_data WHERE CONCAT(first_name, " ", last_name) LIKE "%'. $keyword .'%" LIMIT 5');
  
  // Łączy wyniki w tablicę
  $names = array();
  while($row = $results->fetch_assoc())
    $names[] = $row['name'];

  print implode(':', $names);
?>