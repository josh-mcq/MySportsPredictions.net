$(document).ready(function()
{


  
 $("#logout_btn").click(function() {
 $("#logout_form").submit();  
  });  
  
   function increment(field)
  {
     field.val(parseInt(field.val(),10)+1);
  }
  function decrement(field)
  {
      field.val(parseInt(field.val(),10)-1);
  } 
  
  function changeScoreAway(btn){
  if(btn.attr("class") == "away is-loser") {        //if they currently have is-loser class assigned..
	  decrement(btn.siblings(".margin"));           //move to decrement because the losing team is decreasing the lead
      if(btn.siblings(".margin").val()==0) {                      //and once the margin reaches 0
	    btn.siblings(".prediction_home").removeClass('is-winner');             //remove is-winner class from winner
	    btn.removeClass('is-loser');	           //and remove is-loser class from loser
		btn.siblings(".is-winner").attr("value","NULL");

	  }
	}
	else {
	  increment(btn.siblings(".margin"));            //otherwise increment because they are winning
	  if(btn.siblings(".margin").val() ==1) {        //once the margin reaches 1 assign them is-winner
	    btn.addClass('is-winner');                 //assign them is-winner
	    btn.siblings(".prediction_home").addClass('is-loser');                  //assign them is-loser
	     btn.siblings(".winning").attr("value", (btn.attr("value"))); // this may not work.		//assign them is-loser

	  }
	 
	}
}
  function changeScoreHome(btn) {   if(btn.attr("class") == "prediction_home is-loser") {        //if they currently have is-loser class assigned..
	  decrement(btn.siblings(".margin"));           //move to decrement because the losing team is decreasing the lead
      if(btn.siblings(".margin").val()==0) {                      //and once the margin reaches 0
	    btn.siblings(".away").removeClass('is-winner');             //remove is-winner class from winner
	    btn.removeClass('is-loser');	           //and remove is-loser class from loser
		btn.siblings(".is-winner").attr("value","NULL");
	  }
	}
	else {
	  increment(btn.siblings(".margin"));            //otherwise increment because they are winning
	  if(btn.siblings(".margin").val() ==1) {        //once the margin reaches 1 assign them is-winner
	    btn.addClass('is-winner');                 //assign them is-winner
	    btn.siblings(".away").addClass('is-loser'); 
        btn.siblings(".winning").attr("value", (btn.attr("value"))); // this may not work.		//assign them is-loser
	  }
	 
	}
  }
    function changeScoreTimed(changeFunc, btn) {
	changeFunc(btn);
    awayTimer = setTimeout(function(){changeScoreTimed(changeFunc, btn)}, 200) 
	}	
	
	$(".away").mousedown(function(){             
      changeScoreTimed(changeScoreAway, $(this));
  });
  
  $(".away").mouseup(function(){             
     clearTimeout(awayTimer);
  });
 
 
  // This is for the home button
 $(".prediction_home").mousedown(function(){             
      changeScoreTimed(changeScoreHome, $(this));
  });
  
  $(".prediction_home").mouseup(function(){             
     clearTimeout(awayTimer);
  }); 
});  