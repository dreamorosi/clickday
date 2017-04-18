const $ = window.$
var users = window.users

$(document).ready(function () {
  createNumbers()
  $('table').paginator({
    factory: rowFactory,
    list: users
  })
})

function createNumbers () {
  var noProject = users.filter(function (user) {
    if (user.code_ass === 'No') {
      return user
    }
  })
  var totUsers = users.length
  var totNoProj = noProject.length
  var totProj = totUsers - totNoProj
  $('#totUsers').animateNumber({ number: totUsers })
  $('#totProj').animateNumber({ number: totProj })
  $('#totNoProj').animateNumber({ number: totNoProj })
}

// Creates a row in the table
const rowFactory = (container, user) => {
  let $tds = `<td><div class='status-circle status${user.status}'></div></td>`
  $tds += `<td>${user.name}</td>`
  $tds += `<td>${user.join}</td>`
  $tds += `<td>${user.code}</td>`
  $tds += `<td>${user.code_rec}</td>`
  $tds += `<td>${user.screen}</td>`
  $tds += `<td>${user.lastSeen}</td>`

  let $tr = `<tr class='user-line' data-ID='${user.ID}'>${$tds}</tr>`
  container.append($tr)
}
