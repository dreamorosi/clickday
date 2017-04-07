const $ = window.$
let cMs = window.cMs
let pageSpan = $('select.pageSpan').val()
let current = 1
let offset = pageSpan * current

// TODO: Set up tag for codes
// TODO: Set loading state when adding new CM

// Set event listeners and call appropriate functions
$(document).ready(function () {
  // Inser page numbers
  paginatorFactory(cMs)
  // Insert users
  showCurrentSpan(cMs)

  // Create new CM
  $('.addCM form').on('submit', (e) => {
    e.preventDefault()
    let newCm = processForm(e.target)
    if (!newCm.hasError) {
      postNewCm(newCm.info)
    }
  })

  // Click on prev || next in paginator
  $('.pagination').on('click', '.prev, .next', (e) => {
    let $el = $(e.currentTarget)
    if (!$el.hasClass('disabled')) {
      if ($el.hasClass('next')) {
        current++
      } else {
        current--
      }
      offset = current * pageSpan
      paginatorFactory(cMs)
      showCurrentSpan(cMs)
    }
  })

  // Click on number in paginator
  $('.pagination').on('click', 'li', (e) => {
    let $el = $(e.currentTarget)
    if (!$el.hasClass('prev') && !$el.hasClass('next')) {
      current = parseInt($el.find('a').text())
      offset = current * pageSpan
      paginatorFactory(cMs)
      showCurrentSpan(cMs)
    }
  })

  // Change pageSpan
  $('.pageSpan').on('change', (e) => {
    current = 1
    pageSpan = $(e.currentTarget).val()
    offset = current * pageSpan
    paginatorFactory(cMs)
    showCurrentSpan(cMs)
  })
})

// Process the passed form, shallow validation and errors
const processForm = (form) => {
  let $form = $(form)
  let error = false
  let info = {}
  $.each($form.find('input'), (i, el) => {
    let $el = $(el)
    $el.parent().removeClass('has-error')
    $el.siblings('small').addClass('hidden')
    let value = $.trim($el.val())

    error = value === ''

    if (error) {
      $el.parent().addClass('has-error')
      $el.siblings('small').removeClass('hidden')
    } else {
      info[$el.attr('name')] = value
    }
  })
  if (!error) {
    return {
      hasError: false,
      info: info
    }
  } else {
    return {
      hasError: true
    }
  }
}

// Reset the passed form and removes errors
const resetForm = ($form) => {
  $.each($form.find('input'), (i, el) => {
    let $el = $(el)
    $el.parent().removeClass('has-error')
    $el.siblings('small').addClass('hidden')
    $el.val('')
  })
}

// Get the ID of the pressed button's row
const getId = el => $(el).parent().parent().data('id').toString()

// Get user by ID (local)
const getUser = (ID, arr) => arr.find(usr => usr.ID === ID)

// Post new CM to server
const postNewCm = (newCm) => {
  $.ajax({
    method: 'POST',
    dataType: 'json',
    url: `${window.base_url}dashboard/addCm/`,
    data: newCm,
    success: (data) => {
      // TODO: wire up notifications
      if (data.code === 200) {
        resetForm($('.addCM form'))
        getUpdatedCMs()
      } else {
        console.log('error', data.message)
      }
    }
  })
}

// Post edited CM to server
const postEditCm = (cm, ID) => {
  $.ajax({
    method: 'POST',
    dataType: 'json',
    url: `${window.base_url}dashboard/editCm/`,
    data: cm,
    success: (data) => {
      // TODO: wire up notifications
      if (data) {
        resetForm($('.editMode form'))
        restoreRow(ID)
        getUpdatedCMs()
      } else {
        console.log('error', data)
      }
    }
  })
}

// Post delete action to server
const postDeleteCm = (ID) => {
  $.ajax({
    method: 'POST',
    dataType: 'json',
    url: `${window.base_url}dashboard/deleteCm/`,
    data: `ID=${ID}`,
    success: (data) => {
      // TODO: wire up notifications
      if (data) {
        getUpdatedCMs()
      } else {
        console.log('error', data)
      }
    }
  })
}

// Toggle edit mode on a row
const toggleEditMode = (ID) => {
  let $this = $(`.user-line[data-id="${ID}"]`)
  if ($this.hasClass('editMode')) {
    $this.removeClass('editMode')
  } else {
    $this.addClass('editMode')
  }
  $this.empty()
}

// Restores the row as original
const restoreRow = (ID) => {
  let user = getUser(ID, cMs)
  toggleEditMode(ID)
  rowFactory(user)
}

// Creates a row in the table
const rowFactory = (user) => {
  let $tr = $(`.user-line[data-id="${user.ID}"]`)

  let className = 'clickable'
  let title = `Clicca per vedere le info di ${user.fullName}`

  let $tds = `<td class='${className}' title='${title}'><b>${user.fullName}</b></td>`
  $tds += `<td class='${className}' title='${title}'>${user.code}</td>`
  $tds += `<td class='${className}' title='${title}'>${user.email}</td>`
  $tds += `<td class='${className}' title='${title}'>${user.users}</td>`
  $tds += `<td class='${className}' title='${title}'>${user.projRatio}</td>`

  let $editBtn = `<button class="btn btn-sm btn-info editCm" title="Modifica ${user.fullName}"><span class="glyphicon glyphicon-pencil"></span></button>`

  let $deleteBtn = `<button title="Elimina ${user.fullName}" class="btn btn-sm btn-danger deleteCm"><span class="glyphicon glyphicon-remove"></span></button>`

  $tds += `<td>${$editBtn} ${$deleteBtn}</td>`

  $tr.append($tds)
  // Go to CM page when line is clicked
  $('.user-line').on('click', 'td.clickable', (e) => {
    e.stopImmediatePropagation()
    e.stopPropagation()
    let ID = $(e.target).parent().data('id')
    window.location.href = `${window.base_url}dashboard/clickmaster/${ID}`
  })
}

