$(function() {
    "use strict";

	$('body').on('click', '.wndPopup', function (){
		var left  = ($(window).width()/2)-(660/2),
			top   = ($(window).height()/2)-(460/2),
		popup = window.open ($(this).attr( "href" ), 'wndPopup', "width=800, height=450, top="+top+", left="+left);
		if (window.focus) {popup.focus()}
		return false;
	});

})