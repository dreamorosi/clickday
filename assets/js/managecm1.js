const $ = window.$
let cms = window.cMs
let pageSpan = window.pageSpan
let maxOffset = window.maxOffset
let pages = window.pages
let current = 0
let chosen = -1
let $rowEl = -1
let editing = -1
let $rowEle = -1

$(document).ready(function () {
  $('.confirm').on('show.bs.modal', function (event) {
    let button = $(event.relatedTarget)
    let $rowEl = button.parent().parent()
    chosen = $rowEl.data('id')
    let name
    if (button.data('action') === 'delete') {
      name = button.parent().siblings('.cmName').html()
      $(this).find('.modal-body p').html('Stai per eliminare il Click Master' + name + ". L'azione è irreversibile.")
      $(this).find('.btn-primary').addClass('del')
    } else {
      name = button.parent().siblings('.cmName').attr('prev')
      $(this).find('.modal-body p').html('Stai per modificare le informazioni del Click Master <b>' + name + "</b>. L'azione è irreversibile.")
      $(this).find('.btn-primary').addClass('ed')
    }
  })

  $('.confirm').on('hidden.bs.modal', function (event) {
    $(this).find('.btn-primary').removeClass('del').removeClass('ed')
    $(this).find('.modal-body p').text('')
    chosen = -1
    $rowEl = -1
    editing = -1
    $rowEle = -1
  })

  $('.cmT').on('click', '.label-info', function () {
    let el = $(this)
    let ID = getId(el)
    let user = getUser(ID, cms)
    toggleEditMode(el)
  })

  $('.confirm').on('click', '.del', function () {
    $.ajax({
      method: 'POST',
      dataType: 'json',
      url: window.base_url + 'dashboard/deleteCm/',
      data: 'ID=' + chosen,
      beforeSend: function () {
        $('.modal-footer   .btn-primary').button('loading').delay(100).append('.').delay(100).append('.')
      },
      success: function (data) {
        $('.modal-footer .btn-primary').button('reset')
        $('.confirm').modal('hide')
        let el = $('#cmPages .active')
        rebuild(chosen)
        $rowEl.fadeOut('750', function () {
          $(this).remove()
          pages = Math.ceil(cms.length / pageSpan)
          maxOffset = pageSpan * (pages - 1)
          el = $('#cmPages .active')
          let ofst = el.data('offset')
          if (ofst > maxOffset) ofst = maxOffset
          updatePaginator(ofst)
          showPage(ofst)
        })
      },
      error: function (data) {
        $('.modal-footer .btn-primary').button('reset')
        $(this).find('.modal-body p').html('<span class="text-danger">Si è verificato un errore, riprovare più tardi.</span>')
      }
    })
  })

  let prevCount = -1
  $('.confirm').on('click', '.ed', function () {
    let valid = true
    removeErrors()
    if (!checkNamePunct($('#newName'))) { valid = false }
    if (!checkNamePunct($('#newSurname'))) { valid = false }
    if ($.trim($('#newCode').val()) === '') {
      valid = false
    }
    if (!checkEmail($('#newMail'))) { valid = false }
    if (valid) {
      $.ajax({
        method: 'POST',
        dataType: 'json',
        url: window.base_url + 'dashboard/editCm/',
        data: `ID=${$rowEle}&${$('#newName').serialize()}&${$('#newSurname').serialize()}&${$('#newCode').serialize()}&${$('#newMail').serialize()}`,
        success: function (data) {
          editing.empty().append('<td class="cmName"><b>' + data.name + ' ' + data.surname + '</b></td><td class="cmCode">' + data.code + '</td><td  class="cmEmail">' + data.email + '</td><td class="cmUsers"><span>' + prevCount + '</span><span class="glyphicon glyphicon-search"></span></td><td class="cmActions"><span class="label label-info"><span class="glyphicon glyphicon-pencil"></span></span> <span data-toggle="modal" data-target=".confirm" data-action="delete" class="label label-danger"><span class="glyphicon glyphicon-remove"></span></span></td>')
          $('.confirm').modal('hide')
          $.each($('.label-info, .label-danger'), function () {
            $(this).removeClass('disabled').attr('data-target', '.confirm')
          })
        },
        error: function (data) {
          if (data.status === 409) {
            $('.addCM .text-danger').removeClass('hidden').text(data.responseJSON)
          } else {
            $('.addCM .text-danger').removeClass('hidden').text('Si è verificato un errore inaspettato, aggiornare la pagina e ritentare')
          }
        }
      })
    }
  })

  $('.cmT').on('click', '.label-default', function () {
    let $name = $(this).parent().siblings('.cmName')
    $name.empty().append('<b>' + $name.attr('prev') + '</b>')
    let $code = $(this).parent().siblings('.cmCode')
    $code.empty().append($code.attr('prev'))
    let $email = $(this).parent().siblings('.cmEmail')
    $email.empty().append($email.attr('prev'))
    $(this).parent().empty().append('<span class="label label-info"><span class="glyphicon glyphicon-pencil"></span></span> <span data-toggle="modal" data-target=".confirm" data-action="delete" class="label label-danger"><span class="glyphicon glyphicon-remove"></span></span>')
    $.each($('.label-info, .label-danger'), function () {
      $(this).removeClass('disabled').attr('data-target', '.confirm')
    })
  })

  $('.table-striped').on('click', '.cmName, .cmCode, .cmEmail, .cmUsers', function (e) {
    var ID = $(this).parent().data('id')
    window.location.href = window.base_url + 'dashboard/clickmaster/' + ID
  })

  $('button.newCm').click(function () {
    removeErrors()
    let valid = true
    if (!checkNamePunct($('.form-control[name=name]'))) {
      $('.addCM .text-danger').removeClass('hidden').text('Inserisci un nome valido.')
      valid = false
    }
    if (valid && !checkNamePunct($('.form-control[name=surname]'))) {
      $('.addCM .text-danger').removeClass('hidden').text('Inserisci un cognome valido.')
      valid = false
    }
    if (valid && !checkEmail($('.form-control[name=email]'))) {
      $('.addCM .text-danger').removeClass('hidden').text('Inserisci un indirizzo eMail valido.')
      valid = false
    }
    if (valid && $.trim($('.form-control[name=code]').val()) === '') {
      $('.addCM .text-danger').removeClass('hidden').text('Inserisci un codice valido.')
      valid = false
    }
    if (valid) {
      $.ajax({
        method: 'POST',
        dataType: 'json',
        url: window.base_url + 'dashboard/addCM/',
        data: $('.form-control[name=name]').serialize() + '&' + $('.form-control[name=surname]').serialize() + '&' + $('.form-control[name=email]').serialize() + '&' + $('.form-control[name=code]').serialize(),
        beforeSend: function () {
          $('button.newCm').addClass('disabled').attr('disabled', 'disabled')
        },
        success: function (data) {
          $('button.newCm').removeClass('disabled').removeAttr('disabled')
          $('button.newCm span').addClass('animated fadeOutUp').one('webkitAnimationEnd mozAnimationEnd MSAnimationEnd oanimationend animationend', function () {
            $(this).removeClass('animated fadeOutUp')
          })
          $('.addCM .form-control').val('')
          let obj = {'ID': data.ID, 'name': data.usr.name + ' ' + data.usr.surname, 'email': data.usr.email, 'code': data.usr.code, 'users': 0}
          cms.unshift(obj)
          pages = Math.ceil(cms.length / pageSpan)
          maxOffset = pageSpan * (pages - 1)
          let el = $('#cmPages .active')
          let ofst = el.data('offset')
          updatePaginator(ofst)
          showPage(0)
          $('#pag1').click()
        },
        error: function (data) {
          $('button.newCm').button('reset')
          if (data.status === 409) {
            $('.addCM .text-danger').removeClass('hidden').text(data.responseJSON)
          } else {
            $('.addCM .text-danger').removeClass('hidden').text('Si è verificato un errore inaspettato, aggiornare la pagina e ritentare')
          }
        }
      })
    } else {
      return
    }
  })

  $('#cmPages').on('click', 'li', function () {
    if ($(this).hasClass('active')) return
    else if ($(this).hasClass('ext')) {
      nextPage($(this))
    } else {
      $('#cmPages li').removeClass('active')
      $(this).addClass('active')
      showPage($(this).attr('data-offset'))
    }
  })

  $('.addCM .form-control').keypress(function (e) {
    let key = e.which
    if (key === 13) {
      $('button.newCm').click()
      return
    }
  })
})

