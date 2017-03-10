$(document).ready(function(){
	cms = window.cMs;
	pageSpan = window.pageSpan;
	maxOffset = window.maxOffset;
	pages = window.pages;
	current = 0;

	function showPage(offset){
		offset = parseInt(offset);
		$('#cmPages .prev,#cmPages .next').removeClass('disabled');
		if(offset==0)$('#cmPages .prev').addClass('disabled');
		if(offset==maxOffset) $('#cmPages .next').addClass('disabled');
		if(offset<maxOffset){
			$('.cmT tbody').empty();
			for(var i = offset; i < offset+pageSpan; i++){
				$('.cmlistWidget .table-striped tbody').append('<tr class="user-line" data-ID="'+cms[i].ID+'"><td class="cmName"><b>'+cms[i].name+'</b></td><td class="cmCode">'+cms[i].code+'</td><td class="cmEmail">'+cms[i].email+'</td><td class="cmUsers"><span>'+cms[i].users+'</span><span class="glyphicon glyphicon-search"></span></td><td class="cmActions"><span class="label label-info"><span class="glyphicon glyphicon-pencil"></span></span> <span data-toggle="modal" data-target=".confirm" data-action="delete" class="label label-danger"><span class="glyphicon glyphicon-remove"></span></span></td>');
			};
		}else{
			$('.cmT tbody').empty()
			for(var i = offset; i < cms.length; i++){
				$('.cmlistWidget .table-striped tbody').append('<tr class="user-line" data-ID="'+cms[i].ID+'"><td class="cmName"><b>'+cms[i].name+'</b></td><td class="cmCode">'+cms[i].code+'</td><td class="cmEmail">'+cms[i].email+'</td><td class="cmUsers"><span>'+cms[i].users+'</span><span class="glyphicon glyphicon-search"></span></td><td class="cmActions"><span class="label label-info"><span class="glyphicon glyphicon-pencil"></span></span> <span data-toggle="modal" data-target=".confirm" data-action="delete"  class="label label-danger"><span class="glyphicon glyphicon-remove"></span></span></td>');
			};
		}
		current = offset;
	}

	function nextPage(el){
		if(el.hasClass('disabled')) return;
		else
		if(el.hasClass('prev')){
			if(current>0){
				el = $('#cmPages .active').prev();
				$('#cmPages li').removeClass('active');
				el.addClass('active');
			}
			showPage(current-pageSpan)
		}else{
			if(current<maxOffset){
				el = $('#cmPages .active').next();
				$('#cmPages li').removeClass('active');
				el.addClass('active');
			}
			showPage(current+pageSpan);
		}
	}

	function updatePaginator(ac){
		$('#cmPages').empty().append('<li class="disabled ext prev"><a href="#" aria-label="Previous"><span aria-hidden="true">&laquo;</span></a></li>');
		var c = 0;
		if(ac>pages)
			ac=(pages-1)*pageSpan;
		while(c < pages){
			if(eval(c*pageSpan)==eval(ac)){
				$('#cmPages').append('<li class="active" id="pag'+(c+1)+'" data-offset="'+ (c*pageSpan) +'"><a href="#">'+ (c+1) +'</a></li>');
			}else{
				$('#cmPages').append('<li id="pag'+(c+1)+'" data-offset="'+ (c*pageSpan) +'"><a href="#">'+ (c+1) +'</a></li>');
			}
			c++;
		}
		k = '';
		if(pages==1) k='disabled';
		$('#cmPages').append('<li class="'+k+' ext next"><a href="#" aria-label="Next"><span aria-hidden="true">&raquo;</span></a></li>')
	}

	$('#cmPages').on('click', 'li', function(){
		if($(this).hasClass('active')) return;
		else if($(this).hasClass('ext')){
			nextPage($(this));
		}
		else{
			$('#cmPages li').removeClass('active');
			$(this).addClass('active');
			showPage($(this).attr('data-offset'));
		}
	});

	chosen = -1;
	$rowEl = -1;
	editing = -1;
	$rowEle = -1

	$('.confirm').on('show.bs.modal', function (event) {
		button = $(event.relatedTarget);
		$rowEl = button.parent().parent();
		chosen = $rowEl.data('id');
		if(button.data('action')=='delete'){
			name = button.parent().siblings('.cmName').html();
			$(this).find('.modal-body p').html("Stai per eliminare il Click Master "+ name +". L'azione è irreversibile.");
			$(this).find('.btn-primary').addClass('del');
		}else{
			name = button.parent().siblings('.cmName').attr('prev');
			$(this).find('.modal-body p').html("Stai per modificare le informazioni del Click Master <b>"+ name +"</b>. L'azione è irreversibile.");
			$(this).find('.btn-primary').addClass('ed')
		}
	});

	$('.confirm').on('hidden.bs.modal', function (event) {
		$(this).find('.btn-primary').removeClass('del').removeClass('ed');
		$(this).find('.modal-body p').text('');
		chosen = -1;
		$rowEl = -1;
		editing = -1;
		$rowEle = -1
	});

	function rebuild(chosen){
		var tmp = [];
		for(i=0; i<cms.length; i++){
			if(cms[i].ID!=chosen)
				tmp.push(cms[i]);
		}
		cms = tmp;
	}

	$('.confirm').on('click', '.del', function(){
		$.ajax({
			method: 'POST',
			dataType: 'json',
			url: window.base_url + 'dashboard/deleteCm/',
			data: 'ID='+chosen,
			beforeSend: function(){
				$('.modal-footer .btn-primary').button('loading').delay(100).append('.').delay(100).append('.');
			},
			success: function(data){
				$('.modal-footer .btn-primary').button('reset');
				$('.confirm').modal('hide');
				p = $rowEl.parent();
				el = $('#cmPages .active');
				rebuild(chosen);
				$rowEl.fadeOut('750', function(){
					$(this).remove();
					pages = Math.ceil(cms.length/pageSpan);
					maxOffset = pageSpan * (pages-1);
					el = $('#cmPages .active');
					ofst = el.data('offset');
					if(ofst>maxOffset)
						ofst=maxOffset;
					updatePaginator(ofst);
					showPage(ofst);
				});
			},
			error: function(data){
				$('.modal-footer .btn-primary').button('reset');
				$(this).find('.modal-body p').html('<span class="text-danger">Si è verificato un errore, riprovare più tardi.</span>');
			}
		});
	});
	prevCount = -1;
	$('.confirm').on('click', '.ed', function(){
		valid = true;
		removeErrors();
		if(!checkNamePunct($('#newName'))){valid = false;}
		if(!checkNamePunct($('#newSurname'))){valid = false;}
		if($.trim($('#newCode').val()) == ""){
			valid = false;
		}
		if(!checkEmail($('#newMail'))){valid = false;}
		if(valid){
			$.ajax({
				method: 'POST',
				dataType: 'json',
				url: window.base_url + 'dashboard/editCm/',
				data: 'ID='+$rowEle+'&'+$('#newName').serialize()+'&'+$('#newSurname').serialize()+'&'+$('#newCode').serialize()+'&'+$('#newMail').serialize(),
				success: function(data){
					editing.empty().append('<td class="cmName"><b>'+data.name+ ' ' +data.surname+'</b></td><td class="cmCode">'+data.code+'</td><td class="cmEmail">'+data.email+'</td><td class="cmUsers"><span>'+prevCount+'</span><span class="glyphicon glyphicon-search"></span></td><td class="cmActions"><span class="label label-info"><span class="glyphicon glyphicon-pencil"></span></span> <span data-toggle="modal" data-target=".confirm" data-action="delete" class="label label-danger"><span class="glyphicon glyphicon-remove"></span></span></td>');
					$('.confirm').modal('hide');
					$.each($('.label-info, .label-danger'), function(){
						$(this).removeClass('disabled').attr('data-target', '.confirm');;
					});
				},
				error: function(data){
					if(data.status == 409){
						$('.addCM .text-danger').removeClass('hidden').text(data.responseJSON);
					}else{
						$('.addCM .text-danger').removeClass('hidden').text('Si è verificato un errore inaspettato, aggiornare la pagina e ritentare');
					}
				}
			});
		}
	});

	$('.cmT').on('click', '.label-info', function(){
		if(!$(this).hasClass('disabled')){
			editing = $(this).parent().parent();
			$rowEle = editing.data('id');
			$.each($('.label-info, .label-danger'), function(){
				if($(this).parent().parent().attr('data-id')==$rowEle){
					return
				}else{
					$(this).addClass('disabled').removeAttr('data-target');
				}

			});
			$name = $(this).parent().siblings('.cmName');
			$name.attr('prev', $name.text());
			$tmp = $name.text().split(' ');
			$name.html('<div class="col-md-5"><input type="text" value="'+$tmp[0]+'" id="newName" placeholder="Nome" name="name" autocomplete="off" class="form-control input-md"></div><div class="col-md-5"><input type="text" value="'+$tmp[1]+'" id="newSurname" placeholder="Cognome" name="surname" autocomplete="off" class="form-control input-md"></div>');
			$code = $(this).parent().siblings('.cmCode');
			$code.attr('prev', $code.text());
			$code.html('<div class="col-md-5"><input type="text" value="'+$code.text()+'" id="newCode" name="code" autocomplete="off" class="form-control input-md"></div>');
			$email = $(this).parent().siblings('.cmEmail');
			$email.attr('prev', $email.text());
			$email.html('<div class="col-md-8"><input type="email" value="'+$email.text()+'" id="newMail" name="email" autocomplete="off" class="form-control input-md"></div>');
			prevCount = $(this).parent().siblings('.cmUsers').text();
			$(this).parent().empty().append('<span class="label label-default"><span class="glyphicon glyphicon-arrow-left"></span></span> <span data-toggle="modal" data-target=".confirm" data-action="edit" class="label label-success"><span class="glyphicon glyphicon-ok"></span></span>');
		}
	});

	$('.cmT').on('click', '.label-default', function(){
		$name = $(this).parent().siblings('.cmName');
		$name.empty().append('<b>'+$name.attr('prev')+'</b>');
		$code = $(this).parent().siblings('.cmCode');
		$code.empty().append($code.attr('prev'));
		$email = $(this).parent().siblings('.cmEmail');
		$email.empty().append($email.attr('prev'));
		$(this).parent().empty().append('<span class="label label-info"><span class="glyphicon glyphicon-pencil"></span></span> <span data-toggle="modal" data-target=".confirm" data-action="delete" class="label label-danger"><span class="glyphicon glyphicon-remove"></span></span>');
		$.each($('.label-info, .label-danger'), function(){
			$(this).removeClass('disabled').attr('data-target', '.confirm');;
		});
	});

	user = [];
	mOff = 0;
	pgSp = 0;
	pg = 0;
	cr = 0;

	function showPageUsers(offset){
		offset = parseInt(offset);
		$('.detailsClickWidget .prev, .detailsClickWidget .next').removeClass('disabled');
		if(offset==0)$('.detailsClickWidget .prev').addClass('disabled');
		if(offset==mOff) $('.detailsClickWidget .next').addClass('disabled');
		if(offset<mOff){
			$('.detailsClickWidget .table-striped tbody').empty();
			for(var i = offset; i < offset+pgSp; i++){
				$('.detailsClickWidget .table-striped tbody').append('<tr class="user-line" data-ID="'+user[i].ID+'"><td><div class="status-circle status'+user[i].status+'"></div></td><td><b>'+user[i].name+'</b></td><td>'+user[i].join+'</td><td>'+user[i].clickM+'</td><td>'+user[i].approved+'</td><td>'+user[i].code+'</td><td>'+user[i].screen+'</td></tr>');
			};
		}else{
			$('.detailsClickWidget .table-striped tbody').empty()
			for(var i = offset; i < user.length; i++){
				$('.detailsClickWidget .table-striped tbody').append('<tr class="user-line" data-ID="'+user[i].ID+'"><td><div class="status-circle status'+user[i].status+'"></div></td><td><b>'+user[i].name+'</b></td><td>'+user[i].join+'</td><td>'+user[i].clickM+'</td><td>'+user[i].approved+'</td><td>'+user[i].code+'</td><td>'+user[i].screen+'</td></tr>');
			};
		}
		cr = offset;
	}

	function nextPageUsers(el){
		if(el.hasClass('disabled')) return;
		else
		if(el.hasClass('prev')){
			if(cr>0){
				el = $('#usrPages .active').prev();
				$('#usrPages li').removeClass('active');
				el.addClass('active');
			}
			showPageUsers(cr-pgSp)
		}else{
			if(cr<mOff){
				el = $('#usrPages .active').next();
				$('#usrPages li').removeClass('active');
				el.addClass('active');
			}
			showPageUsers(cr+pgSp);
		}
	}

	$('#usrPages').on('click','li', function(){
		if($(this).hasClass('active')) return;
		else if($(this).hasClass('usrA')){
			nextPageUsers($(this));
		}
		else{
			$('#usrPages li').removeClass('active');
			$(this).addClass('active');
			showPageUsers($(this).attr('data-offset'));
		}
	});

	function createUserPages(){
		$('.detailsClickWidget .panel-footer').removeClass('hidden');
		$('#usrPages').empty().append('<li class="disabled usrA prev"><a href="#" aria-label="Previous"><span aria-hidden="true">&laquo;</span></a></li>');
		c = 0;
		while(c<pg){
			if(c==0) a = 'class="active"';
			else a = '';
			$('#usrPages').append('<li '+a+' data-offset="'+ c*pgSp +'"><a href="#">'+ (c+1) +'</a></li>');
			c++;
		}
		if(pg==1) d = 'disabled';
		else d = '';
		$('#usrPages').append('<li class="'+d+' usrA next"><a href="#" aria-label="Next"><span aria-hidden="true">&raquo;</span></a></li>');
	}

	$('.table-striped').on('click', '.cmName, .cmCode, .cmEmail, .cmUsers', function (e) {
		var ID = $(this).parent().data('id')
		window.location.href = window.base_url + "dashboard/clickmaster/" + ID
	})

	$('button.newCm').click(function(){
		removeErrors();
		valid = true;
		if(!checkNamePunct($('.form-control[name=name]'))){$('.addCM .text-danger').removeClass('hidden').text('Inserisci un nome valido.'); valid = false;}
		if(valid && !checkNamePunct($('.form-control[name=surname]'))){$('.addCM .text-danger').removeClass('hidden').text('Inserisci un cognome valido.'); valid = false;}
		if(valid && !checkEmail($('.form-control[name=email]'))){$('.addCM .text-danger').removeClass('hidden').text('Inserisci un indirizzo eMail valido.'); valid = false;}
		if(valid && $.trim($('.form-control[name=code]').val()) == ""){
			$('.addCM .text-danger').removeClass('hidden').text('Inserisci un codice valido.'); valid = false;
		}
		if(valid){
			$.ajax({
				method: 'POST',
				dataType: 'json',
				url: window.base_url + 'dashboard/addCM/',
				data: $('.form-control[name=name]').serialize()+'&'+$('.form-control[name=surname]').serialize()+'&'+$('.form-control[name=email]').serialize()+'&'+$('.form-control[name=code]').serialize(),
				beforeSend: function(){
					$('button.newCm').addClass('disabled').attr('disabled','disabled');
				},
				success: function(data){
					$('button.newCm').removeClass('disabled').removeAttr('disabled');
					$('button.newCm span').addClass('animated fadeOutUp').one('webkitAnimationEnd mozAnimationEnd MSAnimationEnd oanimationend animationend', function(){
			            $(this).removeClass('animated fadeOutUp');
			        });
					$('.addCM .form-control').val('');
					obj = {'ID': data.ID, 'name': data.usr.name+ ' '+ data.usr.surname, 'email': data.usr.email, 'code': data.usr.code, 'users': 0};
					cms.unshift(obj);
					pages = Math.ceil(cms.length/pageSpan);
					maxOffset = pageSpan * (pages-1);
					el = $('#cmPages .active');
					ofst = el.data("offset");
					updatePaginator(ofst);
					showPage(0);
					$("#pag1").click();
				},
				error: function(data){
					$('button.newCm').button('reset');
					if(data.status == 409){
						$('.addCM .text-danger').removeClass('hidden').text(data.responseJSON);
					}else{
						$('.addCM .text-danger').removeClass('hidden').text('Si è verificato un errore inaspettato, aggiornare la pagina e ritentare');
					}
				}
			});
		}else{
			return
		}
	});

	$('.addCM .form-control').keypress(function (e) {
		key = e.which;
		if(key == 13){
			$('button.newCm').click();
			return;
		}
	});
});
