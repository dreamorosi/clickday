const $ = window.$
const FormUtils = window.FormUtils
const Clipboard = window.Clipboard

$(document).ready(function () {
  prepareDate()

  let editForm = new FormUtils()
  editForm.init({
    form: document.querySelector('.editForm'),
    extendValidation: [checkIban]
  })

  $('.editForm').on('submit', (e) => {
    e.preventDefault()
    let form = e.currentTarget
    let $btn = $(form).find('button')
    if (!$btn.hasClass('disabled')) {
      let updatedUser = editForm.process()
      if (updatedUser.valid) {
        $.ajax({
          method: 'POST',
          url: `${window.base_url}users/editUser/${updatedUser.payload.ID}`,
          dataType: 'json',
          data: updatedUser.payload,
          beforeSend: () => $btn.text('Caricamento').addClass('disabled'),
          success: (data) => {
            $btn.text('Salva').removeClass('disabled')
            if (data.success) {
              $.notify({type: 'success', message: 'Profilo aggiornato con successo!'})
            } else {
              $.notify({type: 'error', message: 'Si è verificato un errore inaspettato, aggiornare la pagina.'})
            }
          }
        })
      } else {
        return
      }
    }
  })

  const Referral = new Clipboard('.referralBtn')

  Referral.on('success', function (e) {
    $.notify({type: 'success', message: 'Url copiato con successo!'})
  })
})

const prepareDate = () => {
  const bday = document.querySelector('.editForm .bday')
  const label = bday.querySelectorAll('.bday-day')
  const date = label[0].dataset.birthdate.split('/')
  const inputs = Array.from(bday.querySelectorAll('input'))
  inputs.forEach((input, i) => (input.value = parseInt(date[i])))
}

const checkIban = (inputs) => {
  let iban = inputs.find(input => input.name === 'iban')
  if (iban === undefined) return true
  if (!IBAN.isValid(iban.value)) {
    let $iban = $('input[name="iban"]')
    $iban.addClass('has-error')
    $iban.parent().find('label').addClass('has-error')
  }
  return IBAN.isValid(iban.value)
}
