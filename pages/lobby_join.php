<div id="login_page">
	<div class="inside">
    	<form class="box" method="post" action="./?page=lobby_host">
        	<header>
                <h1>THE FAMILY MAZE</h1>
            </header>
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
			$.post( "ajax/get_started.php?game_id="+game_id, function( started ) {
				if(started == '1')
					window.location.replace("./?page=play");
			});
			
			$.post( "ajax/lobby.php?game_id="+game_id+"&team=1&host=0", function( data ) {
				$('#lobby-team1').html( data );
			});
			
			$.post( "ajax/lobby.php?game_id="+game_id+"&team=2&host=0", function( data ) {
				$('#lobby-team2').html( data );
			});
			
			
		}
		
		// init lobby
		refresh_lobby();
		
		setInterval(refresh_lobby, 1000);
		</script>
    </div>
</div>