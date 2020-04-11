$('form span').hide();

$('#password').keyup(errorMensaje).keyup(enableButton);
$('#confirmarpassword').keyup(matchPassword).keyup(enableButton);

function isPassValid(){
	return $('#password').val().length >= 6;
}

function isMatching(){
	return $('#password').val() === $('#confirmarpassword').val();
}

function errorMensaje(){
	if (isPassValid()){
		$("#passwordLength").hide();
	}else{
		$("#passwordLength").show();
	};
}

function matchPassword(){
	if (isMatching()){
		$("#passwordNoMatch").hide();
	}else{
		$("#passwordNoMatch").show();
	};	
}

function isButtonEnabled(){
	return isPassValid() && isMatching();
}

function enableButton(){
	$('#submit').prop("disabled",!isButtonEnabled);
	if (!isButtonEnabled()) {
		$('#submit').css({backgroundColor: "grey"});
	}else{
		$('#submit').css({backgroundColor: "#464a3b"});
	};
}