var $ = window.$
var projectsClassic = window.projects_classic
var projectsSc = window.projects_sc
var currentType = 1 // classic == 1 && sc == 0
var currentOffset = 10
var currentQuery = []
var querying = 0

$(document).ready(function () {
  // Loads first 10 projects
  initProjectList(currentType)

  /* Manage clicks on left column. If click on a project show info, otherwise
  * load more */
  $('.projectsWidget tbody ul').on('click', 'li', function () {
    if ($(this).hasClass('loadMore')) {
      currentOffset = loadMore(currentOffset, currentType)
    } else {
      var child = $(this).get(0)
      var parent = child.parentNode
      $('.leftCol ul').find('.active').removeClass('active')
      $(this).addClass('active')
      var index = Array.prototype.indexOf.call(parent.children, child)
      var project = {}

      if (querying) {
        project = currentQuery[index]
      } else {
        if (currentType) {
          project = projectsClassic[index]
        } else {
          project = projectsSc[index]
        }
      }

      showProjectInfo(project)
    }
  })

  /* Manage project type selection and reinitialises the list */
  $('.projectsWidget thead').on('click', '.projectHandle', function () {
    let newType = $(this).data('project')
    currentType = newType ? 1 : 0
    currentOffset = 10

    $('.projectHandle.active').removeClass('active')
    $(this).addClass('active')

    showProjectInfo()
    initProjectList(currentType)
  })

  /* Manage search field and shows results or resets */
  $('.panel-body').on('keyup', '#search', function () {
    var $searchBox = $(this)
    var $resetButton = $('.resetQuery')
    var query = $.trim($searchBox.val())
    if (query === '') {
      querying = 0
      currentQuery = []
      initProjectList(currentType)
      $searchBox.removeClass('querying')
      $resetButton.addClass('hidden')
    } else {
      querying = 1
      filterProjects(currentType, query)
      $searchBox.addClass('querying')
      $resetButton.removeClass('hidden')
    }
  })

  $('.panel-body').on('click', '.resetQuery', function () {
    querying = 0
    currentQuery = []
    $('#search').val('').removeClass('querying')
    $(this).addClass('hidden')
    initProjectList(currentType)
  })
})

/* Takes an array of projects and an offset and returns the markup for the
 * selected 10 projects */
function getProjectChunk (projects, offset) {
  var projectsChunk = []
  projectsChunk = projects.slice(offset - 10, offset)
  var projectsMarkup = projectsChunk.map(function (project) {
    return '<li>' + project.proj + '</li>'
  })
  return projectsMarkup
}

/* Takes a project type and resets the list showing the first 10 projects */
function initProjectList (type) {
  var projectsMarkup = ''
  if (type) {
    projectsMarkup = getProjectChunk(projectsClassic, 10)
  } else {
    projectsMarkup = getProjectChunk(projectsSc, 10)
  }
  $('.projectsWidget tbody .leftCol ul')
    .empty()
    .append(projectsMarkup.join(''))
    .append('<li class="loadMore text-center">Load More</li>')
}

/* Takes an offset and project type and loads the next 10 elements */
function loadMore (currentOffset, type) {
  let $box = $('.leftCol ul')
  var $loadButton = $box.find('li.loadMore')
  currentOffset += 10
  $loadButton.text('Caricando..')

  var projectsMarkup = ''
  let maxL
  if (type) {
    projectsMarkup = getProjectChunk(projectsClassic, currentOffset)
    maxL = projectsClassic.length
  } else {
    projectsMarkup = getProjectChunk(projectsSc, currentOffset)
    maxL = projectsSc.length
  }

  $loadButton
    .remove()
    .text('Load More')

  $box
    .append(projectsMarkup)

  if (currentOffset <= maxL) {
    $box
      .append($loadButton)
  }
  return currentOffset
}

/* Takes an optional project argument. If provided it'll show the project info
 * otherwise it'll show a message */
function showProjectInfo (project = null) {
  let $infoBox = $('.projectsWidget tbody .projectInfo')
  $infoBox.empty()

  if (project === null) {
    $infoBox.append('<p class="text-center blankInfo">Seleziona un progetto per visualizzare le informazioni.</p>')
  } else {
    var proj = project.file.substr(0, project.file.length - 4)
    $infoBox.append('<dl>')
    $infoBox.append('<dt>Nome Progetto</dt><dd>' + project.proj + '</dd>')
    $infoBox.append('<dt>Regione</dt><dd>' + project.region_ex + '</dd>')
    $infoBox.append('<dt>File associato</dt><dd>' + project.file + '</dd>')
    $infoBox.append('<dt>Cliccatori Assegnati</dt><dd class="infoClicker">Loading..</dd>')
    $infoBox.append('</dl>')
    $infoBox.append('<div class="text-center"><a class="btn btn-default btn-sm" href="' + window.base_url + 'dashboard/codes/' + proj + '">Assegna questo codice a dei cliccatori</a><div>')
    getAssociatedClickers(project.file)
  }
}

/* Takes a project ID and returns the users associated to it */
function getAssociatedClickers (code) {
  var url = window.base_url + 'dashboard/getProjClickers/' + code
  $.getJSON(url, function (data) {
    $('.infoClicker').text(data)
  })
}

/* Takes a query and a project type and returns the matching (case insensitive) */
function filterProjects (type, query) {
  var projects = []
  if (type) {
    projects = projectsClassic
  } else {
    projects = projectsSc
  }
  var queried = []
  queried = projects.filter(function (project) {
    var text = project.proj
    if (text.toLowerCase().indexOf(query.toLowerCase()) !== -1) {
      return project
    }
  })
  currentQuery = queried
  let queriedMarkup = queried.map(function (project) {
    return '<li>' + project.proj + '</li>'
  })
  $('.projectsWidget tbody .leftCol ul')
    .empty()
    .append(queriedMarkup.join(''))
}
