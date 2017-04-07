const $ = window.$
let cMs = window.cMs

// TODO: Set up tag for codes
// TODO: Set loading state when adding new CM

// Set event listeners and call appropriate functions
$(document).ready(function () {
  $('table').paginator({
    factory: rowFactory,
    list: cMs
  })

  // Create new CM
  $('.addCM form').on('submit', (e) => {
    e.preventDefault()
    let newCm = processForm(e.target)
    if (!newCm.hasError) {
      postNewCm(newCm.info)
    }
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
  rowFactory($('tbody'), user)
}

// Creates a row in the table
const rowFactory = (container, user) => {
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

  let $tr = `<tr class='user-line' data-ID='${user.ID}'>${$tds}</tr>`
  container.append($tr)
  setRowEvents()
}

const setRowEvents = () => {
  // Go to CM page when line is clicked
  $('.user-line').on('click', 'td.clickable', (e) => {
    e.stopImmediatePropagation()
    e.stopPropagation()
    let ID = $(e.target).parent().data('id')
    window.location.href = `${window.base_url}dashboard/clickmaster/${ID}`
  })

  // Delete CM
  $('.user-line').on('click', '.deleteCm', (e) => {
    e.stopImmediatePropagation()
    e.stopPropagation()
    let ID = getId(e.currentTarget)
    postDeleteCm(ID)
  })

  // Edit CM (triggers Edit Mode)
  $('.user-line').on('click', '.editCm', (e) => {
    e.stopImmediatePropagation()
    e.stopPropagation()
    let $this = e.currentTarget
    let ID = getId($this)
    let user = getUser(ID, cMs)
    toggleEditMode(ID)
    editRowFactory(user)
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
    $('table').paginator('refresh', cMs)
  })
}
