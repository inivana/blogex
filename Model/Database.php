<?php


class Database
{
    private $servername;
    private $username;
    private $password;
    private $dbname;
    private $connection;

    /**
     * @return mixed
     */
    public function getConnection()
    {
        return $this->connection;
    }

    function __construct($servername, $username, $password, $dbname)
    {
        $this->servername = $servername;
        $this->username = $username;
        $this->password = $password;
        $this->dbname = $dbname;
        $this->Connect();
    }

    function Connect()
    {
        $this->connection = new mysqli($this->servername, $this->username, $this->password, $this->dbname);

        if ($this->connection->connect_error) {
            die("Error: " . $this->connection->connect_error);
        }
    }

    function InsertArticle($title, $author)
    {
        $query = "INSERT INTO article(title, author) VALUES ('" .  $title . "', '" . $author . "')";

        if(mysqli_query($this->connection, $query))
        {
            echo "Udalo sie dodac rekord";
        }else {
            echo "Error: " . $query . "" . mysqli_error($this->connection);
        }
    } //czy to nie powinno być w kontrolerze?

    function __destruct()
    {
        $this->connection->close();
    }
}