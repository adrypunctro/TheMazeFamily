<?php
include('../config.php');

$conn = new PDO('mysql:host='.DB_SERVER.';dbname='.DB_DB.'', DB_USER, DB_PASS);

$game_id = (int)$_GET['game_id'];

// Executa update-ul
$stmt = $conn->prepare("SELECT * FROM ph2_games WHERE game_id = '$game_id' LIMIT 1");
$stmt->execute(); 
$row = $stmt->fetch();

echo $row['started'];
?>