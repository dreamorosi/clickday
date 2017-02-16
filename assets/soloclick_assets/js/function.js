function scrollpage(){
  var lastId,
      topMenu = $("#menu"),
      topMenuHeight = topMenu.outerHeight()+15,
      menuItems = topMenu.find("a"),
      scrollItems = menuItems.map(function(){
        var item = $($(this).attr("href"));
        if (item.length) { return item; }
      });

  /*menuItems.click(function(e){
    var href = $(this).attr("href"),
        offsetTop = href === "#" ? 0 : $(href).offset().top-topMenuHeight+1;
    $('html, body').stop().animate({
        scrollTop: offsetTop
    }, 900, 'easeOutExpo');
    e.preventDefault();
  });*/

  $('header nav span').eq(0).click(function(e){
    $("html, body").animate({ scrollTop: $('#cose').offset().top - 60 }, 900, 'easeInOutExpo'); return false;
    document.location.href = String( document.location.href ).replace( /#cose/, "" );
  });

  $('header nav span').eq(1).click(function(e){
    $("html, body").animate({ scrollTop: $('#come-funziona').offset().top - 60 }, 900, 'easeInOutExpo'); return false;
    document.location.href = String( document.location.href ).replace( /#come-funziona/, "" );
  });

  $('header nav span').eq(2).click(function(e){
    $("html, body").animate({ scrollTop: $('#successi').offset().top }, 900, 'easeInOutExpo'); return false;
    document.location.href = String( document.location.href ).replace( /#successi/, "" );
  });

  $('header nav span').eq(3).click(function(e){
    $("html, body").animate({ scrollTop: $('#costo').offset().top - 180 }, 900, 'easeInOutExpo'); return false;
    document.location.href = String( document.location.href ).replace( /#costo-servizio/, "" );
  });

  $('header nav span').eq(4).click(function(e){
    $("html, body").animate({ scrollTop: $('#chi-siamo').offset().top + 30 }, 900, 'easeInOutExpo'); return false;
    document.location.href = String( document.location.href ).replace( /#chi-siamo/, "" );
  });

  $('header nav span').eq(5).click(function(e){
    $("html, body").animate({ scrollTop: $('#contatti').offset().top + 30 }, 900, 'easeInOutExpo'); return false;
    document.location.href = String( document.location.href ).replace( /#contatti/, "" );
  });

  $(window).scroll(function(){
     var fromTop = $(this).scrollTop()+topMenuHeight;

     var cur = scrollItems.map(function(){
       if ($(this).offset().top < fromTop)
         return this;
     });

     cur = cur[cur.length-1];
     var id = cur && cur.length ? cur[0].id : "";

     if (lastId !== id) {
         lastId = id;
         menuItems
           .parent().removeClass("active")
           .end().filter("[href='#"+id+"']").parent().addClass("active");
     }
  });
}

$(document).ready(function () {
  scrollpage();
  $.cookieBar({fixed:true});

  bxslider = $('.bxslider').bxSlider({'pager':false, /*auto:true, pause:5500,*/ controls:false, useCSS:false, easing:'easeInOutBack', speed:1200,
    onSliderLoad: function(currentIndex) { $('.slide ul li:not(.bx-clone)').eq(currentIndex).addClass('active-slide'); },
    onSlideBefore: function ($slideElement, oldIndex, newIndex) { setTimeout(function(){ $('.slide').find('.bx-viewport').find('ul').children().removeClass('active-slide'); $slideElement.addClass('active-slide'); } , 1150); }
  });

  $('.slide .prev').click(function(){ /*bxslider.stopAuto();*/ bxslider.goToPrevSlide(); /*bxslider.startAuto();*/ });
  $('.slide .next').click(function(){/* bxslider.stopAuto();*/ bxslider.goToNextSlide(); /*bxslider.startAuto();*/ });

  $('#gotop').click(function(){ $("html, body").animate({ scrollTop: 0}, 1300, 'easeInOutExpo'); return false; });

  //responsive
  if( $(window).width() < 729 ){ $("#cose p br").remove(); $("#costo-servizio p br").remove(); $('.animation-resp').attr('data-translateY', '300'); }
  if( $(window).width() < 420 ){ $("#successi .title br").remove(); }

  $('#menu span').click(function(){ if( $('#menu').hasClass('open') ){ setTimeout(function(){ $('#menu').removeClass('open'); $('#nav-icon3').removeClass('open'); }, 150); } });

  $('#btn-menu').click(function(){ if( $('#menu').hasClass('open') ){
      $('#menu').removeClass('open');
      $('#nav-icon3').removeClass('open');
    }else{
      $('#menu').addClass('open')
      $('#nav-icon3').addClass('open');
    }
  });



});

$(window).resize(function () {
  if( $(window).width() < 729 ){ $("#cose p br").remove(); $("#costo-servizio p br").remove(); }
  if( $(window).width() < 420 ){ $("#successi .title br").remove(); }
});
