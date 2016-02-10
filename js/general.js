var global = this; // in the top-level context, "this" always
                   // refers to the global object


// Map methods -------------------------------------------

function map_init(html_id) {
	//"use strict";
	// ascundem celulele care nu sunt cuprinse in vision si umbrele
	
	if(vision_changed) {
		calc_vision();
	}
	
	// centreaza harta
	if(center_changed) {
		center_map();
	}
	
	// -----------------------------------------------------------------------------------------------
	
	// Dimensiunea celulelor si izometria
	$('#'+html_id+' > ul').each(function(index, element) {
		$(this).css('margin-left', ((index)*-((sizes.cell-2)*0.9166666666666667))+'px');
		$(this).css('height', ((sizes.cell-2)*0.5333333333333333)+'px');
        $(this).children('li').each(function(index, element) {
			// pozitionarea celulei
			$(this).css('width', sizes.cell+'px');
			$(this).css('height', sizes.cell+'px');
            $(this).css('top', (index*(sizes.cell-2)*0.5333333333333333)+'px');//(sizes.cell*0.52) 0,5333333333333333
			$(this).css('left', (index*(sizes.cell-2)*0.9166666666666667)+'px');//(sizes.cell*0.906) 0,9166666666666667
			$(this).children('.cell').css({width:sizes.cell+'px', height:sizes.cell+'px'});
			
			$(this).find('.road').css({width:(sizes.cell-26)+'px', height:(sizes.cell-26)+'px'});
			$(this).find('.sand').css({width:(sizes.cell)+'px', height:(sizes.cell)+'px'});
			$(this).find('.trees').css('height', sizes.cell+'px');
			$(this).find('.character').css('width', (sizes.cell*0.5)+'px');
			$(this).find('.character').css('height', (sizes.cell*1.5)+'px');
			$(this).find('.finish-icon').css('width', (sizes.cell*1.0)+'px');
			$(this).find('.finish-icon').css('height', (sizes.cell*1.0)+'px');
			$(this).find('.start-icon').css('width', (sizes.cell*0.5)+'px');
			$(this).find('.start-icon').css('height', (sizes.cell*0.25)+'px');
        });
    });
}

function cell_holder(posx, posy, cost) {
	//"use strict";
	
	// Avoid other players
	var ok = 1;
	$.each(players, function( p_id, value ) {
		if(value[1] == posx && value[2] == posy && value[8] != 1) {
			ok = 0;
		}
	});
	
	if(ok)
	{
		$('#y'+posy+'x'+posx).children('.cell').addClass('holder');
		$('#y'+posy+'x'+posx).children('.cell').children('.road').addClass('animated dur2 loop flicker');
	}
	
}

function cell_vision(posx, posy, cost) {
	//"use strict";
	
	$('#y'+posy+'x'+posx).css('visibility','visible');
	
}

function cell_vision_shadows(posx, posy, cost) {
	//"use strict";
	
	if(cost == me_vision) {
		
		var cell_obj = $('#y'+posy+'x'+posx).children('.cell');
		if($('#y'+(posy+1)+'x'+(posx)).children('.cell').children('.road').length &&
		   $('#y'+(posy+1)+'x'+(posx)).children('.cell').children('.road').css('visibility') == 'hidden') {
			cell_obj.append( '<div class="shadow down"></div>' );
		}
		
		if($('#y'+(posy-1)+'x'+(posx)).children('.cell').children('.road').length &&
		   $('#y'+(posy-1)+'x'+(posx)).children('.cell').children('.road').css('visibility') == 'hidden') {
			cell_obj.append( '<div class="shadow up"></div>' );
		}
			
		if($('#y'+(posy)+'x'+(posx+1)).children('.cell').children('.road').length &&
		   $('#y'+(posy)+'x'+(posx+1)).children('.cell').children('.road').css('visibility') == 'hidden') {
			cell_obj.append( '<div class="shadow right"></div>' );
		}
			
		if($('#y'+(posy)+'x'+(posx-1)).children('.cell').children('.road').length &&
		   $('#y'+(posy)+'x'+(posx-1)).children('.cell').children('.road').css('visibility') == 'hidden') {
			cell_obj.append( '<div class="shadow left"></div>' );
		}
	}
}


