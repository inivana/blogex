<?php
include_once '../Model/Database.php';

$login = $_POST["login"];
$password = $_POST["password"];

$query = "SELECT * FROM author WHERE nickname='" . $login  . "' AND password ='" . $password . "';";
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "articles";

$connection = new Database($servername, $username, $password, $dbname);
$result = mysqli_query($connection->getConnection(), $query);
$result = $result->fetch_array();
if($result != null){
    echo "udało się zalogować </br>";
    //w resulcie mamy tablice z wynikami z selecta
    //var_dump($result["id"]) lub var_dump($result);
}else{
    echo "Niepoprawne dane logowania";
}