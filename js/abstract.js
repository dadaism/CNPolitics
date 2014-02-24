	$(document).ready(function(){
		
		$.each($('.abstract-full'),function(index,value) {

			var abstractLength = $(this).html().length;
			var headLength = $(this).parent().parent().children('p.latest-head').find('a').html().length;
			var abstractHeight = $(this).height();

			if (headLength > 20 && abstractLength > 75) {
				var shortText = $(this).html().substr(0,65)+'\&hellip;\&hellip;<span class="hint-area" style="font-size:13px;color:#b9b9b9;">\&#65372;完整摘要 \&#9662;</span>';
				$(this).parent('div.box-abstract').parent().children("p.abstract-short").html(shortText);
			} else if (headLength <= 20 && abstractLength > 100) {
				var shortText = $(this).html().substr(0,90)+'\&hellip;\&hellip;<span class="hint-area" style="font-size:13px;color:#b9b9b9;">\&#65372;完整摘要 \&#9662;</span>';
				$(this).parent('div.box-abstract').parent().children("p.abstract-short").html(shortText);
			} else {
				$(this).parent('div.box-abstract').parent().children("p.abstract-short").html($(this).html());
			}

		});

		$(".hint-area").mouseover(function()	{
			if ($(this).parent().parent().children('div.box-abstract').children('.abstract-full').html().length !== $(this).parent().html().length) {
			
				$(this).parent().parent().children('div.box-abstract').show();
				$(this).parent().hide();
			
			} 
		})

		$("p.abstract-full").mouseout(function()	{
			$(this).parent('div.box-abstract').hide();
			$(this).parent('div.box-abstract').parent().children("p.abstract-short").show();
		})
	})