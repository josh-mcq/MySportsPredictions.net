
<?php

   function autoGetGames() {
	function getNthDay($n) {
	$nthdate = date('Ymd')+$n;
	return $nthdate;
	}
    $ACCESS_TOKEN = "0b054483-d4f6-477e-a186-615842e91010";
	//$game_date = date();
	$url = "https://erikberg.com/events.json?date=" . getNthDay(0) . "&sport=nba";
    $ch = curl_init(); 
	curl_setopt($ch, CURLOPT_URL, $url); 
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_USERAGENT, "info@joshmcquiston.com");	
	curl_setopt($ch, CURLOPT_HTTPHEADER, 
	array('Authorization: Bearer ' . $ACCESS_TOKEN)); 
	$output = curl_exec($ch);
	curl_close($ch);
	return $output;
	}
	echo autoGetGames();
	?>