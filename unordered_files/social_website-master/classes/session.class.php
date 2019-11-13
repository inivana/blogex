<?php
  define('COOKIE_EXPIRE', 5*60); // W seskundach
  define('COOKIE_NAME', 'sessval');
  
  include_once('database.class.php');
  
  // Definiuje inny system wyświetlania wyjątków.
  include_once('classes/exception_handler.class.php');
  set_exception_handler(array('Exception_Handler', 'handle_exception'));
  
  class Session
  /**
   * Pozwala zarządzać daną sesją. 
   */
  {
      private $db_handler,
              $id,
              $value,
              $user_id,
              $time,
              $ip,
              $browser;

    public function __construct()
    /**
     * Pobiera z bazy informacje o danej sesji i przypisuje je do obiektu.
     */
    {
      if(!array_key_exists(COOKIE_NAME, $_COOKIE))
        throw new Exception('Sesja nie istnieje lub wygasła.');
      
      $this->db_handler = new Database;

      $session_value = $_COOKIE[COOKIE_NAME];

      $results = $this->db_handler->query('SELECT * FROM sessions WHERE value="'. $session_value .'" AND time > NOW() - INTERVAL '.COOKIE_EXPIRE.' SECOND');
      $result = $results->fetch_assoc();

      if(!$results->num_rows)
        throw new Exception('Sesja nie istnieje lub wygasła.');

      $this->id = $result['id'];
      $this->value = $result['value'];
      $this->time = $result['time'];
      $this->user_id = $result['user_id'];
      $this->ip = $result['ip'];
      $this->browser = $result['browser'];
      $this->start = $result['start'];
      
      $this->regenerate();
    }
    
    public function __get($var)
    /**
     * Pozala pobrać wartość zmiennych mimo atrybutu private, 
     * który zapobiega nadpisaniu zmiennych z zewnątrz.
     */
    {
      return $this->$var;
    }
    
    static function create($user_id)
    /**
     * Tworzy sesję. Nie zwraca sesji z powodu problemu z buferowaniem.
     */
    {
      $db_handler = new Database;
      
      /**
       * Szuka wartości sesji, która nie została już użyta.
       */
      $session_value = sha1(uniqid(time() + $_SERVER['REMOTE_ADDR']));
      while(1)
      {
        $results = $db_handler->query('SELECT COUNT(*) as session FROM sessions WHERE value = "'. $session_value . '"');
        $result = $results->fetch_assoc();
        
        if(!$result['session'])
        {
          break;
        }
        
        $session_value = sha1(uniqid(time() + $_SERVER['REMOTE_ADDR']));
      }

      setcookie(COOKIE_NAME, $session_value, time() + COOKIE_EXPIRE);
      $db_handler->query(sprintf('INSERT INTO sessions(value, user_id, ip, browser, start) VALUES("%s", "%s", "%s", "%s", NULL)',
                                                                                                                     $session_value,
                                                                                                                     $user_id,
                                                                                                                     $_SERVER['REMOTE_ADDR'],
                                                                                                                     $_SERVER['HTTP_USER_AGENT']
                                                                                                                     ));

    }
    
    static function exists()
    /*
     * Sprawdza czy sesja istnieje.
     */
    {
      if(!array_key_exists(COOKIE_NAME, $_COOKIE))
        return false;
      
      $db_handler = new Database;
      
      $session_value = $_COOKIE[COOKIE_NAME];
      
      $results = $db_handler->query('SELECT * FROM sessions WHERE value="'. $session_value .'" AND time > NOW() - INTERVAL '.COOKIE_EXPIRE.' SECOND');
      $result = $results->fetch_assoc();
      
      if(!$results->num_rows)
        return false;
      

      return true;
    }
    
    public function regenerate()
    /*
     * Regeneruje czas życia sesji.
     */
    {
      setCookie(COOKIE_NAME, $this->value, time() + COOKIE_EXPIRE);
      $this->db_handler->query('UPDATE sessions SET time = NOW() WHERE value = "'. $this->value .'" AND id ='. $this->id); 
    }
    
    /*
     * Nie mam zielonego pojęcia po co to napisałem, ale może się przydać.
    function expired()
    {
      $results = $this->db_handler->query('SELECT expired FROM sessions WHERE value = '. $this->value);
      $result = $results->fetch_row();
      
      if($result['expired'])
        return true;
      else
        return false;
      
    }*/
    
    public function destroy()
    /*
     * Usuwa sesję.
     */
    {        
      if(array_key_exists(COOKIE_NAME, $_COOKIE))
      {
        setCookie(COOKIE_NAME, '0', time() - 5);
          $this->db_handler->query('UPDATE sessions SET expired = 1 WHERE value = '. $this->value);
        return true;
      }
      else
        return false;
    }
    
    static function garbage_collector()
    {
      $db_handler = new Database;
      
      $db_handler->query('UPDATE sessions SET expired = 1 WHERE time < NOW() - INTERVAL '. COOKIE_EXPIRE .' SECOND');      
    }
  }
?>