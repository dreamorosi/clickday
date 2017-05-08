$(document).ready(function(){
	$('.forgot').click(function(){
		$('.modal-body').toggleClass('hidden');
		$('.forgotForm').removeClass('hidden');
		$('.modal-body .form-control').val(null);
		removeErrors();
	})

	$('.modal-body .form-control').keypress(function (e) {
		key = e.which;
		if(key == 13){
			if($('button.loginDo').is(':visible')) {
				$('button.loginDo').click();
			}else{
				$('button.forgotDo').click();
			}
			return;
		}
	});

	$('button.loginDo').click(function(){
		removeErrors();
		checkEmail($('.modal-body .form-control[name=email]'));
		if($('.modal-body .form-control[name=password]').val() === "" && $('.modal-body .text-danger').hasClass('hidden')){
			$('.modal-body .form-control[name=password]').parent().addClass('has-error');
			$('.modal-body .text-danger').text('Inserisci una password').removeClass('hidden');
		}
		if($('.modal-body .text-danger').hasClass('hidden')){
			$.ajax({
				method: 'POST',
				dataType: 'json',

				url: window.base_url + 'login/signin/',
				data: $('.modal-body .log').serialize()+'&'+$('.modal-body .form-control[name=password]').serialize(),
				beforeSend: function(){
					$('button.loginDo').button('loading');
				},
				success: function(data){
					$('button.loginDo').button('reset');
					window.location.href = window.base_url+"dashboard/";
				},
				error: function(data){
					$('button.loginDo').button('reset');
					if(data.status == 409){
						$('.modal-body .text-danger').removeClass('hidden').text('Combinazione email e password errata');
					}else{
						$('.modal-body .text-danger').removeClass('hidden').text('Si è verificato un errore inaspettato, aggiornare la pagina e ritentare.');
					}
				}
			});
		}else{
			return
		}
	});

	$('button.forgotDo').click(function(){
		removeErrors();
		checkEmail($('.forgotMail'));
		if($('.modal-body .text-danger').hasClass('hidden')){
			$.ajax({
				method: 'POST',
				dataType: 'json',
				url: window.base_url + 'login/setRecoveryCode/',
				data: $('.forgotMail').serialize(),
				beforeSend: function(){
					$('button.forgotDo').button('loading');
				},
				success: function(data){
					$('button.forgotDo').button('reset');
					$('.text-justify').text("Le istruzioni per reimpostare la tua password sono state inviate all'indirizzo indicato.");
					$('.forgotForm').addClass('hidden');
					console.log(data)
				},
				error: function(data){
					$('button.forgotDo').button('reset');
					if(data.status == 409){
						$('.modal-body .text-danger').removeClass('hidden').text(data.responseJSON);
						$('.modal-body .form-control[name=email]').parent().addClass('has-error');
					}else{
						$('.modal-body .text-danger').removeClass('hidden').text('Si è verificato un errore inaspettato, aggiornare la pagina e ritentare.');
					}
				}
			});
		}
	});
});
