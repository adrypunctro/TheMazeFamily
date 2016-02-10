<?php
include('../config.php');

$conn = new PDO('mysql:host='.DB_SERVER.';dbname='.DB_DB.'', DB_USER, DB_PASS);

$game_id = (int)$_GET['game_id'];
$user_id = (int)$_GET['user_id'];
$team = (int)$_GET['team'];

// Executa update-ul
$conn->query("UPDATE ph2_players SET team = '$team' WHERE user_id = '$user_id' AND game_id = '$game_id'");
?>