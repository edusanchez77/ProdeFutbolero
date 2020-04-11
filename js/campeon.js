$(document).ready(function(){
	$('#contenido #grupo #bandera>div').hide();

	$('#contenido #grupo #bandera>div').hover(function(){
		$(this).show();
	},
	function(){
		$('#contenido #grupo #bandera>div').hide();
	});
});