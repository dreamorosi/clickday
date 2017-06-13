$(document).ready(function(){
	$.fn.extend({
		animateCss: function (animationName) {
		    var animationEnd = 'webkitAnimationEnd mozAnimationEnd MSAnimationEnd oanimationend animationend';
		    $(this).removeClass('hidden').addClass('animated ' + animationName).one(animationEnd, function() {
		        $(this).removeClass('animated ' + animationName);
		    });
		}
	});

	var first,
		second,
		third,
		fourth,
		fifth,
		sixth;
	$('#fullpage').fullpage({
		scrollingSpeed: 700,
		verticalCentered: true,
		autoScrolling: false,
		scrollOverflow: false,
		paddingTop: '115px',
		responsiveWidth: 992,
		responsiveHeight: 768,
		fitToSectionDelay: 600,
		controlArrows: true,
		afterLoad: function(anchorLink, index){
      var loadedSection = $(this);
			switch (index) {
				case 1:
					if(first==undefined){
						$('.ent').animateCss('fadeInUp');
						$('#bg01').animateCss('fadeInLeft');
						$('#bg02').animateCss('fadeInRight');
						$('#iscriviti').animateCss('fadeInUp');
						first = 1;
					}else{
						return;
					}
					break;
				case 2:
					if(second==undefined){
						$("#bg03i").css('height', $(window).height()-115+30);
						$("#bg03i").css('margin-top', -30);
						$('#chiSono h3').animateCss('fadeInUp');
						$('#chiSono p.text-center').animateCss('fadeInUp');
						$('#chiSono img').animateCss('fadeInUp');
						$('#chiSono .testo2').animateCss('fadeInUp');
						$('#bg03i').animateCss('fadeInRight');
						$('#bg03 h3').animateCss('fadeInRight');
						$('#bg03 img').animateCss('fadeInRight');
						$('#bg03 p').animateCss('fadeInRight');
						$('#button1').animateCss('fadeInRight');
						second = 1;
					}
					break;
				case 3:
					if(third==undefined){
						$('.sezione3 h3').animateCss('fadeInUp');
						$('.sezione3 .text-left').animateCss('fadeInUp');
						$('.sezione3 .testo3').animateCss('fadeInUp');
						$('.sezione3 img').animateCss('fadeInUp');
						third = 1;
					}
					break;
				case 4:
					if(fourth==undefined){
						$("#bg04i").css('height', $(window).height()-115+30);
						$("#bg04i").css('margin-top', -30);
						$('#comeGuadagni img').animateCss('fadeInUp');
						$('#comeGuadagni h3').animateCss('fadeInUp');
						$('#comeGuadagni p').animateCss('fadeInUp');
						$('#button2').animateCss('fadeInUp');
						$('#bg04i').animateCss('fadeInRight');
						$('#bg04 .testo3').animateCss('fadeInRight');
						$('#bg04 h3').animateCss('fadeInRight');
						$('#bg04 img').animateCss('fadeInRight');
						fourth = 1;
					}
					break;
				case 5:
					if(fifth==undefined){
						$("#bg05i").css('height', $(window).height()-115+30);
						$("#bg05i").css('margin-top', -30);
						$('#bg05i').animateCss('fadeInLeft');
						$('#bg05 h3').animateCss('fadeInLeft');
						$('#bg05 p').animateCss('fadeInLeft');
						$('#bg05 img').animateCss('fadeInLeft');
						$('#button3').animateCss('fadeInLeft');
						$('#chiGest img').animateCss('fadeInUp');
						$('#chiGest h3').animateCss('fadeInUp');
						$('#chiGest p').animateCss('fadeInUp');
						$('#button4').animateCss('fadeInUp');
						fifth = 1;
					}
					break;
				case 6:
					if(sixth==undefined){
						$("#bg06i").css('height', $(window).height()-115-115+30);
						$("#bg06i").css('margin-top', -30);
						$('.sezione5 .row1left h3').animateCss('fadeInUp');
						$('.sezione5 .row1left img').animateCss('fadeInUp');
						$('#bg06i').animateCss('fadeInRight');
						$('#bg06 img').animateCss('fadeInRight');
						$('#bg06 h5').animateCss('fadeInRight');
						$('#bg06 h1').animateCss('fadeInRight');
						$('#bg06 h2').animateCss('fadeInRight');
						$('#bg06 h6').animateCss('fadeInRight');
						sixth = 1;
					}
					break;
			}
        }
	});

	if(window.emailN != undefined){
		$('.login').modal('toggle').on('shown.bs.modal', function () {
			$('.log[name=email]').val(window.emailN);
			$('.form-control[type=password]').focus();
		});
	}

	// href = window.location.href.substr(window.location.href.indexOf('#')+1, window.location.href.length+1);
	//
	// if(href!=window.location.href) {
	// 	$('html, body').animate({
	// 	scrollTop: $(href).offset().top-165}, 500);
	// }

	$('#subNavItems li a').click(function(e){
		e.preventDefault();
		//console.log($(href).offset().top-165);
		href = $(this).attr('href');
		$('html, body').animate({
		scrollTop: $(href).offset().top-165}, 500, function(){
				window.location.hash =  '#' + href;
			return false;
			});
	});



	$("#bg03i").css('height', $(window).height()-115+30);
	$("#bg04i").css('height', $(window).height()-115+30);
	$("#bg05i").css('height', $(window).height()-115+30);
	$("#bg06i").css('height', $(window).height()-115-115+30);

	$("#bg03i").css('margin-top', -30);
	$("#bg04i").css('margin-top', -30);
	$("#bg05i").css('margin-top', -30);
	$("#bg06i").css('margin-top', -30);

	$( window ).resize(function() {
		$("#bg03i").css('height', $(window).height()-115+30);
		$("#bg04i").css('height', $(window).height()-115+30);
		$("#bg05i").css('height', $(window).height()-115+30);
		$("#bg06i").css('height', $(window).height()-115-115+30);

		$("#bg03i").css('margin-top', -30);
		$("#bg04i").css('margin-top', -30);
		$("#bg05i").css('margin-top', -30);
		$("#bg06i").css('margin-top', -30);
	});

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

	$('.yourCountdownContainer').countdown({
		date: "June 19, 2017 15:55:00"
	});
});
