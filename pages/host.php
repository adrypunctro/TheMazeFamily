<div id="login_page">
	<div class="inside">
    	<form class="box" method="post" action="./?page=lobby_host">
        	<input id="hidden_ch" type="hidden" name="character" value="1" />
        	<header>
                <h1>THE FAMILY MAZE</h1>
            </header>
            <section class="room">
            
                <div class="player-face">
                	<div class="arr-left"><span>&nbsp;</span></div>
                    <div id="face-ch" class="face ch1"></div>
                    <div class="arr-right"><span>&nbsp;</span></div>
                </div>
                <div class="player-name">
                    <div class="label">Enter name:</div>
                    <div class="name"><input id="field-name" type="text" name="name" autofocus="autofocus" autocomplete="off" /></div>
                </div>
                
            </section>
            <nav>
                <ul>
                    <li><button id="bt-host" name="host" class="host_button" disabled="disabled"> </button></li>
                    <li><a href="./" class="cancel_button" title="">Cancel</a></li>
                </ul>
            </nav>
            <footer>
            <!--Creat de <a href="http://adry.ro">adry.ro</a>-->
            </footer>
        </form>
        <script>
		var cur_ch = 1;
		var min_ch = 1;
		var max_ch = 2;
		
		$('.arr-left > span').on('click', function(){
			var old_ch = cur_ch;
			if(cur_ch > min_ch)
			{
				cur_ch--;
				$('#hidden_ch').val(cur_ch);
				$('#face-ch').removeClass('ch'+old_ch);
				$('#face-ch').addClass('ch'+cur_ch);
			}
		});
		$('.arr-right > span').on('click', function(){
			var old_ch = cur_ch;
			if(cur_ch < max_ch)
			{
				cur_ch++;
				$('#hidden_ch').val(cur_ch);
				$('#face-ch').removeClass('ch'+old_ch);
				$('#face-ch').addClass('ch'+cur_ch);
			}
		});
		
		
		$('#field-name').keyup(function(){
			if($(this).val().length > 0)
			{
				$('#bt-host').attr('disabled', false);
			}
			else
			{
				$('#bt-host').attr('disabled', true);
			}
		});
		</script>
    </div>
</div>