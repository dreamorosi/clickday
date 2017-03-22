var $ = window.$
var notCodeUsers = window.notCodeUsers
var base_url = window.base_url
var code = window.code
var select_cl = window.projects_cl
var select_sc = window.projects_sc
var projects_cl = []
var projects_sc = []

$(document).ready(function(){
	selectCode(code)
	getCodeCount()

	$('.glyphicon-user + span').animateNumber({ number: notCodeUsers }, 1500)

	$('.codesWidget form').on('submit', function (e) {
		e.preventDefault()
		$input = $(this).find('input[type="number"]')
		$btn = $(this).find('button')
		$mode = $(this).find('input[type="checkbox"]').prop('checked')
		$input.css('border-color', '#CCC')
		var projectsType = $(this).data('projects')
		var usersToAssign = parseInt($input.val(), 10)
		if (isNaN(usersToAssign) || usersToAssign <= 0) {
			$input.css('border-color', '#F7403D')
		} else {
			if ($mode) {
				assignCodes(projectsType, usersToAssign)
			} else {
				assignSingleCode(usersToAssign)
			}
		}
	})

	$('form input[type="radio"]').on('change', function () {
		changeType($(this).val())
	})

	$('form input[type="checkbox"]').on('change', function () {
		var $select = $('form select')
		$.each($select, function () {
			if (!$(this).hasClass('hidden')) {
				var status = $select.prop('disabled')
				$select.prop('disabled', !status)
			}
		})
	})
})

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

function changeType (type) {
	$form = $('form')
	$select = $form.find('select')
	if (type === 'cl') {
		$form.data('projects', 'cl')
	} else {
		$form.data('projects', 'sc')
	}
	$.each($select, function () {
		$(this).toggleClass('hidden')
	})
}

function selectCode (code) {
	if (code !== '') {
		var file = code + '.txt'
		var $firstSelect = $('select[data-projects="cl"]')
		var $secondSelect = $('select[data-projects="sc"]')
		var isInFirstSelect = $firstSelect.find(`option[value="${file}"]`).length > 0 ? 1 : 0
		var isInSecondSelect = $secondSelect.find(`option[value="${file}"]`).length > 0 ? 1 : 0
		if (isInFirstSelect) {
			$firstSelect.prop('disabled', false).val(file)
			$('input[type="checkbox"]').prop('checked', false)
		} else if (isInSecondSelect){
			$firstSelect.addClass('hidden')
			$secondSelect.removeClass('hidden').prop('disabled', false).val(file)
			$('input[type="checkbox"]').prop('checked', false)
			$('input[type="radio"]').filter('[value=sc]').prop('checked', true)
		}
		$('input[type="number"]').focus()
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

/* Gets the list of all the codes ordered from the one with less users up */
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

// Assign codes logic

/* Runs the balancing function and syncs the result with db */
var codesToDistrib = {}
var usersToAdd = 0
function assignCodes (type, usersCount) {
	if (type == 'cl') {
		balanceCodes(projects_cl, usersCount)
	} else {
		balanceCodes(projects_sc, usersCount)
	}
	postAdditions(codesToDistrib, usersToAdd)
}

/* Gets the selected code and posts it along with the usersCount */
function assignSingleCode (usersToAssign, $btn) {
	var code = {}
	var $select = $('form select')
	$.each($select, function () {
		if (!$(this).hasClass('hidden')) {
			code[$(this).val()] = usersToAssign
		}
	})
	postAdditions(code, usersToAdd)
}

/* Runs the distributeCodes function until a number of codes equal to the input has been assigned */
var x = {}
var y = 0
function balanceCodes (projects, usersCount) {
	while (usersCount > y) {
		distributeCodes(projects, 0)
	}
	usersToAdd = y
	codesToDistrib = x
	x = {}
	y = 0
}

/* Recursively called, it looks at a project and the one after and fills the difference */
function distributeCodes (prj, i) {
	var current = prj[i].count
	var next = prj[i + 1]
	if (next === undefined) {
		registerAddition(prj[i], 1)
	} else {
		var diff = next.count - current
		if (diff > 0) {
			registerAddition(prj[i], diff)
		} else {
			distributeCodes(prj, i + 1)
		}
	}
}

/* Assigns codes to users */
function postAdditions (codesToDistrib, usersToAdd) {
	$btn = $('form button')
	buttonUI($btn, 'loading')
	var url = `${window.base_url}dashboard/assignCodes`
	var toDistribute = Object.keys(codesToDistrib).map(function (code) {
		return { project: code, count: codesToDistrib[code]}
	})
	var dataOut = {
		"codesToDistrib": toDistribute,
		"usersToAdd": usersToAdd
	}
	$.getJSON(url, dataOut, function (codesAssigned) {
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
		if (codesAssigned > 0) {
			updateUserCount(notCodeUsers - codesAssigned)
			result = messages.success
		}
		notify(result)
		buttonUI($btn, 'reset')
	})
}

/* Keeps in sync all the support variables */
function registerAddition (el, diff) {
	el.count = el.count + diff
	x[el.project] = initOrAdd(x[el.project], diff)
	y += diff
}

/* If the value is NaN initializes it otherwise adds the value */
function initOrAdd (el, val) {
	return isNaN(el) ? val : el + val
}
