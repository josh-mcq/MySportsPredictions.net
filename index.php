<?php
session_start();
include 'config.php';
function __autoload($classname) 
{
  include strtolower($classname) . '.class.php';
}
if(isset($_SESSION['email']))
{ 
  if(!empty($_POST['prediction']))
  
  {  include 'echo.php'; 
   ''' $predictions = Match::flipdiagonally($_POST);
    foreach($predictions as $prediction) 
    {
      if($prediction['winner']!='NULL')
	  {
        $prediction_object = new Prediction($prediction['game'], $prediction['winner'], $prediction['margin'], $_SESSION['email']);
        $prediction_object->storePrediction();
	    $prediction_object->storeMatchPredictionRel();
	  }
    }
	header("Location: http://www.mysportspredictions.net/");'''
  }
  elseif(isset($_POST['logout']))
  {
    session_start();
    session_unset();
    session_destroy();
   // include 'login.html.php';
	//exit("thanks dude!");
	header("Location: http://www.mysportspredictions.net/");
  } 
  else
  {
    // FOR CREATING NEW PREDICTIONS SECTION
    $start = time(); //mktime(0,0,0,date("m"),date("d")-1, date("Y"));//
	$end = mktime(0,0,0,date("m"),date("d")+3,date("Y"));
	$query_new = 'timestamp:[' . $start . ' TO ' . $end . ']'; 
    $gamesJson = Match::getMatchesQuery($query_new, 100, "0");
	$bigArray = json_decode($gamesJson, 1);
    $arrays_new = $bigArray['results'];
	
	
	// FOR CREATING USER SCORES SECTION  //
	$user = new User($_SESSION['name'], $_SESSION['email']);

	$scores_json = $user->getScores($_SESSION['email'], "", "");
	$total_user_points = $user->totalUserScores($scores_json);
	$query_scores="*";
	$user_record_list_json = User::getMultipleUserRecords($query_scores, 8, 0);
	$user_scores_array = User::getUserScoresFromRecords($user_record_list_json);
	function compareOrder($a, $b)
  {
    return $b['score'] - $a['score'];
  }
   usort($user_scores_array, 'compareOrder');
   
 //  FOR PENDING PREDICTIONS SECTION
   $query_pending = Prediction::getUrlForUnsweredPredictions();
   $predictionsJson = Prediction::getPredictionsQuery(urlencode($query_pending),20,0);
   $predArray = json_decode($predictionsJson, 1);
   $p_arrays = $predArray['results'];
   // to create an array of all the game keys here.
   foreach($p_arrays as $array) {
	$game_keys[] = $array['value']['game'];
	}
	
  // FOR PREVIOUS PREDICTIONS SECTION         
   $prevPredictionsJson = User::getPrevScoredQuery($_SESSION['email'], User::getPrevSunday(), time());
   $prevArray = json_decode($prevPredictionsJson, 1);
   $p_events_arrays = $prevArray['results'];
   foreach($p_events_arrays as $p_events_array) 
   {
	 $prev_game_keys[] = $p_events_array['value']['game_key'];
   }
	
   $start = User::getPrevSunday();
   $end = time();
   $query_prev = 'timestamp:[' . $start . ' TO ' . $end . ']'; 
   $arrayJson = Match::getMatchesQuery($query_prev, 100, "0");
   $gamesArray = json_decode($arrayJson, 1);
   $arrays = $gamesArray['results'];
   foreach($arrays as $array) 
   {
	 $prev_keys[$array['path']['key']] = $array['value'];
   } 
   //for getting data from the prediction
   $start = User::getPrevSunday();
   $end = time();
   $query_prev2 = date('Ymd', $start) . " OR " . date('Ymd', $start+86400) . " OR " . date('Ymd', $start+172800) . " OR " . date('Ymd', $start+259200) . " OR " . date('Ymd', $start+345600) . " OR " . date('Ymd', $start+432000) . " OR " . date('Ymd', $start+518400);
  // $query_prev2 = '20140119 OR 20140120 OR 20140121 OR 20140122 OR 20140123 OR 20140124 OR 20140125'; 
   $predictionsJason = Prediction::getPredictionsQuery(urlencode($query_prev2),100,0);
   $ApredArray = json_decode($predictionsJason, 1);
   $pr_arrays = $ApredArray['results'];
   foreach($pr_arrays as $pr_array) 
   {
	 $pred_keys[$pr_array['value']['game']] = $pr_array['value'];
   }
   
	include 'home.html.php';
	//include 'echo2.php';
  
  }
} 

elseif(isset($_POST['name']) || isset($_POST['email'])) 
{ 
  // SIGN-IN form submitted 
  // check for required values 
  if (empty($_POST['name'])) 
  { 
    die ("ERROR: Please enter username!"); 
  } 
  if (empty($_POST['email'])) 
  { 
    die ("ERROR: Please enter email address!"); 
  } 
  if(User::validateUser($_POST['name'], $_POST['email']))
  {
    session_start();
	$_SESSION['email'] = $_POST['email'];
	$_SESSION['name'] = $_POST['name'];
	
	header("Location: http://www.mysportspredictions.net/");
  }
  else
  {
    echo 'sorry, that was an invalid username and/or password';
    include 'login.html.php';
  }	

}
elseif(isset($_POST['new_name']) || isset($_POST['new_email']))
{
// SIGNUP FORM SUBMITTED 
// check for required values 
 if(empty($_POST['new_name'])) { 
    echo 'Please enter username!'; 
    exit;
 } 

 if(empty($_POST['new_email'])) { 
    echo 'Please enter email address!'; 
    exit;
 } 
 include 'user.class.php';
 $user = new User($_POST['new_name'], $_POST['new_email']);
 $user->storeUser();

 
// signed up!
session_start();
$_SESSION['email'] = $email;
//header("Location: http://www.mysportspredictions.net/");
echo 'thanks for registering ' . $user->name . "! Now let's get started!  <a href = 'http://www.mysportspredictions.net'>Continue</a>";
exit;
}
else
{
include 'login.html.php';
}



?>