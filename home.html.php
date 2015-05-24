<!DOCTYPE html>

<!-- paulirish.com/2008/conditional-stylesheets-vs-css-hacks-answer-neither/ -->
<!--[if IE 8]>    <html class="no-js lt-ie9" lang="en"> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js" lang="en"> <!--<![endif]-->
<head>
	<meta charset="utf-8" />

	<!-- Set the viewport width to device width for mobile -->
	<meta name="viewport" content="width=device-width" />

	<title>My Sports Predictions</title>

	<!-- Included CSS Files -->
  <link rel="stylesheet" href="stylesheets/app.css">
  <link rel="stylesheet" href="stylesheets/offcanvas.css">
  <link rel="stylesheet" href="stylesheets/_custom.css">
  <link rel="stylesheet" href="stylesheets/test.css">
 
  <script src="javascripts/foundation/modernizr.foundation.js"></script> 

</head>

  <body id="page" class="off-canvas paneled">
    <?php include_once("analyticstracking.php") ?>
	<div class="container">

		<header id="header" class="row "><!--fixed-->
		  <div class="four columns">
		    <h1 id="site-title"><a href="http://www.mysportspredictions.net">My Sports Predictions.net</a></h1>
		  </div>
		  <div class="six columns">
		    <div class="fixed sticky">
			<nav id="menu" role="navigation" class="hide-for-small sticky">
  				<ul id="nav" class="nav-bar">
  					<li><a href="#panel-1" class="main nav-item">New</a></li>
  					<li><a href="#panel-2" class="main nav-item">Pending</a></li>
  					<li><a href="#panel-3" class="main nav-item">Previous</a></li>
  					<li><a href="#panel-4" class="main nav-item">Week</a></li>
					<li class="has-flyout">
					  <a href="#"><?php echo $user->name;?></a>
				      <a href="#" class="flyout-toggle"><span> </span></a>
					  
					  <ul class="flyout left">
						<li id="logout_form">
						 <form action="?" method ="post">
                           <input class="logout_btn" type="submit" name="logout" value="Logout">
						   </form> 
						</li>
					  </ul> 
					</li>
					
				  <!--  <li>
                      <form name="logout" id="logout_btn" method="post">logout</a> -->
					
					
					
					<!--<li><a href="#panel-5" class="main nav-item"><?php echo $user->name;?></a></li>--> 
  				</ul>
  			</nav>

			</div>

  			<dl class="tabs five-up show-for-small" id="switchPanels">
          <dd class="active"><a href="#panel-1">New</a></dd>
          <dd><a href="#panel-2">Pending</a></dd>
          <dd><a href="#panel-3">Previous</a></dd>
          <dd><a href="#panel-4">Week</a></dd>
          <dd><a href="#panel-5">Logout</a></dd> 
  			</dl>
		  </div>
		</header>

		<div class="row">
  		<section role="main" id="main">
  		  <article id="panel-1" class="page-panel">
			
			<div class="prediction_descr">		
			  <h1>Make New Predictions</h1>
			  <p>Make a prediction by clicking on whichever team you think will win to set the margin you think they will win by.</p>
			</div>
			<!--<p>hello NAME this moved to top bar</p>-->
			<form class= "prediction_form" action = "?" method = "post">
			   <?php 
			   $sorted_arrays = Match::resort($arrays_new);
			   array_unique($sorted_arrays);
			  foreach($sorted_arrays as $array_new)
			   {
			  // var_dump($array_new);
			   //echo "<br/>hello<br/>hi<br/>";
			     if(!in_array($array_new['path']['key'], $game_keys)) { 
			     $home = str_replace("-", " ", $array_new['value']['home_key']);
	             $away = str_replace("-", " ", $array_new['value']['away_key']);
				 date_default_timezone_set("America/New_York");
                 $time = date('l\, M jS g:i', $array_new['value']['timestamp']);			 ?>
			     <fieldset class = "prediction">
			       <input type="hidden" name="game[]" value="<?php echo $array_new['path']['key'];?>">     
			       <p class = "prediction_date-time"><?php echo $time;?>(ET)</p>
			     <input type="hidden" name="winner[]" class="winning" value="NULL">
			     <button type="button" class ="away" value="<?php echo $array_new['value']['away_key'];?>"> <?php echo ucwords($away);?></button>
                 <input  name="margin[]" type="number" class = "margin" value="0">
                 <button type = "button" class = "prediction_home" value="<?php echo $array_new['value']['home_key'];?>"> <?php echo ucwords($home);?></button>
                 </fieldset>   
               <?php }}  ?> 
			   <input type = "submit" name = "prediction">
			   </form>
			  </article><!-- /#panel-1 -->

            <article id="panel-2" class="page-panel">
  				<h1 class="pending_h1">Pending Predictions</h1>
				 <?php foreach($p_arrays as $p_array) {
				   $pending_dategame = explode("-", $p_array['value']['game']);
				   $pending_date = strtotime($pending_dategame[0]);
				   $pending_h_date = date('l\, M jS', $pending_date);
				   array_shift($pending_dategame);
				   $pending_game = ucwords(implode(" ", $pending_dategame));
				   if(!in_array($p_array['value']['game'], $prev_game_keys))  {?>
				   <div class="pending">
				     <table class="pending_table">
					   <thead class = "pending_thead">
					     <tr>
						   <th colspan="2"class="pending_date"><?php echo $pending_h_date; ?></th>
						 </tr>
					   </thead>
					   <tbody class = "pending_tbody">
					     <tr class ="">
					       <td colspan="2" class="pending_game"><?php echo $pending_game;?></td>
					     </tr>
					     <tr>
					       <td>Winner:</td>
						   <td><?php echo ucwords(str_replace("-", " ", $p_array['value']['winner']));?></td>
					     </tr>
					     <tr class="pending_margin">
					       <td>Margin of Victory:</td>
					       <td><?php echo $p_array['value']['margin'];?></td>
					     </tr>
					   </tbody>
					 </table>
				   </div>
				 <?php }}?>
  		  </article><!-- /#panel-2 -->
  			


			  <article id="panel-3" class="page-panel">
				 <h1>Previous Predictions</h1>
				 <?php foreach($p_events_arrays as $p_events_array) {?>
				 <?php $date_game = explode("-", $p_events_array['value']['game_key']);?>
				 <?php $a = strtotime($date_game[0]); 
				 $b = date('l\, M jS', $a);
				 array_shift($date_game);
				 $matches = implode(" ",$date_game);
				 $match_a = explode(" at ", $matches);
				
				 ?>
				 
				 
				  <div class="previous">
				    <table class= "previous_table">
					  <thead class="previous_thead">
					    <tr>
						  <th class = "previous_date"><?php echo $b;?></th><th>Final</th>
						</tr>
					  </thead>	
					  <tbody>
					    <tr class = "previous_team--winner">
					      <td class = "previous_away"><?php echo ucwords($match_a[0]);?></td>
				          <td class="previous_score"><?php echo $prev_keys[$p_events_array['value']['game_key']]['away_score'];?></td>
					    </tr>
					    <tr class = "previous_team--loser">
					      <td class = "previous_away"><?php echo ucwords($match_a[1]);?></td>
				          <td class="previous_score"><?php echo $prev_keys[$p_events_array['value']['game_key']]['home_score'];?></td>
					    </tr>
					    <tr colspan= "2" class = "previous_prediction">
				          <td class="">Prediction: </td>
						  <td><?php echo ucwords(str_replace("-", " ", $pred_keys[$p_events_array['value']['game_key']]['winner'])) . " by ";?><?php echo $pred_keys[$p_events_array['value']['game_key']]['margin'];?></td>
				        </tr>
				        <tr  class = "">
                          <td colspan = "2" class="previous_result"><?php echo $p_events_array['value']['usrpts'];?>  points earned</td>				  
				        </tr>
					  </tbody>	
					</table>
		        </div> <?php } ?>
			  </article><!-- /#panel-3 -->


			  <article id="panel-4" class="page-panel">
				  <h1>This Week Leaders</h1>
                    <table class = "leader_table">
					  <thead>
					    <tr>
						  <th>Player</th>
						  <th>No. Games</th>
						  <th>Pts Per Game</th>
						  <th>No. Wins</th>
						  <th>Total Points</th>
						</tr>
				      </thead>
					  <?php foreach($user_scores_array as $score) {?>
                      <tbody>
					    <tr>
						  <td><?php echo $score[name];?></td>
						  <td>-</td>
						  <td>-</td>
						  <td>-</td>
						  <td><?php echo $score[score];?></td>
						</tr>
                        <?php } ?>
					    
                    </table>
				  </article><!-- /#panel-4 -->


			  <article id="panel-5" class="page-panel">
				  <h1>Logout</h1>
				  <p>Awww.. Leaving already? Well, I hope you'll come back soon and play again!</p>
                  <form action="?" method = "post">
                    <input type="submit" name="logout" value="logout">
                  </form>
               </article><!-- /#panel-5 -->
             	 
		  </section>
		</div>

    <footer class="site-footer row" role="contentinfo">
      <div class="twelve columns">
       Site by Josh McQuiston
      </div>
    </footer>
  </div>


	<!-- Included JS Files -->
  <script src="javascripts/foundation/jquery.js"></script>
  <script src="javascripts/foundation/jquery.foundation.reveal.js"></script>
  <script src="javascripts/foundation/jquery.foundation.orbit.js"></script>
  <script src="javascripts/foundation/jquery.foundation.forms.js"></script>
  <script src="javascripts/foundation/jquery.placeholder.js"></script>
  <script src="javascripts/foundation/jquery.foundation.tooltips.js"></script>
  <script src="javascripts/foundation/jquery.foundation.alerts.js"></script>
  <script src="javascripts/foundation/jquery.foundation.buttons.js"></script>
  <script src="javascripts/foundation/jquery.foundation.accordion.js"></script>
  <script src="javascripts/foundation/jquery.foundation.navigation.js"></script>
  <script src="javascripts/foundation/jquery.foundation.mediaQueryToggle.js"></script>
  <script src="javascripts/foundation/jquery.foundation.tabs.js"></script>
  <script src="javascripts/foundation/jquery.offcanvas.js"></script>
  <script src="javascripts/foundation/app.js"></script>
  <!--<script src="javascripts/testscript.js"></script>-->
  <script src="javascripts/customjs.js"></script>



</body>