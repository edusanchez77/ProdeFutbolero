$(document).ready(function(){
	$('.grupos-detalle #crea_grupo').hide();
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
			
			flag = 1;
			return false;
		} else{
			$('.grupos-detalle .grupos-pertenecientes').show();
			$('.grupos-detalle #crea_grupo').hide();
			flag = 0;
		}
	});
});