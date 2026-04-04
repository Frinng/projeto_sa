<?php
$host = '127.0.0.1';
$user = 'root';
$pass = ''; 
$db   = 'AprendizadoPHP';

// porta do mysql
$port = 3306; 
// --------------------

$mysqli = new mysqli($host, $user, $pass, $db, $port);

if ($mysqli->connect_error) {
    die("Erro de conexão (" . $mysqli->connect_errno . "): " . $mysqli->connect_error);
}
?>