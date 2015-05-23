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
  <link rel="stylesheet" href="stylesheets/custom.css">
  <link rel="stylesheet" href="stylesheets/test.css">
 
  <script src="javascripts/foundation/modernizr.foundation.js"></script> 

</head>

  <body id="page" class="off-canvas paneled">
	<div class="container">

		<header id="header" class="row">
		  <div class="four columns">
		    <h1 id="site-title"><a href="http://www.mysportspredictions.net">My Sports Predictions.net</a></h1>
		  </div>
		
		</header> 
    <body> 
    <form method="post" action="?"> 
	    <input type="hidden" name="name" value="guest">
        <input type="hidden" name="email" value="info@joshmcquiston.com"> 
        <input type="submit" name="submit" value="Enter as Guest" class="button"> 
	  </form>
	
	  <form method="post" action="?"> 
	    <fieldset class="login_fieldset">
		  <h3 class = "login_h3">Sign In</h3>
	      <label for="name">Username:</label>
		  <input type="text" name="name">
          <label for = "email">Email Address:</label>
          <input type="email" name="email"> 
          <input type="submit" name="submit" value="Log In"> 
	    </fieldset>
	  </form>
	  
	
	  <form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>"> 
	    <fieldset class="login_fieldset">
	      <h3 class = "login_h3">New User Sign Up</h3>
		  <label for="new_name">Username:</label>
		  <input type="text" name="new_name">
          <label for = "new_email">Email Address:</label>
          <input type="email" name="new_email"> 
          <input type="submit" name="signup" value="signup"> 
	    </fieldset>
      </form>
	
	  <footer class="site-footer row" role="">
      <div class="twelve columns">
      
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
	
 