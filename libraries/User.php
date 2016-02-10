<?php
class User
{
	
	public function __construct()
	{
		if(!isset($_SESSION)) {
			$_SESSION = array();	
		}
		
		if(!array_key_exists('user_id', $_SESSION)) {
			$_SESSION['user_id'] = 0;
		}
		
		if(!array_key_exists('user_name', $_SESSION)) {
			$_SESSION['user_name'] = 'Guest';
		}
		
		if(!array_key_exists('user_character', $_SESSION)) {
			$_SESSION['user_character'] = 1;
		}
	}
	
	
	
	public function guest() {
		
		if($_SESSION['user_id'] == 0) {
			// se creeaza un guest nou
			$_SESSION['user_id'] = ModelDB::new_guest();
		}
	}
	
	
	
	public function logged() {
	
		return ($_SESSION['user_id'] > 0);
	}
	
	
	
	public function signin($user_id) {
	
		$_SESSION['user_id'] = $user_id;
		
	}
	
	
	
	public function signout() {
	
		$_SESSION['user_id'] = 0;
		
	}
	
	
	
	public function user_id() {
		
		return $_SESSION['user_id'];
		
	}
	
	
	
	public function user_name() {
		
		return $_SESSION['user_name'];
		
	}
	
	
	
	public function user_character() {
		
		return $_SESSION['user_character'];
		
	}
	
	
	
	public function save_player($game_id, $name, $character) {
		
		ModelDB::change_player($this->user_id(), $game_id, $name, $character);
		
		$this->save_player_in_sess($name, $character);
		
	}
	
	public function save_player_in_sess($name, $character) {
		
		$_SESSION['user_name'] = $name;
		$_SESSION['user_character'] = $character;
		
	}
}
?>