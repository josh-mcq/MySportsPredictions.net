<?php
?>
<html>
<head>
  <link rel="stylesheet" type="text/css" href="mystyle.css">
</head>

<!--*** FORM FOR MANUALLY ADDING MORE GAMES ***-->
<form action = "?" method = "post">
  <label for="game_date">Game Date</label>                   
  <input type = "date" name = "game_date">
  <label for="game_time">Start Time</label>
  <input type = "time" name = "game_time">
  <label for="home_key">Home Team</label>                    
  <select name = "home_key">
    <option value = 'boston-celtics'>Boston Celtics</option>
	<option value = 'new-jersey-nets'>New Jersey Nets</option>
	<option value = 'new-york-knicks'>New York Knicks</option>
	<option value = 'philadelphia-76ers'>Philadelphia 76ers</option>
	<option value = 'toronto-raptors'>Toronto Raptors</option>
	<option value = 'chicago-bulls'>Chicago Bulls</option>
	<option value = 'cleveland-cavaliers'>Cleveland Cavaliers</option>
	<option value = 'detroit-pistons'>Detroit Pistons</option>
	<option value = 'indiana-pacers'>Indiana Pacers</option>
	<option value = 'milwaukee-bucks'>Milwaukee Bucks</option>
	<option value = 'atlanta-hawks'>Atlanta Hawks</option>
	<option value = 'charlotte-bobcats'>Charlotte Bobcats</option>
	<option value = 'miami-heat'>Miami Heat</option>
	<option value = 'orlando-magic'>Orlando Magic</option>
	<option value = 'washington-wizards'>Washington Wizards</option>
	<option value = 'golden-state-warriors'>Golden State Warriors</option>
	<option value = 'los-angeles-clippers'>Los Angeles Clippers</option>
	<option value = 'los-angeles-lakers'>Los Angeles Lakers</option>
	<option value = 'phoenix-suns'>Phoenix Suns</option>
	<option value = 'sacrament-kings'>Sacramento Kings</option>
	<option value = 'dallas-mavericks'>Dallas Mavericks</option>
	<option value = 'houston-rockets'>Houston Rockets</option>
	<option value = 'memphis-grizzlies'>Memphis Grizzlies</option>
	<option value = 'new-orleans-pelicans'>New Orleans Pelicans</option>
	<option value = 'san-antonio-spurs'>San Antonio Spurs</option>
	<option value = 'denver-nuggets'>Denver Nuggets</option>
	<option value = 'minnesota-timberwolves'>Minnesota Timberwolves</option>
	<option value = 'oklahoma-city-thunder'>Oklahoma City Thunder</option>
	<option value = 'portland-trail-blazers'>Portland Trail Blazers  </option>
	<option value = 'utah-jazz'>Utah Jazz</option>
  </select
>
  <label for="away_key">Away Team</label>
  <select name = "away_key">
      <option value = 'boston-celtics'>Boston Celtics</option>
	<option value = 'new-jersey-nets'>New Jersey Nets</option>
	<option value = 'new-york-knicks'>New York Knicks</option>
	<option value = 'philadelphia-76ers'>Philadelphia 76ers</option>
	<option value = 'toronto-raptors'>Toronto Raptors</option>
	<option value = 'chicago-bulls'>Chicago Bulls</option>
	<option value = 'cleveland-cavaliers'>Cleveland Cavaliers</option>
	<option value = 'detroit-pistons'>Detroit Pistons</option>
	<option value = 'indiana-pacers'>Indiana Pacers</option>
	<option value = 'milwaukee-bucks'>Milwaukee Bucks</option>
	<option value = 'atlanta-hawks'>Atlanta Hawks</option>
	<option value = 'charlotte-bobcats'>Charlotte Bobcats</option>
	<option value = 'miami-heat'>Miami Heat</option>
	<option value = 'orlando-magic'>Orlando Magic</option>
	<option value = 'washington-wizards'>Washington Wizards</option>
	<option value = 'golden-state-warriors'>Golden State Warriors</option>
	<option value = 'los-angeles-clippers'>Los Angeles Clippers</option>
	<option value = 'los-angeles-lakers'>Los Angeles Lakers</option>
	<option value = 'phoenix-suns'>Phoenix Suns</option>
	<option value = 'sacrament-kings'>Sacramento Kings</option>
	<option value = 'dallas-mavericks'>Dallas Mavericks</option>
	<option value = 'houston-rockets'>Houston Rockets</option>
	<option value = 'memphis-grizzlies'>Memphis Grizzlies</option>
	<option value = 'new-orleans-pelicans'>New Orleans Pelicans</option>
	<option value = 'san-antonio-spurs'>San Antonio Spurs</option>
	<option value = 'denver-nuggets'>Denver Nuggets</option>
	<option value = 'minnesota-timberwolves'>Minnesota Timberwolves</option>
	<option value = 'oklahoma-city-thunder'>Oklahoma City Thunder</option>
	<option value = 'portland-trail-blazers'>Portland Trail Blazers  </option>
	<option value = 'utah-jazz'>Utah Jazz</option>
  </select>
  <input type = "submit" name = "match_entry" value="submit">
