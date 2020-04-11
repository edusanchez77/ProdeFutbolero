jQuery(document).on('submit','#formlg', function(event){
	event.preventDefault();

	jQuery.ajax({
		url: 'login.php',
		type: 'POST',
		dataType: 'json',
		data: $(this).serialize(),
		beforeSend: function(){
			$('.botonlg').val('Validando');
		}
	})
	.done(function(respuesta){
		console.log(respuesta);
		if(!respuesta.error){
			swal({
			  title: respuesta.nombre,
		      text: respuesta.mensaje+" a Prode Futbolero",
		      icon: "success",
		      button: false
		    });
		    setTimeout(function(){
		    	location.href='jugar.php';
		    }, 1000);
			

		}else{
			swal({
		      text: "Dni o Password Incorrecto",
		      icon: "error",
		      button: true
		    });
		    setTimeout(function(){
		    	$('.botonlg').val('INGRESAR');
		    }, 3000);

			/*$('.error').slideDown('slow');
			setTimeout(function(){
				$('.error').slideUp('slow');	
			},3000);
			$('.botonlg').val('INGRESAR');*/
		}
	})
	.fail(function(resp){
		console.log(resp.responseText);	
	})
	.always(function(){
		console.log("complete");
	});
});