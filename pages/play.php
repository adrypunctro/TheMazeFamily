<div id="play_page">
    <header>
        <ul class="players">
        	<?php
			$players_db = ModelDB::get_players($platform->game->game_id());
			$teams = array();
			foreach($players_db as $row) {
				$teams[$row['team']][] = $row;
			}
			
			foreach($teams as $team => $users):
			?>
        	<li class="">
            	<ul class="profiles">
                	<!--<div class="mask slow"></div>-->
                    <?php foreach($users as $user): ?>
            		<li><div class="img ch<?php echo $user['ch_id'];?>"></div></li>
                    <?php endforeach; ?>
                    <?php
					if(count($users) <= 1) {
                    	echo '<li><div class="img ch"></div></li>';
					}
					?>
				</ul>
                <ul id="spells-player-<?php echo $user['player_id'];?>" class="spells">
                	<!-- Ajax content -->
                    
                	<!--<li class="slow"><span class="icon"></span><span class="time">25s</span></li>
                    <li class="medical"><span class="icon"></span><span class="time">45s</span></li>
                    <li class="delay"><span class="icon"></span><span class="time">25s</span></li>
                    <li class="slow"><span class="icon"></span><span class="time">25s</span></li>-->
                </ul>
            </li>
            <?php endforeach; ?>
        </ul>
    </header>
    <div class="cards">
        <ul>
            <li id="card-1">
            	<!-- Ajax content -->
            	<h1>Slow</h1><div class="img snail"><div class="inside"></div></div><p class="desc">Bla Bla Bla</p>
            </li>
            <li id="card-2">
            	<!-- Ajax content -->
            </li>
        </ul>
    </div>
    <div id="MapNavigator">
        <ul>
            <li class="up"></li>
            <li class="right"></li>
            <li class="down"></li>
            <li class="left"></li>
        </ul>
    </div>
    <div id="front-mask" class="<?php echo (controller=='won'||controller=='loss')?'show':'';?>">
    	<div class="lobby">
        	<h1>End of game</h1>
            <h2>It finished</h2>
            <ul id="finished-players" class="profiles">
				<!-- Ajax content -->
            </ul>
            <br />
            <h2>It is in game</h2>
            <ul id="unfinished-players" class="profiles">
            	<!-- Ajax content -->
            </ul>
            <br /><br />
            <div class="cancel-box">
            	<a href="./" class="cancel_button2">Exit game</a>
            </div>
        </div>
    </div>
    <section id="map">
    	<?php foreach($map_grid as $y => $r): ?>
        <ul id="<?php echo 'y'.$y;?>">
        <?php foreach($r as $x => $c):?>
            <?php
            $p_id = is_character($x,$y);
            $type = (int)$c;
            $subtype = $c*10-($type*10);
            
			// check finish
			$is_finish_pos = ($x == $finishx && $y == $finishy);
			
            $ground = $map_ground[$y][$x];
            switch((int)$ground)
            {
                default:
                case 0: $texture = 'none'; break;// no road
                case 1: $texture = 'concrete'; break;// road
                //case 2: $texture = 'start'; break;// start
            }
			
			// override texture
			if($is_finish_pos) {
				$texture = 'finish';
			}
			
            ?>
            <li id="<?php echo 'y'.$y.'x'.$x;?>">
                <div class="cell <?php echo $texture;?>"><?php
				
                switch($type)
                {
                    case 1: echo '<div class="road t'.$subtype.''.(($p_id)?' pressed':'').'"></div>'; break;
                    case 0:
                        switch($subtype) {
							
                            case 2: echo '<div class="sand"></div>'; break;
							
                        }
                        break;
                    break;
                }
                ?></div>
                <div class="inside"><?php
				// Display start position
                //if($type == 2) {
				//	echo '<div id="start-pos" class="start-icon"></div>';
				//}
				
				// Display finish position
                if($is_finish_pos) {
					echo '<div id="finish-pos" class="finish-icon"></div>';
				}
				
				// Caracterul
                if($p_id) {
					
                    echo '<div id="player_'.$p_id.'" class="character ch'.$players[$p_id][3].''.(($p_id != $player_id)?' tooltips':'').'">';
                    if($p_id == $player_id) {
                        echo '<div class="dice"></div>';
					}
                    else {
                        echo '<div class="name">'.$players[$p_id][0].'</div>';
					}
                    echo '</div>';
                }
                
                switch($type)
                {
                    case 0:
                        switch($subtype)
                        {
                            case 1: echo '<div class="trees"></div>'; break;
                        }
                        break;
                }
                ?></div></li>
                <?php endforeach; ?>
		</ul>
		<?php endforeach; ?>
	</section>
</div>