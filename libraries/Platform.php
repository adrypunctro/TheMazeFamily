<?php

require_once('ModelDB.php');
require_once('Game.php');
require_once('Map.php');
require_once('Player.php');
require_once('User.php');

ModelDB::init();

class Platform
{
	public $config;
	public $user;
	public $game;
	
	
	public function __construct() {
		
		$this->config = array(
			'view_teams' => 4,
			'view_players_per_team' => 2,
			'view_spells' => 4,
			'view_cards' => 2,
			'view_map_align' => 'center',
			
		);
		$this->init();
		
	}
	
	
	
	private function init() {
		
		$this->user = new User();
		$this->game = new Game();
		
	}
	
	
	
	public function get_players() {
		
		$players = array();// Nume, posy, posx
		foreach (ModelDB::get_players($this->game->game_id()) as $row) {
			$players[$row['player_id']] = array($row['fullname'], $row['posx'], $row['posy'], $row['ch_id'], $row['vision']);
		}
		
		return $players;
		
	}
	
	
	
	public function get_map() {
		
		return $this->game->get_map();
		
	}
}
?>