<?php
include('../config.php');

$conn = new PDO('mysql:host='.DB_SERVER.';dbname='.DB_DB.'', DB_USER, DB_PASS);

$game_id = (int)$_GET['game_id'];

$players = array();// Nume, posy, posx
$sql = "SELECT * FROM ph2_players p, ph2_characters c, ph2_users u
WHERE p.ch_id = c.ch_id AND p.user_id = u.user_id AND p.game_id = '$game_id'";
foreach ($conn->query($sql) as $row)
{
	printf("%d,%d,%d;",$row['player_id'],$row['posx'],$row['posy']);
}
?>