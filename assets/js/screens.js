const $ = window.$
const Event = window.Event
const Magnify = window.Magnifier
let screens = window.screens

$(document).ready(function () {
  $('table').paginator({
    factory: rowFactory,
    list: screens
  })

  let evt = new Event()
  let m = new Magnify(evt)

  m.attach({
    thumb: '.thumb',
    zoom: 2,
    zoomable: true
  })
})

const renderImage = (filename, ID) => {
  let url = `${window.base_url}assets/uploads/screenshots/thumbs/${filename}`
  let image = `<img class="thumb" style="width: 298px;" src="${url}" data-large-img-url="${url}" data-large-img-wrapper="preview${ID}" />`
  return `<div class="magnifier-thumb-wrapper">${image}</div>`
}

const renderPreview = (ID) => `<div class="magnifier-preview" id="preview${ID}" style="width: 298px;"></div>`

// Creates a row in the table
const rowFactory = (container, screen) => {
  let $tds = `<td><b>${screen.name}</b></td>`
  $tds += `<td>${renderImage(screen.filename, screen.ID)}</td>`
  $tds += `<td>${renderPreview(screen.ID)}</td>`

  let $editBtn = `<button class="btn btn-sm btn-success approveScreen" data-userid="${screen.userID}" title="Approva"><span class="glyphicon glyphicon-ok"></span></button>`

  let $deleteBtn = `<button class="btn btn-sm btn-danger rejectScreen" data-userid="${screen.userID}" title="Rifiuta"><span class="glyphicon glyphicon-remove"></span></button>`

  $tds += `<td>${$editBtn} ${$deleteBtn}</td>`

  let $tr = `<tr class='screen-line' data-ID='${screen.ID}'>${$tds}</tr>`
  container.append($tr)
  setRowEvents()
}

// Get the ID of the pressed button's row
const getId = el => $(el).parent().parent().data('id').toString()

// Get the userID of the button
const getUserID = el => el.dataset.userid

const setRowEvents = () => {
  // Reject Screen
  $('.screen-line').on('click', '.rejectScreen', (e) => {
    e.stopImmediatePropagation()
    e.stopPropagation()
    let el = e.currentTarget
    let ID = getId(el)
    let userID = getUserID(el)
    postChangeScreen(ID, userID, -1)
  })

  // Approve Screen
  $('.screen-line').on('click', '.approveScreen', (e) => {
    e.stopImmediatePropagation()
    e.stopPropagation()
    let el = e.currentTarget
    let ID = getId(el)
    let userID = getUserID(el)
    postChangeScreen(ID, userID, 2)
  })
}

// Approve or Reject Screen
const postChangeScreen = (ID, userID, action) => {
  // TODO: Test and update list
  $.ajax({
    method: 'POST',
    dataType: 'json',
    url: `${window.base_url}dashboard/changeScreen/`,
    data: `ID=${ID}&userid=${userID}&action=${action}`,
    beforeSend: () => {},
    success: (data) => {
      console.log(data)
      if (data) {
        $.notify({type: 'success', message: 'Operazione avvenuta con successo'})
      } else {
        $.notify({type: 'error', message: 'Si è verificato un errore, aggiornare e riprovare.'})
      }
    }
  })
}
