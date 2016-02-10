<?php
class Map
{
	
	private $_ground;     // layer 1
	private $_road;       // layer 2
	private $_abilities;  // layer 3
	private $_width;
	private $_height;
	private $_caracteristics;
	// places
	private $_places_width;
	private $_places_height;
	private $_places_cols;
	private $_places_rows;
	
	
	
	public function __construct($width, $height) {
		
		$this->_init();
		
		$this->_width = $width;
		$this->_height = $height;
		
		$this->_places_width = 8;
		$this->_places_height = 8;
		$this->_places_cols = 3;
		$this->_places_rows = 3;
	
	}
	
	
	
	private function _init() {
		
		$this->_ground = array();
		$this->_road = array();
		$this->_abilities = array();
		$this->_caracteristics = array();
		
	}
	
	
	
	public function generate_map() {
	
		$places = $this->_places();
		$places_ver = array();
		
		foreach($places as $k1 => $p) {
			$ver = rand(0, count($p)-1);
			$places_ver[] = $ver;
		}
		
		return $places_ver;
	}
	
	
	
	
	
	
	
	public function get_map($places_ver) {
		
		$places = $this->_places();
		$r_i=-$this->_places_height;
		$c_i=-$this->_places_width;
		
		// parcurge portiunile
		foreach($places as $k1 => $p) {
			
			// Get ver
			$vers=$places_ver[$k1];
			
			if($k1%$this->_places_cols == 0) {
				$r_i+=$this->_places_height;
				$c_i=-$this->_places_width;
			}
			
			$c_i += $this->_places_width;
			
			// parcurge randurile
			foreach($p[$vers] as $k2 => $rows) {
				
				// parcurge coloanele
				foreach($rows as $k3 => $v) {
					$this->_ground[$r_i+$k2][$c_i+$k3] = $v;
				}
					
			}
		}

		return $this->_ground;
		
	}
	
	
	public function get_finish_pos($game_id) {
		
		return ModelDB::get_finish_pos($game_id);
		
	}
	
	
	public function generate_finish_pos() {
		
		// Posible finish pos
		$posible_finish = array(array(0,0),array(20,0),array(22,4),array(0,10),array(10,12),array(18,10),array(16,14),array(0,22),array(6,18),array(12,18),array(12,22),array(20,18),array(22,22));
		
		return $posible_finish[rand(0, count($posible_finish)-1)];;
		
	}
	
	
	public function get_go_pos($game_id) {
		
		// Get places vers
		$places_ver = ModelDB::get_places_ver($game_id);
		
		//$go = $this->_go_places();
		
		$go_pos = array();
		
		
		// TODO: Nu suporta versionarea parcelelor
		$go_pos[1] = array(array(4, 1), array(7, 0), array(8, 0), array(10, 0), array(12, 0));
		$go_pos[2] = array(array(0, 13), array(0, 15), array(1, 14), array(2, 15), array(0, 17));
		
		return $go_pos;
	}
	
	
	
