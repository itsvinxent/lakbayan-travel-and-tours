/**
** Author: ZAID BIN KHALID
** Website: https://learncodeweb.com
** Version: 0.1
**/
(function($){
	$.fn.loadScrollData = function(start,options) {
		
		action	=	"inactive";
		
		var settings	=	$.extend({
			limit			:	30, //Default limit to get data
			listingId		:	'', //Pass ID or Class where you want to append your data
			loadMsgId		:	'', //Loading message id
			ajaxUrl			:	'', //Ajax file path to get data
			loadingMsg		:	'<div style:"text-align:center;">Please Wait...!</div>', //Loading message
			packageID		:   ''
		},options);
		
		$.ajax({
			method	:	"POST",
			data	:	{'getData':'ok','limit':settings.limit,'start':start,packageID:settings.packageID},
			url		:	settings.ajaxUrl,
			success	:	function(data){
				$(settings.listingId).append(data);
				if(data == ''){
					$(settings.loadMsgId).html('');
					action = 'active';
				}else{
					$(settings.loadMsgId).html(settings.loadingMsg);
					action = "inactive";
				}
			}
		});
	
		if(action == 'inactive'){
			action = 'active';
		}
		
		$(window).scroll(function(){
			if($(window).scrollTop() + $(window).height() > $(settings.listingId).height() && action == 'inactive'){
				action  	=   'active';
				start	  	=   parseInt(start)+parseInt(settings.limit);
				setTimeout(function(){
					$.fn.loadScrollData(start,options);
				},1000);
			}
		});
					
	};
}(jQuery));