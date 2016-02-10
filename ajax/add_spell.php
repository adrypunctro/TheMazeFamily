<?php
session_start();

// Includes
include('../config.php');
require_once('../libraries/ModelDB.php');

if(!isset($_SESSION['game_id']) || !isset($_SESSION['user_id'])) {
	die("0");	
}

// Parse GET parameters
$game_id   = (int)$_SESSION['game_id'];
$user_id   = (int)$_SESSION['user_id'];
$spell_key = (string)$_GET['spell_key'];
$time      = (int)$_GET['time'];


// Working with Db
ModelDB::init();
$player_id = ModelDB::get_player_id($game_id, $user_id);
$spell_id = ModelDB::get_spell_id($spell_key);
ModelDB::add_spell($game_id, $player_id, $spell_id, $time);