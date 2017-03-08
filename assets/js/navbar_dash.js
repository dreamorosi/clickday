var active = window.navActive
var items = document.querySelectorAll('.nav-sidebar.items li')
items.forEach(function (item) {
  if (item.dataset.nav === active) {
    item.classList.add('active')
  }
})
