<?php
class ModelDB
{
	static private $conn;
	
	
	public function __construct() {
		
		$this->init();
		
	}
	
	
	
	static public function init() {
		
		ModelDB::$conn = new PDO('mysql:host='.DB_SERVER.';dbname='.DB_DB.'', DB_USER, DB_PASS);
		
	}
	
	
	
	static public function get_players($game_id) {

		return ModelDB::$conn->query("SELECT * FROM ph2_players p, ph2_characters c, ph2_users u
		WHERE p.ch_id = c.ch_id AND p.user_id = u.user_id AND p.game_id = '$game_id'");
		
	}
	
	
	static public function pos_is_free($game_id, $posx, $posy) {

		$res = ModelDB::$conn->query("SELECT COUNT(*) FROM ph2_players
		WHERE game_id = '$game_id' AND posx = '$posx' AND posy = '$posy' LIMIT 1");
		
		return ($res->fetchColumn() == 0);
	}
	
	
	static public function get_players_spells($game_id) {

		$rows = ModelDB::$conn->query("SELECT * FROM ph2_game_spells gs, ph2_spells s
		WHERE gs.spell_id = s.spell_id AND gs.game_id = '$game_id'");
		
		$players_spells = array();
		$timeNow = strtotime(date('Y-m-d H:i:s'));
		foreach($rows as $row) {
			
			// Calc left time
			$timeStart  = strtotime($row['start']);
			$diff = $timeNow - $timeStart;// in seconds
			$left = $row['time'] - ($diff * 1000);
			
			// if expired, delete this spell
			if($left <= 0) {
				ModelDB::$conn->query("DELETE FROM ph2_game_spells
					WHERE game_id = '$game_id' AND player_id = '$row[player_id]'
						AND spell_id = '$row[spell_id]' AND `start` = '$row[start]'");
				continue;
			}
			
			// Add in array
			$players_spells[$row['player_id']][] = array(
				'spell_id' => $row['spell_id'],
				'spell_key' => $row['spell_key'],
				'label' => $row['label'],
				'description' => $row['description'],
				'start' => $row['start'],// datatime
				'time' => $row['time'],// miliseconds
				'left' => $left,// miliseconds
			);
		}
		
		return $players_spells;
	}
	
	
	
	static public function get_player_id($game_id, $user_id) {
		
		$stmt = ModelDB::$conn->prepare("SELECT * FROM ph2_players WHERE user_id = '$user_id' AND game_id = '$game_id' LIMIT 1");
		$stmt->execute(); 
		$row = $stmt->fetch();
		
		return $row['player_id'];
		
	}
	
	
	static public function get_finish_pos($game_id) {
		
		$stmt = ModelDB::$conn->prepare("SELECT * FROM ph2_game_finish_pos WHERE game_id = '$game_id' LIMIT 1");
		$stmt->execute(); 
		$row = $stmt->fetch();
		
		return array($row['posx'],$row['posy']);
		
	}
	
	
	
	static public function is_started($game_id) {
		
		$rows = ModelDB::$conn->query("SELECT started FROM ph2_games WHERE game_id = '$game_id'");
		foreach($rows as $row) {
			return ($row['started'] == '1');
		}
		
	}
	
	
	
	static public function update_player_pos($p_id, $posx, $posy) {
		
		return ModelDB::$conn->query("UPDATE ph2_players SET posx='$posx', posy='$posy' WHERE player_id='$p_id'");
		
	}
	
	
	static public function update_player_finished($p_id) {
		
		return ModelDB::$conn->query("UPDATE ph2_players SET finished='1' WHERE player_id='$p_id'");
		
	}
	
	
	static public function update_player($player_id, $sets) {
		
		$update='';
		foreach($sets as $k => $v) {
			$update .= "`$k`='$v',";
		}
		$update = rtrim($update, ',');
		
		return ModelDB::$conn->query("UPDATE ph2_players SET $update WHERE player_id = '$player_id'");
		
	}
	
	
	static public function set_finish_pos($game_id, $posx, $posy) {
		
		ModelDB::$conn->query("INSERT INTO ph2_game_finish_pos (game_id, posx, posy) VALUES ($game_id, $posx, $posy)");
		
	}
	

	static public function new_guest() {
		
		ModelDB::$conn->query("INSERT INTO ph2_users (user_id, fullname) VALUES (NULL, 'Guest".rand(1111,9999)."')");
		return ModelDB::$conn->lastInsertId();
		
	}
	
	
	
	static public function add_spell($game_id, $player_id, $spell_id, $time) {
		
		//printf("%d %d %d %d", $game_id, $player_id, $spell_id, $time);
		
		ModelDB::$conn->query("INSERT INTO ph2_game_spells (game_id, player_id, spell_id, start, time) VALUES ($game_id, $player_id, $spell_id, '".date('Y-m-d H:i:s')."', $time)");
		
	}
	
	
	static public function get_spell_id($spell_key) {
		
		$stmt = ModelDB::$conn->prepare("SELECT * FROM ph2_spells WHERE `spell_key` = '$spell_key' LIMIT 1");
		$stmt->execute(); 
		$row = $stmt->fetch();
		
		return $row['spell_id'];
		
	}
	
	
	
	
	static public function new_game($max_players, $places_ver) {
		
		// Create new game entry
		ModelDB::$conn->query("INSERT INTO ph2_games (game_id, name, pass) VALUES (NULL, 'Family four', '".rand(1111,9999)."')");
		$game_id = ModelDB::$conn->lastInsertId();
		
		// Reservation
		ModelDB::$conn->query("INSERT INTO ph2_players (player_id, game_id, team) VALUES (NULL, $game_id, 1)");
		
		// Generate and save map
		ModelDB::$conn->query("INSERT INTO ph2_game_map_places (game_id, place_pos, place_ver) VALUES ($game_id, 1, $places_ver[0])");
		ModelDB::$conn->query("INSERT INTO ph2_game_map_places (game_id, place_pos, place_ver) VALUES ($game_id, 2, $places_ver[1])");
		ModelDB::$conn->query("INSERT INTO ph2_game_map_places (game_id, place_pos, place_ver) VALUES ($game_id, 3, $places_ver[2])");
		ModelDB::$conn->query("INSERT INTO ph2_game_map_places (game_id, place_pos, place_ver) VALUES ($game_id, 4, $places_ver[3])");
		ModelDB::$conn->query("INSERT INTO ph2_game_map_places (game_id, place_pos, place_ver) VALUES ($game_id, 5, $places_ver[4])");
		ModelDB::$conn->query("INSERT INTO ph2_game_map_places (game_id, place_pos, place_ver) VALUES ($game_id, 6, $places_ver[5])");
		ModelDB::$conn->query("INSERT INTO ph2_game_map_places (game_id, place_pos, place_ver) VALUES ($game_id, 7, $places_ver[6])");
		ModelDB::$conn->query("INSERT INTO ph2_game_map_places (game_id, place_pos, place_ver) VALUES ($game_id, 8, $places_ver[7])");
		ModelDB::$conn->query("INSERT INTO ph2_game_map_places (game_id, place_pos, place_ver) VALUES ($game_id, 9, $places_ver[8])");
		
		
		return $game_id;
		
	}
	
	
	
	static public function get_game_pass($game_id) {
		
		$stmt = ModelDB::$conn->prepare("SELECT * FROM ph2_games WHERE game_id = '$game_id' LIMIT 1");
		$stmt->execute(); 
		$row = $stmt->fetch();
		
		return $row['pass'];
		
	}
	
	
	
	static public function get_places_ver($game_id) {
		
		$stmt = ModelDB::$conn->prepare("SELECT * FROM ph2_game_map_places WHERE game_id = '$game_id' ORDER BY `place_pos` ASC");
		$stmt->execute(); 
		$places_ver = array();
		while($row = $stmt->fetch()) {
			$places_ver[] = $row['place_ver'];
		}
		
		if(count($places_ver) != 9) {
			throw new Exception("The map places in db does not have 9 entries.");	
		}
		
		return $places_ver;
		
	}
	
	
	
	static public function start_game($game_id) {
		
		ModelDB::$conn->query("UPDATE ph2_games SET `started` = '1',
		`started_date` = '".date('Y-m-d H:i:s')."' WHERE `game_id` = '$game_id' LIMIT 1");
		
	}
	
	
	
	static public function change_player($user_id, $game_id, $name, $character) {
		
		ModelDB::$conn->query("UPDATE ph2_users SET `fullname` = '$name' WHERE `user_id` = '$user_id' LIMIT 1");
		ModelDB::$conn->query("UPDATE ph2_players SET `ch_id` = '$character' WHERE `user_id` = '$user_id' AND `game_id` = '$game_id' LIMIT 1");
		
	}
	
	
	
	static public function add_player($game_id, $user_id) {
		
		// verificam daca este introdus deja
		$res = ModelDB::$conn->query("SELECT * FROM ph2_players WHERE game_id = '$game_id' AND user_id = '$user_id'");



		if ($res->fetchColumn() == 0) {
			
			if(!isset($_SESSION['user_character'])) {
				throw new Exception("User character is not set.");	
			}
			
			// Add player
			ModelDB::$conn->query("INSERT INTO ph2_players (player_id, user_id, ch_id, game_id, team) VALUES (NULL, $user_id, ".$_SESSION['user_character'].", $game_id, 1)");
			
		}
		
	}
	
}
?>