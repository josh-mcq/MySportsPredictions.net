<?php
include 'match.class.php';
$jason = json_decode(Match::getAllGames(),0);




var_dump($jason);
$joe =  $jason['results'][1]['path']['key'];

?>