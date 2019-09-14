$(function() {
    "use strict";

    //Make the dashboard widgets sortable Using jquery UI
    // $(".connectedSortable").sortable({
    //     placeholder: "sort-highlight",
    //     connectWith: ".connectedSortable",
    //     handle: ".box-header, .nav-tabs",
    //     forcePlaceholderSize: true,
    //     zIndex: 999999
    // }).disableSelection();
    // $(".connectedSortable .box-header, .connectedSortable .nav-tabs-custom").css("cursor", "move");
	$(".windowPopUp").click(function() {
		var left  = ($(window).width()/2)-(700/2),
			top   = ($(window).height()/2)-(500/2),
		popup = window.open ($(this).attr( "href" ), 'windowPopUp', "toolbar=no,width=700, height=500, top="+top+", left="+left);
		if (window.focus) {popup.focus()}
		return false;
	});
})