<?php
include('../config.php');

$conn = new PDO('mysql:host='.DB_SERVER.';dbname='.DB_DB.'', DB_USER, DB_PASS);

$code = $_GET['code'];
$e = explode('-', $code);

if(count($e) != 2)
	die('0');

$game_id = (int)$e[0];
$pass = $e[1];

// Executa update-ul
$stmt = $conn->prepare("SELECT * FROM ph2_games WHERE game_id = '$game_id' LIMIT 1");
$stmt->execute(); 
$row = $stmt->fetch();

if($row['pass'] == $pass)
	echo $game_id;
else
	echo 0;
?>