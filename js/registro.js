jQuery(document).on('submit','#formlg', function(event){ 
	event.preventDefault();

	jQuery.ajax({
		url: 'registro.php',
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
		      text: respuesta.mensaje,
		      icon: "success",
		      button: false
		    });
		    setTimeout(function(){
		    	location.href=respuesta.url;
		    }, 3000);
			

		}else{
			swal({
		      text: respuesta.mensaje,
		      icon: "error",
		      button: true
		    });
		    setTimeout(function(){
		    	$('.botonlg').val('CREAR CUENTA');
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