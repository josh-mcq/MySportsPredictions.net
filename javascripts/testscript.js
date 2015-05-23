$(document).ready(function()
{
//var a = $("#score1").val();
	//  alert(a);

  function increment(field)
  {
     field.val(parseInt(field.val(),10)+1);
  }
  function decrement(field)
  {
      field.val(parseInt(field.val(),10)-1);
  } 
  $(".away").click(function(){
  
    decrement($(this).siblings(".score"));
	//alert($(this).siblings("input").val());
	 if($(this).siblings("input").val()==-1 ) {
	 $(this).siblings("button").addClass('winner');
	 $(this).addClass('loser');
	 }
	}); //end $(document).ready(function()) {  
	
	//
	//alert($(this).attr("class"));
	
if($(this).siblings("input").val() ==0) {
	$(this).removeClass('loser');
	$(this).siblings("button").removeClass('winner');
   }
  /*
  $(".away").click(function() {
    //if($(this).siblings.attr('class') == "incbut") {
	increment($("#score1"));
	var a = "hello";
	alert(a);
	
	});  */
 
 //$("button").click(function(){
   // var id = this.id;
   //alert(id);
    // if(this.class == "home") {
	// alert("home");
	 //});
	  /*decrement($(this)siblings(".score"));
      if($(this).siblings(".score").val()==0) {
	  $(this).siblings(".away").removeClass('winner');
	  $(this).removeClass('loser');	
	  }
	  
	
	//else {
	increment($(this).siblings("input.score"));                    */
	/*if($(this).siblings("input.score").val() ==1) {
	  $(this).addClass('winner');
	  $(this).siblings("button").addClass('loser');
	  }
	if($(this).siblings("input.score").val()==0) {
	  $(this)siblings(".away").removeClass('winner');
	  $(this).removeClass('loser');
	  }*/
	 /*
  });
 
  $(".away").click(function(){
    if($("#away1").attr("class") == "away loser") {
	  decrement($("#score1"));
      if($("#score1").val()==0) {
	  $("#home1").removeClass('winner');
	  $("#away1").removeClass('loser');	
	  }
	}
	else {
	increment($("#score1"));
	if($("#score1").val() ==1) {
	  $("#away1").addClass('winner');
	  $("#home1").addClass('loser');
	  }
	if($("#score1").val()==0) {
	  $("#home1").removeClass('winner');
	  $("#away1").removeClass('loser');
	  }
	}
  }); 
   
  */ /*
  $(".away").click(function(){
   decrement($(this).siblings(".score"));

  if($(this).siblings(".score").val() ==-1) {
	$(this).siblings("button").addClass('winner');
	$(this).addClass('loser');
	}
if($(this).siblings(".score").val() ==0) {
	$(this).removeClass('loser');
	$(this).siblings("button").removeClass('winner');
   }  */
  });
 // });

	  
//});