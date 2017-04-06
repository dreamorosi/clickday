var $ = window.$
$(document).ready(function () {
  $('.save').click(function () {
    const ID = $(this).data('id')
    let payload = checkFields(ID)
    if (ID !== '') {
      postPass(payload)
    }
  })
})

function addErr (el, msg) {
  el.parent().addClass('has-error')
  $('.tips').find('small').append(`${msg}<br />`)
  $('.tips').removeClass('hidden')
}

function removeErr (el) {
  el.parent().removeClass('has-error')
  $('.tips').addClass('hidden').find('small').text('')
}

function checkFields (ID) {
  let pass = $('input[tabindex="1"]')
  let pass2 = $('input[tabindex="2"]')
  removeErr(pass)
  removeErr(pass2)
  let passVal = $.trim(pass.val())
  let passVal2 = $.trim(pass2.val())
  let error = passVal === ''
  if (error) {
    addErr(pass, 'Inserisci una password')
  }
  error = passVal2 === ''
  if (error) {
    addErr(pass2, 'Conferma la password')
  }
  error = passVal !== passVal2
  if (error) {
    addErr(pass2, 'Le due password non coincidono')
  }
  if (!error) {
    return {
      ID: ID,
      pass: passVal
    }
  }
}

function postPass (payload) {
  var url = `${window.base_url}login/setAdminPassw`
  $.ajax({
    method: 'POST',
    url: url,
    dataType: 'json',
    data: payload,
    success: function (data) {
      let res = data ? '<p>La tua password è stata salvata, adesso puoi accedere.</p>' : '<p>Si è verificato un errore, per favore contattare un altro Admin.</p>'
      $('.jumbotron')
        .empty()
        .append(res)
    }
  })
}
