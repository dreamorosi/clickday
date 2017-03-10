var $ = window.$;
var jlinq = window.jlinq;

$(document).ready(function () {
  var role = window.role;
  var users_mnpl = window.users;
  var pageSpan = window.pageSpan;
  var maxOffset = window.maxOffset;
  var projects_classic = window.projects_classic;
  var projects_sc = window.projects_sc;
  var fixcode = window.fixcode;
  var current = 0;
  var old_filter = '';
  var ass_filter = '';
  var rec_filter = '';
  var letter_filters = {};
  var destID;

  function filtering(trigger) {
    $('tbody').empty();
    var filter = $.trim($('#search').val());
    console.log(filter);
    // Retrieve the input field text and reset the count to zero
    switch(trigger){
      case 'search':
        if (filter.length <= 3) {
          if (users_mnpl.length !== window.users) {
            users_mnpl = window.users;
            pages = Math.ceil(users_mnpl.length / pageSpan);
            maxOffset = pageSpan * (pages - 1);
            var el = $('#usrPages .active');
            var ofst = el.data('offset')
            if (typeof ofst === 'undefined') ofst = 0;
            if (ofst > maxOffset) ofst = maxOffset;
            updatePaginator(ofst);
            showPage(ofst);
            return
          }
        }
        if (filter.length > old_filter.length)
          users_mnpl = jlinq.from(users_mnpl).starts('name', filter).starts('code_ass', ass_filter).starts('code_rec', rec_filter).or().starts('inverted_name', filter).starts('code_ass', ass_filter).starts('code_rec', rec_filter).select();
        else
          users_mnpl = jlinq.from(window.users).starts('name', filter).starts('code_ass', ass_filter).starts('code_rec', rec_filter).or().starts('inverted_name', filter).starts('code_ass', ass_filter).starts('code_rec', rec_filter).select();
        break;
      case 'select':
      case 'letter':
        //users_mnpl = jlinq.from(window.users).starts('name', filter).starts('code_ass', ass_filter).starts('code_rec', rec_filter).or().starts('inverted_name', filter).starts('code_ass', ass_filter).starts('code_rec', rec_filter).select();

        if (Object.keys(letter_filters).length==0)
          users_mnpl = jlinq.from(window.users).starts('code_ass', ass_filter).starts('code_rec', rec_filter).select();
        else {
          l = 0;
          for (letter in letter_filters) {
            users_letter_filtered = l == 0 ?  jlinq.from(window.users).starts('inverted_name', letter) : users_letter_filtered.or(letter);
            l++;
          }
          users_mnpl = users_letter_filtered.select();
          users_mnpl = jlinq.from(users_mnpl).starts('code_ass', ass_filter).starts('code_rec', rec_filter).select();
        }
        break;
    }

    var c = 0;
    $.each(users_mnpl, function (i) {
      region = '';
      sent = '';
      c++
    });
    //console.log(c)
    if (c == 0) {
      $('tbody').append('<tr class="user-line text-center"><td colspan="14" class="no-results">Nessun Risultato</td></tr>');
    }
    old_filter = filter;
    pages = Math.ceil(users_mnpl.length/pageSpan);
    maxOffset = pageSpan * (pages-1);
    updatePaginator(0);
    showPage(0);
  }

  function update() {

  }

  $('#search').keyup(function () {
      filtering('search')
  });

  $('.letters').on('click','span', function () {
  	letter = $(this).html().toLowerCase()
    if(letter != 'tutti') {
      $('#search').val('').prop('disabled', true)
  		$('.letters span:first-child').removeClass('selected');
  		if($(this).hasClass('selected')) {
        $(this).removeClass('selected')
        delete letter_filters[letter];
        if (Object.keys(letter_filters).length==0) {
          $('#all').addClass('selected');
          $('#search').prop('disabled', false);
        }
      }else {//Ho selezionato una nuova lettera, l'aggiungo ai filtri
        $(this).addClass('selected')
        letter_filters[letter] = letter;
      }
	   } else {
      $('#search').prop('disabled', false);
      $('.letters span').removeClass('selected');
      $('.letters span:first-child').addClass('selected');
        letter_filters = {};
     }
    filtering('letter')
  });

  $('body').on('change', '.dropdown-filters select', function (e) {
    select_case = $(this).parent().attr('id')
    selection = $(this).val();
    if(select_case == 'code_ass') {
      ass_filter = selection;
      if(selection!='No')
        $('#code_rec select').prop('disabled', false);
      else {
        $('#code_rec select').prop('disabled', true).val('');
        rec_filter = '';
      }
    }
    if(select_case == 'code_rec') {
      rec_filter = selection;
    }
    filtering('select');
  });

	function showPage (offset) {
		if (users_mnpl.length==0)
			return;

    offset = parseInt(offset)
		$('.prev, .next').removeClass('disabled');
		if (offset === 0) $('.prev').addClass('disabled');
		if (offset === maxOffset) $('.next').addClass('disabled');

    $('.table-striped tbody').empty();

    var totalIteration = offset < maxOffset ? offset+pageSpan : users_mnpl.length;

		for (var i = offset; i < totalIteration; i++) {
			region = ''
			sent = ''
			if (users_mnpl[i].code_rec === 'No') {
				select_projects_classic = "<select id='select_classic" + users_mnpl[i].ID + "' class='select_code_classic'><option value='---'>---</option>";

				select_projects_sc = "<select id='select_sc" + users_mnpl[i].ID + "' class='select_code_sc'><option value='---'>---</option>";
			} else {
				select_projects_classic = "<select id='select_classic" + users_mnpl[i].ID + "' class='select_code_classic' disabled><option value='---'>---</option>";

				select_projects_sc = "<select id='select_sc" + users_mnpl[i].ID + "' class='select_code_sc' disabled><option value='---'>---</option>";

				sent = "sent"
			}

      projects_classic.forEach(function (project) {
        var selected = users_mnpl[i].code !== project.file ? '' : 'selected';
        var option = "<option value='" + project.region + "' " + selected + ">" + project.file + "</option>";
        select_projects_classic += option;
        region = users_mnpl[i].code !== project.file ? users_mnpl[i].region : '';
      })
      select_projects_classic += "</select>"


      projects_sc.forEach(function (project) {
        var selected = users_mnpl[i].code !== project.file ? '' : 'selected';
        var option = "<option value='" + project.region + "' " + selected + ">" + project.file + "</option>";
        select_projects_sc += option;
        region = users_mnpl[i].code !== project.file ? users_mnpl[i].region : '';
      })
			select_projects_sc += "</select>";

      var tr = '<tr class="user-line" data-id="' + users_mnpl[i].ID + '"'
      tr += ' data-name="' + users_mnpl[i].name + '"';
      tr += ' data-pos="' + users_mnpl[i].pos + '"';
      tr += ' data-pos_mnpl="' + i + '">';

      tr += '<td><div class="status-circle status' + users_mnpl[i].status + '"></div></td>';
      tr += '<td class="cName"><b>' + users_mnpl[i].name + '</b></td>';
      tr += '<td>' + users_mnpl[i].join + '</td>';
      tr += '<td>' + users_mnpl[i].clickM + '</td>';
      tr += '<td>' + users_mnpl[i].approved + '</td>';
      tr += '<td>' + users_mnpl[i].code_rec + '</td>';
      tr += '<td>' + users_mnpl[i].screen + '</td>';
      tr += '<td>' + users_mnpl[i].contract + '</td>';
      tr += '<td class="select_td">' + select_projects_classic + '</td>';
      tr += '<td class="select_td">' + select_projects_sc + '</td>';
      tr += '<td class="select_region">' + region + '</td>';

      sendready = users_mnpl[i].code_ass == 'Si' ? 'warning' : '';
      tr += '<td class="sendcode"><button class="btn btn-sm btn-default ' + sendready + '"><small>Invia Codice</small></button></td>';
      tr += '<td class="setsendmessage2" title="Contatta Utente"><button class="btn btn-sm btn-warning"><span class="glyphicon glyphicon-envelope"></span></button></td>';
      tr += '<td class="noDet" title="Elimina Utente"><button class="btn btn-sm btn-danger" data-toggle="modal" data-target=".confirm" data-action="delete"><span class="glyphicon glyphicon-remove"></span></button></td>';
      tr += '</tr>'
			$('.table-striped tbody').append(tr)
		}
		current = offset
	}

	function nextPage (el) {
		if (el.hasClass('disabled')) return;
		else
		if (el.hasClass('prev')) {
			if (current > 0) {
				el = $('.pagination .active').prev();
				$('.pagination li').removeClass('active');
				el.addClass('active');
			}
			showPage(current - pageSpan);
		} else {
			if (current < maxOffset) {
				el = $('.pagination .active').next();
				$('.pagination li').removeClass('active');
				el.addClass('active');
			}
			showPage(current + pageSpan);
		}
	}

	function updatePaginator (ac) {
		$('#usrPages').empty().append('<li class="disabled ext prev"><a href="#" aria-label="Previous"><span aria-hidden="true">&laquo;</span></a></li>');
		var c = 0
		if (ac > pages)
			ac = (pages - 1) * pageSpan;
		while (c < pages) {
			if (eval(c * pageSpan) === eval(ac)) {
				$('#usrPages').append('<li class="active" id="pag' + (c + 1) + '" data-offset="' + (c * pageSpan) + '"><a href="#">' + (c + 1) + '</a></li>');
			} else {
				$('#usrPages').append('<li id="pag' + (c + 1) + '" data-offset="' + (c * pageSpan) + '"><a href="#">' + (c + 1) + '</a></li>');
			}
			c++
		}
    var disabled = pages === 1 ? 'disabled' : '';
		$('#usrPages').append('<li class="' + disabled + ' ext next"><a href="#" aria-label="Next"><span aria-hidden="true">&raquo;</span></a></li>');
	}

	$('#usrPages').on('click','li', function () {
		if ($(this).hasClass('active')) return;
		else if ($(this).hasClass('ext')) {
			nextPage($(this));
		} else {
			$('#usrPages li').removeClass('active');
			$(this).addClass('active');
			showPage($(this).attr('data-offset'));
		}
	});

	$('.print').click(function () {
		pop_up= window.open(window.base_url+'dashboard/printList', "PopUpName");
		var x = setTimeout(function () {
			pop_up.document.write('<script type="text/javascript">window.onload=window.close();</script>')
		}, 5000)
	});

	$('body').on('change', '.select_code_classic, .select_code_sc', function (e) {
    pos = $(this).parent().parent().data('pos');
    pos_mnpl = $(this).parent().parent().data('pos_mnpl');
		if ($(this).val() !== '---') {
			$(this).parent().parent().find(".select_region").html($(this).val());
      var idName = $(this).hasClass('select_code_classic') ? '#select_classic' : '#select_sc';
      var oppositeClass = $(this).hasClass('select_code_classic') ? '.select_code_sc' : '.select_code_classic';

			$(this).parent().parent().find(".select_td > " + oppositeClass).val('---');

			var ID = $(this).parent().parent().data('id');
			selected = $(idName + ID + ' option:selected' ).text();
			region = $(idName + ID + ' option:selected' ).val();
			setcode(ID, selected, region, pos, pos_mnpl);
			$(this).parent().parent().find('.sendcode').addClass('warning');
		} else {
			setcode(ID, '', '', pos, pos_mnpl);
			$(this).parent().parent().find('.select_region').html('');
			$(this).parent().parent().find('.sendcode').removeClass('warning')
		}
	})

	function setcode(ID, selected, region, pos, pos_mnpl) {
		$.ajax({
			method: 'POST',
			dataType: 'json',
			url: window.base_url + 'dashboard/setcode/',
			data: 'ID='+ID+'&code='+selected+"&region="+region,
			success: function(data){
        var value = selected ? 'Si' : 'No'
        window.users[pos]['code_ass'] = value;
        window.users[pos]['code'] = selected;
        window.users[pos]['region'] = region;

        users_mnpl[pos_mnpl]['code_ass'] = value;
        users_mnpl[pos_mnpl]['code'] = selected;
        users_mnpl[pos_mnpl]['region'] = region;
			}
		})
	}

	$('body').on('click', '.setsendmessage2', function () {
		$('#messDest').html($(this).parent().data('name'));
		destID = $(this).parent().data('id');
		$('.sendmessage2').modal('show');
	})

	$('body').on('click', '.sendcode .btn', function () {
    var ID = $(this).parent().parent().data('id')
    var name = $(this).parent().parent().find('.cName').html()
		if (!$(this).hasClass('success') || $(this).hasClass('warning')) {
      var btn = $(this)
			selected = $('#select_classic' + ID + ' option:selected' ).text();
			if (selected === '---') {
				selected = $('#select_sc' + ID + ' option:selected' ).text();
				if (selected === '---') {
					return
				} else {
					region = $('#select_sc' + ID + ' option:selected' ).val();
				}
			} else {
				region = $('#select_classic' + ID + ' option:selected' ).val();
			}

			if (selected !== '') {
				$.ajax({
					method: 'POST',
					dataType: 'json',
					url: window.base_url + 'dashboard/sendcode/',
					data: 'ID=' + ID + '&code=' + selected + '&region=' + region,
					success: function (data) {
            var messages = {
              success: {
                type: 'success',
                message: `Il codice di ${name} è stato inviato con successo`
              },
              error: {
                type: 'error',
                message: `Si è verificato un errore durante l'invio del codice di ${name}`
              }
            }

            var result = data ? messages.success : messages.error
            btn.removeClass('warning').addClass(result.type)
						$('#select_classic' + ID).prop('disabled', data);
						$('#select_sc' + ID).prop('disabled', data);
            notify(result)
					}
				})
			}
		} else {
      prompt(`Vuoi riassegnare un nuovo codice a ${name}`, ID)
		}
	});

	function confirmReassign (ID) {
		$.ajax({
			method: 'POST',
			dataType: 'json',
			url: window.base_url + 'dashboard/deleteUserCode/',
			data: 'ID=' + ID,
			success: function(data){
        var messages = {
          success: {
            type: 'success',
            message: `Il codice di ${name} è stato inviato con successo`
          },
          error: {
            type: 'error',
            message: `Si è verificato un errore durante l'invio del codice di ${name}`
          }
        }

        var result = data ? messages.success : messages.error
        btn.removeClass('warning').addClass(result.type)
        $('#select_classic' + ID).prop('disabled', data);
        $('#select_sc' + ID).prop('disabled', data);
        notify(result)
			}
		})
	}

	$('button.sendmessageDo2').click(function () {
		removeErrors()
		if ($('.sendmessage2 .form-control[name=oggetto]').val() === '' && $('.sendmessage2 .text-danger').hasClass('hidden')) {
			$('.sendmessage2 .form-control[name=oggetto]').parent().addClass('has-error');
			$('.sendmessage2 .text-danger').text('Inserisci un oggetto').removeClass('hidden');
		} else {
			if ($('.sendmessage2 .form-control[name=testo]').val() === '' && $('.sendmessage2 .text-danger').hasClass('hidden')) {
				$('.sendmessage2 .form-control[name=testo]').parent().addClass('has-error');
				$('.sendmessage2 .text-danger').text('Inserisci un testo').removeClass('hidden');
			}
		}
		if ($('.sendmessage2 .text-danger').hasClass('hidden')) {
			type = 0
			destRole='user'
			if (role === 'admin')
				type=-27;
			if (role === 'clickMaster')
				type=-24;
			$.ajax({
				method: 'POST',
				dataType: 'json',
				url: window.base_url + 'dashboard/sendmessage/',
				data: $('.sendmessage2 .oggetto').serialize() + '&' + $('.sendmessage2 .testo').serialize() + '&type=' + type + '&destID=' + destID + '&parent=-1',
				beforeSend: function () {
					$('button.sendmessageDo2').button('loading');
				},
				success: function (data) {
					$('button.sendmessageDo2').button('reset');
					$('.sendmessage2').modal('hide')
				}
			})
		}
	})

	$('.userListWidget').on('click', '.user-line td', function () {
		if ( $(this).hasClass('noDet') || $(this).hasClass('setsendmessage2') || $(this).hasClass('select_td') || $(this).hasClass('sendcode') || $(this).hasClass('no-results')) {
			return;
		} else {
			$.ajax({
				method: 'POST',
				dataType: 'json',
				url: window.base_url + 'dashboard/getDetailsUs/',
				data: 'ID=' + $(this).parent().data('id'),
				beforeSend: function () {

				},
				success: function (data) {
					$('#userDetails .detName span').text(data.name + ' ' + data.surname);
					$('#userDetails .detEmail span').text(data.email);
					$('#userDetails .detAddr span').text(data.address + ', ' + data.cap + ', ' + data.prov + ', ' + data.country);
					$('#userDetails .detBirth span').text(data.dateBirth);
					$('#userDetails .detCf span').text(data.cf);
					$('#userDetails .detPhone span').text(data.phone);
					$('#userDetails .detWork span').text(data.work);
					$('#userDetails .detJoin span').text(data.joinDate);
					if (data.lastSeen === null) $('#userDetails .detLast span').text('-');
					else $('#userDetails .detLast span').text(data.lastSeen);
					$('.detScreen').empty();
					if(data.screen_uploaded === 0) $('.detScreen').append("<span>L'utente non ha ancora caricato uno screenshot</span>");
					else $('.detScreen').append('<img src="' + window.base_url + '/assets/uploads/screenshots/' + data.screen_file + '" class="img-responsive"/>');
					$('.detCont').empty();
					if (data.cont_uploaded ===0) $('.detCont').append("<span>L'utente non ha ancora caricato il proprio contratto</span>");
					else $('.detCont').append('<a href="' + window.base_url + 'assets/uploads/contratti/' + data.contract_file + '" target="_blank">Visualizza contratto</a>');
					$('.userDetails').modal('toggle');
				},
				error: function(data){
					if (data.status === 409) {
						$('.userDetails .modal-body').append('<p class="text-danger">' + data.responseJSON + '</p>');
					} else {
						$('.userDetails .modal-body').append('<p class="text-danger">Si è verificato un errore inaspettato, aggiornare la pagina e ritentare</p>');
					}
				}
			})
		}
	});

	chosen = -1;
	$rowEl = -1;
	$('body').on('click', '.btn-danger', function (event) {
		event.stopPropagation();
		$('.confirm').modal('show');
		$rowEl = $(this).parent().parent();
		chosen = $rowEl.data('id');
		if ($(this).data('action') === 'delete') {
			name = $(this).parent().siblings('.cName').html();
			$('.confirm .modal-body p').html("Stai per eliminare l'utente " + name + ". L'azione è irreversibile.");
			$('.confirm .btn-primary').addClass('del')
		} else {
			return;
		}
	})

	$('.confirm').on('hidden.bs.modal', function (event) {
		$(this).find('.btn-primary').removeClass('del').removeClass('ed');
		$(this).find('.modal-body p').text('');
		chosen = -1;
		$rowEl = -1;
	})

	function rebuild (chosen) {
    return users_mnpl.filter(function (user) {
      if (user.ID !== chosen) {
        return user;
      }
    })
	}

	$('.confirm').on('click', '.del', function () {
		$.ajax({
			method: 'POST',
			dataType: 'json',
			url: window.base_url + 'dashboard/deleteUser/',
			data: 'ID=' + chosen,
			beforeSend: function () {
				$('.confirm .modal-footer .btn-primary').button('loading').delay(100).append('.').delay(100).append('.')
			},
			success: function (data) {
				$('.confirm .modal-footer .btn-primary').button('reset')
				$('.confirm').modal('hide');
				rebuild(chosen)
				$rowEl.fadeOut('750', function(){
					$(this).remove();
					pages = Math.ceil(users_mnpl.length / pageSpan);
					maxOffset = pageSpan * (pages - 1);
					el = $('#usrPages .active');
					ofst = el.data('offset');
					if (ofst > maxOffset);
						ofst=maxOffset;
					updatePaginator(ofst);
					showPage(ofst)
				})
			},
			error: function (data) {
				$('.confirm .modal-footer .btn-primary').button('reset');
				$(this).find('.modal-body p').html('<span class="text-danger">Si è verificato un errore, riprovare più tardi.</span>');
			}
    })
  })
})

function notify (obj) {
  noty({
    layout: 'topRight',
    theme: 'relax',
    type: obj.type,
    text: obj.message,
    force: true,
    timeout: 2000,
    progressBar: true
  })
}

function prompt (message, ID) {
  noty({
    layout: 'center',
    theme: 'relax',
    type: 'warning',
    text: message,
    force: true,
    timeout: false,
    buttons: [{
      addClass: 'btn btn-primary ' + ID,
      text: 'Conferma',
      onClick: function($noty) {
        let ID = this[0].classList[2]
        confirmReassign(ID)
        $noty.close()
      }
    },
    {
      addClass: 'btn btn-danger',
      text: 'Annulla',
      onClick: function($noty) {
        $noty.close()
      }
    }
  ]
  })
}
