
<?php

   function autoGetGames() {
	function getNthDay($n) {
	$nthdate = date('Ymd')+$n;
	return $nthdate;
	}
    $ACCESS_TOKEN = "a28c6655-f9a1-487d-8f61-ab5fd1519978";
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