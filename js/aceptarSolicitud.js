function aceptarSolicitud(idInvitacion, status){
	if (status == "R") {
		swal({
	        text: "Solicitud rechazada",
	        icon: "error",
	        button: false
        });
	}else{
		swal({
	        text: "Solicitud aceptada",
	        icon: "success",
	        button: false
        });
	}
	setTimeout(function(){
		location.href='aceptar_invitacion.php?invitacion='+idInvitacion+'&status='+status
	}, 500);
}

function invitarAmigos(){
	swal({
	    text: "Invitación enviada",
	    icon: "success",
	    button: false
    });
    setTimeout(function(){
		return true
	}, 500);
}

function crearGrupo(){
	swal({
	    title: "Grupo creado con éxito",
	    text: "Se envió e-mail a tus amigos",
	    icon: "success",
	    button: true
    });
    setTimeout(function(){
		return true
	}, 500);
}

/*
href="aceptar_invitacion.php?invitacion=<?php echo $id_invitacion ?>&status=R"
*/