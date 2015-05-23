<?php

//echo Date("m_d_Y");
$in2days = mktime(0,0,0,date("m"),date("d")+2,date("Y"));
//echo date("m_d_Y", $in2days);


$url =  "game_date:{" . Date("m_d_Y") . " TO " . date("m_d_Y", $in2days) . "}";
echo urlencode($url);

//game_date:{12_01_2013 TO 12_06_2013}

 // game_date:{11_14_2013 TO 11_16_2013}
?>