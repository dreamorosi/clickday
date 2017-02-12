$(document).ready(function(){
	$('#subNavItems .navbar-left li a').click(function(e){
		e.preventDefault();
		$('html, body').animate({
			scrollTop: $($(this).attr('href')).offset().top-200
		}, 1500);
	});
});