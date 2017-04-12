const $ = window.$
const sessionStorage = window.sessionStorage
const FormUtils = window.FormUtils

$(document).ready(function () {
  manageCode()

  $('input.cm').change(function () {
    if (this.checked) {
      $('input[name=code]').val('').attr('disabled', this.checked)
    } else {
      $('input[name=code]').attr('disabled', false).focus()
    }
  })

  let form = document.querySelector('.signupForm')

  let formUt = new FormUtils()

  const checkCmCode = (inputs) => {
    let code = inputs.find(input => input.name === 'code')
    let notCode = inputs.find(input => input.name === 'notCode')
    return code.value !== '' || notCode.checked !== false
  }

  formUt.init({
    form: form,
    extendValidation: [checkCmCode]
  })

  $('.signupForm').on('submit', (e) => {
    e.preventDefault()
    let form = e.currentTarget
    let $btn = $(form).find('button')
    $('.feedback').text('')
    if (!$btn.hasClass('disabled')) {
      let newCm = formUt.process()
      if (newCm.valid) {
        $.ajax({
          method: 'POST',
          url: `${window.base_url}users/newUser`,
          dataType: 'json',
          data: newCm.payload,
          beforeSend: () => $btn.text('Caricamento').addClass('disabled'),
          success: (data) => {
            $btn.text('Registrati').removeClass('disabled')
            if (data.success) {
              $('.signupForm').addClass('hidden')
              $('.confirm').removeClass('hidden')
            } else {
              $('.feedback').text(data.message)
            }
          }
        })
      } else {
        return
      }
    }
  })
})

const manageCode = () => {
  const $input = $('.form-control[name="code"]')
  const code = $.trim($input.val())
  if (code !== '') {
    sessionStorage.setItem('cmCode', code)
  } else {
    $input.val(sessionStorage.getItem('cmCode'))
  }
}
