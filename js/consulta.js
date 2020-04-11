function enviarConsulta(){
  swal({
    title: "Tu consulta fue enviada con éxito", 
    text: "La misma será respondida a la brevedad. Muchas gracias por comunicarte con nosotros.",
    icon: "success",
    button: false
  });
  setTimeout(function(){
    return true
  }, 5000);
        
}