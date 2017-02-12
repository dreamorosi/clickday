$(document).ready(function(){
	if(window.emailN != ''){
		$('.login').modal('toggle').on('shown.bs.modal', function () {
			$('.log[name=email]').val(window.emailN);
			$('.form-control[type=password]').focus();
		});
	}

	href = window.location.href.substr(window.location.href.indexOf('#')+1, window.location.href.length+1);

	if(href!=window.location.href) {
		$('html, body').animate({
		scrollTop: $(href).offset().top-200}, 500);
	}

	var decimal_places = 1;
	var decimal_factor = decimal_places === 0 ? 1 : Math.pow(10, decimal_places);
	var percent_number_step = $.animateNumber.numberStepFactories.append('%')
	$('.number1').animateNumber({number: 500}, 2000);
	$('.number2').animateNumber({number: 38, numberStep: percent_number_step}, 2000);
	$('.number3').animateNumber({
		number: 3.4 * decimal_factor,
		numberStep: function(now, tween) {
			var floored_number = Math.floor(now) / decimal_factor,
			target = $(tween.elem);
			if (decimal_places > 0) {
				floored_number = floored_number.toFixed(decimal_places);
			}
			target.text(floored_number);
		}
	}, 2000);
	$('.number4').animateNumber({
		number: 3.2 * decimal_factor,
		numberStep: function(now, tween) {
			var floored_number = Math.floor(now) / decimal_factor,
			target = $(tween.elem);
			if (decimal_places > 0) {
				floored_number = floored_number.toFixed(decimal_places);
			}
			target.text(floored_number);
		}
	}, 2000);

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