function calc_vision() {
	//"use strict";
	
	var hide = true;
	var vision_range = new Array();

	move_ways(me_posx, me_posy, me_vision, map_road, vision_range);
	// adaugam pozitia lui
	var i_temp = vision_range.length;
	vision_range[i_temp] = new Array();
	vision_range[i_temp][0] = me_posx;
	vision_range[i_temp][1] = me_posy;
	vision_range[i_temp][2] = 0;
	
	// Reset all cells and object with them
	$('#map > ul > li').css('visibility','hidden');
	$('.cell > .shadow').remove();
	
	
	// Show posibile way
	for(i=0;i<vision_range.length; ++i) {
		cell_vision(vision_range[i][0], vision_range[i][1], vision_range[i][2]);
	}
	
	// Show shadows
	for(i=0;i<vision_range.length; ++i) {
		cell_vision_shadows(vision_range[i][0], vision_range[i][1], vision_range[i][2]);
	}
	
	// Show characters
	
	
	
	vision_changed = false;
	
}

function refresh_map() {
	//"use strict";
	//alert(players_changes.length);
	for(i=0;i<players_changes.length; ++i) {
		
		var p_key	 = players_changes[i][0];
		var p_id	 = players_changes[i][1];
		var old_posx = players_changes[i][2];
		var old_posy = players_changes[i][3];
		var new_posx = players_changes[i][4];
		var new_posy = players_changes[i][5];
		
		// Change position
		move_character(p_key, old_posx, old_posy, new_posx, new_posy);
	}
	
	// Reset changes
	players_changes = new Array();
	
	
	// recalculeaza centrul
	if(center_changed) {
		center_map();
	}
	
	// recalculeaza visionul
	if(vision_changed) {
		calc_vision();
	}
}




// Game methods -----------------------------------------

function load_data_server(async) {
	//"use strict";
	
	$.ajax({
         url:     "ajax/load_data_server.php?",
         success: function(result_json) {

					var obj = jQuery.parseJSON(result_json);
					
					var old_players = players.slice();
					
					// Update Players Array
					players = new Array();
					
					var i = 0;
					var j = 0;
					var changes_i = players_changes.length;
					
					// Put intro array
					while(obj[i] !== undefined) {
						
						// update key for current player
						if(obj[i].player_id == player_id) {
							me_key_in_players = i;
						}
						
						players[i] = new Array();
						players[i][0] =  obj[i].player_id;
						players[i][1] =  obj[i].posx;
						players[i][2] =  obj[i].posy;
						players[i][3] =  obj[i].image;
						players[i][4] =  obj[i].vision;
						players[i][5] =  obj[i].team;
						players[i][6] =  obj[i].fullname;
						players[i][7] =  obj[i].ch_id;
						players[i][8] =  obj[i].finished;
						players[i][9] = new Array();
						
						if(old_players.length > 0) {
							
							// If position is changed
							if(players[i][1] !== old_players[i][1] || players[i][2] !== old_players[i][2]) {
								players_changes[changes_i] = new Array();
								players_changes[changes_i][0] = i;// player_key
								players_changes[changes_i][1] = players[i][0];// player_id
								players_changes[changes_i][2] = old_players[i][1];// old_posx
								players_changes[changes_i][3] = old_players[i][2];// old_posy
								players_changes[changes_i][4] = players[i][1];// posx
								players_changes[changes_i][5] = players[i][2];// posy
								++changes_i;
							}
							
						}
						
						
						j = 0;
						while(obj[i].spells[j] !== undefined) {
							
							players[i][9][j] = new Array();
							players[i][9][j][0] = obj[i].spells[j].spell_id;
							players[i][9][j][1] = obj[i].spells[j].spell_key;
							players[i][9][j][2] = obj[i].spells[j].label;
							players[i][9][j][3] = obj[i].spells[j].description;
							players[i][9][j][4] = obj[i].spells[j].start;
							players[i][9][j][5] = obj[i].spells[j].time;
							players[i][9][j][6] = obj[i].spells[j].left;
							
							++j;
						}
						
						++i;
					}
				  
				  
                  },
         async:   async
    });  
}

