<?php

/*
 METHODS:
 *public function __construct($_name, $_email)
 *public function storeUser()
 *public static function createEvent($score, $game_key, $user_key) 
 *public function getStats()
 *public function login()
 *public function logout()
 
 */
class User
{
  public $name;
  public $email;

  public function __construct($_name, $_email)
  {
    // this needs to be constructed and
	$this->name = $_name; 
    $this->email = $_email;
  }
  
  public function storeUser() 
  {
    $userdata = json_encode($this);
    $url = "https://api.orchestrate.io/v0/users/" . urlencode($this->email);
    $ch = curl_init(); 
	curl_setopt($ch, CURLOPT_URL, $url); 
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "PUT");
    curl_setopt($ch, CURLOPT_POSTFIELDS,($userdata));
	curl_setopt($ch, CURLOPT_USERPWD, API_KEY);
  	curl_setopt($ch, CURLOPT_HTTPHEADER, 
	array('Content-Type: application/json','Accept-Language:application/json')); 
	$output = curl_exec($ch);
	curl_close($ch);
  }
  public static function createEvent($score, $game_key, $user_key, $stamp) 
  {
    // check to see if they have an account already, if not, create one.
    $data = json_encode(array("game_key"=>$game_key, "usrpts"=>$score));
   // $stamp = time();
	$url = "https://api.orchestrate.io/v0/users/" . urlencode($user_key) . "/events/points_earn?timestamp=" . $stamp;
  
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
	return $data;
  }
  //public static function getUsers
  
  public function getScores($user_email, $start, $end)
  {
    // create an array of users.  for each user, get all their predictions
    $key = urlencode($user_email);
	$url = "https://api.orchestrate.io/v0/users/" . $key . "/events/points_earn?start=" . $start . "&end=" . $end;
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
  public function totalUserScores($scores_json)
  {
    $events_array = json_decode($scores_json, 1);
	foreach($events_array['results'] as $result)
	{
	  $pts_array[] = $result['value']['usrpts'];
	}
   	$sum = array_sum($pts_array);
	return $sum; 
	//return $pts_array;
  }
  public static function totalUserScores_static($scores_json)
  {
    $events_array = json_decode($scores_json, 1);
	foreach($events_array['results'] as $result)
	{
	  $pts_array[] = $result['value']['usrpts'];
	}
   	$sum = array_sum($pts_array);
	return $sum; 
	//return $pts_array;
  }
  public static function getMultipleUserRecords($query, $limit, $offset)
  {
    $url = "https://api.orchestrate.io/v0/users/?query=" . urlencode($query) . "&limit=" . $limit . "&offset=" . $offset;
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
  public static function getUserScoresFromRecords($records_array_json )
  {
    $records_array = json_decode($records_array_json, 1);
	foreach($records_array['results'] as $result)
	{
	  $scores_arrays[] = array(name=>$result['value']['name'], score=>User::getScores($result['value']['email'], User::getPrevSunday(),time()));//User::getScores($result['value']['email']);
	
	}
    foreach($scores_arrays as $scores_array)
	{
	  //$a = $scores_array;
	  $ttl_user_pts_array[] = array(name=>$scores_array[name], score=>User::totalUserScores_static($scores_array[score]));
	}  
	
	return $ttl_user_pts_array;
      
  }
  public function getPreviousPredictions()
  {
    $output = Prediction::getPredictionsQuery($this->email, "100", "0");
	return $output;
    // use Prediction::getPredictionsQuery()  for this, but will be able to pass the user->email as query parameter.  Also will need to do separate $user['events'] search and then will need to match up the events with the predictions to create pairs.
  }
  public static function getPrevSunday() 
  {
   	$thisday = date('D');
	if($thisday=='Mon')
	{$d = 1;}
	if($thisday=='Tue')
	{$d = 2;}
	if($thisday=='Wed')
	{$d = 3;}
	if($thisday=='Thu')
	{$d = 4;}
	if($thisday=='Fri')
	{$d = 5;}
	if($thisday=='Sat')
	{$d = 6;}
	if($thisday=='Sun')
	{$d = 7;}
	return mktime(1, 1, 0, date("m"),date("d")-$d,date("Y"));
	
 }
  
  public static function getPrevScoredQuery($key, $start, $end) 
  {
    $url = "https://api.orchestrate.io/v0/users/" . $key . "/events/points_earn?start=" . $start . "&end=" . $end;
    $ch = curl_init(); 
	curl_setopt($ch, CURLOPT_URL, $url); 
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1); 
	curl_setopt($ch, CURLOPT_USERPWD, API_KEY);
	curl_setopt($ch, CURLOPT_HTTPHEADER, 
	array('Content-Type: application/json','Accept-Language:application/json')); 
	$output = curl_exec($ch);
	curl_close($ch);
	return $output;
	//return $url;
  }
  public function getMatches(){}
  // use Matches::getMatchesQuery, and then also get an array of predictions made by this user to filter the list of matches so that matches already predicted on show last. 
  public static function deleteUser($user_key)
  {
    $url = "https://api.orchestrate.io/v0/users/" . $user_key;
    $ch = curl_init(); 
	curl_setopt($ch, CURLOPT_URL, $url); 
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "DELETE");
    curl_setopt($ch, CURLOPT_POSTFIELDS,($data));
	curl_setopt($ch, CURLOPT_USERPWD, API_KEY);
    curl_setopt($ch, CURLOPT_HTTPHEADER, 
	array('Content-Type: application/json','Accept-Language:application/json')); 
	$output = curl_exec($ch);
	curl_close($ch);
	return $user_key;
  }
	
  public static function validateUser($name, $email)
  {
    $url = "https://api.orchestrate.io/v0/users/" . urlencode($email);
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1); 
    curl_setopt($ch, CURLOPT_USERPWD, API_KEY);
    curl_setopt($ch, CURLOPT_HTTPHEADER, 
    array('Content-Type: application/json','Accept-Language:application/json')); 
    $output = curl_exec($ch);
    curl_close($ch);
    $auth = json_decode($output, 1);
	if(!empty($auth) && in_array($name, $auth))
	{ 
	  return TRUE;
    }
	else{
  	return FALSE;}
  }   	 
  public static function logout()
  {
    session_start();
    session_unset();
    session_destroy();
    exit("thanks dude!");
  }
}

?>