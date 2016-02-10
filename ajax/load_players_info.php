<?php
// Includes
include('../config.php');
require_once('../libraries/ModelDB.php');

// Parse GET parameters
$game_id = (int)$_GET['game_id'];

// Working with Db
ModelDB::init();
$players = ModelDB::get_players($game_id);

$prepare=array();
foreach ($players as $row) {
	$prepare[] = array(
		'player_id'=>$row['player_id'],
		'fullname'=>$row['fullname'],
		'chid'=>$row['ch_id'],
		'finished'=>$row['finished'],
	);
}

echo json_encode($prepare);
?>