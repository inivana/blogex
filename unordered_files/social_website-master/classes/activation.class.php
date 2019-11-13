<?php
  define('ACTIVATION_EXPIRE', 7*24*60*60); // W sekundach
  
  include_once('database.class.php');
  
  // Definiuje nowy system wyświetlania wyjątków.
  include_once('classes/exception_handler.class.php');
  set_exception_handler(array('Exception_Handler', 'handle_exception'));

  class Activation
  {
    private $db_handler,
            $id,
            $code,
            $time,
            $user_id;
    
    public function __construct($activation_code)
    /*
     * Pobiera z bazy informacje o danej aktywacji i przypisuje je do obiektu
     */
    {
      $this->db_handler = new Database;
      
      $results = $this->db_handler->query('SELECT * FROM activations WHERE code="'. $activation_code .'"');
      $result = $results->fetch_assoc();

      if(!$results->num_rows)
        throw new Exception('Aktywacja nie istnieje lub wygasła.');
      
      $this->id = $result['id'];
      $this->code = $result['code'];
      $this->time = $result['time'];
      $this->user_id = $result['user_id'];
    }
    
    public function __get($var)
    /**
     * Pozala pobrać wartość zmiennych mimo atrybutu private, który zapobiega nadpisaniu zmiennych z zewnątrz.
     */
    {
      return $this->$var;
    }
    
    static function create($user_id)
    /**
     * Tworzy aktywację i zwraca obiekt Activation tej aktywacji.
     */
    {
      $db_handler = new Database;
      
      // Szuka kodu aktywacyjnego, który nie został już użyty.
      $activation_code = sha1(uniqid(time() + $_SERVER['REMOTE_ADDR']));
      while(1)
      {
        $results = $db_handler->query('SELECT COUNT(*) as codes FROM activations WHERE code="'. $activation_code .'"');
        $result = $results->fetch_assoc();
        
        if(!$result['codes'])
          break;
        
        $activation_code = sha1(uniqid(time() + $_SERVER['REMOTE_ADDR']));
      }
      
      $db_handler->query('INSERT INTO activations(code, user_id) VALUES("'. $activation_code .'", "'. $user_id .'")');
      
      return new Activation($activation_code);
    }
    
    public function activate()
    /*
     * Aktywuje dane konto.
     */
    {
      $results = $this->db_handler->query('SELECT user_data_id FROM users WHERE id='. $this->user_id);
      $result = $results->fetch_assoc();

      $this->db_handler->query('UPDATE users_data SET active=1 WHERE id='. $result['user_data_id']);
      $this->db_handler->query('DELETE FROM activations WHERE user_id='. $this->user_id);
      
      return true;
    }
    
    static function garbage_collector()
    /*
     * Usuwa wszystkie aktywacje, których czas życia minął.
     */
    {
      $db_handler = new Database;
      
      $db_handler->query('DELETE FROM activations WHERE time < NOW() - INTERVAL '. ACTIVATION_EXPIRE.' SECOND');
    }

    public function __destruct()
    {
      if($this->db_handler)
        $this->db_handler->close();
    }
  }
?>