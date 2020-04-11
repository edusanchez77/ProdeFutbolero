$(document).ready(function(){
	$('.grupos-detalle #crea_grupo').hide();
	$('.grupos-detalle #modifica_grupo').hide();
	$('.grupos-detalle .grupos-pertenecientes').show();
	$('.grupos-invitar-form').hide();
	$('.grupos-miembros').hide();
	$('.grupos-busqueda').hide();

	var flag = 0;
	var flag2 = 0;
	var flag3 = 0;
	var flag4 = 0;
	var flag5 = 0;

	$('.crear').click(function(){
		if (flag == 0) {
			$('.grupos-detalle .grupos-pertenecientes').hide();
			$('.grupos-detalle #crea_grupo').show();
			$(this).text('VOLVER');
			
			flag = 1;
			return false;
		} else{
			$('.grupos-detalle .grupos-pertenecientes').show();
			$('.grupos-detalle #crea_grupo').hide();
			$(this).text('CREAR GRUPO');
			flag = 0;
		}
	});

	$('.invitar').click(function(){
		if (flag2 == 0) {
			$('.grupos-invitar-form').show();
			$(this).text('CERRAR');
			flag2 = 1;
			return false;
		} else{
			$('.grupos-invitar-form').hide();
			$(this).text('INVITAR AMIGOS');
			flag2 = 0;
		}
	});

	$('.miembros').click(function(){
		if (flag3 == 0) {
			$('.grupos-detalle .grupos-pertenecientes').hide();
			$('.grupos-miembros').show();
			
			flag3 = 1;
			return false;
		} else{
			$('.grupos-detalle .grupos-pertenecientes').show();
			$('.grupos-miembros').hide();
			flag3 = 0;
		}
	});

	$('.modificar-grupo').click(function(){
			$('.grupos-detalle .grupos-pertenecientes').hide();
			$('.grupos-detalle #modifica_grupo').show();
			$('.crear').hide();
	});

	$('.modificarVolver').click(function(){
		$('.grupos-detalle .grupos-pertenecientes').show();
		$('.grupos-detalle #modifica_grupo').hide();
		$('.crear').show();
	});

	
		
	

});

function nav(value) {
			if (value != ""){ 
				location.href = value; 
			}
		}


function confirmacion(idComentario){
	swal({
		title: "¿Estás seguro?",
		text: "Estás por eliminar el comentario",
		icon: "warning",
		buttons: ["NO", "SI"],
		dangerMode: false,
	})
	.then((willDelete) => {
		if (willDelete) {
	    	swal("El comentario ha sido eliminado", {
	      		icon: "success",
	    	});
	    	window.location.href="eliminar_comentario.php?id="+idComentario;
	  	} 
	});
			/*if(confirm("¿Está seguro de borrar este comentario?")){
				window.location.href="eliminar_comentario.php?id="+idComentario;
			}else(this.close())*/
}

function eliminarUsuario(idGrupo, userNombre, userApellido, userDni){
	swal({
		title: "¿Estás seguro?",
		text: "Estás por eliminar a "+userNombre+" "+userApellido+" del grupo",
		icon: "warning",
		buttons: ["NO", "SI"],
		dangerMode: false,
	})
	.then((willDelete) => {
		if (willDelete) {
	    	swal(userNombre+" ha sido eliminado", {
	      		icon: "success",
	    	});
	    	window.location.href="eliminarUsuarioGrupo.php?id="+idGrupo+"&dni="+userDni;
	  	} 
	});
			/*if(confirm("¿Está seguro de borrar este comentario?")){
				window.location.href="eliminar_comentario.php?id="+idComentario;
			}else(this.close())*/
}