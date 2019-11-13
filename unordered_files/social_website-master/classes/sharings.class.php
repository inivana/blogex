<?php
  include_once('database.class.php');

  class Sharing
  {
    var $id,
        $shared_user_id, // Udostępniający
        $user_id; // Osoba, której udostępniono
        
    function __construct($id, $shared_user_id, $user_id)
    {
      $this->id = $id;
      $this->shared_user_id = $shared_user_id;
      $this->user_id = $user_id;
    }
  }

  class Sharings
  {
    private $user_id,
            $db_handler;

    function __construct($user_id)
    {
      $this->user_id = $user_id;
      
      $this->db_handler = new Database;
    }
    
    function get_sharings()
    {
      $sharings = array();
      
      // Jeżeli ktoś udostępni mi swój, a ja jemu udostępnię swój profil, badź to ja najpierw mu udostępnie pierwszy, to zapytanie pobierze taki rekord. Jeśli swój profil udostępni jedna osoba, rekord zostanie pominięty.
      $results = $this->db_handler->query(sprintf('SELECT id, shared_user_id, user_id FROM sharings as s1 WHERE shared_user_id = %d AND user_id = (SELECT shared_user_id FROM sharings as s2 WHERE s2.shared_user_id = s1.user_id AND s2.user_id = s1.shared_user_id)', $this->user_id));

      while($row = $results->fetch_assoc())
      {
        array_push($sharings, new Sharing(
                              $row['id'],
                              $row['shared_user_id'],
                              $row['user_id']
                              ));
      }
      
      return $sharings;
    }
    
    function add($sharing_user_id)
    {
      $this->db_handler->query(sprintf('INSERT INTO sharings VALUES (NULL, "%d", "%d")', $this->user_id, $sharing_user_id));
    }
  }
?>