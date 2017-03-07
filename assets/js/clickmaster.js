var $ = window.$
var users = window.users

$(document).ready(function () {
  createNumbers()
  populateTable()
})

function createNumbers () {
  var noProject = users.users.filter(function (user) {
    if (user.code === null) {
      return user
    }
  })
  var totUsers = users.users.length
  var totNoProj = noProject.length
  var totProj = totUsers - totNoProj
  $('#totUsers').animateNumber({ number: totUsers })
  $('#totProj').animateNumber({ number: totProj })
  $('#totNoProj').animateNumber({ number: totNoProj })
}

function populateTable () {
  if (users.users.length === 0) {
    $('.emptyDetails').removeClass('hidden')
  } else {
		$('.emptyDetails').addClass('hidden')
		$('.detailsClickWidget .panel-body .table').removeClass('hidden');
		user = users.users;
		mOff = users.maxOffset;
		pgSp = users.pageSpan;
		pg = users.pages;
		if(pg>1) createUserPages();
		showPageUsers(0);
	}
}

function createUserPages(){
  $('.detailsClickWidget .panel-footer').removeClass('hidden');
  $('#usrPages').empty().append('<li class="disabled usrA prev"><a href="#" aria-label="Previous"><span aria-hidden="true">&laquo;</span></a></li>');
  c = 0;
  while(c<pg){
    if(c==0) a = 'class="active"';
    else a = '';
    $('#usrPages').append('<li '+a+' data-offset="'+ c*pgSp +'"><a href="#">'+ (c+1) +'</a></li>');
    c++;
  }
  if(pg==1) d = 'disabled';
  else d = '';
  $('#usrPages').append('<li class="'+d+' usrA next"><a href="#" aria-label="Next"><span aria-hidden="true">&raquo;</span></a></li>');
}

function showPageUsers(offset){
  offset = parseInt(offset);
  $('.detailsClickWidget .prev, .detailsClickWidget .next').removeClass('disabled');
  if(offset==0)$('.detailsClickWidget .prev').addClass('disabled');
  if(offset==mOff) $('.detailsClickWidget .next').addClass('disabled');
  if(offset<mOff){
    $('.detailsClickWidget .table-striped tbody').empty();
    for(var i = offset; i < offset+pgSp; i++){
      $('.detailsClickWidget .table-striped tbody').append('<tr class="user-line" data-ID="'+user[i].ID+'"><td><div class="status-circle status'+user[i].status+'"></div></td><td><b>'+user[i].name+'</b></td><td>'+user[i].join+'</td><td>'+user[i].approved+'</td><td>'+user[i].code+'</td><td>'+user[i].screen+'</td></tr>');
    };
  }else{
    $('.detailsClickWidget .table-striped tbody').empty()
    for(var i = offset; i < user.length; i++){
      $('.detailsClickWidget .table-striped tbody').append('<tr class="user-line" data-ID="'+user[i].ID+'"><td><div class="status-circle status'+user[i].status+'"></div></td><td><b>'+user[i].name+'</b></td><td>'+user[i].join+'</td><td>'+user[i].approved+'</td><td>'+user[i].code+'</td><td>'+user[i].screen+'</td></tr>');
    };
  }
  cr = offset;
}

function nextPageUsers(el){
  if(el.hasClass('disabled')) return;
  else
  if(el.hasClass('prev')){
    if(cr>0){
      el = $('#usrPages .active').prev();
      $('#usrPages li').removeClass('active');
      el.addClass('active');
    }
    showPageUsers(cr-pgSp)
  }else{
    if(cr<mOff){
      el = $('#usrPages .active').next();
      $('#usrPages li').removeClass('active');
      el.addClass('active');
    }
    showPageUsers(cr+pgSp);
  }
}

$('#usrPages').on('click','li', function(){
  if($(this).hasClass('active')) return;
  else if($(this).hasClass('usrA')){
    nextPageUsers($(this));
  }
  else{
    $('#usrPages li').removeClass('active');
    $(this).addClass('active');
    showPageUsers($(this).attr('data-offset'));
  }
});
