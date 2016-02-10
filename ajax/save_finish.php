<?php
session_start();

// Includes
include('../config.php');
require_once('../libraries/Platform.php');


if(!isset($_SESSION['game_id']) && !isset($_SESSION['user_id'])) {
	die("game_id or user_id key SESSION is not sets.");
}

// Init the platform instance
$platform = new Platform();

// Parse GET parameters
$posx = (int)$_GET['posx'];
$posy = (int)$_GET['posy'];
$game_id = $_SESSION['game_id'];
$user_id = $_SESSION['user_id'];


// Get start/finish pos
$finish_pos = $platform->game->map->get_finish_pos($game_id);
$finishx = $finish_pos[0];
$finishy = $finish_pos[1];

ModelDB::init();
$player_id = ModelDB::get_player_id($game_id, $user_id);

if($posx == $finishx && $posy == $finishy) {
	// Working with Db
	ModelDB::init();
	ModelDB::update_player_pos($player_id, $posx, $posy);
	ModelDB::update_player_finished($player_id);
	
	echo 1;
}
else {
	echo 0;// #Error	
}
