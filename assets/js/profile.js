$(document).ready(function(){

	$('button.signup').click(function(){
		removeErrors();
		valid = true;
		if(!checkNamePunct($('.form-control[name=name]'))){valid = false}
		if(!checkNamePunct($('.form-control[name=surname]'))){valid = false}
		if(!checkDigits($('.form-control[name=phone]'))){valid = false};
		if(!checkEmail($('.form-control[name=emailS]'))){valid = false};

		if($.trim($('.form-control[name=dateBirth]').val()) == ""){valid = false};

		if($.trim($('.form-control[name=address]').val())==""){valid = false}

		if(!checkDigits($('.form-control[name=cap]'))){valid = false}
		if(!checkNamePunct($('.form-control[name=prov]'))){valid = false}
		if(!checkCF($('.form-control[name=cf]'))){valid = false}

		if(!checkNamePunct($('.form-control[name=country]'))){valid = false}
		if(!checkNamePunct($('.form-control[name=work]'))){valid = false}
		if(valid){
			$.ajax({
				method: 'POST',
				dataType: 'json',
				url: window.base_url + 'users/editUser/',
				data: $('.form-control[name=name]').serialize()+'&'+$('.form-control[name=surname]').serialize()+'&'+$('.form-control[name=dateBirth]').serialize()+'&'+$('.form-control[name=country]').serialize()+'&'+$('.form-control[name=address]').serialize()+'&'+$('.form-control[name=cap]').serialize()+'&'+$('.form-control[name=prov]').serialize()+'&'+$('.form-control[name=cf]').serialize()+'&'+$('.form-control[name=emailS]').serialize()+'&'+$('.form-control[name=phone]').serialize()+'&'+$('.form-control[name=work]').serialize(),
				beforeSend: function(){
					$('button.signup').button('loading');
				},
				success: function(data){
					$('button.signup').button('reset');
					window.location.href = window.base_url+"dashboard";
				},
				error: function(data){
					$('button.signup').button('reset');
					if(data.status == 409){
						$(' .text-danger').removeClass('hidden').text(data.responseJSON);
					}else{
						$(' .text-danger').removeClass('hidden').text('Si è verificato un errore inaspettato, aggiornare la pagina e ritentare');
					}
				}
			});
		}else{
			$('.text-danger').removeClass('hidden');
			return
		}
	});

	$('body').on('click', '.winners .modal-footer a', function(e){
		$.ajax({
			method: 'POST',
			dataType: 'json',
			url: window.base_url + 'dashboard/confirmWinner/',
			data: 'role='+$(this).data('role')+'&ID='+$(this).data('id'),
			success: function(data){
				$('.winners').modal('toggle');
			}
		});
	});
});
