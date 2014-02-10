$('body').on('keyup',function(e){
	if (((e.keyCode || e.which)== 27) && ($('.front').css('display')=='block')){
		$('.closeme').click();
		window.history.pushState(null,'', 'http://franco.encom.uy');
	}
});
$('.closeme').on("click",function(){
	$('.container').css('display','block');
	$('.front').fadeOut("slow",function(){
		$(this).remove();
	});
	window.location.hash = '';
	$( "script" ).each(function(){
  		if (($( this ).attr('src')=='js/popup.js') || ($( this ).attr('src')=='js/popup.img.js') || ($( this ).attr('src')=='js/popup.pag.js')){
  			$(this).remove();
  			//return false; 
  		}
	});
});