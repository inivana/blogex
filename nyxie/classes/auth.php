<?php

class Auth
{
    private $db;

    public function __construct()
    {
        $this->db = new Database;
        $this->db->connect("localhost", "root", "", "blogex");
    }

    public function login($email, $password)
    {
        $result = $this->db->where("ID", "users", "email = '" . $email . "' AND password = '" . hash('sha256', $password) . "'");
        return boolval(count($result));
    }
}

?>