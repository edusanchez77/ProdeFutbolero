$(document).ready(function(){
	$("#contenido #grupos #grupo #equipos a").css("opacity","0.5");

	$("#contenido #grupos #grupo #equipos a").hover(function(){
		$(this).css("opacity","1");
	});
});