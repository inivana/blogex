<?php
  include_once('formvalidator.class.php');
  include_once('database.class.php');

  // Definiuje inny system wyświetlania wyjątków.
  include_once('classes/exception_handler.class.php');
  set_exception_handler(array('Exception_Handler', 'handle_exception'));

  class User
  {
    public $id,
           $user_data_id,
           $login,
           $password,
           $first_name,
           $last_name,
           $activate,
           $email,
           $registration_date,
           $status,
           $settings,
           $date_of_birth,
           $class;
           
    private $db_handler;

    public function __construct($user_id)
    /*
     * Przypisuje wszystkie informacje zmiennym w obiekcie.
     */
    {
      $this->db_handler = new Database;
      
      $results = $this->db_handler->query('SELECT *, day(date_of_birth) as day, month(date_of_birth) as month, year(date_of_birth) as year FROM users, users_data WHERE users.id = '. $user_id .' AND users_data.id = users.user_data_id');
      $result = $results->fetch_assoc();
      
      $this->id = $result['id'];
      $this->login = $result['login'];
      $this->password = $result['password'];
      $this->first_name = $result['first_name'];
      $this->last_name = $result['last_name'];
      $this->active = $result['active'];
      $this->email = $result['email'];
      $this->registration_date = $result['registration_date'];
      $this->settings = $result['settings'];
      $this->date_of_birth['full'] = $result['date_of_birth'];
      $this->date_of_birth['year'] = $result['year'];
      $this->date_of_birth['month'] = $result['month'];
      $this->date_of_birth['day'] = $result['day'];
      $this->class = $result['class'];
      $this->user_data_id = $result['user_data_id'];
    }
    
    public function change_email($email)
    {
      $this->db_handler->query('UPDATE users_data SET email = "'. $email .'" WHERE id = "'. $this->user_data_id .'"');
    }

    public function change_password($password)
    {
      $this->db_handler->query('UPDATE users SET password = "'. hash('sha256', $password) .'" WHERE id = "'. $this->id .'"');
    }
  }
?>