
$(document).ready(function(){
	
	$('input[type=checkbox],input[type=radio],input[type=file]').uniform();
	
	$(".select2").select2({
        placeholder: "--- Lựa chọn ---",
        allowClear: true
	});
    // $('.colorpicker').colorpicker();
    $(".datepicker").datepicker();

    $(".windowPopUp").click(function() {
        var left  = ($(window).width()/2)-(700/2),
            top   = ($(window).height()/2)-(500/2),
            popup = window.open ($(this).attr( "href" ), 'windowPopUp', "toolbar=no,width=700, height=500, top="+top+", left="+left);
        if (window.focus) {popup.focus()}
        return false;
    });
});
