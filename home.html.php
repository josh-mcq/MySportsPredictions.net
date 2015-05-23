<?php

/*
 * home page is where the prediction form will be.  The goal is to keep this page as SIMPLE as possible and mobile friendly.
 */
?>


<!--this is the form to submit the prediction-->
<!DOCTYPE html>
<html>
<p>hello <?php echo $user->name;?></p>
<p>games displayed from <?php echo time(); ?> to <?php echo $day; ?>.</p>
<form action = "?" method = "post">
 <!-- <select name="game"> -->
    <?php foreach($arrays as $array){ ?>
    <p>Game: <?php echo $array['value']['away_key'];?> at <?php echo $array['value']['home_key'];?></p>
    <input type="hidden" name="game[]" value="<?php echo $array['path']['key'];?>">     
  <br/>
  <label for="winner">The Winner</label>
   <select name="winner[]">
    <option value = "NULL">Select Winner</option>
    <option value = "<?php echo $array['value']['home_key'];?>"><?php echo $array['value']['home_key'];?></option>
	<option value = "<?php echo $array['value']['away_key'];?>"><?php echo $array['value']['away_key'];?></option>              
  </select>

  <label for="margin">Margin of victory</label>
  Points: 0<input type="range" name="margin[]" min="1" max="50">50
  <br />
  <?php } ?>
  <!--<label for="email">Your email address:</label>
  <input name="email" type = "email">
 <br/>-->
<input type = "submit" name = "prediction">
</form>
<!--  My Points  -->

<p>My points equals:<?php echo $total_user_points; ?></p>
<!--***LIST OF ACTIVE PLAYERS RANKED BY THEIR POINTS***-->
<?php 

echo "<br/>";
?>
<table>
<th>Player Scores</th>
<?php foreach($user_scores_array as $score) {?>
  <tr><td><?php echo $score[name];?></td><td><?php echo $score[score];?></td></tr>
  <?php } ?>
  </table>
  
 
<!--*** The Logout Button ***-->
<form action="?" method = "post">
<input type="submit" name="logout" value="logout">
</form>