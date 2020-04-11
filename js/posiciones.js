$(document).ready(function(){
	$('ul.titulo li a:first').addClass('activo');
	$('.general article').hide();
	$('.general article:first').show();

	$('ul.titulo li a').click(function(){
		$('ul.titulo li a').removeClass('activo');
		$(this).addClass('activo');
		$('.general article').hide();

		var activeTab = $(this).attr('href');
		$(activeTab).show();
		return false;
	});
});