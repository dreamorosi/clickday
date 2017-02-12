$(document).ready(function(){
	screens = window.screens;
	pageSpan = window.pageSpan;
	maxOffset = window.maxOffset;
	current = 0;
	
	
	$( ".thumb" ).each(function( index ) {
		//this.
	  //console.log( index + ": " + $( this ).text() );
	});
	
	var evt = new Event(),
    m = new Magnifier(evt);
	
	m.attach({
		thumb: '.thumb',
		zoom: 2,
		zoomable: true
		
	});
	
	console.log(window.screens);
	
	function showPage(offset){
		offset = parseInt(offset);
		$('.prev, .next').removeClass('disabled');
		if(offset==0)$('.prev').addClass('disabled');
		if(offset==maxOffset) $('.next').addClass('disabled');
		if(offset<maxOffset){
			$('.table-striped tbody').empty();
			for(var i = offset; i < offset+pageSpan; i++){
				$('.table-striped tbody').append('<tr class="screen-line"><td>'+screens[i].name+'</td><td><div class="magnifier-thumb-wrapper"><img class="thumb" style="width: 298px;" src="'+window.base_url+'assets/uploads/screenshots/thumbs/'+screens[i].filename+'" data-large-img-url="'+window.base_url+'assets/uploads/screenshots/'+screens[i].filename+'" data-large-img-wrapper="preview'+screens[i].ID+'"/></div></td><td><div class="magnifier-preview" id="preview'+screens[i].ID+'" style="width: 298px;"></div></td><td><span class="label label-success" data-action="2" data-id="'+screens[i].ID+'" data-userid="'+screens[i].userID+'"><span class="glyphicon glyphicon-ok"></span></span> <span class="label label-danger" data-action="-1" data-id="'+screens[i].ID+'" data-userID="'+screens[i].userID+'"><span class="glyphicon glyphicon-remove"></span></span></td></tr>');
			}
		}else{
			$('.table-striped tbody').empty()
			for(var i = offset; i < screens.length; i++){
				$('.table-striped tbody').append('<tr class="screen-line"><td>'+screens[i].name+'</td><td><div class="magnifier-thumb-wrapper"><img class="thumb" style="width: 298px;" src="'+window.base_url+'assets/uploads/screenshots/thumbs/'+screens[i].filename+'" data-large-img-url="'+window.base_url+'assets/uploads/screenshots/'+screens[i].filename+'" data-large-img-wrapper="preview'+screens[i].ID+'"/></div></td><td><div class="magnifier-preview" id="preview'+screens[i].ID+'" style="width: 298px;"></div></td><td><span class="label label-success" data-action="2" data-id="'+screens[i].ID+'" data-userid="'+screens[i].userID+'"><span class="glyphicon glyphicon-ok"></span></span> <span class="label label-danger" data-action="-1" data-id="'+screens[i].ID+'" data-userid="'+screens[i].userID+'"><span class="glyphicon glyphicon-remove"></span></span></td></tr>');
			};
		}
		current = offset;
		var evt = new Event(),
		m = new Magnifier(evt);
		m.attach({
			thumb: '.thumb',
			zoom: 2,
			zoomable: true
		});
	}
	
	function nextPage(el){
		if(el.hasClass('disabled')) return;
		else
		if(el.hasClass('prev')){
			if(current>0){
				el = $('.pagination .active').prev();
				$('.pagination li').removeClass('active');
				el.addClass('active');
			}
			showPage(current-pageSpan)
		}else{
			if(current<maxOffset){
				el = $('.pagination .active').next();
				$('.pagination li').removeClass('active');
				el.addClass('active');
			}
			showPage(current+pageSpan);
		}
	}
	
	function updatePaginator(ac){
		$('#scrPages').empty().append('<li class="disabled ext prev"><a href="#" aria-label="Previous"><span aria-hidden="true">&laquo;</span></a></li>');
		var c = 0;
		if(ac>pages)
			ac=(pages-1)*pageSpan;
		while(c < pages){
			if(eval(c*pageSpan)==eval(ac)){
				$('#scrPages').append('<li class="active" id="pag'+(c+1)+'" data-offset="'+ (c*pageSpan) +'"><a href="#">'+ (c+1) +'</a></li>');
			}else{
				$('#scrPages').append('<li id="pag'+(c+1)+'" data-offset="'+ (c*pageSpan) +'"><a href="#">'+ (c+1) +'</a></li>');
			}
			c++;
		}
		k = '';
		if(pages==1) k='disabled';
		$('#scrPages').append('<li class="'+k+' ext next"><a href="#" aria-label="Next"><span aria-hidden="true">&raquo;</span></a></li>')
	}
	
	$('#scrPages').on('click','li', function(){
		if($(this).hasClass('active')) return;
		else if($(this).hasClass('ext')){
			nextPage($(this));
		}
		else{
			$('#scrPages li').removeClass('active');
			$(this).addClass('active');
			showPage($(this).attr('data-offset'));
		}
	});
	
	function rebuild(chosen){
		var tmp = [];
		for(i=0; i<screens.length; i++){
			if(screens[i].ID!=chosen)
				tmp.push(screens[i]);
		}
		screens = tmp;
	}
	
	$('body').on('click', '.label', function(){
		console.log('ok');
		$rowEl = $(this).parent().parent();
		action = $(this).data('action');
		id = $(this).data('id');
		userid = $(this).data('userid');
		$.ajax({
			method: 'POST',
			dataType: 'json',
			url: window.base_url + 'dashboard/changeScreen/',
			data: 'ID='+id+'&action='+action+'&userid='+userid,
			beforeSend: function(){
				
			},
			success: function(data){
				rebuild(id);
				$rowEl.fadeOut('750', function(){
					$(this).remove();
					pages = Math.ceil(screens.length/pageSpan);
					maxOffset = pageSpan * (pages-1);
					el = $('#scrPages .active');
					ofst = el.data('offset');
					if(ofst>maxOffset)
					ofst=maxOffset;
					updatePaginator(ofst);
					showPage(ofst);
				});
			}
		});
	});
});