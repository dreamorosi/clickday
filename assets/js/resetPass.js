$(document).ready(function(){
	$('.forgotPage .form-control').keypress(function (e) {
		key = e.which;
		if(key == 13){
			$('button.resetDo').click();
			return;  
		}
	});  
	
	$('button.resetDo').click(function(){
		removeErrors();
		checkStrongPass($('.form-control[name=passwordF]'));
		if($('.text-danger').hasClass('hidden')){
			if($.trim($('.form-control[name=passwordF]').val()) !== $.trim($('.form-control[name=passwordR]').val()) || $.trim($('.form-control[name=passwordR]').val()) === ""){
				$('.form-control[name=passwordF]').parent().addClass('has-error');
				$('.form-control[name=passwordR]').parent().addClass('has-error');
				$('.text-danger').text('Le password inserite non coincidono').removeClass('hidden');
			}else{
				$.ajax({
					method: 'POST',
					dataType: 'json',
					url: window.base_url + 'users/setNewPassword/',
					data: $('.form-control[name=passwordF]').serialize()+'&tab='+$(this).attr('tab_index')+'&role='+$(this).attr('data-role'),
					beforeSend: function(){
						$('button.resetDo').button('loading');
					},
					success: function(data){
						$('button.resetDo').button('reset');
						$.each($('.jumbotron .row'), function(){
							$(this).toggleClass('hidden');
						});
					},
					error: function(data){
						$('button.resetDo').button('reset');
						if(data.status == 409){
							$('.text-danger').removeClass('hidden').text(data.responseJSON);
							$('.form-control[name=passwordF]').parent().addClass('has-error');
							$('.form-control[name=passwordR]').parent().addClass('has-error');
						}else{
							$('.text-danger').removeClass('hidden').text('Si è verificato un errore inaspettato, aggiornare la pagina e ritentare');
						}
					}
				});
			}
		}
	});
});