<?php
session_start();
include('config.php');


// Required library
require_once('libraries/Platform.php');

// parsare url
define('ROOT', 'http://adry.ro/');
define('page', isset($_GET['page'])?$_GET['page']:'index');

// Init the platform instance
$platform = new Platform();

// Loghin at guest
$platform->user->guest();


// Mobile --------------------------
$platform->config['view_cards'] = 1;
$platform->config['view_teams'] = 3;
// ---------------------------------

// verificare pagina
if(!in_array(page, array('index','lobby','join','lobby_join','lobby_host','play','won','loss'))) {
	
	die("Aceasta pagina nu exista!");
	
}


if(!$platform->user->logged()) {
	
	die("Nu s-a putut face logarea ca guest!");
	
}
else {
	
	if(page == 'lobby') {
	
		if(isset($_POST['host'])) {
		
			// creem jocul
			$platform->game->host();
			
			if($platform->game->game_id() == 0) {
				die("Jocul nu s-a putut creea!");
			}
			
			// adauga hostul pe prima pozitie libera de player
			$platform->game->add_player($platform->user->user_id());
			
			// salvam datele despre utilizator
			$name = isset($_POST['name']) ? $_POST['name'] : '';
			$count = null;
			$name = preg_replace('/[^A-Za-z0-9\\._]+/', '', $name, -1, $count);
			$character = isset($_POST['character']) ? (int)$_POST['character'] : 0;
			
			$platform->user->save_player($platform->game->game_id(), $name, $character);
			
			if($platform->user->user_name() == '') {
				die("Jucatorul nu s-a putut salva!");
			}
			
			// lobby
			header("Location: ./?page=lobby_host");
			die();
		}
		
		if(isset($_POST['join']))
		{
			// salvam datele despre utilizator
			$name = isset($_POST['name']) ? $_POST['name'] : '';
			$count = null;
			$name = preg_replace('/[^A-Za-z0-9\\._]+/', '', $name, -1, $count);
			$character = isset($_POST['character']) ? (int)$_POST['character'] : 0;
			
			$platform->user->save_player_in_sess($name, $character);
			
			// lobby
			header("Location: ./?page=join");
			die();
		}
	}
	else if(page == 'lobby_host') {
		
		// lobby
		define('controller', 'lobby_host');
		
	}
	else if(page == 'join') {
		
		// lobby
		define('controller', 'join');
		
	}
	else if(page == 'lobby_join') {
		
		$game_id = (int)$_GET['game_id'];
		
		$platform->game->join($game_id);
		
		if($platform->game->game_id() == 0) {
			die("Nu s-a putut conecta la joc!");
		}
		
		// salveaza datele despre user in baza de date
		$platform->user->save_player($platform->game->game_id(), $platform->user->user_name(), $platform->user->user_character());
		
		// adauga jucatorul pe o pozitie libera de player
		$platform->game->add_player($platform->user->user_id());
			
		// lobby
		define('controller', 'lobby_join');
		
	}
	else if(page == 'play') {
		
		// If game is not created
		if($platform->game->game_id() == 0) {
			header("Location: ./");
			die();
		}
		
		if(isset($_POST['start'])) {
			$platform->game->start();
		}
		
		// hostare sau join to game
		define('controller', 'play');
		
	}
	else if(page == 'won') {
		
		// If game is not created
		if($platform->game->game_id() == 0) {
			header("Location: ./");
			die();
		}
		
		//if(isset($_POST['start'])) {
		//	$platform->game->start();
		//}
		
		// hostare sau join to game
		define('controller', 'won');
		
	}
	else if(page == 'loss') {
		
		// If game is not created
		if($platform->game->game_id() == 0) {
			header("Location: ./");
			die();
		}
		
		//if(isset($_POST['start'])) {
		//	$platform->game->start();
		//}
		
		// hostare sau join to game
		define('controller', 'loss');
		
	}
	else {
		
		// reset session
		$_SESSION['game_id'] = 0;
		
		// hostare sau join to game
		define('controller', 'main_game');
		
	}
	
}
?><!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>The Family Maze</title>
<link href="css/reset.css" rel="stylesheet" />
<link href="css/style.css" rel="stylesheet" />
<script src="js/jquery-1.11.2.min.js"></script>
<script src="js/keydrown.min.js"></script>
<script src="js/general.js"></script>
<?php
switch(controller)
{
	case 'play':
	case 'won':
	case 'loss': include('heads/play.php'); break;
}
?>
</head>

<body>
    <?php
	switch(controller)
	{
		case 'auth': include('pages/auth.php'); break;
		case 'main_game': include('pages/main_game.php'); break;
		case 'host': include('pages/host.php'); break;
		case 'lobby_host': include('pages/lobby_host.php'); break;
		case 'join': include('pages/join.php'); break;
		case 'lobby_join': include('pages/lobby_join.php'); break;
		case 'rooms': include('pages/rooms.php'); break;
		case 'play':
		case 'won':
		case 'loss': include('pages/play.php'); break;
		case 'loss': include('pages/loss.php'); break;
	}
	?>
</body>
</html>