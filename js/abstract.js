	$(document).ready(function(){
		$(".box-abstract").mouseover(function()	{
			$(this).css("border","1px solid #777");
			$(this).css("background-color","#fff");
			$(this).animate({ boxShadow : "0 0 5px rgba(0,0,0,0.75)"});
			$(this).children("p.abstract-full").show();
			$(this).children("p.abstract-short").hide();
		})

		$(".box-abstract").mouseout(function()	{
			$(this).animate({ boxShadow : "none"});
			$(this).css("background-color","transparent");
			$(this).css("border","none");
			$(this).children("p.abstract-full").hide();
			$(this).children("p.abstract-short").show();
		})
	})