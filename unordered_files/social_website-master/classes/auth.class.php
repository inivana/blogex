<?php
  include_once('session.class.php');
  include_once('database.class.php');
  
  class Auth
  {
    private $db_handler;

    public function __construct()
    /*
     * Tworzy połączenie z bazą.
     */
    {
      $this->db_handler = new Database;
    }
    public function login($login, $password)
    /*
     * Przy poprawnym podaniu danych tworzy sesję użytkownika.
     */
    {
      $results = $this->db_handler->query('SELECT id FROM users WHERE login = "'. $login .'" AND password = "'. hash('sha256', $_POST['password']) .'"');
      $user = $results->fetch_assoc();
      
      if($results->num_rows)
      {
        Session::create($user['id']);
        
        return true;
      }
      else
        return false;
    }
    
    public function __desctruct()
    /*
     * Zamyka połączenie z bazą.
     */
    {
      $db_handler->close();
    }
  }
?>