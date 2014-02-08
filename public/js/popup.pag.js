$('li a').on('click',function(){
	$( "script" ).each(function(){
  		if ($( this ).attr('src')=='js/popup.img.js'){
  			$(this).remove();
  			return false; 
  		}
	});
	$( "#images img" ).each(function(){
  		$(this).remove();
	});

	var tab = parseInt($(this).text());
	var inicio = ((tab-1)*4)+1;
	var fin = (window.Imgs.length < (tab*4))? Imgs.length : tab*4;
	var imprimir ='';
	inicio = inicio -1;
	fin = fin -1;
	for(var i=inicio; i<=fin; i++){
		imprimir = imprimir + '<img class="img-thumbnail img-responsive" alt="180x135" src="' + window.Imgs[i].url + '" style="width: 180px; height: 135px;">';
	}
	$( "#images" ).prepend(imprimir); 
	$('body').prepend('<script src="js/popup.img.js"></script>');
});