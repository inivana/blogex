<?php
  include_once('classes/database.class.php');
  include_once('classes/user.class.php');

  // Definiuje inny system wyświetlania wyjątków.
  include_once('classes/exception_handler.class.php');
  set_exception_handler(array('Exception_Handler', 'handle_exception'));

  class Settings 
  {
    private $db_handler,
            $user,
            $user_id,
            $user_data_id,
            $settings;
    
    public static $default_settings = array(
                                          'photo_name'=>'default_photo.png',
                                          'photo_visibility'=>'false',
                                          'phone_number'=>'',
                                          'phone_number_visibility'=>'false'
                                          );
    
    public function __construct($user_id)
    /*
     * Pobiera z bazy opcje użytkownika
     */
    {
      $this->user_id = $user_id;
      
      $this->user = new User($this->user_id);
      
      $this->db_handler = new Database;

      $this->user_data_id = $this->user->user_data_id;
      
      $results = $this->db_handler->query('SELECT settings FROM users_data WHERE id='. $this->user_data_id);
      $result = $results->fetch_assoc();
      
      $this->settings = unserialize($result['settings']);
    }
    
    public function get_settings()
    {
      return $this->settings;
    }
    
    public function __get($setting)
    /*
     * Zwraca wartość opcji
     */
    {
      return $this->settings[$setting];
    }
    
    public function __set($setting, $value)
    /*
     * Zmienia wartość opcji
     */
    {
      if(array_key_exists($setting, $this->settings))
      {
        $this->settings[$setting] = $value;
        $this->db_handler->query('UPDATE users_data SET settings =\''. serialize($this->settings) .'\' WHERE id ='. $this->user_data_id);
      }
    }
    
    public function change_email($email)
    {
      if(preg_match('/^[_\.0-9a-zA-Z-]+@([0-9a-zA-Z][0-9a-zA-Z-]+\.)+[a-zA-Z]{2,6}$/', $email))
      {
        $this->user->change_email($email);
        return true;
      }
      else 
        return false;
    }
    
    public function change_password($password)
    {
      $this->user->change_password($password);
    }
  }
?>