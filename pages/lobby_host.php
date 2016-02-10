<div id="login_page">
	<div class="inside">
    	<form class="box" method="post" action="./?page=play">
        	<header>
                <h1>THE FAMILY MAZE</h1>
            </header>
            <section class="code-box">
            	<div class="label">Send this code to you friends:</div>
                <div class="code"><?php echo $platform->game->game_id().'-'.$platform->game->game_pass();?></div>
            </section>
            <section class="lobby-box">
            	<div id="lobby-team1" class="team1">
                	<!-- Ajax content -->
                </div>
                <div class="sep"></div>
                <div id="lobby-team2" class="team2">
                	<!-- Ajax content -->
                </div>
            </section>
            <nav>
                <ul>
                    <li><button name="start" class="start_button"> </button></li>
                    <!--<li class="cancel-box"><a href="./" class="cancel_button" title="">Cancel game</a></li>-->
                </ul>
            </nav>
            <footer>
            <!--Creat de <a href="http://adry.ro">adry.ro</a>-->
            </footer>
        </form>
        <script>
		var game_id = <?php echo $platform->game->game_id();?>;
		
		function refresh_lobby()
		{
			$.post( "ajax/lobby.php?game_id="+game_id+"&team=1&host=1", function( data ) {
				$('#lobby-team1').html( data );
			});
			
			$.post( "ajax/lobby.php?game_id="+game_id+"&team=2&host=1", function( data ) {
				$('#lobby-team2').html( data );
			});
		}
		
		function sel_team(user_id)
		{
			var new_team = $('#sel-team-user-'+user_id).val();
			
			$.post( "ajax/lobby_change_team.php?game_id="+game_id+"&user_id="+user_id+"&team="+new_team, function( data ) {
				refresh_lobby();
			});
		}
		
		// init lobby
		refresh_lobby();
		</script>
    </div>
</div>