function showPage (offset) {
  offset = parseInt(offset)
  $('#cmPages .prev,#cmPages .next').removeClass('disabled')
  if (offset === 0)$('#cmPages .prev').addClass('disabled')
  if (offset === maxOffset) $('#cmPages .next').addClass('disabled')

  let iterationSpan = offset < maxOffset ? offset + pageSpan : cms.length

  $('.cmT tbody').empty()
  for (var i = offset; i < iterationSpan; i++) {
    $('.cmlistWidget .table-striped tbody').append('<tr class="user-line" data-ID="' + cms[i].ID + '"><td class="cmName"><b>' + cms[i].name + '</b></td><td class="cmCode">' + cms[i].code + '</td><td class="cmEmail">' + cms[i].email + '</td><td class="cmUsers"><span>' + cms[i].users + '</span><span class="glyphicon glyphicon-search"></span></td><td class="cmActions"><span class="label label-info"><span class="glyphicon glyphicon-pencil"></span></span> <span data-toggle="modal" data-target=".confirm" data-action="delete" class="label label-danger"><span class="glyphicon glyphicon-remove"></span></span></td>')
  }
  current = offset
}

function nextPage (el) {
  if (el.hasClass('disabled')) return
  else
  if (el.hasClass('prev')) {
    if (current > 0) {
      el = $('#cmPages .active').prev()
      $('#cmPages li').removeClass('active')
      el.addClass('active')
    }
    showPage(current - pageSpan)
  } else {
    if (current < maxOffset) {
      el = $('#cmPages .active').next()
      $('#cmPages li').removeClass('active')
      el.addClass('active')
    }
    showPage(current + pageSpan)
  }
}

