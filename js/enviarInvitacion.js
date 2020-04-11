function enviarInvitacion(idGrupo){
	swal({
        text: "Solicitud enviada con éxito",
        icon: "success",
        button: false
        });
	setTimeout(function(){
		location.href='enviar_solicitud.php?grupo='+idGrupo
	}, 2000);
}