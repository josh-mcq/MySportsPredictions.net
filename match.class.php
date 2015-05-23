<?php
/*
 * This is the object that is created when I fill in the new games form.  I can put in as many as I need ahead of time.
 * METHODS:
 * public function __construct($_game_date, $_home_key, $_away_key, $_home_score, $_away_score, $_timestamp)
 * public function storeMatch()
 * public function getKey()
 * public static function getAllGames()
 * public static function autoStoreGames() 
 * public static function autoGetGames() 
 * public static function deleteMatch($matchKey)  
 * public static function flipdiagonally($arr)
 */
class Match
{
  public $game_date;
  public $home_key;
  public $away_key;
  public $home_score;
  public $away_score;
  public $timestamp;
  
  public function __construct($_game_date, $_home_key, $_away_key, $_home_score, $_away_score, $_timestamp)
  { 
    $this->game_date = $_game_date;
	$this->home_key = $_home_key;
	$this->away_key = $_away_key;
	$this->home_score = $_home_score;
	$this->away_score = $_away_score;
	$this->timestamp = $_timestamp;
  }
  
  public function storeMatch()
  {
    $data = json_encode($this);
	$key = $this->getKey();
	$url = "https://api.orchestrate.io/v0/matches/" . $key;
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
    header("Location: http://www.mysportspredictions.net/admin.php");
  }
	
  public function getKey()
  {	
     if(!empty($event['event']['event_id']))
	 {
	   return $event['event']['event_id'];
	 }
	 else
	 {
	 $d = $this->game_date;
	 $a = str_replace("-", "", $d);
     $b = $this->away_key;
	 $c = $this->home_key; 
	 return $a . "-" . $b . "-at-" . $c;
	 }
  }
 
	public static function getMatch($key)
    {
     // this will be generic query method
	 $url = "https://api.orchestrate.io/v0/matches/" . $key;
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
	
	public static function getMatchesQuery($query, $limit, $offset)
    {
     // this will be generic query method
	  $url = "https://api.orchestrate.io/v0/matches/?query=" . urlencode($query) . "&limit=" . $limit . "&offset=" . $offset;
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
	// take events array, parse and store each match.
	public static function autoStoreGames($days) 
	{
	  $events_json = Match::autoGetGames($days);
	  $events = json_decode($events_json, 1);
	  foreach($events['event'] as $event)
	  {
	    $timestamp = date("U",strtotime($event['start_date_time']));
	    $game_date = explode("T",$events['events_date'])[0];
	    $newMatch = new Match($game_date, $event['home_team']['team_id'], $event['away_team']['team_id'], 'NULL', 'NULL', $timestamp); 
	    $newMatch->storeMatch();
	    $newMatches[] = $newMatch;
      }
	  return $newMatches;
	}

	public static function autoGetGames($nth_day) 
	{
	// This function does not seem able to produce a date for the next month.  Or maybe just because it's december.  Will have to try in january to see what happens.  Could try as early as jan 1st..
	function getNthDay($n) {
	$nthdate = date('Ymd')+$n;
	return $nthdate;
	}
    $url = "https://erikberg.com/events.json?date=" . getNthDay($nth_day) . "&sport=nba";
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
	
	public static function resort($mda)
    {
      foreach($mda as $array)
      {
        $stamparray[] = $array['value']['timestamp'];
      }
      sort($stamparray);
      foreach ($stamparray as $timestamp) 
      {
        foreach($mda as $array) 
        {
          if($array['value']['timestamp'] == $timestamp && !in_array($array, $final))
	      {
            $final[] = $array;
		  }
        }
      }
      return $final;
    }
	
    public static function deleteMatch($matchKey)   
    {
	$url = "https://api.orchestrate.io/v0/matches/" . $matchKey;
    $ch = curl_init(); 
	curl_setopt($ch, CURLOPT_URL, $url); 
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "DELETE");
	curl_setopt($ch, CURLOPT_USERPWD, API_KEY);
    curl_setopt($ch, CURLOPT_HTTPHEADER, 
	array('Content-Type: application/json','Accept-Language:application/json')); 
	$output = curl_exec($ch);
	$info = curl_getinfo($ch);
	curl_close($ch);
	return $matchKey;
  }
  
  public static function flipdiagonally($arr)
  {
    $out = array();
    foreach ($arr as $key => $subarr) {
    	foreach ($subarr as $subkey => $subvalue) {
    		$out[$subkey][$key] = $subvalue;
    	}
    }
    return $out;
  }
  
  
}	 
?>  
