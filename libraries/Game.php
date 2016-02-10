<?php
class Game
{
	public $map;
	
	public function __construct() {
		
		if(!array_key_exists('game_id', $_SESSION)) {
			$_SESSION['game_id'] = 0;
		}

		$this->init();
		
	}
	
	
	private function init() {
		
		//$this->id = 1;
		$this->map = new Map(10,10);
		
	}
	
	
	
	public function host() {
		
		if($_SESSION['game_id'] == 0) {
			
			// Generate new map
			$places_ver = $this->_generate_map();
			
			// se creeaza un guest nou
			$_SESSION['game_id'] = ModelDB::new_game(5, $places_ver);
		}
		
	}
	
	public function join($game_id) {
		
		$_SESSION['game_id'] = $game_id;
		
	}
	
	
	public function game_id() {
		
		return $_SESSION['game_id'];
		
	}
	
	
	
		
	public function get_player_id($user_id) {
		
		return ModelDB::get_player_id($this->game_id(), $user_id);
		
	}
	
	
	
	public function game_pass() {
		
		return ModelDB::get_game_pass($_SESSION['game_id']);
		
	}
	
	
	
	public function start() {
		
		// check if started
		if(ModelDB::is_started($this->game_id())) {
			return 2;// #err 2 say 'Is started'
		}
		
		// Get players
		$players = ModelDB::get_players($this->game_id());
		
		// Get [0] start team1 / [1] start team 2
		$go_pos = $this->map->get_go_pos($this->game_id());
		
		// seteaza configuratia jucatorilor
		foreach ($players as $row) {
			$sets = array();
			
			// set vision range
			$sets['vision'] = start_vision;
			
			$this_pos = array_shift($go_pos[$row['team']]);
			// set position
			$sets['posx'] = $this_pos[0];
			$sets['posy'] = $this_pos[1];
			
			ModelDB::update_player($row['player_id'], $sets);
		}
		
		// Set finish pos
		$finish_pos = $this->map->generate_finish_pos();
		$finishx = $finish_pos[0];
		$finishy = $finish_pos[1];
		ModelDB::set_finish_pos($this->game_id(), $finishx, $finishy);
		
		// start game
		ModelDB::start_game($this->game_id());
		
	}
	
	
	
	public function add_player($user_id) {
		
		ModelDB::add_player($this->game_id(), $user_id);
		
	}
	
	
	
	private function _generate_map() {
		
		return $this->map->generate_map();
		
	}
	
	
	
	public function get_map() {
		
		// Get map places version
		$places_ver = ModelDB::get_places_ver($this->game_id());
		
		return $this->map->get_map($places_ver);
		
	}
}
?>