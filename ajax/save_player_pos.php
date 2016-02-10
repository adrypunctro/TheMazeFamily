<?php
session_start();

// Includes
include('../config.php');
require_once('../libraries/ModelDB.php');

if(!isset($_SESSION['game_id']) || !isset($_SESSION['user_id'])) {
	die("0");	
}

// Parse GET parameters
$game_id = $_SESSION['game_id'];
$user_id = $_SESSION['user_id'];
$posx = (int)$_GET['posx'];
$posy = (int)$_GET['posy'];


// Working with Db
ModelDB::init();
$player_id = ModelDB::get_player_id($game_id, $user_id);

// Check if pos is free
$free = ModelDB::pos_is_free($game_id, $posx, $posy);
if($free) {
	ModelDB::update_player_pos($player_id, $posx, $posy);
	echo '1';
}
else {
	echo '0';
}
