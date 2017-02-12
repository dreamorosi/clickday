function checkEmail(el){
	pattern = /^([a-z\d!#$%&'*+\-\/=?^_`{|}~\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]+(\.[a-z\d!#$%&'*+\-\/=?^_`{|}~\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]+)*|"((([ \t]*\r\n)?[ \t]+)?([\x01-\x08\x0b\x0c\x0e-\x1f\x7f\x21\x23-\x5b\x5d-\x7e\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]|\\[\x01-\x09\x0b\x0c\x0d-\x7f\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]))*(([ \t]*\r\n)?[ \t]+)?")@(([a-z\d\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]|[a-z\d\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF][a-z\d\-._~\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]*[a-z\d\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])\.)+([a-z\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]|[a-z\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF][a-z\d\-._~\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]*[a-z\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])\.?$/i;
	if(!pattern.test($.trim(el.val()))){
		el.parent().addClass('has-error');
		if($('.login').hasClass('in')){
			$('.modal-body .text-danger').text('Inserisci un indirizzo email valido').removeClass('hidden');
		}else{
			return false;
		}
	}else{
		return true;
	}
}

function removeErrors(){
	$('.text-danger').addClass('hidden');
	$('.form-control').parent().removeClass('has-error');
}

function checkDate(el){
	valid = true;
	data = el;
	dateformat = /^(0?[1-9]|[12][0-9]|3[01])[\/\-](0?[1-9]|1[012])[\/\-]\d{4}$/;
	if (data.match(dateformat)) {
		opera1 = data.split('/');
		opera2 = data.split('-');
		var pdate;
		if (opera1.length > 1) {
			pdate = opera1;
		}else if(opera2.length > 1){
			pdate = opera2;
		}
		dd = parseInt(pdate[0]);
		mm = parseInt(pdate[1]);
		yy = parseInt(pdate[2]);
		var list = [31, 28, 31, 30, 31, 30, 31, 31, 30, 31, 30, 31];
		if (mm == 1 || mm > 2) {
			if (dd > list[mm - 1]) {
				$('.birthDate').children().children().addClass('has-error');
				return false;
			}
		}
		if (mm == 2) {
			var leapY = false;
			if ((yy%4 == 0) && (yy%100 != 0) || (yy%400 == 0)) {
				leapY = true;
			}
			if ((leapY == false) && (dd >= 29)) {
				$('.birthDate').children().children().addClass('has-error');
				return false;
			}
			if ((leapY == true) && (dd > 29)) {
				$('.birthDate').children().children().addClass('has-error');
				return false;
			}
		}
		return true;
	}else{
		$('.birthDate').children().children().addClass('has-error');
		return false;
	}
}

function checkNamePunct(el){
	pattern = /^([ \u00c0-\u01ffa-zA-Z'\-])+$/i;
	if(!pattern.test($.trim(el.val()))){
		el.parent().addClass('has-error');
		return false;
	}else{
		return true;
	}
}

function checkAddr(el){
	pattern = /^([ \u00c0-\u01ffa-zA-Z'\-])+.*$/i;
	if(!pattern.test($.trim(el.val()))){
		el.parent().addClass('has-error');
		return false;
	}else{
		return true;
	}
}

function checkDigits(el){
	pattern = /^\d+$/;
	if(!pattern.test($.trim(el.val().replace(" ", "")))){
		el.parent().addClass('has-error');
		return false;
	}else{
		return true;
	}
}

function checkStrongPass(el){
	pattern = /(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{6,}/;
	if(!pattern.test($.trim(el.val()))){
		el.parent().addClass('has-error');
		return false;
	}else{
		return true;
	}
}

function checkCF(el) {
	if($.trim(el.val()).length != 16){
		el.parent().addClass('has-error');
		return false;
	}
	for(i=0; i<16; i++){
		if("ABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789".indexOf(el.val().toUpperCase().charAt(i)) == -1){
			el.parent().addClass('has-error');
			return false;
		}
	}
    s = 0;
	for(i=1; i<=13; i+=2) {
		s+="ABCDEFGHIJKLMNOPQRSTUVWXYZ".indexOf("ABCDEFGHIJABCDEFGHIJKLMNOPQRSTUVWXYZ".charAt("0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ".indexOf(el.val().toUpperCase().charAt(i))));
	}
	for(i=0; i<=14; i+=2){
		s+="BAKPLCQDREVOSFTGUHMINJWZYX".indexOf("ABCDEFGHIJABCDEFGHIJKLMNOPQRSTUVWXYZ".charAt("0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ".indexOf(el.val().toUpperCase().charAt(i))));
	}
	if(s%26!=el.val().toUpperCase().charCodeAt(15) - 'A'.charCodeAt(0)){
		el.parent().addClass('has-error');
		return false;
	}
	return true;
}
