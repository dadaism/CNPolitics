jQuery(document).ready( function($) {
	//   var newCat, noSyncChecks = false, syncChecks, catAddAfter;
	// $('#link_name').focus();
    // postboxes
	// postboxes.add_postbox_toggles('link');

    $('#topic-tabs a').click(function(){
        var t = $(this).attr('href');
        $(this).parent().addClass('tabs').siblings('li').removeClass('tabs');
        $('#taxonomy-topic').children('.tabs-panel').hide();
        $(t).show();
       // if ( '#categories-all' == t )
         //   deleteUserSetting('cats');
       // else
         //   setUserSetting('cats','pop');
        return false;
    });
    $('#rsch-tabs a').click(function(){
        var t = $(this).attr('href');
        $(this).parent().addClass('tabs').siblings('li').removeClass('tabs');
        $('#taxonomy-rsch').children('.tabs-panel').hide();
        $(t).show();
       // if ( '#categories-all' == t )
         //   deleteUserSetting('cats');
       // else
         //   setUserSetting('cats','pop');
        return false;
    });
    $('#test-tabs a').click(function(){
        var t = $(this).attr('href');
        $(this).parent().addClass('tabs').siblings('li').removeClass('tabs');
        //$('.tabs-panel').hide();
        $('#taxonomy-test').children('.tabs-panel').hide();
        $(t).show();
       // if ( '#categories-all' == t )
         //   deleteUserSetting('cats');
       // else
         //   setUserSetting('cats','pop');
        return false;
    });
});

function showtab(tabAreaId, tabId, taxonomyId, divId) {

/*
* @para tabAreaId: tab area
* @para tabId: tab list
* @para listId: content list
* @para ulId: ul list
*/
	//alert(tabAreaId);
	//alert(tabId);
	var tabs = document.getElementById(tabAreaId).childNodes;

	//alert(tabs.length);
	for (i=0; i<tabs.length; ++i) {
		if ( tabs[i].tagName=="LI" ) {
			//alert(tabs[i].id);
			if (tabs[i].id==tabId)
				tabs[i].className='tabs';
			else
				tabs[i].className='';
		}
	}
	//alert(taxonomyId);
	var divs = document.getElementById(taxonomyId).childNodes;
	//console.log(divs);
	//alert(divId);
	//alert(divs.length);
	for (i=0; i<divs.length; ++i) {
		//alert(divs[i].tagName);
		//alert(divs[i].nodeType);
		if ( divs[i].tagName=="DIV" ) {
			//alert(divs[i].id);
			console.log(divs[i].id);
			console.log(divId);
			if (divs[i].id==divId) {
				//console.log(document.getElementById(divId))
				document.getElementById(divId).style.display='block';
				//console.log(document.getElementById(divId))
				//alert('They are equal');
				//alert(divId);
				//alert(document.getElementById(divId).style.display);
			}
			else {
				//console.log(document.getElementById(divs[i].id));
				document.getElementById(divs[i].id).style.display='none';
			}
		}
	}

}

function check_checkbox( prefixID, arrayID ) {
	for(var i = 0; i < arrayID.length; i++) {
		//alert("topicid-"+arrayID[i]);    //no .value here
		document.getElementById(prefixID+arrayID[i]).checked = true;
	}
}

function decorate_filter_box(authorname, quarter) {
	//alert(authorname);
	//alert(quarter);
	//alert( $('.filter-list li').text() );
	//document.getElementsById("author-all-a");
	
	var authors = document.getElementsByClassName("author-all-a");
	authors[0].style.color = '#b42800';
	authors[0].style.fontWeight = 'bold';
	if (authorname) {
		$(".author-filter").slideDown();
		$(".collapse-author-filter").hide();
		$(".expand-author-filter").show();
		
		authors = document.getElementsByClassName("author-all-a");
		authors[0].style.color = '#777';
		authors[0].style.fontWeight = '';
		//document.getElementsById("author-all-a")[0].style.fontWeight = '';
		var authors = document.getElementsByClassName("author-filter-a");
		for (var i=0; i<authors.length; ++i) {
			//alert(authors[i].innerHTML);
		
			if ( authors[i].innerHTML == authorname ){
				//alert(authors[i].innerHTML);
				authors[i].style.color = '#b42800'; 
				authors[i].style.fontWeight = 'bold';
			}
			else {
				authors[i].style.color = '#777'; 
				authors[i].style.fontWeight = '';
			}
		}
	}
	var quarters = document.getElementsByClassName("quarter-all-a");
	quarters[0].style.color = '#b42800';
	quarters[0].style.fontWeight = 'bold';
	if (quarter) {
		$(".quarter-filter").slideDown();
		$(".expand-quarter-filter").hide();
		$(".collapse-quarter-filter").show();
	
		quarters = document.getElementsByClassName("quarter-all-a");
		quarters[0].style.color = '#777';
		quarters[0].style.fontWeight = '';
		//document.getElementsById("author-all-a")[0].style.fontWeight = '';
		var quarters = document.getElementsByClassName("quarter-filter-a");
		for (var i=0; i<quarters.length; ++i) {
			//alert(authors[i].innerHTML);
		
			if ( quarters[i].innerHTML == quarter ){
				//alert(authors[i].innerHTML);
				quarters[i].style.color = '#b42800'; 
				quarters[i].style.fontWeight = 'bold';
			}
			else {
				quarters[i].style.color = '#777'; 
				quarters[i].style.fontWeight = '';
			}
		}
	}
	
	//alert( $('.filter-list li a'):contains("guisu").text() );
}