// Creates a row (in Edit Mode) in the table
const editRowFactory = (user) => {
  let $tr = $(`.user-line[data-id="${user.ID}"]`)

  let $userInput = `<label>Full Name</label><input type="text" name="fullName" class="form-control" required value="${user.fullName}" />`

  let $emailInput = `<label>Email</label><input type="text" name="email" class="form-control" required value="${user.email}" />`

  let $leftCol = `<div class="col-md-3">${$userInput}<br />${$emailInput}</div>`

  let $codesInput = `<div class="col-md-3"><label>Codici</label><input type="text" name="code" class="form-control" required value="${user.code}" /></div>`

  let $row1 = `<div class="row">${$leftCol}${$codesInput}</div>`

  let $row2 = `<div class="row text-right"><div class="col-md-11"><button class="btn btn-primary" type="submit">Salva</button> <button class="btn btn-default" data-id="${user.ID}">Annulla</button></div></div>`

  let $form = `<td colspan="6"><form class="editForm">${$row1}${$row2}</form></td>`

  $tr.append($form)

  // Confirm Edit CM
  $('.editForm').on('submit', (e) => {
    e.preventDefault()
    e.stopImmediatePropagation()
    e.stopPropagation()
    let cm = processForm(e.target)
    if (!cm.hasError) {
      let ID = getId(e.target)
      cm.info.ID = ID
      postEditCm(cm.info, ID)
    }
  })

  // Cancel Edit CM
  $('.user-line.editMode').on('click', '.btn-default', (e) => {
    e.preventDefault()
    e.stopImmediatePropagation()
    e.stopPropagation()
    let ID = $(e.currentTarget).data('id').toString()
    restoreRow(ID)
  })
}

// Get updated CMs after action
const getUpdatedCMs = () => {
  let url = `${window.base_url}/dashboard/getCMs/1`
  $.getJSON(url, (data) => {
    cMs = data
    paginatorFactory(cMs)
    showCurrentSpan(cMs)
  })
}

// Show current page
const showCurrentSpan = (arr) => {
  let offsetStart = offset - pageSpan
  let toShow = arr.slice(offsetStart, offset)
  if (toShow.length > 0) {
    $('tbody').empty()
    toShow.forEach(user => {
      $('tbody').append(`<tr class='user-line' data-ID='${user.ID}'></tr>`)
      rowFactory(user)
    })
  }

  // Delete CM
  $('.user-line').on('click', '.deleteCm', (e) => {
    let ID = getId(e.currentTarget)
    postDeleteCm(ID)
  })

  // Edit CM (triggers Edit Mode)
  $('.user-line').on('click', '.editCm', (e) => {
    let $this = e.currentTarget
    let ID = getId($this)
    let user = getUser(ID, cMs)
    toggleEditMode(ID)
    editRowFactory(user)
  })
}

// Creates and manages pagination
const paginatorFactory = (arr) => {
  let users = arr.length
  let pages = Math.ceil(users / pageSpan)
  $('ul.pagination').empty()
  $('ul.pagination').append('<li class="prev"><a href="#" aria-label="Previous"><span aria-hidden="true">&laquo;</span></a></li>')
  $('ul.pagination').append('<li class="next"><a href="#" aria-label="Next"><span aria-hidden="true">&raquo;</span></a></li>')
  // Check if prev & next should be disabled
  if (current === 1) {
    $('li.prev').addClass('disabled')
  } else if (current === pages) {
    $('li.next').addClass('disabled')
  }
  // If there's only 1 page insert it
  if (pages === 1) {
    $('li.prev').after('<li class="active"><a href="#">1</a></li>')
  // If there are 2 - 5 pages show them
  } else if (pages < 6) {
    while (pages > 0) {
      let active = pages === current ? 'active' : ''
      $('li.prev').after(`<li class="${active}"><a href="#">${pages}</a></li>`)
      pages--
    }
  // If there are 6+ page show always 5
  } else {
    let numbers = []
    // If current - 2 || current - 1 aren't possible
    if (current < 3) {
      let pointer = current
      let remainder = 5 - current
      while (remainder > 0) {
        numbers.push(current + remainder)
        remainder--
      }
      while (pointer > 0) {
        numbers.push(pointer)
        pointer--
      }
    // If current + 1 || current + 2 aren't possible
    } else if (current + 1 > pages || current + 2 > pages) {
      if (current + 1 <= pages) {
        numbers = [current + 1, current, current - 1, current - 2, current - 3]
      } else {
        numbers = [current, current - 1, current - 2, current - 3, current - 4]
      }
    // otherwise show current -2 && current && current +2
    } else {
      numbers = [current + 2, current + 1, current, current - 1, current - 2]
    }
    numbers.forEach(number => {
      let active = number === current ? 'active' : ''
      $('li.prev').after(`<li class="${active}"><a href="#">${number}</a></li>`)
    })
  }
}