</form>

<!-- ***FORM TO DELETE MATCHES*** -->
<form action = "?" method = "post">

  <?php foreach($arrays as $array) {?>
  <input type="checkbox" name="deleted_match[]" value="<?php echo $array['path']['key'];?>"><?php echo $array['path']['key'];?><br />
  <?php }?>
  <input type="submit" name="delete" value="delete_matches">
</form>
<br />

<!-- ***FORM TO DELETE PREDICTIONS*** 
<form action = "?" method = "post">
   <?php foreach($p_arrays as $p_array) {?>
  <input type="checkbox" name="deleted_prediction[]" value="<?php echo $p_array['path']['key'];?>"><?php echo $p_array['path']['key'];?><br />
  <?php }?>
  <input type="submit" name="delete_prediction" value="delete_predictions">
</form>
<br />-->

   
<!-- ***FORM TO MANUALLY INPUT FINAL SCORES *** -->

<form action = "?" method = "post">
  <?php foreach($arrays as $arrayb) { ?>

   <?php echo $arrayb['path']['key']; ?>
    <br />
  <label for="away_score">Home Team Score</label>
    <?php printf('<select name = "home_score[]">'); ?> 
	  <?php $array = array(); $array[0] = "Pick Score"; for($i=60; $i<=150; $i++){$array[] = $i;}?> <?php foreach($array as $j) { //creating the option list?><option value = "<?php echo $j; ?>"><?php echo $j;} ?></option>
	</select>
    <br/>
    <label for="away_score">Away Team Score</label>
    <?php printf('<select name = "away_score[]">'); ?> 
      <?php $array = array(); $array[0] = "Pick Score";for($i=60; $i<=150; $i++){$array[] = $i;}?><?php foreach($array as $j) { //creating the option list?><option value = "<?php echo $j; ?>"><?php echo $j;} ?></option>
    </select><br/>
   <input type = "hidden" name="key[]" value="<?php echo $arrayb['path']['key']; ?>">
    <input type = "hidden" name="timestamp[]" value="<?php echo $arrayb['value']['timestamp']; ?>">
  <?php } ?>
  
  <input type = "submit" name = "final_scores">
</form>

<!-- ***FORM TO AUTO ADD MATCHES VIA XMLSTATS API*** -->
<form action = "?" method = "post">
  <label for = "api_match_entry">AutoLoad Games</label>
  <select name = "offset">
    <option value=-1>-1</option>
    <option value =0>0</option>
    <option value=1>1</option>	
    <option value=2>2</option>
	<option value=3>3</option>
	<option value=4>4</option>
	<option value=5>5</option>
	<option value=6>6</option>

  </select>
  <input type = "submit" name = "api_match_entry">
</form>
</html>	

<!-- ***FORM TO AUTO ADD FINAL SCORES VIA XMLSTATS API*** -->
<form action = "?" method = "post">
  <label for = "api_final_scores">AutoLoad Final Scores</label>
  <select name = "score-offset">
  <option value=-3>-3</option>
    <option value=-2>-2</option>
	<option value=-1>-1</option>
    <option value =0>0</option>
    <option value=1>1</option>	

  </select>
    <input type = "submit" name = "api_final_scores">
</form>
<form action = "?" method = "post">
 <input name="byejoe" type = "text">
 <input type="submit" value="delete user">
 </form>

</html>	




















