# MySportsPredictions.net

**Bug Alert!!**
05/26/2015 - A bug somewhere is preventing predictions from being saved currently, I am currently working to debug the application, and suspect it has to do with changes to one of the API's used in this application.

**Disclaimer**
This application was my first major project building a dynamic application, and I was guided mostly by late nights, intuition, coffee(no sugar please), and books, tutorials, and stack overflow.  While it does not live up to the quality coding standards I'd like to think I try to adhere now, it was at one point a functional application, that shows, if nothing else, that with persistence you can achieve a lot.  That said, read the following code at your own risk.


**Functional Overview of this application**

- Users may sign up with a username and email address, or by clicking on "guest" you may see functionality and use it as 'guest user' 

- Predict outcome future NBA basketball games by clicking and holding one of the buttons labeled with team names, as button is clicked and/or held, the margin will continue to increase, the color of the button belonging to winning team will appear green, losing team will appear blue.

- Change decision by clicking and holding button labeled with opposite team, margin will decrease until 0, then begin incrementing again while the colors of the buttons will switch as the button being clicked/held will now be green instead of blue to indicate this is the winning team.

- Make predictions in manner described above and then click submit button.   All games with predictions made will be recorded, and the predictions will be viewable in the "Pending" section until actual game has completed. 

- Games will only be available to make predictions on until the start time of the game.

- Once game has completed, all predictions will be evaluated and user will be given a score based on how close their prediction is to the actual game outcome.

- Weekly scores will be reset every Sunday.


**Technical Overview of this application**

- NBA game data retrieved via cURL calls to https://erikberg.com API.
- All user and game data is stored via cURL calls to https://api.orchestrate.io, an non-relational database API.
- Front end built using Bootstrap framework.
- Score prediction button functionality achieved using JQuery(see javascripts/customjs.js)
- Retrieval of upcoming games and completed game final scores done via admin page, done semi-automatically, simply with the click of a button.(see admin.php, match.class.php)
- Individual NBA games are represented by Match object(see match.class.php)


- Scoring of completed games 
- Index.php acts as controller
- Users are represented by User objects(see user.class.php)


- Predictions made are represented by Prediction object(see prediction.class.php)
- Evaluation of predictions and awarding of points handled by Prediction Class methods
