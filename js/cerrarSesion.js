function cerrarSesion(){
  swal({
      text: "¡Hasta Pronto!",
      button: false
    });
    setTimeout(function(){
	   	location.href='cerrarsesion.php';
	}, 2000);
}