function refresh_finish_lobby() {
	
	var finish_i=0;
	var unfinish_i=0;
	
	var finished_html = '';
	var unfinished_html = '';
	
	// Players
	for(i=0; i<players.length; ++i) {
		
		// Finished
		if(players[i][8] == '1') {
			finished_html += '<li class="p-'+(i+1)+'"><div class="img ch'+players[i][7]+'"></div><span class="label">'+players[i][6]+'</span></li>';
			++finish_i;
		}
		else {
			unfinished_html += '<li class="p-'+(i+1)+'"><div class="img ch'+players[i][7]+'"></div><span class="label">'+players[i][6]+'</span></li>';
			++unfinish_i;
		}
		
	}
	
	// Fill with empty spaces
	for(i=0; i<5-finish_i; ++i) {
		finished_html += '<li class="p-'+(i+1)+'"><div class="img"></div></li>';
	}
		
	for(i=0; i<5-unfinish_i; ++i) {
		unfinished_html += '<li class="p-'+(i+1)+'"><div class="img"></div></li>';
		
	}

	// Write HTML finished players
	if(finished_html != $('#finished-players').html()) {
		$('#finished-players').html(finished_html);
	}
	
	// Write HTML unfinished players
	if(unfinished_html != $('#unfinished-players').html()) {
		$('#unfinished-players').html(unfinished_html);
	}
	
}



// Dice methods ------------------------------------------

function dice_action(obj_dice) {
	//"use strict";
	
	// Animeaza procesul de randomizare (1)
	obj_dice.attr('class', 'dice_anim animated shake');
	
	// Genereaza numarul si afiseaza rezultatul
	var intval_dice1 = setTimeout(function () {
		// Animeaza procesul de randomizare (2)
		obj_dice.attr('class', 'dice_anim animated rotateOut');
		
		var intval_dice2 = setTimeout(function () {
			dice_val = Math.floor((Math.random() * 4) + 1);
			//dice_val = 1;
			obj_dice.attr('class', 'dice_result animated tada');
			obj_dice.html(dice_val);
			
			var intval_dice3 = setTimeout(function () {
				obj_dice.attr('class', 'dice_result animated bounceOut');
			
				// Reafiseaza inapoi zarul
				var intval_dice4 = setTimeout(function () {
					obj_dice.attr('class', 'dice_mini');
					obj_dice.html('x'+dice_val);
				
					// Verifica daca se poate deplasa
					if(calc_move === true) {
						
						// Calcularea posibilitati de mutare
						calc_move = move_ways(me_posx, me_posy, dice_val, map_road, move_cells);
						
						// Afisare posibilitati de mutare
						for(i=0;i<move_cells.length; ++i) {
							
							cell_holder(move_cells[i][0], move_cells[i][1], move_cells[i][2]);
						}
					}
				
					
				},1000);
			},1000);
		},1);
	},1000);
	
}

function reset_dice(p_id, dice_delay) {
	//"use strict";
	
	dice_val = 0;
	move_cells = new Array();
	calc_move = true;
	
	var obj_dice = $('#y'+me_posy+'x'+me_posx).find('.dice_mini');
	var time_per_act = dice_delay/100;

	// start dice delay
	var delay_spell_i = add_spells('dice_delay', dice_delay);
	
	if(intro_card_delay == false) {
		add_card('delay', 15000);
		intro_card_delay = true;
	}
	
	// ----------------------------------------------------------
	// Check for dice_delay
	//alert(players[me_key_in_players][9].length);	
	/*for(k=0; k<players[me_key_in_players][9].length; ++k) {
		//alert(k);
		if(players[me_key_in_players][9][k][1] == 'dice_delay') {
			//alert('da '+k);
		}
	}*/
	
	obj_dice.attr('class', 'dice_delay act1');
	setTimeout(function(){
		obj_dice.attr('class', 'dice_delay act2');
		setTimeout(function(){
			obj_dice.attr('class', 'dice_delay act3');
			setTimeout(function(){
				obj_dice.attr('class', 'dice_delay act4');
				setTimeout(function(){
					obj_dice.attr('class', 'dice_delay act5');
					setTimeout(function(){
						// end delay
						obj_dice.attr('class', 'dice');
					}, time_per_act*15);
					
				}, time_per_act*23);
			
			}, time_per_act*24);
		
		}, time_per_act*23);
	
	}, time_per_act*15);
	// ----------------------------------------------------------
	
	obj_dice.html(' ');
	
	// reset drum
	$('#map > ul > li > .cell.holder').each(function(index, element) {
        $(this).removeClass('holder');
		$(this).children('.road').removeClass('animated dur2 loop flicker');
    });
	
}

function listener_dice_action() {
	//"use strict";
	
	$('.character').on('click', '.dice', function(){
		dice_action($(this));
	});
	
}





// Card methods -------------------------------------------

