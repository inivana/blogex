<?php
  include_once('formvalidator.class.php');
  include_once('database.class.php');
  include_once('settings.class.php');

  // Definiuje nowy system wyświetlania wyjątków.
  include_once('classes/exception_handler.class.php');
  set_exception_handler(array('Exception_Handler', 'handle_exception'));

  class Registration extends FormValidator
  {
    private $db_handler,
            $validated = false;
    
    public $user_id;
    
    public function __construct()
    {
      parent::__construct();
      $this->db_handler = new Database;
    }
    
    public function register()
    /**
     * Waliduje dane
     */
    {
      $results = $this->db_handler->query('SELECT count(users.login) as login, count(users_data.email) as email  FROM users, users_data WHERE users.login = "'. $_POST['login'] .'" AND users_data.email = "'. $_POST['email'] .'"');
      $result = $results->fetch_assoc();
            
      if($result['login'] != 0)
        $this->add_custom_error('login', 'Ten login jest zajęty.');

      if($result['email'] != 0)
        $this->add_custom_error('email', 'Ten email jest zajęty.');
      
      $this->addValidation('login', 'maxlen=30', 'Możesz użyć od 6 do 30 znaków.');
      $this->addValidation('login', 'minlen=6', 'Możesz użyć od 6 do 30 znaków.');
      $this->addValidation('password', 'maxlen=60', 'Możesz użyć od 6 do 30 znaków.');
      $this->addValidation('password', 'minlen=8', 'Możesz użyć od 8 do 60 znaków.');
      $this->addValidation('class', 'maxlen=1', ''); // po za formularzem można tu wcisnąć wszystko

      $this->addValidation('login', 'alnum', 'W loginie dozwolone są tylko znaki alfabetyczne, cyfry oraz znak podkreślenia.');
      $this->addValidation('first_name', 'alpha', 'Twoje imię może zawierać tylko znaki alfabetyczne.');
      $this->addValidation('last_name', 'alpha_s', 'Twoje nazwisko może zawierać tylko znaki alfabetyczne i spacje.');
      $this->addValidation('class', 'alpha', ''); // po za formularzem można tu wcisnąć wszystko

      $this->addValidation('password', 'eqelmnt=repeated_password', 'Hasła do siebie nie pasują.');
      $this->addValidation('email', 'eqelmnt=repeated_email', 'Emaile do siebie nie pasują.');

      $this->addValidation('email', 'email', 'Musisz podać prawidłowy email.');  

      if(!checkdate(intval($_POST['month']), intval($_POST['day']), intval($_POST['year'])))
        $this->add_custom_error('date', 'Data urodzenia nie jest poprawna.');
      
      $this->addValidation('login', 'req', 'Musisz podać nazwę użytkownika.');
      $this->addValidation('password', 'req', 'Musisz podać hasło.');
      $this->addValidation('repeated_password', 'req', 'Musisz potwierdzić swoje hasło.');
      $this->addValidation('first_name', 'req', 'Musisz podać imię.');
      $this->addValidation('last_name', 'req', 'Musisz podać nazwisko.');
      $this->addValidation('email', 'req', 'Musisz podać email.');
      $this->addValidation('repeated_email', 'req', 'Musisz potwierdzić swój email.');
      $this->addValidation('class', 'dontselect=first', 'Musisz podać klasę.');

      if($this->ValidateForm())
      {
        $this->validated = true;
        return true;
      }
      else
        return false;
    }

    public function commit()
    /*
     * Zapisuje nowego użytkownika do bazy.
     */
    {
      if(!$this->validated)
        throw new Exception('Dane przed zapisaniem nie przeszły walidacji.');

      $this->db_handler->query(sprintf('INSERT INTO users_data(first_name, last_name, active, email, settings, date_of_birth, class) 
                                        VALUES ("%s", "%s", %d, "%s", "%s", "%s", "%s")',
                                                                             $_POST['first_name'],
                                                                             $_POST['last_name'],
                                                                             0,
                                                                             $_POST['email'],
                                                                             addslashes(serialize(Settings::$default_settings)),
                                                                             implode('-', array(
                                                                                          $_POST['year'],
                                                                                          $_POST['month'],
                                                                                          $_POST['day']
                                                                                          )),
                                                                             $_POST['class']
                                                                             ));


      $user_data_id = $this->db_handler->query('SELECT id FROM users_data WHERE email = "'. $_POST['email'] .'" AND last_name = "'. $_POST['last_name'] .'"');
      $user_data_id = $user_data_id->fetch_assoc();
      $user_data_id = $user_data_id['id'];
  
      $this->db_handler->query('INSERT INTO users(login, password, user_data_id) VALUES("'. $_POST['login'] .'", "'. hash('sha256', $_POST['password']) .'", "'. $user_data_id .'")');
    
      $user_id = $this->db_handler->query('SELECT id FROM users WHERE login="'. $_POST['login'] .'" AND password="'. hash('sha256', $_POST['password']) .'"');
      $user_id = $user_id->fetch_assoc();
      $this->user_id = $user_id['id'];
    }
    
    public function __destruct()
    {
      $this->db_handler->close(); 
    }
  }
?>