function rebuild (chosen) {
  var tmp = []
  for (let i = 0; i < cms.length; i++) {
    if (cms[i].ID !== chosen) tmp.push(cms[i])
  }
  cms = tmp
}

function updatePaginator (ac) {
  $('#cmPages').empty().append('<li class="disabled ext prev"><a href="#" aria-label="Previous"><span aria-hidden="true">&laquo;</span></a></li>')
  var c = 0
  if (ac > pages) {
    ac = (pages - 1) * pageSpan
    while (c < pages) {
      if (parseInt(c * pageSpan) === parseInt(ac)) {
        $('#cmPages').append('<li class="active" id="pag' + (c + 1) + '" data-offset="' + (c * pageSpan) + '"><a href="#">' + (c + 1) + '</a></li>')
      } else {
        $('#cmPages').append('<li id="pag' + (c + 1) + '" data-offset="' + (c * pageSpan) + '"><a href="#">' + (c + 1) + '</a></li>')
      }
      c++
    }
  }
  let k = ''
  if (pages === 1) k = 'disabled'
  $('#cmPages').append('<li class="' + k + ' ext next"><a href="#" aria-label="Next"><span aria-hidden="true">&raquo;</span></a></li>')
}

const toggleEditMode = el => el.parent().parent().toggleClass('editMode')

const getId = el => el.parent().parent().data('id').toString()

const getUser = (ID, arr) => arr.find(usr => usr.ID === ID)

const rowFactory = user => {
  let $tr = `<tr class="user-line" data-ID='${user.ID}' title='Clicca per vedere gli utenti associati a ${user.name}'>`
  return $tr
}