function add_card(type, time) {
	
	var target = (!card[1]) ? 1 : 2;
	var content = '';
	
	card[target] = true;
	
	
	// set content
	switch(type) {
		case 'delay':
			content = '<h1>Delay</h1><div class="img snail"><div class="inside"></div></div><p class="desc">You need to wait a time until the dice is ready.</p>';
			break;	
	}
	$('#card-'+target).html(content);
	
	$('#card-'+target).animate({top:'-6px'}, 700, function() {
		setTimeout(function() {
			$('#card-'+target).animate({top:'-190px'}, 700, function() {
				card[target] = false;
				$('#card-'+target).html('');
			});
		}, time);
	});
}







// Spells methods -----------------------------------------

function add_spells(spell_key, time) {
	// time is milisec
	
	$.ajax({
         url:     "ajax/add_spell.php?spell_key="+spell_key+"&time="+time,
         success: function(result) {
                      // do nothing
                  },
         async:   true
    });  

}

function refresh_spells() {
	
	var html_spells;
	var sec_left;
	var spell_key;
	var this_player_id;
	
	// Players
	for(i=0; i<players.length; ++i) {
	
		// reset for this player
		html_spells = '';
		sec_left = 0;
		this_player_id = players[i][0];
		
		// Spells
		for(j=0; j<players[i][9].length; ++j) {
			
			spell_key = players[i][9][j][1];
			sec_left  = players[i][9][j][6] / 1000; // convert milisec in seconds
			
			html_spells += '<li class="'+spell_key+'"><span class="icon"></span><span class="time">'+sec_left+'s</span></li>';;
			
		}
		
		$('#spells-player-'+this_player_id).html(html_spells);
	
	}
}






// Player methods -----------------------------------------


function refresh_me() {
	
	/*
		Required globals:
			- me_key_in_players
		
		Sets globals:
			- me_posx
			- me_posy
			- me_finished
			- me_vision
	*/
	
	// Update pos
	me_posx = players[me_key_in_players][1];
	me_posy = players[me_key_in_players][2];
	
	// Update finised flag
	me_finished = players[me_key_in_players][8];
	
	// Update vision
	me_vision = players[me_key_in_players][4];
	
	// Reset dice
	//reset_dice(player_id, dice_delay);
}

