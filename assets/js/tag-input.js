/* global jQuery */

(function ($) {
  /*
  ///////// Variables ///////////
  */

  const pluginName = '$.tagInput() - '
  let settings = {}
  let isInit = 0
  let $box
  let $input

  /*
  ///////// Init Stuff ///////////
  */

  // Check that init() has been called
  // @private
  const checkInit = () => isInit === 1 ? true : $.error(`${pluginName}Call init method before calling this one`)

  // Check wheter the new tag is already in the group
  // @private
  const checkLocalExistence = (txt) => {
    checkInit()
    let tags = getTags()
    return tags.includes(txt)
  }

  // Check wheter the new tag is already assigned to another CM
  // @private
  const checkAllExistence = (txt) => {
    checkInit()
    return settings.allCodes.includes(txt)
  }

  // Set event listeners
  // @private
  const setEvents = () => {
    $box.on('click', function () {
      $(this).find('input').focus()
    })

    $box.on('click', 'span', function () {
      if (window.confirm('Eliminare il codice ' + $(this).text() + '?')) $(this).remove()
    })

    $input.on({
      focusout: function () {
        var txt = this.value.replace(/[^a-z0-9+\-.#]/ig, '')
        if (txt) {
          if (!checkLocalExistence(txt) && !checkAllExistence(txt)) {
            $('<span/>', {text: txt, insertBefore: this})
          }
        }
        this.value = ''
      },
      keyup: function (e) {
        if (/(188|186|13)/.test(e.which)) {
          $(this).focusout()
        }
      },
      keydown: function (e) {
        if (/(13)/.test(e.which)) {
          e.stopImmediatePropagation()
          e.stopPropagation()
          e.preventDefault()
        }
      }
    })
  }

  // Adds code passed
  // @private
  const addExistingCodes = () => {
    settings.codes.forEach((code) => $('<span/>', {text: code, insertBefore: $input}))
  }

  /*
  ///////// Public Methods ///////////
  */

  // Init function
  // @public
  function init (options) {
    settings = $.extend({
      codes: [],
      allCodes: []
    }, options)

    $box = $(this)
    $input = $box.find('input')
    isInit = 1
    if (settings.codes.length > 0) {
      addExistingCodes()
    }
    setEvents()
  }

  // Returns array of current tags
  // @public
  const getTags = () => {
    checkInit()
    let $tagsEl = Array.from($box.find('span'))
    let tags = $tagsEl.map((el) => $(el).text())
    return tags
  }

  // Serializes the tags and returns a string
  // @public
  const serialize = () => {
    checkInit()
    let tags = getTags()
    return JSON.stringify(tags)
  }

  // Expose methods
  var methods = {
    init: init,
    serialize: serialize,
    getTags: getTags
  }

  // Plugin router
  $.fn.tagInput = function (methodOrOptions) {
    if (methods[methodOrOptions]) {
      return methods[ methodOrOptions ].apply(this, Array.prototype.slice.call(arguments, 1))
    } else if (typeof methodOrOptions === 'object' || !methodOrOptions) {
      // Default to "init"
      return methods.init.apply(this, arguments)
    } else {
      $.error(`${pluginName}Method ${methodOrOptions} doesn't exist`)
    }
  }
}(jQuery))
