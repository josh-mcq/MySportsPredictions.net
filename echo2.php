<?php   



$theBiz = $user_scores_array;




  
if(is_array($theBiz)) {
 var_dump($theBiz);
 }
 else{
 echo 'string ' . $theBiz;
 }

 /*

?>

 <?php foreach($p_arrays as $p_array) {
				   $pending_dategame = explode("-", $p_array['value']['game']);
				   $pending_date = strtotime($pending_dategame[0]);
				   var_dump($p_array);
				   }
?>


 public static function validateUser($name, $email)
  {
    $url = "https://api.orchestrate.io/v0/users/?query=name%3A" . $name . "%20%26%26%20email%3A" . urlencode($email);
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1); 
    curl_setopt($ch, CURLOPT_USERPWD, API_KEY);
    curl_setopt($ch, CURLOPT_HTTPHEADER, 
    array('Content-Type: application/json','Accept-Language:application/json')); 
    $output = curl_exec($ch);
    curl_close($ch);
    $auth = json_decode($output, 1);
	if(empty($auth['results']))
	{ 
	  return FALSE;
    }
	else{
  	return TRUE;}
  }   	*/  ?>