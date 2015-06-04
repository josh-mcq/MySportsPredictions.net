<?php

//this is the admin page called admin.php.
function __autoload($classname) {
include strtolower($classname) . '.class.php';
}
include 'config.php';
// handle adding new games
if(!empty($_POST['match_entry']))
 {
  $date = $_POST['game_date'];
  $game_time = $_POST['game_time'];
  $timestamp = 3600+strtotime($date . $game_time);
  
  $newMatch = new Match($_POST['game_date'], $_POST['home_key'], $_POST['away_key'], 'NULL', 'NULL', $timestamp);
  $newMatch->storeMatch();
  echo '<a href="http://www.mysportspredictions.net/admin.php">Back</a>';
 }
 
 
 // handle adding new games via XMLSTATS API
if(!empty($_POST['api_match_entry']))
{
  $days = $_POST['offset'];
  $ary = Match::autoStoreGames($days);
  var_dump($ary);
}
 
  //  ***handle game deletes*** 
elseif($_POST['delete'])
 {
  //$res =  Match::deleteMatch($_POST['deleted_match']);
  $dms = $_POST['deleted_match'];
  foreach($dms as $dm)
  {
    Match::deleteMatch($dm);
    echo '<a href="http://www.mysportspredictions.net/admin.php">Back</a>';
  }
}
 
 //   ***handles delete predictions***
elseif($_POST['delete_prediction'])
{
  $dps = $_POST['deleted_prediction'];
  foreach($dps as $dp)
  {
    Prediction::deletePrediction($dp);
    echo '<a href="http://www.mysportspredictions.net/admin.php">Back</a>';
  }

}
elseif($_POST['byejoe'])
{
  ///put in the delete user function here
  User::deleteUser($_POST['byejoe']);
  
} 
//  ***handle final score inputs*** 

elseif($_POST['final_scores'])
{ 
  array_pop($_POST); //to get rid of submit button input...
  $matches = Match::flipdiagonally($_POST);
  $hello = 'hello';//stuff goes here
  foreach($matches as $match) {
    $str = $match["key"];
    $matcharray = explode("-at-",$str);
    $match["game_date"] = explode("-", $str)[0];
    $match["home_key"] = array_pop($matcharray);
    $match["away_key"] = join("-", array_slice(explode("-", $matcharray[0]), 1));
    
    if($match["home_score"] != "Pick Score")
      {
        $match_object = new Match($match["game_date"],$match["home_key"],$match["away_key"],$match["home_score"],$match["away_score"], $match["timestamp"]);
        $match_object->storeMatch(); 
        Prediction::awardPoints($match_object);
      }
  }
} 

//  ***handle AUTO final score inputs*** 

elseif($_POST['api_final_scores'])
{ 
  $dias = $_POST['score-offset'];
  $unscored_matches_json = Prediction::getUnscoredMatches($dias);
  
  $unscored_matches = json_decode($unscored_matches_json, 1);
   $t_i = 0;
   foreach($unscored_matches['results'] as $match) 
  {
    
    $outcome = Prediction::getMatchOutcome($match['path']['key']);
//	var_dump($match);
if(empty($outcome["home_score"]))
	{
	  $outcome["home_score"]="NULL";
      $outcome["away_score"]="NULL";
	}  
	$match_object = new Match($match['value']["game_date"],$match['value']["home_key"],$match['value']["away_key"],$outcome["home_score"],$outcome["away_score"],$match['value']['timestamp']+$t_i);
    $match_object->storeMatch() . "<br/>"; 
	Prediction::awardPoints($match_object);
	$t_i++;
	
	
  }
}  
//   ***Include the admin page called match_entry.html.php(change?)*** 
else
 {
   
   $gamesJson = Match::getMatchesQuery("*","100","0");
   $bigArray = json_decode($gamesJson, 1);
   $arrays = $bigArray['results'];
   //$predictionsJson = Prediction::getAllPredictions();
   $predictionsJson = Prediction::getPredictionsQuery("*",20,0);
   $predArray = json_decode($predictionsJson, 1);
   $p_arrays = $predArray['results'];
   include 'match_entry.html.php';
   //include 'echo.php';
   }
?>