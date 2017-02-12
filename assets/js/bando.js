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
		second;
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
			console.log(index)
			switch (index) {
				case 1:
					if(first==undefined){
						$("#bg04i").css('height', $(window).height()-115+30);
						$("#bg04i").css('margin-top', -30);
						$('#comeGuadagni h3').animateCss('fadeInUp');
						$('#comeGuadagni img').animateCss('fadeInUp');
						$('#comeGuadagni .testo3').animateCss('fadeInUp');
						$('#comeGuadagni .btn').animateCss('fadeInUp');
						$('#bg04i').animateCss('fadeInRight');
						$('#bg04 h3').animateCss('fadeInRight');
						$('#quest').animateCss('fadeInRight');
						$('#bg04 .testo3').animateCss('fadeInRight');

						first = 1;
					}else{
						return;
					}
					break;
				case 2:
					if(second==undefined){
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
						second = 1;
					}
					break;
			}
        }
	});

	$("#bg04i").css('height', $(window).height()-115+30);
	$("#bg06i").css('height', $(window).height()-115-115+30);

	$("#bg04i").css('margin-top', -30);
	$("#bg06i").css('margin-top', -30);
	
	$( window ).resize(function() {
		$("#bg04i").css('height', $(window).height()-115+30);
		$("#bg06i").css('height', $(window).height()-115-115+30);
		
		$("#bg04i").css('margin-top', -30);
	$("#bg06i").css('margin-top', -30);
	});

	href = window.location.href.substr(window.location.href.indexOf('#')+1, window.location.href.length+1);

	if(href!=window.location.href) {
		$('html, body').animate({
		scrollTop: $(href).offset().top-165}, 500);
	}

	$('#subNavItems li a').click(function(e){
		e.preventDefault();
		//console.log($(href).offset().top-165);
		href = $(this).attr('href');
		console.log(href);
		$('html, body').animate({
		scrollTop: $(href).offset().top-165}, 500, function(){
				window.location.hash =  '#' + href;
			return false;
			});
	});
});
