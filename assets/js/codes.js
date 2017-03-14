var $ = window.$
var notCodeUsers = window.notCodeUsers
var base_url = window.base_url
var code = window.code

$(document).ready(function(){
	selectCode(code)
	$('.glyphicon-user + span').animateNumber({ number: notCodeUsers }, 1500)

	$('.codesWidget form').on('submit', function(e) {
		e.preventDefault()
		$input = $(this).find('input')
		$btn = $(this).find('button')
		$select = $(this).find('select')
		$input.css('border-color', '#CCC')
		var projectsType = $(this).data('projects')
		var usersToAssign = parseInt($input.val(), 10)
		if (isNaN(usersToAssign) || usersToAssign <= 0) {
			$input.css('border-color', '#F7403D')
		} else {
			assignCodes(projectsType, usersToAssign, $btn, $select.val())
		}
	})
});

function assignCodes (type, usersCount, $btn, code) {
	buttonUI($btn, 'loading')
	var url = `${window.base_url}dashboard/`
	url += type === 'cl' ? 'assign_cl_codes' : 'assign_sc_codes'
	var dataOut = {
		"usersCount": usersCount,
		"code": code
	}
	$.getJSON(url, dataOut, function(data) {
		var messages = {
			success: {
				type: 'success',
				message: `Codici assegnati con successo!`
			},
			error: {
				type: 'error',
				message: `Si è verificato un errore durante l'assegnazione`
			}
		}

		var result = messages.error
		if (data.success) {
			updateUserCount(notCodeUsers - data.affected)
			result = messages.success
		}
		notify(result)
		buttonUI($btn, 'reset')
	})
}

function buttonUI ($btn, state) {
	switch (state) {
		case 'reset':
			$btn.find('span').text('Assegna')
			$btn.find('i').toggleClass('hidden')
			$btn.removeClass('disabled')
			break;
		default:
			$btn.find('span').text('')
			$btn.find('i').toggleClass('hidden')
			$btn.addClass('disabled')
	}
}

function updateUserCount (userCount) {
	$('.glyphicon-user + span')
		.prop('number', notCodeUsers)
		.animateNumber(
			{ number: userCount },
			1500,
			'linear',
			function() {
	      $('.glyphicon-arrow-down').toggleClass('hidden')
				notCodeUsers = userCount
	    })
	$('.glyphicon-arrow-down').toggleClass('hidden')
}

function selectCode (code) {
	if (code !== '') {
		var file = code + '.txt'
		$.each($('select'), function() {
			if ($(this).find('option[value="' + file + '"]').length > 0) {
				$(this).val(file)
				$(this).siblings('input').focus()
			}
		})
	}
}

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