	// start - finish positions
	private function _go_places() {
		
		/*$go = array();
		// [place][version]['start/finish'][team]
		
		// TODO: it support maximum 5 players into team
		$go[0][0]['start'][1] = array(array(4, 1), array(7, 0), array(8, 0), array(10, 0), array(12, 0));
		$go[0][0]['start'][2] = false;
		$go[0][0]['finish'] = array(0, 5);
		
		$go[1][0]['start'][1] = false;
		$go[1][0]['start'][2] = false;
		$go[1][0]['finish'] = false;
		
		$go[2][0]['start'][1] = false;
		$go[2][0]['start'][2] = false;
		$go[2][0]['finish'] = false;
		
		$go[3][0]['start'][1] = false;
		$go[3][0]['start'][2] = array(array(0, 7), array(1, 7), array(1, 6), array(1, 5), array(1, 4));
		$go[3][0]['finish'] = false;
		
		$go[4][0]['start'][1] = false;
		$go[4][0]['start'][2] = false;
		$go[4][0]['finish'] = false;
		
		$go[5][0]['start'][1] = false;
		$go[5][0]['start'][2] = false;
		$go[5][0]['finish'] = false;
		
		$go[6][0]['start'][1] = false;
		$go[6][0]['start'][2] = false;
		$go[6][0]['finish'] = false;
		
		$go[7][0]['start'][1] = false;
		$go[7][0]['start'][2] = false;
		$go[7][0]['finish'] = false;
		
		$go[8][0]['start'][1] = false;
		$go[8][0]['start'][2] = false;
		$go[8][0]['finish'] = false;

		return $go;*/
	}
	
	
	private function _places() {

		$places = array();
		// [place_nr][versiune]
		$places[0][0] = array(
			array(1,1,1,0,1,1,1,1),
			array(1,0,1,0,1,0,0,1),
			array(1,0,1,0,1,0,1,1),
			array(1,0,1,0,0,0,1,0),
			array(1,0,1,1,1,0,1,1),
			array(1,0,0,0,1,0,1,0),
			array(1,0,1,1,1,0,1,0),
			array(1,0,1,0,0,0,1,0),
		);  
		$places[1][0] = array(
			array(1,1,1,1,1,0,1,1),
			array(0,1,0,0,1,0,1,0),
			array(1,1,1,0,1,0,1,1),
			array(0,0,1,0,1,0,0,0),
			array(1,0,1,0,1,1,1,0),
			array(1,0,1,0,0,0,1,0),
			array(1,0,1,1,1,0,1,1),
			array(1,0,0,0,1,0,0,1),
		);
		$places[2][0] = array(
			array(1,1,1,0,1,1,1,0),
			array(0,0,1,0,0,0,1,0),
			array(1,0,1,0,1,1,1,0),
			array(1,0,1,0,1,0,0,0),
			array(1,0,1,0,1,0,1,0),
			array(1,0,1,0,1,0,1,0),
			array(1,0,1,1,1,1,1,0),
			array(0,0,1,0,0,0,1,0),
		);
		$places[3][0] = array(
			array(1,0,1,1,1,1,1,0),
			array(1,0,0,0,0,0,1,0),
			array(1,1,1,0,1,1,1,0),
			array(0,0,1,0,1,0,1,0),
			array(1,0,1,1,1,0,1,0),
			array(1,0,0,0,1,0,1,0),
			array(1,1,1,0,1,0,1,1),
			array(1,0,1,0,1,0,1,0),
		);
		$places[4][0] = array(
			array(1,1,1,0,1,0,1,1),
			array(0,0,1,0,1,0,1,0),
			array(1,1,1,0,1,1,1,1),
			array(1,0,0,0,0,1,0,0),
			array(1,1,1,0,1,1,1,0),
			array(1,0,0,0,1,0,1,0),
			array(1,1,1,1,1,0,1,0),
			array(0,0,0,0,0,0,1,0),
		);
		$places[5][0] = array(
			array(1,1,1,1,1,0,1,0),
			array(0,0,0,0,1,0,1,0),
			array(1,1,1,0,1,0,1,0),
			array(1,0,0,0,1,0,1,0),
			array(1,1,1,1,1,0,1,0),
			array(0,0,1,0,0,0,1,0),
			array(1,1,1,1,1,1,1,0),
			array(0,0,1,0,0,0,0,0),
		);
		$places[6][0] = array(
			array(1,0,1,1,1,0,1,1),
			array(1,0,0,0,0,0,0,0),
			array(1,1,1,1,1,1,1,0),
			array(0,0,1,0,0,0,0,0),
			array(1,1,1,0,1,1,1,0),
			array(1,0,0,0,1,0,1,0),
			array(1,1,1,1,1,0,1,1),
			array(0,0,0,0,0,0,0,0),
		);
		$places[7][0] = array(
			array(1,0,1,1,1,0,1,0),
			array(1,0,1,0,1,0,1,0),
			array(1,1,1,0,1,0,1,1),
			array(0,0,1,0,0,0,1,0),
			array(1,1,1,0,1,1,1,0),
			array(1,0,0,0,1,0,1,0),
			array(1,1,1,1,1,0,1,1),
			array(0,0,0,0,0,0,0,0),
		);
		$places[8][0] = array(
			array(1,1,1,1,1,1,1,0),
			array(1,0,0,0,0,0,1,0),
			array(1,1,1,1,1,0,1,0),
			array(0,0,0,0,0,0,1,0),
			array(1,1,1,0,1,1,1,0),
			array(1,0,1,0,1,0,0,0),
			array(1,0,1,1,1,1,1,0),
			array(0,0,0,0,0,0,0,0),
		);
		
		return $places;
	}
}
?>