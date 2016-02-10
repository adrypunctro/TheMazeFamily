<?php
include('../config.php');

$conn = new PDO('mysql:host='.DB_SERVER.';dbname='.DB_DB.'', DB_USER, DB_PASS);

$game_id = (int)$_GET['game_id'];
$team = (int)$_GET['team'];
$host = (int)$_GET['host'];
?>
<div class="label">Team <?php echo $team;?></div>
<?php
$sql = "SELECT * FROM ph2_players p, ph2_users u
WHERE p.user_id = u.user_id AND p.game_id = '$game_id' AND p.team = '$team'";
$i=0;
foreach ($conn->query($sql) as $row)
{
	?>
    <div class="player-box">
        <div class="character ch<?php echo $row['ch_id'];?>"></div>
        <div class="info">
            <div class="name"><?php echo $row['fullname'];?></div>
            <?php if($host == 1): ?>
            <div class="team"><select id="sel-team-user-<?php echo $row['user_id'];?>" class="sel_team" onchange="sel_team(<?php echo $row['user_id'];?>)">
            <option value="1"<?php echo 1 == $row['team'] ? ' selected="selected"' : '';?>>Team 1</option>
            <option value="2"<?php echo 2 == $row['team'] ? ' selected="selected"' : '';?>>Team 2</option>
            </select></div>
            <?php else: ?>
            <div class="team-name"><em>Team <?php echo $row['team'];?></em></div>
            <?php endif;?>
        </div>
    </div>
    <?php
	++$i;
}

for($j=$i; $j<0; ++$j)
{
	?>
	<div class="player-box-empty">
        <em>Empty</em>
    </div>
	<?php	
}
?>