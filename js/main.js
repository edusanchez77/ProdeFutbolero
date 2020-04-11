$(document).ready(function(){
	$('.dropdown').hover(function(){
		$(this).children('.sub-menu').slideDown();
	},
		function(){
			$(this).children('.sub-menu').slideUp();		
		}
	);


});