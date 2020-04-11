function confirmacion(){
	swal({
		title: "¿Estás seguro?",
		text: "¿Desea salir sin guardar los cambios?",
		icon: "warning",
		buttons: ["NO", "SI"],
		dangerMode: false,
	})
	.then((willDelete) => {
		if (willDelete) {
	    	window.location.href="jugar.php";
	  	} 
	});
}

function guardar(){
	swal("El pronóstico ha sido guardado", {
	    icon: "success",
	});
}