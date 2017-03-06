var $ = window.$
var jlinq = window.jlinq

$(document).ready(function () {
  var role = window.role
  var users_mnpl = window.users
  var pageSpan = window.pageSpan
  var maxOffset = window.maxOffset
  var projects_classic = window.projects_classic
  var projects_sc = window.projects_sc
  var fixcode = window.fixcode
  var current = 0
  var old_filter = ''
  var destID

  $('#search').keyup(function () {
    $('tbody').empty()
    // Retrieve the input field text and reset the count to zero
    var filter = $.trim($(this).val())
    if (filter.length <= 3) {
      if (users_mnpl.length !== window.users) {
    		users_mnpl = window.users
        var pages = Math.ceil(users_mnpl.length / pageSpan)
        maxOffset = pageSpan * (pages - 1)
        var el = $('#usrPages .active')
        var ofst = el.data('offset')
        if (typeof ofst === 'undefined') ofst = 0
        if (ofst > maxOffset) ofst = maxOffset
        updatePaginator(ofst)
        showPage(ofst)

        /*
        for (i=current; i < pageSpan + current; i++) {
        region = ''
        sent = ''
        if (users_mnpl[i].code_rec=="No") {
          select_projects_classic = "<select id='select_classic" + users_mnpl[i].ID + "' class='select_code_classic'><option value='---'>---</option>";

          select_projects_sc = "<select id='select_sc" + users_mnpl[i].ID + "' class='select_code_sc'><option value='---'>---</option>";
        } else {
          select_projects_classic = "<select id='select_classic" + users_mnpl[i].ID + "' class='select_code_classic' disabled><option value='---'>---</option>";

          select_projects_sc = "<select id='select_sc" + users_mnpl[i].ID + "' class='select_code_sc' disabled><option value='---'>---</option>";

          sent = "sent";
        }
        for(k=0; k<projects_classic.length; k++){
          if(users_mnpl[i].code!=projects_classic[k].file){
            select_projects_classic = select_projects_classic + "<option value='"+ projects_classic[k].region +"'>"+ projects_classic[k].file +"</option>";
          } else {
            select_projects_classic = select_projects_classic + "<option value='"+ projects_classic[k].region +"' selected>"+ projects_classic[k].file +"</option>";
            region = users_mnpl[i].region;
          }
        }
        select_projects_classic = select_projects_classic + "</select>";

        for(k=0; k<projects_sc.length; k++){
          if(users_mnpl[i].code!=projects_sc[k].file){
            select_projects_sc = select_projects_sc + "<option value='"+ projects_sc[k].region +"'>"+ projects_sc[k].file +"</option>";
          } else {
            select_projects_sc = select_projects_sc + "<option value='"+ projects_sc[k].region +"' selected>"+ projects_sc[k].file +"</option>";
            region = users_mnpl[i].region;
          }
        }
        select_projects_sc = select_projects_sc + "</select>";

        $('tbody').append('<tr class="user-line" data-id="'+users_mnpl[i].ID+'" data-name="'+users_mnpl[i].name+'"><td><div class="status-circle status'+users_mnpl[i].status+'"></div></td><td class="cName"><b>'+users_mnpl[i].name+'</b></td><td>'+users_mnpl[i].join+'</td><td>'+users_mnpl[i].clickM+'</td><td>'+users_mnpl[i].approved+'</td><td>'+users_mnpl[i].code_rec+'</td><td>'+users_mnpl[i].screen+'</td><td>'+users_mnpl[i].contract+'</td><td '+fixcode+' class="select_td">'+select_projects_classic+'</td><td '+fixcode+' class="select_td">'+select_projects_sc+'</td><td '+fixcode+' class="select_region">'+region+'<td '+fixcode+' class="sendcode '+sent+'"><span class="glyphicon glyphicon-arrow-right"></span></td><td class="setsendmessage2"><span class="glyphicon glyphicon-envelope"></span></td><td class="noDet"><span data-toggle="modal" data-target=".confirm" data-action="delete" class="label label-danger"><span class="glyphicon glyphicon-remove"></span></span></td></tr>');
      }
        */
        return
      }
    }

    console.log(filter)
    console.log(users_mnpl)

    var $c = 0
    if (filter.length > old_filter.length)
      users_mnpl = jlinq.from(users_mnpl).starts('name', filter).or().starts('inverted_name', filter).select()
        else
    		users_mnpl = jlinq.from(window.users).starts('name', filter).or().starts('inverted_name',filter).select();
    	$.each(users_mnpl, function (i) {
				region = ''
				sent = ''
				/*
				if(users_mnpl[i].code_rec=="No") {
					select_projects_classic = "<select id='select_classic" + users_mnpl[i].ID + "' class='select_code_classic'><option value='---'>---</option>";

					select_projects_sc = "<select id='select_sc" + users_mnpl[i].ID + "' class='select_code_sc'><option value='---'>---</option>";
				} else {
					select_projects_classic = "<select id='select_classic" + users_mnpl[i].ID + "' class='select_code_classic' disabled><option value='---'>---</option>";

					select_projects_sc = "<select id='select_sc" + users_mnpl[i].ID + "' class='select_code_sc' disabled><option value='---'>---</option>";

					sent = "sent";
				}
				for(k=0; k<projects_classic.length; k++){
					if(users_mnpl[i].code!=projects_classic[k].file){
						select_projects_classic = select_projects_classic + "<option value='"+ projects_classic[k].region +"'>"+ projects_classic[k].file +"</option>";
					}
					else{
						select_projects_classic = select_projects_classic + "<option value='"+ projects_classic[k].region +"' selected>"+ projects_classic[k].file +"</option>";
						region = users_mnpl[i].region;
					}
				}
				select_projects_classic = select_projects_classic + "</select>";

				for(k=0; k<projects_sc.length; k++){
						if(users_mnpl[i].code!=projects_sc[k].file){
							select_projects_sc = select_projects_sc + "<option value='"+ projects_sc[k].region +"'>"+ projects_sc[k].file +"</option>";
						}
						else{
							select_projects_sc = select_projects_sc + "<option value='"+ projects_sc[k].region +"' selected>"+ projects_sc[k].file +"</option>";
							region = users_mnpl[i].region;
						}
					}
					select_projects_sc = select_projects_sc + "</select>";

				$('tbody').append('<tr class="user-line" data-id="'+users_mnpl[i].ID+'" data-name="'+users_mnpl[i].name+'"><td><div class="status-circle status'+users_mnpl[i].status+'"></div></td><td class="cName"><b>'+users_mnpl[i].name+'</b></td><td>'+users_mnpl[i].join+'</td><td>'+users_mnpl[i].clickM+'</td><td>'+users_mnpl[i].approved+'</td><td>'+users_mnpl[i].code_rec+'</td><td>'+users_mnpl[i].screen+'</td><td>'+users_mnpl[i].contract+'</td><td class="select_td">'+select_projects_classic+'</td><td class="select_td">'+select_projects_sc+'</td><td class="select_region">'+region+'<td class="sendcode '+sent+'"><span class="glyphicon glyphicon-arrow-right"></span></td><td class="setsendmessage2"><span class="glyphicon glyphicon-envelope"></span></td><td class="noDet"><span data-toggle="modal" data-target=".confirm" data-action="delete" class="label label-danger"><span class="glyphicon glyphicon-remove"></span></span></td></tr>');

                */
                $c++;
        });
        if($c==0){
        	$('tbody').append('<tr class="user-line"><td>Nessun Risultato</td></tr>');
        }
        old_filter = filter
        pages = Math.ceil(users_mnpl.length/pageSpan);
		maxOffset = pageSpan * (pages-1);
		el = $('#usrPages .active');
		ofst = el.data('offset');
		if(typeof ofst == 'undefined')
			ofst = 0
		if(ofst>maxOffset)
			ofst=maxOffset;
		console.log(ofst)
		updatePaginator(ofst);
		showPage(ofst);
    });

	function showPage(offset){
		if(users_mnpl.length==0)
			return;
		offset = parseInt(offset);
		$('.prev, .next').removeClass('disabled');
		if(offset==0)$('.prev').addClass('disabled');
		if(offset==maxOffset) $('.next').addClass('disabled');
		if(offset<maxOffset){
			$('.table-striped tbody').empty();
			for(var i = offset; i < offset+pageSpan; i++){
				region = "";
				sent = "";
				if(users_mnpl[i].code_rec=="No") {
					select_projects_classic = "<select id='select_classic" + users_mnpl[i].ID + "' class='select_code_classic'><option value='---'>---</option>";

					select_projects_sc = "<select id='select_sc" + users_mnpl[i].ID + "' class='select_code_sc'><option value='---'>---</option>";
				}
				else{
					select_projects_classic = "<select id='select_classic" + users_mnpl[i].ID + "' class='select_code_classic' disabled><option value='---'>---</option>";

					select_projects_sc = "<select id='select_sc" + users_mnpl[i].ID + "' class='select_code_sc' disabled><option value='---'>---</option>";

					sent = "sent";
				}
				for(k=0; k<projects_classic.length; k++){
					if(users_mnpl[i].code!=projects_classic[k].file){
						select_projects_classic = select_projects_classic + "<option value='"+ projects_classic[k].region +"'>"+ projects_classic[k].file +"</option>";
					}
					else{
						select_projects_classic = select_projects_classic + "<option value='"+ projects_classic[k].region +"' selected>"+ projects_classic[k].file +"</option>";
						region = users_mnpl[i].region;
					}
				}
				select_projects_classic = select_projects_classic + "</select>";

				for(k=0; k<projects_sc.length; k++){
						if(users_mnpl[i].code!=projects_sc[k].file){
							select_projects_sc = select_projects_sc + "<option value='"+ projects_sc[k].region +"'>"+ projects_sc[k].file +"</option>";
						}
						else{
							select_projects_sc = select_projects_sc + "<option value='"+ projects_sc[k].region +"' selected>"+ projects_sc[k].file +"</option>";
							region = users_mnpl[i].region;
						}
					}
				select_projects_sc = select_projects_sc + "</select>";

				$('.table-striped tbody').append('<tr class="user-line" data-id="'+users_mnpl[i].ID+'" data-name="'+users_mnpl[i].name+'"><td><div class="status-circle status'+users_mnpl[i].status+'"></div></td><td class="cName"><b>'+users_mnpl[i].name+'</b></td><td>'+users_mnpl[i].join+'</td><td>'+users_mnpl[i].clickM+'</td><td>'+users_mnpl[i].approved+'</td><td>'+users_mnpl[i].code_rec+'</td><td>'+users_mnpl[i].screen+'</td><td>'+users_mnpl[i].contract+'</td><td class="select_td">'+select_projects_classic+'</td><td class="select_td">'+select_projects_sc+'</td><td class="select_region">'+region+'<td class="sendcode '+sent+'"><span class="glyphicon glyphicon-arrow-right"></span></td><td class="setsendmessage2"><span class="glyphicon glyphicon-envelope"></span></td><td class="noDet"><span data-toggle="modal" data-target=".confirm" data-action="delete" class="label label-danger"><span class="glyphicon glyphicon-remove"></span></span></td></tr>');
			};
		}else{
			$('.table-striped tbody').empty()
			for(var i = offset; i < users_mnpl.length; i++){
				region = "";
				sent = "";
				if(users_mnpl[i].code_rec=="No") {
					select_projects_classic = "<select id='select_classic" + users_mnpl[i].ID + "' class='select_code_classic'><option value='---'>---</option>";

					select_projects_sc = "<select id='select_sc" + users_mnpl[i].ID + "' class='select_code_sc'><option value='---'>---</option>";
				}
				else{
					select_projects_classic = "<select id='select_classic" + users_mnpl[i].ID + "' class='select_code_classic' disabled><option value='---'>---</option>";

					select_projects_sc = "<select id='select_sc" + users_mnpl[i].ID + "' class='select_code_sc' disabled><option value='---'>---</option>";

					sent = "sent";
				}
				for(k=0; k<projects_classic.length; k++){
					if(users_mnpl[i].code!=projects_classic[k].file){
						select_projects_classic = select_projects_classic + "<option value='"+ projects_classic[k].region +"'>"+ projects_classic[k].file +"</option>";
					}
					else{
						select_projects_classic = select_projects_classic + "<option value='"+ projects_classic[k].region +"' selected>"+ projects_classic[k].file +"</option>";
						region = users_mnpl[i].region;
					}
				}
				select_projects_classic = select_projects_classic + "</select>";

				for(k=0; k<projects_sc.length; k++){
						if(users_mnpl[i].code!=projects_sc[k].file){
							select_projects_sc = select_projects_sc + "<option value='"+ projects_sc[k].region +"'>"+ projects_sc[k].file +"</option>";
						}
						else{
							select_projects_sc = select_projects_sc + "<option value='"+ projects_sc[k].region +"' selected>"+ projects_sc[k].file +"</option>";
							region = users_mnpl[i].region;
						}
					}
				select_projects_sc = select_projects_sc + "</select>";

				$('.table-striped tbody').append('<tr class="user-line" data-id="'+users_mnpl[i].ID+'" data-name="'+users_mnpl[i].name+'"><td><div class="status-circle status'+users_mnpl[i].status+'"></div></td><td class="cName"><b>'+users_mnpl[i].name+'</b></td><td>'+users_mnpl[i].join+'</td><td>'+users_mnpl[i].clickM+'</td><td>'+users_mnpl[i].approved+'</td><td>'+users_mnpl[i].code_rec+'</td><td>'+users_mnpl[i].screen+'</td><td>'+users_mnpl[i].contract+'</td><td class="select_td">'+select_projects_classic+'</td><td class="select_td">'+select_projects_sc+'</td><td class="select_region">'+region+'<td class="sendcode '+sent+'"><span class="glyphicon glyphicon-arrow-right"></span></td><td class="setsendmessage2"><span class="glyphicon glyphicon-envelope"></span></td><td class="noDet"><span data-toggle="modal" data-target=".confirm" data-action="delete" class="label label-danger"><span class="glyphicon glyphicon-remove"></span></span></td></tr>');
			};
		}
		current = offset;
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
		$('#usrPages').empty().append('<li class="disabled ext prev"><a href="#" aria-label="Previous"><span aria-hidden="true">&laquo;</span></a></li>');
		var c = 0;
		if(ac>pages)
			ac=(pages-1)*pageSpan;
		while(c < pages){
			if(eval(c*pageSpan)==eval(ac)){
				$('#usrPages').append('<li class="active" id="pag'+(c+1)+'" data-offset="'+ (c*pageSpan) +'"><a href="#">'+ (c+1) +'</a></li>');
			}else{
				$('#usrPages').append('<li id="pag'+(c+1)+'" data-offset="'+ (c*pageSpan) +'"><a href="#">'+ (c+1) +'</a></li>');
			}
			c++;
		}
		k = '';
		if(pages==1) k='disabled';
		$('#usrPages').append('<li class="'+k+' ext next"><a href="#" aria-label="Next"><span aria-hidden="true">&raquo;</span></a></li>')
	}

	$('#usrPages').on('click','li', function(){
		if($(this).hasClass('active')) return;
		else if($(this).hasClass('ext')){
			nextPage($(this));
		}
		else{
			$('#usrPages li').removeClass('active');
			$(this).addClass('active');
			showPage($(this).attr('data-offset'));
		}
	});

	$('.print').click(function(){
		pop_up= window.open(window.base_url+'dashboard/printList', "PopUpName");
		var x = setTimeout(function(){
			pop_up.document.write('<script type="text/javascript">window.onload=window.close();</script>');
		}, 5000);
	});

	$('body').on('change', '.select_code_classic', function(e){
		if($(this).val()!="---") {
			$(this).parent().parent().find(".select_region").html($(this).val());

			$(this).parent().parent().find(".select_td > .select_code_sc").val('---')

			ID = $(this).parent().parent().data('id');
			selected = $("#select_classic"+ID+" option:selected" ).text();
			region = $("#select_classic"+ID+" option:selected" ).val();
			setcode(ID, selected, region);
			$(this).parent().parent().find(".sendcode").addClass("sendready");
		}
		else {
			setcode(ID, '', '');
			$(this).parent().parent().find(".select_region").html("");
			$(this).parent().parent().find(".sendcode").removeClass("sendready");
		}
	});

	$('body').on('change', '.select_code_sc', function(e){
		if($(this).val()!="---") {
			$(this).parent().parent().find(".select_region").html($(this).val());

			$(this).parent().parent().find(".select_td > .select_code_classic").val('---')

			ID = $(this).parent().parent().data('id');
			selected = $("#select_sc"+ID+" option:selected" ).text();
			region = $("#select_sc"+ID+" option:selected" ).val();
			setcode(ID, selected, region);
			$(this).parent().parent().find(".sendcode").addClass("sendready");
		}
		else {
			setcode(ID, '', '');
			$(this).parent().parent().find(".select_region").html("");
			$(this).parent().parent().find(".sendcode").removeClass("sendready");
		}
	});

	function setcode(ID, selected, region){
		$.ajax({
			method: 'POST',
			dataType: 'json',
			url: window.base_url + 'dashboard/setcode/',
			data: 'ID='+ID+'&code='+selected+"&region="+region,
			success: function(data){
			}
		});

	}

	$('body').on('click', '.setsendmessage2', function(){
		$('#messDest').html($(this).parent().data('name'));
		destID = $(this).parent().data('id')
		console.log($(this).parent().data('id'));
		$('.sendmessage2').modal('show');
	});

	chosen2 = -1;
	$rowEl2 = -1;
	btn = null;
	$('body').on('click', '.sendcode', function(){
		if(!($(this).hasClass("sent"))){
			ID = $(this).parent().data('id');
			selected = $("#select_classic"+ID+" option:selected" ).text();
			if(selected == "---") {
				selected = $("#select_sc"+ID+" option:selected" ).text();
				if(selected == "---") {
					return;
				}
				else {
					region = $("#select_sc"+ID+" option:selected" ).val();
				}
			}
			else {
				region = $("#select_classic"+ID+" option:selected" ).val();
			}

			btn = $(this);
			if(selected!="") {
				$.ajax({
					method: 'POST',
					dataType: 'json',
					url: window.base_url + 'dashboard/sendcode/',
					data: 'ID='+ID+'&code='+selected+"&region="+region,
					success: function(data){
						btn.removeClass("sendready");
						btn.addClass("sent");
						$("#select_classic"+ID).prop('disabled', true);
						$("#select_sc"+ID).prop('disabled', true);
            console.log(data)
					}
				});
			}
		}
		else {
			//event.stopPropagation();
			$('.confirm2').modal('show');
			$rowEl2 = $(this).parent();
			chosen2 = $(this).parent().data('id');
			name2 = $(this).parent().find('.cName').html();
			btn = $(this);
			$('.confirm2 .modal-body p').html("Vuoi riassegnare un nuovo codice per l'utente "+ name2 +"?");
		}
	});

	$('.confirm2').on('click', '.delcode', function(){
		$.ajax({
			method: 'POST',
			dataType: 'json',
			url: window.base_url + 'dashboard/deleteUserCode/',
			data: 'ID='+chosen2,
			beforeSend: function(){
				$('.confirm2 .modal-footer .btn-primary').button('loading').delay(100).append('.').delay(100).append('.');
			},
			success: function(data){
				$('.confirm2 .modal-footer .btn-primary').button('reset');
				$('.confirm2').modal('hide');
				$("#select"+chosen2).prop('disabled', false);
				//$("#select"+chosen2).val('---');
				//btn.parent().find('.select_region').html("");
				btn.removeClass("sent");


			},
			error: function(data){
				$('.confirm2 .modal-footer .btn-primary').button('reset');
				$(this).find('.confirm2 .modal-body p').html('<span class="text-danger">Si è verificato un errore, riprovare più tardi.</span>');
			}
		});
	});

	$('button.sendmessageDo2').click(function(){
		removeErrors();
		if($('.sendmessage2 .form-control[name=oggetto]').val() === "" && $('.sendmessage2 .text-danger').hasClass('hidden')){
			$('.sendmessage2 .form-control[name=oggetto]').parent().addClass('has-error');
			$('.sendmessage2 .text-danger').text('Inserisci un oggetto').removeClass('hidden');
		}else{
			if($('.sendmessage2 .form-control[name=testo]').val() === "" && $('.sendmessage2 .text-danger').hasClass('hidden')){
				$('.sendmessage2 .form-control[name=testo]').parent().addClass('has-error');
				$('.sendmessage2 .text-danger').text('Inserisci un testo').removeClass('hidden');
			}
		}
		if($('.sendmessage2 .text-danger').hasClass('hidden')){
			type = 0;
			destRole='user';
			if(role=='admin')
				type=-27;
			if(role=='clickMaster')
				type=-24;
			$.ajax({
				method: 'POST',
				dataType: 'json',
				url: window.base_url + 'dashboard/sendmessage/',
				data: $('.sendmessage2 .oggetto').serialize()+'&'+$('.sendmessage2 .testo').serialize()+'&type='+type+'&destID='+destID+'&parent=-1',
				beforeSend: function(){
					$('button.sendmessageDo2').button('loading');
				},
				success: function(data){
					$('button.sendmessageDo2').button('reset');
					$('.sendmessage2').modal('hide');
				}
			});
		}
	});

	$('.userListWidget').on('click', '.user-line td', function(){
		if( ($(this).hasClass('noDet'))||($(this).hasClass('setsendmessage2'))||($(this).hasClass('select_td'))||($(this).hasClass('sendcode')) ){
			return;
		}else{
			$.ajax({
				method: 'POST',
				dataType: 'json',
				url: window.base_url + 'dashboard/getDetailsUs/',
				data: 'ID='+$(this).parent().data('id'),
				beforeSend: function(){

				},
				success: function(data){
					$('#userDetails .detName span').text(data.name+' '+data.surname);
					$('#userDetails .detEmail span').text(data.email);
					$('#userDetails .detAddr span').text(data.address+', '+data.cap+', '+data.prov+', '+data.country);
					$('#userDetails .detBirth span').text(data.dateBirth);
					$('#userDetails .detCf span').text(data.cf);
					$('#userDetails .detPhone span').text(data.phone);
					$('#userDetails .detWork span').text(data.work);
					$('#userDetails .detJoin span').text(data.joinDate);
					if(data.lastSeen==null) $('#userDetails .detLast span').text('-');
					else $('#userDetails .detLast span').text(data.lastSeen);
					$('.detScreen').empty();
					if(data.screen_uploaded==0) $('.detScreen').append("<span>L'utente non ha ancora caricato uno screenshot</span>");
					else $('.detScreen').append('<img src="'+window.base_url+'/assets/uploads/screenshots/'+data.screen_file+'" class="img-responsive"/>');
					$('.detCont').empty();
					if(data.cont_uploaded==0) $('.detCont').append("<span>L'utente non ha ancora caricato il proprio contratto</span>");
					else $('.detCont').append('<a href="'+window.base_url+'assets/uploads/contratti/'+data.contract_file+'" target="_blank">Visualizza contratto</a>');
					$('.userDetails').modal('toggle');
				},
				error: function(data){
					console.log()
					if(data.status == 409){
						$('.userDetails .modal-body').append('<p class="text-danger">'+data.responseJSON+'</p>');
					}else{
						$('.userDetails .modal-body').append('<p class="text-danger">Si è verificato un errore inaspettato, aggiornare la pagina e ritentare</p>');
					}
				}
			});
		}
	});

	chosen = -1;
	$rowEl = -1;
	$('body').on('click', '.label-danger', function(event){
		event.stopPropagation();
		$('.confirm').modal('show');
		$rowEl = $(this).parent().parent();
		chosen = $rowEl.data('id');
		if($(this).data('action')=='delete'){
			name = $(this).parent().siblings('.cName').html();
			$('.confirm .modal-body p').html("Stai per eliminare l'utente "+ name +". L'azione è irreversibile.");
			$('.confirm .btn-primary').addClass('del');
		}else{
			return;
		}
	});

	$('.confirm').on('hidden.bs.modal', function (event) {
		$(this).find('.btn-primary').removeClass('del').removeClass('ed');
		$(this).find('.modal-body p').text('');
		chosen = -1;
		$rowEl = -1;
	});

	function rebuild(chosen){
		var tmp = [];
		for(i=0; i<users_mnpl.length; i++){
			if(users_mnpl[i].ID!=chosen)
				tmp.push(users_mnpl[i]);
		}
		users_mnpl = tmp;
	}

	$('.confirm').on('click', '.del', function(){
		$.ajax({
			method: 'POST',
			dataType: 'json',
			url: window.base_url + 'dashboard/deleteUser/',
			data: 'ID='+chosen,
			beforeSend: function(){
				$('.confirm .modal-footer .btn-primary').button('loading').delay(100).append('.').delay(100).append('.');
			},
			success: function(data){
				$('.confirm .modal-footer .btn-primary').button('reset');
				$('.confirm').modal('hide');
				rebuild(chosen);
				$rowEl.fadeOut('750', function(){
					$(this).remove();
					pages = Math.ceil(users_mnpl.length/pageSpan);
					maxOffset = pageSpan * (pages-1);
					el = $('#usrPages .active');
					ofst = el.data('offset');
					if(ofst>maxOffset)
						ofst=maxOffset;
					updatePaginator(ofst);
					showPage(ofst);
				});
			},
			error: function (data) {
				$('.confirm .modal-footer .btn-primary').button('reset')
				$(this).find('.modal-body p').html('<span class="text-danger">Si è verificato un errore, riprovare più tardi.</span>')
			}
})
})
})
