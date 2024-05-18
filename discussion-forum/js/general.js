$(document).ready(function(){
	var urlPath = window.location.pathname,
    urlPathArray = urlPath.split('.'),
    tabId = urlPathArray[0].split('/').pop();
	$('#dashboard, #users, #category_manager').removeClass('active');	
	$('#'+tabId).addClass('active');	
});