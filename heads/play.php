<?php
/*
Tip joc:	Cooperativ

Jucatori:	2, 4, 6, 8 jucatori in functie de harta

Obiectiv:	Misiune - fiecare echipa va avea o misiune de dus la sfarsit (similar cu jocul Nasa moon)

Abilitatii: Pe harta vor aparea aleator item-uri consumabile imediat din urmatoarele categorii:
			- albastre (abilitatea afecteaza harta)
			- verzi (abilitatea afecteaza persoana si coechipierii)
			- rosii (abilitatea va afecta adversarii) 
			- ascunse (contine una din cele 3 culori insa utilizatorul nu o va vedea)

Deplasare: 	Fiecare jucator are zarul lui propriu pe care il va arunca ori de cate ori
			doreste sa se deplaseze. Zarul va avea un colddown de 45s.
			Deplasarea se face numai pe drum in limita zarului. Jucatorii nu pot trece unii de altii.

*/

$map_ground = $platform->get_map();
$map_grid   = $platform->get_map();


// Get game id
$game_id = $platform->game->game_id();

// Get player id
$player_id = $platform->game->get_player_id($platform->user->user_id());

// Get a list of players
$players = $platform->get_players();

// Get start/finish pos
$finish_pos = $platform->game->map->get_finish_pos($game_id);
$finishx = $finish_pos[0];
$finishy = $finish_pos[1];

function is_character($posx, $posy) {
	
	global $players;
	
	foreach($players as $p_id => $p) {
		
		if($p[1] == $posx && $p[2] == $posy) {
			return $p_id;
		}
	}
	return 0;
	
}
?>
<script>
// About current player (me) -------------
var player_id = <?php echo $player_id;?>;
var me_key_in_players;// is auto update
var me_posx;// is auto update
var me_posy;// is auto update
var me_vision;// is auto update
var dice_val = 0;
var move_cells = new Array();
var calc_move = true;
//var vision_last_cell = new Array();
var vision_changed = true;
var center_changed = true;
var me_finished = true;


// Abount game ---------------------------
var game_id = <?php echo $game_id;?>;
var finishx = <?php echo $finishx;?>;
var finishy = <?php echo $finishy;?>;
var players = new Array();
var players_changes = new Array();
var card = new Array();
card[1] = false;
card[2] = false;


// Load data server about Players in syncron mode
load_data_server(false);
// Initialize me vars
refresh_me();






// About map
var sizes = {
	cell:62,// dimensiune latura celula inainte de izometrie (cand e patrat)
	cell_izo:65.36,// dimensiune latura celula dupa izometrie
	map_deg_right:45,// unghiul de inclinarea al map-ului la dreapta
	map_width:<?php echo count($map_grid[0]); ?>,
	map_height:<?php echo count($map_grid); ?>,
	window_w:$(window).width(),
	window_h:$(window).height(),
	header_h:124,
};
var map_road = new Array();
<?php
	foreach($map_grid as $i1 => $r)
	{
		echo "map_road[$i1]=new Array();\n";
		foreach($r as $i2 => $c)
			echo "map_road[$i1][$i2]=$c;\n";
	}
?>




var spells = new Array();
var spells_i = 0;
var dice_delay = <?php echo delay_normal*1000;?>;// miliseconds

var intro_card_delay = false;




$(document).ready(function(e) {

	map_init('map');
	
	// Actionarea zarului
	listener_dice_action();
	
	var game_refresh = setInterval(function () {
		
		// load data from server in asyncron mode
		load_data_server(true);
		
		// Update me infos
		refresh_me();
		
		// refresh spells
		refresh_spells();
		
		// Actualizeaza harta
		refresh_map();
		
		// Refresh finished lobby
		if(me_finished) {
			refresh_finish_lobby();
		}
	},1000);
	
	// Deplasare caracter
	$('#map > ul > li').on('click', '.cell.holder', function(){
		// Preluam coordonatele
		var str_id = $(this).parent().attr('id');
		var rx = /^y([0-9]+)x([0-9]+)$/gm;
		var coords = rx.exec(str_id);
		var cposx = coords[2];
		var cposy = coords[1];
		
		// Check finish pos
		if(cposx == finishx && cposy == finishy) {
			// save finish (ajax)
			var ok = save_finish(player_id, cposx, cposy);

			if(ok) {
				// redirect to finish page
				window.location.replace("./index.php?page=won");
			}
		}
		
		// Deplasam jucatorul la pozitia ceruta
		// Note: prin ajax catre server
		saved = move_character(me_key_in_players, me_posx, me_posy, cposx, cposy);
		
		// If was not saved
		if(saved == false) {
			return false;	
		}
		
		// reset all
		reset_dice(player_id, dice_delay);
	});
	
	
	// Navigator
	$('#MapNavigator ul li.left').click(function(){
		$('#map').animate({left:'-=50px'},300);
	});
	$('#MapNavigator ul li.right').click(function(){
		$('#map').animate({left:'+=50px'},300);
	});
	$('#MapNavigator ul li.up').click(function(){
		$('#map').animate({top:'-=50px'},300);
	});
	$('#MapNavigator ul li.down').click(function(){
		$('#map').animate({top:'+=50px'},300);
	});
});



$(document).ready(function(e) {
    //show_card();
	//setTimeout(function(){show_card();}, 1000);
	
});

</script>
<style>
<?php
foreach($players as $p_id => $p) {
	echo "#map > ul > li > .inside > .character.ch$p_id {background-image:url(images/$p[3]);}\n";
}
?>
</style>