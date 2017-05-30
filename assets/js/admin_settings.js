var $ = window.$

$(document).ready(function () {
  $('form').on('submit', (e) => {
    e.preventDefault()
    let form = e.currentTarget
    let $btn = $(form).find('button')
    $('.feedback').text('')
    if (!$btn.hasClass('disabled')) {
      let settings = { valid: true, payload: {} }

      let checks = Array.from(document.querySelectorAll('input[type="checkbox"]'))

      checks.forEach(input => (settings.payload[input.name] = ~~input.checked))

      if (settings.valid) {
        postAdditions(settings.payload)
      }
    }
  })
})

function buttonUI ($btn, state) {
  switch (state) {
    case 'reset':
      $btn.find('span').text('Salva')
      $btn.find('i').toggleClass('hidden')
      $btn.removeClass('disabled')
      break
    default:
      $btn.find('span').text('')
      $btn.find('i').toggleClass('hidden')
      $btn.addClass('disabled')
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

function postAdditions (dataOut) {
  let $btn = $('form button')
  buttonUI($btn, 'loading')
  let url = `${window.base_url}dashboard/updateSettings`
  $.getJSON(url, dataOut, function (data) {
    var messages = {
      success: {
        type: 'success',
        message: `Impostazioni aggiornate con successo!`
      },
      error: {
        type: 'error',
        message: `Si è verificato un errore durante, riprovare.`
      }
    }
    var result = data ? messages.success : messages.error
    notify(result)
    buttonUI($btn, 'reset')
  })
}
