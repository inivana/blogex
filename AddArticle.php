<?php
include_once 'Model/Database.php';
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "articles";

$connection = new Database($servername, $username, $password, $dbname);
//$connection->InsertArticle($_POST["title"], $_POST["author"]);
