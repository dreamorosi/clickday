$(document).ready(function(){
	$('#subNavItems .navbar-left li a').click(function(e){
		e.preventDefault();
		$('html, body').animate({
			scrollTop: $($(this).attr('href')).offset().top-165
		}, 1500);
	});

	//$("#bg06").css('height', $(window).height()-115-115+30);
	//$("#bg06").css('margin-top', -30);
	//$( window ).resize(function() {
	//	$("#bg06i").css('height', $(window).height()-115-115+30);
	//$("#bg06").css('margin-top', -30);
	//});
});
