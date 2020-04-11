jQuery(document).on('submit','#formulario', function(event){
  event.preventDefault();

  jQuery.ajax({
    url: 'resetearPassword.php',
    type: 'POST',
    dataType: 'json',
    data: $(this).serialize(),
  })
  .done(function(respuesta){
    console.log(respuesta);
    if(!respuesta.error){
       swal({
        text: respuesta.nombre+", se envió la información solicitada por correo",
        icon: "success",
        buttons: [false,true]
       })
        .then((willDelete) => {
          if (willDelete) {
            //location.href='index.html'; 
            location.href='mailResetearPassword.php?nombre='+respuesta.nombre+'&dni='+respuesta.dni+'&mail='+respuesta.email+'&password='+respuesta.password;
            }
          });
       
      
      //location.href='index.html';

    }else{
      swal({
        text: "No existe usuario registrado con este mail",
        icon: "error"
        });
    }
  })
  .fail(function(resp){
    console.log(resp.responseText); 
  })
  .always(function(){
    console.log("complete");
  });
});