$(document).ready(function(){	
	$('.addRow').click(function(){
		$('.panel-body').append('<div class="row"><div class="col-md-5"><div class="form-group"><input class="form-control" placeholder="Codice" /></div></div><div class="col-md-3"><div class="form-group"><input class="form-control perc" placeholder="% Utenti" /></div></div><div class="col-md-4"><div class="form-group text-right"><button data-action="delete" class="btn btn-sm btn-danger"><span class="glyphicon glyphicon-remove"></span></button></div></div></div>');
	});
	
	$('.save').click(function(){
		tot = 0;
		removeErrors();
		codes = [];
		$.each($('.form-control.perc'), function(){
			if($.trim($(this).val()) != '' && $.trim($(this).parent().parent().siblings('.col-md-5').find('.form-control').val()) != ''){
				tot+=parseInt($(this).val());
				c = [];
				c.push($.trim($(this).parent().parent().siblings('.col-md-5').find('.form-control').val()));
				c.push(parseInt($.trim($(this).val())));
				codes.push(c);
			}else{
				$(this).parent().addClass('has-error');
				$(this).parent().parent().siblings('.col-md-5').children('.form-group').addClass('has-error');
				return
			}
		});
		if(tot<=100 && tot != 0){
			$.ajax({
				method: 'POST',
				dataType: 'json',
				url: window.base_url + 'dashboard/assignCodes/',
				data: {'codes': codes},
				beforeSend: function(){
					$('button.save').button('loading');
				},
				success: function(data){
					$('button.save').button('reset');
					console.log(data);
				},
				error: function(data){
					$('button.save').button('reset');
					if(data.status == 409){
						$('.signup .text-danger').removeClass('hidden').text(data.responseJSON);
					}else{
						$('.signup .text-danger').removeClass('hidden').text('Si è verificato un errore inaspettato, aggiornare la pagina e ritentare');
					}
				}
			});
			codes = [];
		}else{
			alert('ERROR');
			codes = [];
		}
	});
	
	$('body').on('click', '.btn-danger', function(){
		$(this).parent().parent().parent().remove();
	});
});