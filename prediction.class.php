

 <?php

/**
   * The Prediction class will be instantiated when we need to make a prediction.
   *public function __construct($_game, $_winner, $_margin, $_email)
   *public static function getSport(){
   *public static function getGames()
   *public static function getAllPredictions()
   *public function storePrediction()
   *public function storeMatchPredictionRel()
   *public static function deletePrediction($predKey)
   *public static function awardPoints($match_object)
   *public static function getRightPredictions($match)
   *public static function autoScoreMatches()
 **/
 
class Prediction
{
  public $game;
  public $winner;
  public $margin;
  public $email;
  
      
  public function __construct($_game, $_winner, $_margin, $_email)
  {
    $this->game = $_game;
    $this->winner = $_winner;
    $this->margin = $_margin;
    $this->email = $_email;
  }
   
   
  public static function getAllPredictions() 
  {
    $querystring = "*";
	$url = "https://api.orchestrate.io/v0/predictions/?query=*";
    $ch = curl_init(); 
	curl_setopt($ch, CURLOPT_URL, $url); 
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1); 
	curl_setopt($ch, CURLOPT_USERPWD, API_KEY);
	curl_setopt($ch, CURLOPT_HTTPHEADER, 
	array('Content-Type: application/json','Accept-Language:application/json')); 
	$p_output = curl_exec($ch);
	curl_close($ch);
	return $p_output;
	
  }
  //  ***This will be a generic function to get a prediction object by key
  public static function getPrediction($key)
  {
  
  
  }
  
  //  ***This will be a generic function to get multiple prediction objects by query, using limit and offset parameters
  public static function getPredictionsQuery($query, $limit, $offset)
  {
    $url = "https://api.orchestrate.io/v0/predictions/?query=" . $query . "&limit=" . $limit . "&offset=" . $offset;
    $ch = curl_init(); 
	curl_setopt($ch, CURLOPT_URL, $url); 
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1); 
	curl_setopt($ch, CURLOPT_USERPWD, API_KEY);
	curl_setopt($ch, CURLOPT_HTTPHEADER, 
	array('Content-Type: application/json','Accept-Language:application/json')); 
	$prev_output = curl_exec($ch);
	curl_close($ch);
	return $prev_output;
  
  }
  // for building the URL for getPredictionsQuery
  public static function getUrlForUnsweredPredictions() 
  {
    $email = $_SESSION['email'];
    $yesterday = date('Ymd', mktime(0,0,0,date("m"),date("d")-1,date("Y")));
    $today = date('Ymd');
    $tomorrow = date('Ymd', mktime(0,0,0,date("m"),date("d")+1,date("Y")));
    $in_two_days = date('Ymd', mktime(0,0,0,date("m"),date("d")+2,date("Y")));
    $query = $email . " AND " . "(" .$yesterday . " OR " . $today . " OR " . $tomorrow . " OR " . $in_two_days . ")";
    
    
  return $query;
  }
  
  public function storePrediction() 
  {
    $data = json_encode($this);
    $key = $this->email . '|' . $this->game;
    $url = "https://api.orchestrate.io/v0/predictions/" . urlencode($key);//change
    $ch = curl_init(); 
	  curl_setopt($ch, CURLOPT_URL, $url); 
	  curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "PUT");
    curl_setopt($ch, CURLOPT_POSTFIELDS,($data));
	  curl_setopt($ch, CURLOPT_USERPWD, API_KEY);
  	curl_setopt($ch, CURLOPT_HTTPHEADER, 
	  array('Content-Type: application/json','Accept-Language:application/json')); 
  	$output = curl_exec($ch);
	  curl_close($ch);
  }
	
  public function storeMatchPredictionRel()
  {   
    $game_key = $this->game;
    $pred_key = $this->email . '|' . $this->game;
   	$url = "https://api.orchestrate.io/v0/matches/" . urlencode($game_key) . "/relation/prediction/predictions/" . urlencode($pred_key);
    $ch = curl_init(); 
	curl_setopt($ch, CURLOPT_URL, $url); 
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "PUT");
	curl_setopt($ch, CURLOPT_USERPWD, API_KEY);
  	curl_setopt($ch, CURLOPT_HTTPHEADER, 
	array('Content-Type: application/json','Accept-Language:application/json')); 
	$g_output = curl_exec($ch);
	//$info = curl_getinfo($ch);
	curl_close($ch);
	echo $g_output;
  }

   
  public static function deletePrediction($predKey)   
  {
	$url = "https://api.orchestrate.io/v0/predictions/" . urlencode($predKey);
    $ch = curl_init(); 
	curl_setopt($ch, CURLOPT_URL, $url); 
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "DELETE");
   	curl_setopt($ch, CURLOPT_USERPWD, API_KEY);
    curl_setopt($ch, CURLOPT_HTTPHEADER, 
	array('Content-Type: application/json','Accept-Language:application/json')); 
	$output = curl_exec($ch);
	curl_close($ch);
	return $output;
  }

  public static function awardPoints($match_object)
  { 
    if($match_object->home_score !="NULL")
	{
    $game_predictions = Prediction::getRightPredictions($match_object);
	  $array = json_decode($game_predictions, 1);
	  $predictions = $array['results']; 
	  foreach($predictions as $prediction)
	  {
	    $p_margin = $prediction['value']['margin'];
	    $p_winner = $prediction['value']['winner'];
	    $a_margin = abs($match_object->home_score - $match_object->away_score);
	    if($match_object->home_score >= $match_object->away_score)
	    { 
	      $a_winner = $match_object->home_key;
	    }
	    else
	    {
	      $a_winner = $match_object->away_key;
	    }
	    if($p_winner == $a_winner)
	    {
	      $score = 20-(abs($p_margin - $a_margin)); 
		 
	    }
	    else
	    {
	      $score = 20-($p_margin + $a_margin);
	    }
        $game_key = $prediction['value']['game'];	
        $user_key = $prediction['value']['email'];	
		    $stamp = $match_object->timestamp;
  	    User::createEvent($score, $game_key, $user_key, $stamp);
	  } 
	}
    else
    {
      
    }	
  }
  
  public static function getRightPredictions($match)
  {
    $game_key = $match->getKey();  
	  $url = "https://api.orchestrate.io/v0/matches/$game_key/relations/prediction";
    $ch = curl_init(); 
	  curl_setopt($ch, CURLOPT_URL, $url); 
	  curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1); 
	  curl_setopt($ch, CURLOPT_USERPWD, API_KEY);
	  curl_setopt($ch, CURLOPT_HTTPHEADER, 
	  array('Content-Type: application/json','Accept-Language:application/json')); 
	  $output = curl_exec($ch);
	  curl_close($ch);
	  return $output;
  }
  
  public static function getUnscoredMatches($days)
  {
  
  // query for all matches where
  $start = mktime(0,0,0,date("m"),date("d")+$days,date("Y"));
  $end = mktime(0,0,0,date("m"),date("d")+$days+1,date("Y"));
  $query = "timestamp:[" . $start . " TO " . $end . "]AND home_score:'NULL'";
  $unscored = Match::getMatchesQuery($query, 20, 0);
  return $unscored;
  }
    
  public static function getMatchOutcome($match_id)
  {
    $outcomes_json = Prediction::getBoxScore($match_id);
    $outcomes = json_decode($outcomes_json,1);
    $away_scores = $outcomes['away_period_scores'];
    $home_scores = $outcomes['home_period_scores'];
    $final_outcome = array("home_score"=>array_sum($home_scores), away_score=>array_sum($away_scores));
    return $final_outcome;
  }
  
  public static function getBoxScore($match_id) 
  {
    $urlpath = $match_id . '.json';
	$url = "https://erikberg.com/nba/boxscore/" . $urlpath;
    $ch = curl_init(); 
	curl_setopt($ch, CURLOPT_URL, $url); 
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_USERAGENT, "info@joshmcquiston.com");	
	curl_setopt($ch, CURLOPT_HTTPHEADER, 
	array('Authorization: Bearer ' . XML_TOKEN)); 
	$output = curl_exec($ch);
	curl_close($ch);
	return $output;
  }
}
 
 ?>
 
 
 
 
 
 
 
 
 
 
 
 
 
 
 
 
 
 
 
 
 
 
 
 
 
 
 
 
 
 
 