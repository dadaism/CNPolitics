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
	//var arrayID = [1,2,3];	
	//alert(arrayID.length);

	for(var i = 0; i < arrayID.length; i++) {
		//alert("topicid-"+arrayID[i]);    //no .value here
		document.getElementById(prefixID+arrayID[i]).checked = true;
	}
}
