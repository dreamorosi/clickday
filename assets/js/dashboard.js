var mail;

$(document).ready(function(){
	recMail = window.mails;
	recPgSp = window.pageSpan;
	recMaxO = window.maxOffset;
	recPags = window.pages;
	nots = window.nots;
	mails = recMail;
	pageSpan = recPgSp;
	maxOffset = recMaxO;
	pages = recPags;
	current = 0;
	currentDir = 'rec';
	interv = 0;
	jQuery.extend({
		handleError: function( s, xhr, status, e ) {
			if ( s.error )
			s.error( xhr, status, e );
			else if(xhr.responseText)
            console.log(xhr.responseText);
		}
	});

	$('.sendmessage .checkbox').click(function(){
		if(this.checked==false){
			this.setAttribute("checked", "");
			this.removeAttribute("checked");
			this.checked = false;
		}
		else{
			this.setAttribute("checked", "checked");
			this.checked = true;
		}
	});

	$('button.sendmessageDo').click(function(){
		removeErrors();
		if((!($('.sendmessage .checkbox #admin-check').prop('checked')))&&(!($('.sendmessage .checkbox #cm-check').prop('checked')))&&(role=='user')){
			$('.sendmessage .text-danger').text('Seleziona almeno un destinatario').removeClass('hidden');
		}else{
			if((!($('.sendmessage .checkbox #admin-check').prop('checked')))&&(!($('.sendmessage .checkbox #users-check').prop('checked')))&&(role=='clickMaster')){
				$('.sendmessage .text-danger').text('Seleziona almeno un destinatario').removeClass('hidden');
			}else{
				if((!($('.sendmessage .checkbox #cm-check').prop('checked')))&&(!($('.sendmessage .checkbox #users-check').prop('checked')))&&(role=='admin')){
					$('.sendmessage .text-danger').text('Seleziona almeno un destinatario').removeClass('hidden');
				}else{
					if($('.sendmessage .form-control[name=oggetto]').val() === "" && $('.sendmessage .text-danger').hasClass('hidden')){
						$('.sendmessage .form-control[name=oggetto]').parent().addClass('has-error');
						$('.sendmessage .text-danger').text('Inserisci un oggetto').removeClass('hidden');
					}else{
						if($('.sendmessage .form-control[name=testo]').val() === "" && $('.sendmessage .text-danger').hasClass('hidden')){
							$('.sendmessage .form-control[name=testo]').parent().addClass('has-error');
							$('.sendmessage .text-danger').text('Inserisci un testo').removeClass('hidden');
						}
					}
				}
			}
		}
		if($('.sendmessage .text-danger').hasClass('hidden')){
			type = 0;
			if(role=='user'){	// -1 da user a admin;	-2 da user a cm;	-3 da user a admin e cm;
				if($('.sendmessage .checkbox #admin-check').prop('checked'))
					type=type-1;
				if($('.sendmessage .checkbox #cm-check').prop('checked'))
					type=type-2;
			}
			if(role=='clickMaster'){	//-3 da cm a users;	-4 da cm a admin;	-9 da cm a users e admin
				if($('.sendmessage .checkbox #users-check').prop('checked'))
					type=type-4;
				if($('.sendmessage .checkbox #admin-check').prop('checked'))
					type=type-5;
			}
			if(role=='admin'){		//-7 da admin a users;	//-8 da admin a cms;	//-15 da admin a users e cms
				if($('.sendmessage .checkbox #users-check').prop('checked'))
					type=type-7;
				if($('.sendmessage .checkbox #cm-check').prop('checked'))
					type=type-8;
			}
			destID = -1;
			if((role=='user')&&($('.sendmessage .checkbox #cm-check').prop('checked'))){
				destID = $('.sendmessage .checkbox #cm-check').data("id");
			}
			$.ajax({
				method: 'POST',
				dataType: 'json',
				url: window.base_url + 'dashboard/sendmessage/',
				data: $('.sendmessage .oggetto').serialize()+'&'+$('.sendmessage .testo').serialize()+'&type='+type+'&destID='+destID+'&parent=-1',
				beforeSend: function(){
					$('button.sendmessageDo').button('loading');
				},
				success: function(data){
					$('button.sendmessageDo').button('reset');
					window.location.href = window.base_url+"dashboard/";
				}
			});
		}
	});

	$('.message-list').on('click', '.mail-line',function(){
		if(!$(this).hasClass('.noMessages')){
			id=$(this).data("id");
			if(currentDir=='rec')
				pos=$(this).data("pos");
			obj = $(this);
			$.ajax({
				method: 'POST',
				dataType: 'json',
				url: window.base_url + 'dashboard/getMessage/',
				data: 'id='+id,
				success: function(data){
					$('#readmessage .mex').empty().append('<strong>'+data.time+'</strong> Da: <span class="visMitt"><strong>'+data.mitt+'</strong></span> A: <span class="visDest"><strong>'+data.dest+'</strong></span><br/><div class="visOgg">'+data['title']+'</div><div class="visCont">'+data['content']+'</div>');
					mail = data;
					$('#readmessage .parents').empty();
					if(mail['parentID']!='-1'){
						precMails = data['prec'];
						console.log(precMails);
						motherMail = data['mother'];
						level = 0;
						if(precMails!=null)
							for(i=0; i<precMails.length; i++){
								//console.log(precMails[i])
								$('#readmessage .parents').append('<div class="parentSeparator level'+i+'"><strong>'+precMails[i].time+'</strong> Da: <span class="visMitt"><strong>'+precMails[i].mitt+'</strong></span> a <span class="visDest"><strong>'+precMails[i].dest+'</strong>:</span><div class="visOgg">'+precMails[i]['title']+'</div><div class="visCont">'+precMails[i].content+'</div></div>');
								level++;
							}
						$('#readmessage .parents').append('<div class="parentSeparator level'+level+'"><strong>'+data.mother.time+'</strong> Da: <span class="visMitt"><strong>'+data.mother.mitt+'</strong></span> a <span class="visDest"><strong>'+data.mother.dest+'</strong>:</span><div class="visOgg">'+data.mother.title+'</div><div class="visCont">'+data.mother.content+'</div></div>');
						if( (currentDir=='rec')||(currentDir=='sent') ){
							$('#setresponseDo').html('Rispondi');
							interv = 0;
						}
						else{
							$('#setresponseDo').html('Intervieni');
							interv = 1;
						}

					}
					if(currentDir == 'rec') {
						content = $(obj).find('td').eq(0).html();
						content = content.replace(/<\/?strong>/g, "");
						$(obj).find('td').eq(0).html(content);
						mails[pos].mitt = content;

						content = $(obj).find('td').eq(1).html();
						content = content.replace(/<\/?strong>/g, "");
						$(obj).find('td').eq(1).html(content);
						mails[pos].title = content;

						content = $(obj).find('td').eq(2).html();
						content = content.replace(/<\/?strong>/g, "");
						$(obj).find('td').eq(2).html(content);
						mails[pos].time = content;



						if(data['nots'].length>0){
							$('#cnots').html(data['nots'].length);
							$('#cnots').html(data['nots'].length);
						}

						else{
							$('#cnots').html('');
							$('#cnots2').html('');
						}
					}

					$('#readmessage').modal('show');
				},
				error: function(data){
					console.log('no');
				}
			});
		}else{
			return
		}
	});

	function mittrole(type){
		switch(type){
			case -1:
			case -2:
			case -3:
			case -21:
			case -22:
			case -23:
				return 'user';
			break;
			case -4:
			case -5:
			case -9:
			case -24:
			case -25:
			case -26:
				return 'clickMaster';
			break;
			case -7:
			case -8:
			case -15:
			case -27:
			case -28:
			case -29:
				return 'admin';
		}
	}

	function settype(mitt, dest){
		if(mitt=='user'){
			if(dest=='user')
				return -21;	//da user a user
			if(dest=='clickMaster')
				return -22;	//da user a cm
			if(dest=='admin')
				return -23;	//da user a admin
		}
		if(mitt=='clickMaster'){
			if(dest=='user')
				return -24;	//da cm a user
			if(dest=='clickMaster')
				return -25;	//da cm a cm
			if(dest=='admin')
				return -26;	//da cm a admin
		}
		if(mitt=='admin'){
			if(dest=='user')
				return -27;	//da admin a user
			if(dest=='clickMaster')
				return -28;	//da admin a cm
			if(dest=='admin')
				return -29;	//da admin a admin
		}
	}

	$('#setresponseDo').on("click", function(){
		console.log(mail);
		if((interv==1)&&(mail['type']==-24))
			$('#respDest').html(mail['dest']);
		else
			$('#respDest').html(mail['mitt']);
		$('#respOgg').val('RE: '+mail['title']);
		$('#readmessage').modal('hide');
		$('#responsemessage').modal('show');
	});

	$('button.responsemessageDo').click(function(){
		removeErrors();
		if($('.responsemessage .form-control[name=oggetto]').val() === "" && $('.responsemessage .text-danger').hasClass('hidden')){
			$('.responsemessage .form-control[name=oggetto]').parent().addClass('has-error');
			$('.responsemessage .text-danger').text('Inserisci un oggetto').removeClass('hidden');
		}else{
			if($('.responsemessage .form-control[name=testo]').val() === "" && $('.responsemessage .text-danger').hasClass('hidden')){
				$('.responsemessage .form-control[name=testo]').parent().addClass('has-error');
				$('.responsemessage .text-danger').text('Inserisci un testo').removeClass('hidden');
			}
		}
		if($('.responsemessage .text-danger').hasClass('hidden')){
			type = 0;
			console.log(mail['type']);
			destRole=mittrole(parseInt(mail['type']));
			type = settype(role, destRole);
			if(mail['parentID']!='-1')
				parentID = mail['parentID'];
			else
				parentID = mail['ID'];
			if(interv==1)
				parentID = -1;
			if((interv==1)&&(mail['type']==-24)){
				destID = mail['destID'];
				type = -27;
			}
			else
				destID = mail['mittID'];


			$.ajax({
				method: 'POST',
				dataType: 'json',
				url: window.base_url + 'dashboard/sendmessage/',
				data: $('.responsemessage .oggetto').serialize()+'&'+$('.responsemessage .testo').serialize()+'&type='+type+'&destID='+destID+'&parent='+parentID,
				beforeSend: function(){
					$('button.responsemessageDo').button('loading');
				},
				success: function(data){
					$('button.responsemessageDo').button('reset');
					window.location.href = window.base_url+"dashboard/";
				}
			});
		}
	});

	function updatePaginator(){
		$('#mailPages').empty().append('<li class="disabled ext prev"><a href="#" aria-label="Previous"><span aria-hidden="true">&laquo;</span></a></li><li class="active" id="pag1" data-offset="0"><a href="#">1</a></li>');
		var c = 1;
		while(c < pages){
			$('#mailPages').append('<li id="pag'+(c+1)+'" data-offset="'+ (c*pageSpan) +'"><a href="#">'+ (c+1) +'</a></li>');
			c++;
		}
		k = '';
		if(pages==1) k='disabled';
		$('#mailPages').append('<li class="'+k+' ext next"><a href="#" aria-label="Next"><span aria-hidden="true">&raquo;</span></a></li>')
	}

	$('.messageWidget #sent').on('click', function(){
		if(currentDir != 'sent'){
			obj = $(this);
			$.ajax({
				method: 'POST',
				dataType: 'json',
				url: window.base_url + 'dashboard/sentmessages/',
				data: '',
				success: function(data){
					currentDir = 'sent';
					$('.messageWidget .list-group-item').removeClass('active');
					obj.addClass('active');
					if(data.pages == 0){
						$('#mailPages').empty().append('<li class="disabled ext prev"><a href="#" aria-label="Previous"><span aria-hidden="true">&laquo;</span></a></li><li class="active" id="pag1" data-offset="0"><a href="#">1</a></li><li class="disabled ext next"><a href="#" aria-label="Next"><span aria-hidden="true">&raquo;</span></a></li>');
						$('.messageWidget .table-striped thead').empty().append('<tr><th>Destinatario</th><th>Oggetto</th><th>Data</th></tr>');
						$('.messageWidget .table-striped tbody').empty().append('<tr class="mail-line text-center noMessages"><td>Nessun messaggio inviato</td></tr>');;
					}else{
						$('.messageWidget .table-striped thead').empty().append('<tr><th>Destinatario</th><th>Oggetto</th><th>Data</th></tr>');
						mails = data.mails;
						maxOffset = data.maxOffset;
						pageSpan = data.pageSpan;
						pages = data.pages;
						if(pages>1) createMailsList();
						updatePaginator();
						showPage(0);
					}
				}
			});
		}else{
			return
		}
	});

	$('.messageWidget #received').on('click', function(){
		if(currentDir != 'rec'){
			obj = $(this);
			$.ajax({
				method: 'POST',
				dataType: 'json',
				url: window.base_url + 'dashboard/receivedmessages/',
				data: '',
				success: function(data){
					currentDir = 'rec';
					$('.messageWidget .list-group-item').removeClass('active');
					obj.addClass('active');
					if(data.pages == 0){
						$('#mailPages').empty().append('<li class="disabled ext prev"><a href="#" aria-label="Previous"><span aria-hidden="true">&laquo;</span></a></li><li class="active" id="pag1" data-offset="0"><a href="#">1</a></li><li class="disabled ext next"><a href="#" aria-label="Next"><span aria-hidden="true">&raquo;</span></a></li>');
						$('.messageWidget .table-striped thead').empty().append('<tr><th>Mittente</th><th>Oggetto</th><th>Data</th></tr>');
						$('.messageWidget .table-striped tbody').empty().append('<tr class="mail-line text-center noMessages"><td>Nessun messaggio ricevuto</td></tr>');
					}else{
						$('.messageWidget .table-striped thead').empty().append('<tr><th>Mittente</th><th>Oggetto</th><th>Data</th></tr>');
						mails = data.mails;
						//console.log(mails);
						maxOffset = data.maxOffset;
						pageSpan = data.pageSpan;
						pages = data.pages;
						if(pages>1) createMailsList();
						updatePaginator();
						showPage(0);
					}
				}
			});
		}else{
			return
		}
	});


	$('.cmslist').on('click', '.cm-line',function(){
		if(currentDir != $(this).data('id')){
			obj = $(this);
			$.ajax({
				method: 'POST',
				dataType: 'json',
				url: window.base_url + 'dashboard/receivedmessagescm/',
				data: 'id='+ $(this).data('id'),
				success: function(data){
					currentDir =  $(this).data('id');
					$('.messageWidget .list-group-item').removeClass('active');
					obj.addClass('active');
					if(data.pages == 0){
						$('#mailPages').empty().append('<li class="disabled ext prev"><a href="#" aria-label="Previous"><span aria-hidden="true">&laquo;</span></a></li><li class="active" id="pag1" data-offset="0"><a href="#">1</a></li><li class="disabled ext next"><a href="#" aria-label="Next"><span aria-hidden="true">&raquo;</span></a></li>');
						$('.messageWidget .table-striped thead').empty().append('<tr><th>Utente</th><th>Oggetto</th><th>Data</th></tr>');
						$('.messageWidget .table-striped tbody').empty().append('<tr class="mail-line text-center noMessages"><td>Nessun messaggio ricevuto</td></tr>');
					}else{
						$('.messageWidget .table-striped thead').empty().append('<tr><th>Utente</th><th>Oggetto</th><th>Data</th></tr>');
						mails = data.mails;
						//console.log(mails);
						maxOffset = data.maxOffset;
						pageSpan = data.pageSpan;
						pages = data.pages;
						if(pages>1) createMailsList();
						updatePaginator();
						showPage(0);
					}
				}
			});
		}else{
			return
		}
	});


	function createMailsList(){
		$('.messageWidget .panel-footer').removeClass('hidden');
		$('#mailPages').empty().append('<li class="disabled usrA prev"><a href="#" aria-label="Previous"><span aria-hidden="true">&laquo;</span></a></li>');
		c = 0;
		while(c<pages){
			if(c==0) a = 'class="active"';
			else a = '';
			$('#mailPages').append('<li '+a+' data-offset="'+ c*pageSpan +'"><a href="#">'+ (c+1) +'</a></li>');
			c++;
		}
		if(pages==1) d = 'disabled';
		else d = '';
		$('#mailPages').append('<li class="'+d+' usrA next"><a href="#" aria-label="Next"><span aria-hidden="true">&raquo;</span></a></li>');
	}

	function showPage(offset){
		offset = parseInt(offset);
		$('.messageWidget .prev, .messageWidget .next').removeClass('disabled');
		if(offset==0)$('.messageWidget .prev').addClass('disabled');
		if(offset==maxOffset) $('.messageWidget .next').addClass('disabled');
		if(offset<maxOffset){
			$('.messageWidget .table-striped tbody').empty();
			for(var i = offset; i < offset+pageSpan; i++){
				if(currentDir == 'rec') {
					name = mails[i].mitt;
					posinfo = 'data-pos="'+mails[i].pos+'"';
				}
				else {
					name = mails[i].dest;
					posinfo = '';
				}
				$('.messageWidget .table-striped tbody').append('<tr class="mail-line" data-ID="'+mails[i].ID+'" '+posinfo+'><td>'+name+'</td><td>'+mails[i].title+'</td><td>'+mails[i].time+'</td></tr>');
			};
		}else{
			$('.messageWidget .table-striped tbody').empty()
			for(var i = offset; i < mails.length; i++){
				if(currentDir == 'rec') {
					name = mails[i].mitt;
					posinfo = 'data-pos="'+mails[i].pos+'"';
				}
				else {
					name = mails[i].dest;
					posinfo = '';
				}
				$('.messageWidget .table-striped tbody').append('<tr class="mail-line" data-ID="'+mails[i].ID+'" '+posinfo+'><td>'+name+'</td><td>'+mails[i].title+'</td><td>'+mails[i].time+'</td></tr>');
			};
		}
		current = offset;
	}

	$('#mailPages').on('click','li', function(){
		if($(this).hasClass('active')) return;
		else if($(this).hasClass('ext')){
			nextPage($(this));
		}
		else{
			$('.pagination li').removeClass('active');
			$(this).addClass('active');
			showPage($(this).attr('data-offset'));
		}
	});


	function nextPage(el){
		if(el.hasClass('disabled')) return;
		else
		if(el.hasClass('prev')){
			if(current>0){
				el = $('#mailPages .active').prev();
				$('#mailPages li').removeClass('active');
				el.addClass('active');
			}
			showPage(current-pageSpan)
		}else{
			if(current<maxOffset){
				el = $('#mailPages .active').next();
				$('#mailPages li').removeClass('active');
				el.addClass('active');
			}
			showPage(current+pageSpan);
		}
	}
	/*
	$('.btn-file').on('change', '#userfile', function(){
		removeErrors();
		$(this).trigger('fileselect');
	});
	*/

	$("#userfile").on('click', function(){
		console.log('userfile22');
        $(this).val("");
    });

	$('#userfile').on('change', function() {
		ajaxupload();
	});

	$("#userfile2").on('click', function(){
		console.log("asdd")
        $(this).val("");
    });

	$('#userfile2').on('change', function() {
		ajaxupload2();
	});

	function ajaxupload(){
		console.log('userfile');
		$('.errorBox').addClass('hidden')
		$('.btn-file span').html('Caricamento');
		//bef = $(this);
		//console.log($(this));
		$.ajaxFileUpload({
			url 			:window.base_url+'users/upload/',
			secureuri		:false,
			fileElementId	:'userfile',
			dataType		: 'json',
			success	: function (data){
				console.log(data);
				location.reload();
			},
			error : function (data){
				$('.btn-file span').html('Scegli File');
				if(data.status == 409){
					$('.errorBox').removeClass('hidden').append('<p>'+data.responseJSON+'</p>');
				}else{
					$('.errorBox').removeClass('hidden').append('<p>Si è verificato un errore inaspettato, probabilmente il file selezionato non è corretto.</p>');
				}
			}
		});

		$('#userfile').on('change', function() {
			ajaxupload();
		});
		//$(this)['input']='userfile';
		//$(this) = bef;
		//console.log($(this));
	}

	function ajaxupload2(){
		$('.errorBox2').addClass('hidden')
		$('.uploadbtn4 span').html('Caricamento');
		//bef = $(this);
		console.log($('#userfile2'));
		$.ajaxFileUpload({
			url 			:window.base_url+'users/upload2/',
			secureuri		:false,
			fileElementId	:'userfile2',
			dataType		: 'json',
			success	: function (data){
				console.log(data);
				location.reload();
			},
			error : function (data){
				console.log(data);
				$('.btn-file2 span').html('Scegli File');
				if(data.status == 409){
					$('.errorBox2').removeClass('hidden').append('<p>'+data.responseJSON+'</p>');
				}else{
					$('.errorBox2').removeClass('hidden').append('<p>Si è verificato un errore inaspettato, probabilmente il file selezionato non è corretto.</p>');
				}
				$('.uploadbtn4 span').html('Carica Contratto');
			}
		});

		$('#userfile2').on('change', function() {
			ajaxupload2();
		});
		//$(this)['input']='userfile';
		//$(this) = bef;
		//console.log($(this));
	}


	$('.downloadC').click(function(){
		pop_up= window.open(window.base_url+'dashboard/printContract', "PopUpName");
		var x = setTimeout(function(){
			pop_up.document.write('<script type="text/javascript">window.onload=window.close();</script>');
		}, 5000);
	});

	$('body').on('click', '.winners .modal-footer a', function(e){
		$.ajax({
			method: 'POST',
			dataType: 'json',
			url: window.base_url + 'dashboard/confirmWinner/',
			data: 'role='+$(this).data('role')+'&ID='+$(this).data('id'),
			success: function(data){
				$('.winners').modal('toggle');
			}
		});
	});
});
