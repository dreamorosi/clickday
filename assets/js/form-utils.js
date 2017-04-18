window.FormUtils = function (methodOrOptions) {
  /*
  ///////// Variables ///////////
  */

  this.pluginName = 'fn.formUtils() - '
  this.isInit = 0
  this.settings = {
    errorClass: 'has-error'
  }
  this.isValid = 1

  /*
  ///////// Init Stuff ///////////
  */

  // Check that init() has been called
  // @private
  this.checkInit = () => this.isInit === 1 ? true : console.error(`${this.pluginName}Call init method before calling this one`)

  // Set various event listeners
  // @private
  this.setEventListeners = (form) => {
    let inputs = Array.from(form.querySelectorAll('input[required]'))

    form.noValidate = true

    inputs.forEach(input => {
      input.oninput = (e) => {
        let that = e.currentTarget
        if (that.checkValidity()) {
          this.removeError(that)
        } else {
          this.addError(that)
        }
      }
    })

    form.onsubmit = () => {
      inputs.forEach(input => {
        this.removeError(input)
        if (!input.checkValidity()) {
          this.addError(input)
        }
      })
    }
  }

  /*
  ///////// Utilities ///////////
  */
  // Check if node is all white space
  // @private
  this.isAllWs = (node) => !(/[^\t\n\r ]/.test(node.textContent))

  // Check if node can be ignored aka is a comment (8), text (3) or all ws
  // @private
  this.isIgnorable = (node) => (node.nodeType === 8) || ((node.nodeType === 3) && this.isAllWs(node))

  // Find and return the node before the one provided
  // @private
  this.nodeBefore = (node) => {
    while ((node = node.previousSibling)) {
      if (!this.isIgnorable(node)) return node
    }
    return null
  }

  // Scroll to top and add error to element and conditionally show message
  // @private
  this.addError = (input) => {
    let label = this.nodeBefore(input)
    window.scrollTo(0, 0)
    input.classList.add(this.settings.errorClass)
    // input.setCustomValidity(input.title)
    if (label !== null) {
      label.classList.add(this.settings.errorClass)
    }
  }

  // Remove error to element and conditionally remove message
  // @private
  this.removeError = (input) => {
    let label = this.nodeBefore(input)
    input.classList.remove(this.settings.errorClass)
    // input.setCustomValidity('')
    if (label !== null) {
      label.classList.remove(this.settings.errorClass)
    }
  }

  // Check that double fields are equals (i.e. Password & Confirm Password)
  // @private
  this.checkDoubles = (inputs, type) => {
    let fields = inputs.filter(input => input.type === type)
    if (fields.length > 1) {
      if (fields[0].value === fields[1].value) {
        return true
      } else {
        fields.forEach(input => this.addError(input))
        return false
      }
    } else {
      return true
    }
  }

  // Applies additional validation defined by user
  // @private
  this.additionalValidation = (inputs) => {
    let validations = this.settings.extendValidation
    if (validations.length > 0) {
      let isValid = true
      validations.forEach(fn => (isValid = fn(inputs)))
      return isValid
    } else {
      return true
    }
  }

  /*
  ///////// Public Methods ///////////
  */

  // Init function
  // @public
  this.init = (options) => {
    this.isInit = 1
    this.settings.form = options.form
    this.settings.extendValidation = options.extendValidation
    this.setEventListeners(options.form)
    // console.log(options)
  }

  // Process form aka returns a new object
  // @public
  this.process = () => {
    this.checkInit()
    let form = this.settings.form
    let response = {
      valid: true,
      payload: {}
    }
    let inputs = Array.from(form.querySelectorAll('input'))
    this.additionalValidation(inputs)
    // Firstly check html5 validation (empty fields or invalid)
    if (form.checkValidity()) {
      let inputs = Array.from(form.querySelectorAll('input'))
      // Then validate any double field and apply user defined validation
      if (!this.checkDoubles(inputs, 'password') || !this.checkDoubles(inputs, 'email') || !this.additionalValidation(inputs)) {
        response.valid = false
      // If everything's valid return serialized form as object
      } else {
        inputs.forEach(input => {
          response.payload[input.name] = input.value
        })
      }
      return response
    } else {
      response.valid = false
      return response
    }
  }
}
