<?php
session_start();

// Includes
include('../config.php');
require_once('../libraries/ModelDB.php');

if(!isset($_SESSION['game_id'])) {
	die("0");	
}

// Parse GET parameters
$game_id = (int)$_SESSION['game_id'];

// Working with Db
ModelDB::init();
$players = ModelDB::get_players($game_id);
$players_spells = ModelDB::get_players_spells($game_id);

$prepare=array();
foreach ($players as $row) {
	$spells = isset($players_spells[$row['player_id']]) ? $players_spells[$row['player_id']] : array();
	$prepare[] = array(
		'player_id'	=>	$row['player_id'],
		'posx'		=>	$row['posx'],
		'posy'		=>	$row['posy'],
		'image'		=>	$row['image'],
		'vision'	=>	$row['vision'],
		'team'		=>	$row['team'],
		'fullname'	=>	$row['fullname'],
		'ch_id'		=>	$row['ch_id'],
		'finished'	=>	$row['finished'],
		'spells'	=>	$spells
	);
}

echo json_encode($prepare);