$('form span').hide();
document.getElementById("submit").disabled = true;
$('#submit').css({backgroundColor: "grey"});
//$('form #submit').prop("disabled");

$('#confirmarpassword').keyup(matchPassword).keyup(enableButton);

function isMatching(){
	return $('#password').val() === $('#confirmarpassword').val();
}

function matchPassword(){
	if (isMatching()){
		$("#passwordNoMatch").hide();
	}else{
		$("#passwordNoMatch").show();
	};	
}

function isButtonEnabled(){
	return isMatching();
}

function enableButton(){
	if (!isButtonEnabled()) {
		$('#submit').css({backgroundColor: "grey"});
		document.getElementById("submit").disabled = true;
	}else{
		$('#submit').css({backgroundColor: "#464a3b"});
		document.getElementById("submit").disabled = false;
	};
}