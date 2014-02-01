$(document).ready(function(){
	var margin = parseInt($("h1.post-head").outerHeight(true));
	margin = margin + parseInt($("p.post-subhead").outerHeight(true));
	margin = margin + parseInt($("p.post-author").css("margin-top"));
	$("div.post-sidebar-info").css("margin-top", margin-1);
});