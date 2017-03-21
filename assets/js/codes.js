var $ = window.$
var notCodeUsers = window.notCodeUsers
var base_url = window.base_url
var code = window.code
var projects_cl = []
var projects_sc = []
// position in array
// var pointer = 0
// current max value
// var tab = 0
var store = {}
// current project
var currentProjects = []
// var currentUsersCount = 0

$(document).ready(function(){
	selectCode(code)
	getCodeCount()

	$('.glyphicon-user + span').animateNumber({ number: notCodeUsers }, 1500)

	$('.codesWidget form').on('submit', function(e) {
		e.preventDefault()
		$input = $(this).find('input')
		$btn = $(this).find('button')
		$input.css('border-color', '#CCC')
		var projectsType = $(this).data('projects')
		var usersToAssign = parseInt($input.val(), 10)
		if (isNaN(usersToAssign) || usersToAssign <= 0) {
			$input.css('border-color', '#F7403D')
		} else {
			assignCodes(projectsType, usersToAssign, $btn)
		}
	})
});

function assignCodesOLD (type, usersCount, $btn) {
	buttonUI($btn, 'loading')
	var url = `${window.base_url}dashboard/`
	url += type === 'cl' ? 'assign_cl_codes' : 'assign_sc_codes'
	var dataOut = {
		"usersCount": usersCount
	}
	$.getJSON(url, dataOut, function (data) {
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
		console.log(data)
		// var result = messages.error
		// if (data.success) {
		// 	updateUserCount(notCodeUsers - data.affected)
		// 	result = messages.success
		// }
		// notify(result)
		buttonUI($btn, 'reset')
	})
}

function assignCodes (type, usersCount, $btn) {
	var dataOut = []
	// console.table(projects_cl)
	if (type == 'cl') {
		balanceCodes(projects_cl, usersCount, 0)
	} else {
		balanceCodes(projects_sc, usersCount, 0)
	}
	console.table(store)
	resetBalancers()
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

function getCodeCount () {
	var url = `${window.base_url}dashboard/getCodeCount`
	$.getJSON(url, function (data) {
		projects_cl = data.projects_cl.map(function (project) {
			return {
				project: project.file,
				count: ID !== null ? parseInt(project.n, 10) : 0
			}
		})

		projects_sc = data.projects_sc.map(function (project) {
			return {
				project: project.file,
				count: ID !== null ? parseInt(project.n, 10) : 0
			}
		})
	})
}

// non sono sicuro di nessuna di queste due.. quando ci lavori scrivimi
function balanceCodes1 (projects, usersCount) {
	currentProjects = projects
	currentUsersCount = usersCount
	if (currentUsersCount === 0) {
		return
	}
	tab = projects[pointer].count + 1
	projects[pointer].count = projects[pointer].count + 1
	currentUsersCount = currentUsersCount - 1
	var nextTab = projects[pointer + 1].count
	if (tab < nextTab) {
		balanceCodes(currentProjects, currentUsersCount)
	} else {
		pointer = pointer + 1
		balanceCodes(currentProjects, currentUsersCount)
	}
}

function balanceCodes (projects, usersCount, pointer) {
	if (usersCount === 0) {
		return
	}
	next = projects[pointer + 1].count
	diff = projects[pointer + 1].count - projects[pointer].count
	if (diff > 0) {
		code = projects[pointer].project
		store[code] = diff
	}
	pointer++
	usersCount = usersCount - diff
	balanceCodes (projects, usersCount, pointer)
}

function resetBalancers () {
	pointer = 0
	tab = 0
	currentProjects = []
	currentUsersCount = 0
}
