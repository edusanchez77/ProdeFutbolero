function crearGrupo(){
  swal({
    title: "Grupo creado con éxito", 
    text: "Se envió mail invitando a tus amigos a unirse",
    icon: "success",
    button: true
  });
  setTimeout(function(){
    return true
  }, 5000);        
}