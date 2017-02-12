$(document).ready(function(){
	$('input.cm').change(function() {
		if(this.checked) {
      		$('input[name=code]').val('').attr('disabled', true);
      	}else{
	      	$('input[name=code]').attr('disabled', false).focus();
      	}
	});

	$('button.signup').click(function(){
		removeErrors();
		$('.birthDate').children().children().removeClass('has-error');
		$('.accept').parent().removeClass('has-error');
		valid = true;
		if(!checkNamePunct($('.form-control[name=name]'))){valid = false}
		if(!checkNamePunct($('.form-control[name=surname]'))){valid = false}
		var date = "";
		if($.trim($('.form-control[name=dateBirth1]').val()) === "" || $.trim($('.form-control[name=dateBirth2]').val()) === "" || $.trim($('.form-control[name=dateBirth3]').val()) === ""){
			$('.birthDate').children().children().addClass('has-error');
			valid = false;
		}else{
			if($.trim($('.form-control[name=dateBirth1]').val()).length == 1){var dd='0'+$.trim($('.form-control[name=dateBirth1]').val())}else{var dd=$.trim($('.form-control[name=dateBirth1]').val())}
			if($.trim($('.form-control[name=dateBirth2]').val()).length == 1){var mm='0'+$.trim($('.form-control[name=dateBirth2]').val())}else{var mm=$.trim($('.form-control[name=dateBirth2]').val())}
			date = dd + '/' + mm + '/' + $.trim($('.form-control[name=dateBirth3]').val());
			valid = checkDate(date);
		}
		if(!checkNamePunct($('.form-control[name=country]'))){valid = false}
		if(!checkAddr($('.form-control[name=address]'))){valid = false}
		if($.trim($('.form-control[name=door]').val()) == ""){
			$('.form-control[name=door]').parent().addClass('has-error');
			valid = false;
		}
		if(!checkDigits($('.form-control[name=cap]'))){valid = false}
		if(!checkNamePunct($('.form-control[name=prov]'))){valid = false}
		if(!checkCF($('.form-control[name=cf]'))){valid = false}
		if($.trim($('.form-control[name=passwordS]').val()) !== $.trim($('.form-control[name=passwordS2]').val()) || $.trim($('.form-control[name=passwordS2]').val()) === "" || $.trim($('.form-control[name=passwordS]').val()) === ""){
			$('.form-control[name=passwordS]').parent().addClass('has-error');
			$('.form-control[name=passwordS2]').parent().addClass('has-error');
			valid = false;
		}
		if(!checkEmail($('.form-control[name=emailS]'))){valid = false}
		if($.trim($('.form-control[name=emailS]').val()) !== $.trim($('.form-control[name=emailS2]').val()) || $.trim($('.form-control[name=emailS2]').val()) === "" || $.trim($('.form-control[name=emailS]').val()) === ""){
			$('.form-control[name=emailS]').parent().addClass('has-error');
			$('.form-control[name=emailS2]').parent().addClass('has-error');
			valid = false;
		}
		if(!checkDigits($('.form-control[name=phone]')));
		if(!checkNamePunct($('.form-control[name=work]'))){valid = false}
		if($.trim($('.form-control[name=code]').val()) === "" && !$('.cm').is(":checked")){
			$('.form-control[name=code]').parent().addClass('has-error');
			valid = false;
		}else{
			if($('.cm').is(':checked')){
				click = '-1';
			}else{
				click = $.trim($('.form-control[name=code]').val());
			}
		}
		if(!$('.accept').is(":checked")){$('.accept').parent().addClass('has-error');valid=false;}
		if(valid){
			$.ajax({
				method: 'POST',
				dataType: 'json',
				url: window.base_url + 'users/newUser/',
				data: $('.form-control[name=name]').serialize()+'&'+$('.form-control[name=surname]').serialize()+'&dateBirth='+date+'&'+$('.form-control[name=country]').serialize()+'&'+$('.form-control[name=address]').serialize()+'&'+$('.form-control[name=door]').serialize()+'&'+$('.form-control[name=cap]').serialize()+'&'+$('.form-control[name=prov]').serialize()+'&'+$('.form-control[name=cf]').serialize()+'&'+$('.form-control[name=passwordS]').serialize()+'&'+$('.form-control[name=emailS]').serialize()+'&'+$('.form-control[name=phone]').serialize()+'&'+$('.form-control[name=work]').serialize()+'&clickM='+click,
				beforeSend: function(){
					$('button.signup').button('loading');
				},
				success: function(data){
					$('button.signup').button('reset');
					$.each($('.jumbotron .row'), function(){
						$(this).toggleClass('hidden');
					});
				},
				error: function(data){
					$('button.signup').button('reset');
					if(data.status == 409){
						$('.signup .text-danger').removeClass('hidden').text(data.responseJSON);
					}else{
						$('.signup .text-danger').removeClass('hidden').text('Si è verificato un errore inaspettato, aggiornare la pagina e ritentare');
					}
				}
			});
		}else{
			$('.signup .text-danger').removeClass('hidden');
			return
		}
	});

});