function move_ways(posx, posy, steps, map, move_cells) {
	//"use strict";
	
	// calculam costul pentru fiecare pozitie
	// initializare
	var current_start = -1;
	var posib = 0;// nr posibilitati si indexul pentru incrementare
	var way_starts = new Array();
	var ways_cost = new Array();
	var ways_after = new Array();// pozitile prin care a trecut urmand o anumita cale
	var i_after=0;
	var i_move_cells=0;
	
	// introducem pozitia playerului
	current_start = 0;
	way_starts[current_start] = new Array();
	way_starts[current_start][0] = me_posx;// coord x
	way_starts[current_start][1] = me_posy;// coord y
	way_starts[current_start][2] = 0;// start cost
	++posib;
	ways_after[current_start] = new Array();
	
	var cx = way_starts[current_start][0];
	var cy = way_starts[current_start][1];
	var ccost = way_starts[current_start][2];
	var way_continue = false;// va fi true daca exista o cale de continuare
	var way_buffer = [me_posx,me_posy];// tine pozitia curenta
	ways_after[current_start][i_after] = new Array();
	ways_after[current_start][i_after][0] = me_posx;
	ways_after[current_start][i_after][1] = me_posy;
	var i=0;
	var seted_first=false;
	
	while(current_start < posib)
	{
		//alert(cx+','+cy);
		cy=parseInt(cy);
		cx=parseInt(cx);
		
		// verificam vecinii
		if(ccost < steps && cy > 0 && Math.floor(map_road[cy-1][cx]) >= 1 && in_ways_after(cx, cy-1, ways_after[current_start], i_after) == false)// up
		{//alert('Valid la '+(cx)+','+(cy-1)+'\way_continue='+way_continue);
			if(!way_continue)
			{
				way_buffer[0] = cx;
				way_buffer[1] = cy-1;
				way_continue = true;
			}
			else
			{
				way_starts[posib] = new Array();
				way_starts[posib][0] = cx;// coord x
				way_starts[posib][1] = cy-1;// coord y
				way_starts[posib][2] = ccost+1;// start cost
				// last pos
				way_starts[posib][3] = cx;// coord x
				way_starts[posib][4] = cy;// coord y
				++posib;
			}
		}
		if(ccost < steps && cy < (sizes.map_height-1) && Math.floor(map_road[cy+1][cx]) >= 1 && in_ways_after(cx, cy+1, ways_after[current_start], i_after) == false)// down
		{//alert('Valid la '+(cx)+','+(cy+1)+'\way_continue='+way_continue);
			if(!way_continue)
			{
				way_buffer[0] = cx;
				way_buffer[1] = cy+1;
				way_continue = true;
			}
			else
			{
				way_starts[posib] = new Array();
				way_starts[posib][0] = cx;// coord x
				way_starts[posib][1] = cy+1;// coord y
				way_starts[posib][2] = ccost+1;// start cost
				// last pos
				way_starts[posib][3] = cx;// coord x
				way_starts[posib][4] = cy;// coord y
				++posib;
			}
		}
		if(ccost < steps && cx > 0 && Math.floor(map_road[cy][cx-1]) >= 1 && in_ways_after(cx-1, cy, ways_after[current_start], i_after) == false)// left
		{//alert('Valid la '+(cx-1)+','+(cy)+'\way_continue='+way_continue);
			if(!way_continue)
			{
				way_buffer[0] = cx-1;
				way_buffer[1] = cy;
				way_continue = true;
			}
			else
			{
				way_starts[posib] = new Array();
				way_starts[posib][0] = cx-1;// coord x
				way_starts[posib][1] = cy;// coord y
				way_starts[posib][2] = ccost+1;// start cost
				// last pos
				way_starts[posib][3] = cx;// coord x
				way_starts[posib][4] = cy;// coord y
				++posib;
			}
		}
		if(ccost < steps && cx < (sizes.map_width-1) && Math.floor(map_road[cy][cx+1]) >= 1 && in_ways_after(cx+1, cy, ways_after[current_start], i_after) == false)// right
		{//alert('Valid la '+(cx+1)+','+(cy)+'\way_continue='+way_continue);
			if(!way_continue)
			{
				way_buffer[0] = cx+1;
				way_buffer[1] = cy;
				way_continue = true;
			}
			else
			{
				way_starts[posib] = new Array();
				way_starts[posib][0] = cx+1;// coord x
				way_starts[posib][1] = cy;// coord y
				way_starts[posib][2] = ccost+1;// start cost
				// last pos
				way_starts[posib][3] = cx;// coord x
				way_starts[posib][4] = cy;// coord y
				++posib;
			}
		}
		
		// calea s-a terminat 
		if(!way_continue || ccost >= steps)
		{
			// next start
			++current_start;
			if(current_start == posib)// termina ciclul while
				break;
			//alert('next start cu '+way_starts[current_start][0]+','+way_starts[current_start][1]+', cost='+way_starts[current_start][2]);
			i_after=0;
			cx = way_starts[current_start][0];
			cy = way_starts[current_start][1];
			ccost = way_starts[current_start][2];
			way_continue = false;
			ways_after[current_start] = new Array();
			ways_after[current_start][i_after] = new Array();
			ways_after[current_start][i_after][0] = way_starts[current_start][3];
			ways_after[current_start][i_after][1] = way_starts[current_start][4];
			
			
		}
		else
		{//alert('calea continua cu '+way_buffer[0]+','+way_buffer[1]+', cost='+(way_starts[current_start][2]+1));
			// pozitia curenta
			++i_after;
			ways_after[current_start][i_after] = new Array();
			ways_after[current_start][i_after][0] = cx;
			ways_after[current_start][i_after][1] = cy;
			
			// calea continua
			cx = way_buffer[0];
			cy = way_buffer[1];
			ccost = ++way_starts[current_start][2];
			way_continue = false;
			
			if(seted_first==false)
			{
				way_starts[current_start][0] = cx;// coord x
				way_starts[current_start][1] = cy;// coord y
				seted_first=true;
			}
		}
		
		// salvare celula
		move_cells[i_move_cells] = new Array();
		move_cells[i_move_cells][0] = cx;
		move_cells[i_move_cells][1] = cy;
		move_cells[i_move_cells][2] = ccost;
		++i_move_cells;
	}
	/*for(i=0; i<posib; ++i)
	{
		alert('i: '+i+' [x='+way_starts[i][0]+',y='+way_starts[i][1]+',c='+way_starts[i][2]+']');
	}*/
	//alert('end function :::::::::::');
	//alert('++++');
	return false;
}

