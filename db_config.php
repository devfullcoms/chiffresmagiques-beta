<?php
$host = "localhost";  // ou l'adresse du serveur
$user = "magic_game_db1";
$password = "koiVl^jyZ@GA";
$dbname = "magic_game_db";

$conn = new mysqli($host, $user, $password, $dbname);
if ($conn->connect_error) {
    die("Échec de la connexion : " . $conn->connect_error);
}
?>
