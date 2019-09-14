$(document).ready(function(){
	var b = true;
	
	$("#content .slide").slick({
		dots: true,
		infinite: true,
		speed: 300,
		slidesToShow: 1,
		slidesToScroll: 1,
		autoplay: true,
		centerMode: false,
		variableWidth: false,
		centerPadding:0,
		rows:1,
		arrows:false,
		focusOnSelect: true,
		});
	
	$("#header .header2 .nav .navBtn").click(function() {
		$('#header .header2 .nav ul').stop().slideToggle(200);
	});
	
	
 });