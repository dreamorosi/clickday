/* global jQuery noty */
(function ($) {
  $.extend({
    notify: function (obj) {
      noty({
        layout: 'topRight',
        theme: 'relax',
        type: obj.type,
        text: obj.message,
        force: true,
        timeout: 2000,
        progressBar: true
      })
      return this
    },
    prompt: function (obj) {
      noty({
        layout: 'center',
        theme: 'relax',
        type: 'warning',
        text: obj.message,
        force: true,
        timeout: false,
        buttons: [{
          addClass: 'btn btn-primary',
          text: 'Conferma',
          onClick: function ($noty) {
            obj.callback(obj.ID)
            $noty.close()
          }
        },
        {
          addClass: 'btn btn-danger',
          text: 'Annulla',
          onClick: function ($noty) {
            $noty.close()
          }
        }]
      })
    }
  })
})(jQuery)
