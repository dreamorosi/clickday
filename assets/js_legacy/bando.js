$(document).ready(function(){
	href = window.location.href.substr(window.location.href.indexOf('#')+1, window.location.href.length+1);
	if(href!=window.location.href) {
		$('html, body').animate({
		scrollTop: $(href).offset().top-200}, 500);
	}

	$('#subNavItems .navbar-left li a').click(function(e){
		e.preventDefault();

		href = $(this).attr('href');
		console.log(href);
		$('html, body').animate({
		scrollTop: $(href).offset().top-200}, 500, function(){
				window.location.hash =  '#' + href;
			return false;
			});
	});
});
