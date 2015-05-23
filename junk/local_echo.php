<?php

 $yesterdayAM = mktime(0,0,0,date("m"),date("d")-1,date("Y"));
  $two_hours_ago = time()-3600;
  $query = "timestamp:[" . $yesterdayAM . " TO " . $two_hours_ago . "]ANDhome_score:'NULL'";
  echo $query;
  ?>