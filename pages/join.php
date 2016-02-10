<div id="login_page">
	<div class="inside">
    	<form class="box" method="post" action="./?page=lobby_host" onsubmit="return false;">
        	<header>
                <h1>THE FAMILY MAZE</h1>
            </header>
            <section class="code-box">
            	<div class="label">Enter the code game:</div>
                <div class="code"><input id="field-code" type="text" name="code" autocomplete="off" autofocus="autofocus" /></div>
            </section>
            <br />
            <nav>
                <ul>
                    <li><button id="bt-join" name="join" class="join_button" disabled="disabled"> </button></li>
                    <li class="cancel-box"><a href="./" class="cancel_button" title="">Back to main menu</a></li>
                </ul>
            </nav>
            <footer>
            <!--Creat de <a href="http://adry.ro">adry.ro</a>-->
            </footer>
        </form>
        <script>
		$('#field-code').keyup(function(){
			if($(this).val().length > 0)
			{
				$('#bt-join').attr('disabled', false);
			}
			else
			{
				$('#bt-join').attr('disabled', true);
			}
		});
		
		$('#bt-join').click(function(){
			var code = $('#field-code').val();
			$.post( "ajax/valid_join.php?code="+code, function( game_id ) {
				// redirect to join lobby with game_id
				if(game_id > 0)
					window.location.replace("./?page=lobby_join&game_id="+game_id);
				else
					alert('Incorect code!');
			});
		});
		</script>
    </div>
</div>