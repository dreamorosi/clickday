/* global jQuery */

(function ($) {
  /*
  ///////// Variables ///////////
  */

  const pluginName = '$.paginator() - '
  let settings = {}
  let isInit = 0
  let current
  let pageSpan
  let offset
  let arr = []
  let factory
  let container
  let paginatorBox
  let selectPageSpan

  /*
  ///////// Init Stuff ///////////
  */

  // Check that init() has been called
  // @private
  const checkInit = () => isInit === 1 ? true : $.error(`${pluginName}Call init method before calling this one`)

  // Set pageSpan from select || defaults to default pageSpan value
  // @private
  const setPageSpan = (select) => {
    let el = $(select)
    if (el && el.is('select')) {
      let value = parseInt(el.val())
      if (isNaN(value)) {
        $.error(`${pluginName}Invalid value provided for pageSpan`)
      } else {
        return value
      }
    } else {
      console.warn(`${pluginName}Select pageSpan not found, defaulted to setting value`)
    }
  }

  // Set pageSpan select for later use
  // @private
  const setSelectPageSpan = (select) => {
    let el = $(select)
    if (el && el.is('select')) {
      return el
    } else {
      $.error(`${pluginName}Invalid value for select.pageSpan or not found`)
    }
  }

  // Set container || defaults to tbody
  // @private
  const setContainer = (table, tbody) => {
    let el = table.find(tbody)
    if (el && el.is('tbody')) {
      return el
    } else {
      $.error(`${pluginName}Invalid value for tbody or not found`)
    }
  }

  // Set factory callback function that will fill each row
  // @private
  const setFactory = (fn) => {
    if ($.isFunction(fn)) {
      return fn
    } else {
      $.error(`${pluginName}No Row factory callback provided`)
    }
  }

  // Set array of elements to display
  // @private
  const setList = (arr) => {
    if ($.isArray(arr)) {
      return arr
    } else {
      $.error(`${pluginName}No list provided`)
    }
  }

  // Set pagination container || defaults to ul.pagination
  // @private
  const setPaginatorBox = (ul) => {
    let el = $(ul)
    if (el && el.is('ul')) {
      return el
    } else {
      $.error(`${pluginName}Invalid value for ul.pagination or not found`)
    }
  }

  /*
  ///////// Utilities ///////////
  */

  // Calculates and returns offset
  // @private
  const offsetEval = (pageSpan, current) => pageSpan * current

  // Set Event Listeners for page numbers and pageSpan select
  // @private
  const setPaginatorListeners = () => {
    // Click on prev || next in paginator
    paginatorBox.on('click', '.prev, .next', (e) => {
      let $el = $(e.currentTarget)
      if ($el.hasClass('next')) {
        nextPage($el)
      } else {
        prevPage($el)
      }
    })

    // Click on number in paginator
    paginatorBox.on('click', 'li', (e) => {
      let $el = $(e.currentTarget)
      if (!$el.hasClass('prev') && !$el.hasClass('next')) {
        goToPage($el)
      }
    })

    // Change pageSpan
    selectPageSpan.on('change', (e) => {
      let val = $(e.currentTarget).val()
      changePageSpan(val)
    })
  }

  /*
  ///////// Public Methods ///////////
  */

  // Init function
  // @public
  function init (options) {
    settings = $.extend({
      pageSpan: 5,
      select: 'select.pageSpan',
      container: 'tbody',
      paginatorBox: 'ul.pagination'
    }, options)

    isInit = 1
    current = 1
    container = setContainer(this, settings.container)
    selectPageSpan = setSelectPageSpan(settings.select)
    pageSpan = setPageSpan(settings.select)
    offset = offsetEval(pageSpan, current)
    factory = setFactory(options.factory)
    arr = setList(options.list)
    paginatorBox = setPaginatorBox(settings.paginatorBox)
    createPaginator()
    showCurrentSpan()
    setPaginatorListeners()
  }

  // Refresh function
  // @public
  const refresh = (list) => {
    arr = setList(list)
    createPaginator()
    showCurrentSpan()
  }

  // Create pagination numbers
  // @public
  const createPaginator = () => {
    checkInit()
    let users = arr.length
    let pages = Math.ceil(users / pageSpan)
    paginatorBox.empty()
    paginatorBox.append('<li class="prev"><a href="#" aria-label="Previous"><span aria-hidden="true">&laquo;</span></a></li>')
    paginatorBox.append('<li class="next"><a href="#" aria-label="Next"><span aria-hidden="true">&raquo;</span></a></li>')
    // Check if prev & next should be disabled
    if (current === 1) {
      $('li.prev').addClass('disabled')
    }
    if (current === pages || pages === 0) {
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

  // Inject list element in container
  // @public
  const showCurrentSpan = () => {
    checkInit()
    let offsetStart = offset - pageSpan
    let toShow = arr.slice(offsetStart, offset)
    if (toShow.length > 0) {
      container.empty()
      toShow.forEach(user => {
        factory(container, user)
      })
    }
  }

  // Go to previous page
  // @public
  const prevPage = ($el) => {
    if (!$el.hasClass('disabled')) {
      current--
      offset = current * pageSpan
      createPaginator()
      showCurrentSpan()
    }
  }

  // Go to next page
  // @public
  const nextPage = ($el) => {
    if (!$el.hasClass('disabled')) {
      current++
      offset = current * pageSpan
      createPaginator()
      showCurrentSpan()
    }
  }

  // Go to specific page
  // @public
  const goToPage = ($el) => {
    current = parseInt($el.find('a').text())
    offset = current * pageSpan
    createPaginator()
    showCurrentSpan()
  }

  // Change page span
  // @public
  const changePageSpan = (val) => {
    current = 1
    pageSpan = val
    offset = current * pageSpan
    createPaginator()
    showCurrentSpan()
  }

  // Expose methods
  var methods = {
    init: init,
    refresh: refresh,
    createPaginator: createPaginator,
    showCurrentSpan: showCurrentSpan,
    prevPage: prevPage,
    nextPage: nextPage,
    goToPage: goToPage,
    changePageSpan: changePageSpan
  }

  // Plugin router
  $.fn.paginator = function (methodOrOptions) {
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
