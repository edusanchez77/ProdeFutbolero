/*function getSelectValue(){
		var urlMenu = document.getElementById('cambiar-grupo').value;
		window.open(urlMenu);
	};
*/
$(document).ready(function(){
	$('.grupos-detalle #crea_grupo').hide();
	$('.grupos-detalle .grupos-pertenecientes').hide();
	$('.grupos-invitar-form').hide();
	$('.grupos-miembros').hide();
	$('.grupos-busqueda').show();

	var flag = 0;
	var flag2 = 0;
	var flag3 = 0;
	var flag4 = 0;
	var flag5 = 0;

	$('.crear').click(function(){
		if (flag == 0) {
			$('.grupos-detalle .grupos-busqueda').hide();
			$('.grupos-detalle #crea_grupo').show();
			$(this).text('VOLVER');
			
			flag = 1;
			return false;
		} else{
			$('.grupos-detalle .grupos-busqueda').show();
			$('.grupos-detalle #crea_grupo').hide();
			$(this).text('CREAR GRUPO');
			flag = 0;
		}
	});

	$('.invitar').click(function(){
		if (flag2 == 0) {
			$('.grupos-invitar-form').show();
			flag2 = 1;
			return false;
		} else{
			$('.grupos-invitar-form').hide();
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
		if (flag4 == 0) {
			$('.grupos-detalle .grupos-pertenecientes').hide();
			$('.grupos-detalle #crea_grupo').show();
			
			flag4 = 1;
			return false;
		} else{
			$('.grupos-detalle .grupos-pertenecientes').show();
			$('.grupos-detalle #crea_grupo').hide();
			flag4 = 0;
		}
	});

	
	

});