function move_character(p_key, old_posx, old_posy, new_posx, new_posy) {
	//"use strict";
	
	// Instant Update coords
	if(p_key == me_key_in_players) {
		me_posx = new_posx;
		me_posy = new_posy;
	}
	players[p_key][1] = new_posx;
	players[p_key][2] = new_posy;
	
	
	//var $div_character = $("<div>", {class: "character"+((p_id == player_id)?" tooltips":"")});
	//var $div_dice = $("<div>", {class: "dice"});
	//div_dice.click(dice_action(e));
	
	// Creaza caracterul la noua pozitie
	var div_character = $('#y'+old_posy+'x'+old_posx).find('.inside').html();
	
	// Parse start and finish
	//alert(div_character);
	//div_character = div_character.replace(/<div id="start-pos" class="start-icon" style="(.*)"><\/div>/g, '');
	//div_character = div_character.replace(/<div id="finish-pos" class="finish-icon" style="(.*)"><\/div>/g, '');
	
	// Save ONLY It is me
	if(p_key == me_key_in_players) {
		// Save on server the new pos
		it_is_posible = save_player_pos(new_posx, new_posy);
	
		if(it_is_posible === false) {
			return false;	
		}
	}
	
	// Remove the character from old pos
	$('#y'+old_posy+'x'+old_posx).find('.character').remove();
	
	// If It not finished
	if(players[p_key][8] != 1) {
		
		// Put the character to new pos
		$('#y'+new_posy+'x'+new_posx).find('.inside').append(div_character);
	}
	
	listener_dice_action();
	
	return true;
}

function save_finish(p_id, posx, posy) {
	//"use strict";
	var ret = false;
	
	$.ajax({
         url:     "ajax/save_finish.php?p_id="+p_id+"&posx="+posx+"&posy="+posy,
         success: function(result) {
                      ret = (result == '1');
                  },
         async:   false
    });  
	
	return ret;
}

function save_player_pos(posx, posy) {
	//"use strict";
	
	var successful;
	
	$.ajax({
         url:     "ajax/save_player_pos.php?posx="+posx+"&posy="+posy,
         success: function(result) {
					// Check if it is posibile to move
					successful = (result == 1);
					
					vision_changed = true;
					center_changed = true;
                  },
         async:   false
    });  
	
	return successful;
}

function center_map() {
	//"use strict";
	
	// sizes.cell_izo; // dimensiune celula izometrizata
	// sizes.window_w; // dimensiunea spatiului de lucru
	// players[players_ids_keys[player_id]][1]; // coordonata x a jucatorului
	// players[players_ids_keys[player_id]][2]; // coordonata y a jucatorului
	var Px;// coordonatele jucatorului
	var Py;// coordonatele jucatorului
	var Cx;// coordonatele jucatorului in pixeli relativ de punctul planului map
	var Cy;// coordonatele jucatorului in pixeli relativ de punctul planului map
	var MargLeft;// margin left pentru harta
	var MargTop;// margin top pentru harta
	
	//alert('--- '+me_posx+','+me_posy);
	Px = me_posx;// coordonatele jucatorului
	Py = me_posy;// coordonatele jucatorului
	
	// convert to Float
	Px = parseFloat(Px);
	Py = parseFloat(Py);
	
	// Add an epsilor value for Zero Exception
	Px+=0.01;	
	Py+=0.01;
	
	// coordonatele jucatorului in pixeli relativ de punctul planului map
	Cx = sizes.cell_izo * Math.sqrt(Math.pow(Px, 2)+Math.pow(Py, 2)) * Math.sin(sizes.map_deg_right - Math.atan(Py/Px));
	Cy = sizes.cell_izo * Math.sqrt(Math.pow(Px, 2)+Math.pow(Py, 2)) * Math.cos(sizes.map_deg_right - Math.atan(Py/Px));
	
	MargLeft = sizes.window_w/2-Cx;
	MargTop = (sizes.window_h-sizes.header_h)/2-Cy;
	
	//alert('window_h('+sizes.window_h+') Cy('+Cy+') MargTop('+MargTop+') ');
	//alert('Px('+Px+') Py('+Py+') MargTop('+MargTop+') ');
	
	
	$('#map').css({'margin-top':sizes.header_h+Math.floor(MargTop)+'px', 'margin-left':Math.floor(MargLeft)+'px'});
	
	center_changed = false;
	
}





function in_ways_after(posx, posy, afters, i_ways) {
	//"use strict";
	
	for(i=0; i<=i_ways; ++i) {
		
		if(afters[i][0] == posx && afters[i][1] == posy) {
			return true;
		}
	}
	return false;
}











