<?php
include 'match.class.php';  
  $matches = $_POST;
  foreach($matches as $match)
   {
      $game_date = 'date';
      $home_key = 'homekey';
      $away_key = 'awaykey';
      $home_score = $match[];
     // $away_score = $match->away_score;
     // echo $xxx = new Match($game_date, $home_key, $away_key, $home_score, $away_score);
	//  echo $match['home_score'][1];
	  //$xxx->storeMatch;	 
	  // echo '<a href="http://www.mysportspredictions.net/admin.php">Back</a>';
   echo $home_score;
   echo '<br />';
   }
?>