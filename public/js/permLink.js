	var tam;//cantidad de imagenes a mostrar x tab

	function Paginacion(){
		var cantImg = 0;

		$( "#images img" ).each(function(i,e){
  			if(i<tam){
  				$(e).css('display','block');
  			}else{
  				$(e).css('display','none');
  			}
  			cantImg++;
		});

		var pag= Math.floor(cantImg / tam);
		pag=((cantImg % tam)> 0) ? pag+1: pag;
		
		if (pag>6){
			if(!($('ul .pagination').hasClass('pagination-sm'))){
				$('ul .pagination').addClass('pagination-sm');
			}
		}else{
			if($('ul .pagination').hasClass('pagination-sm')){
				$('ul .pagination').removeClass('pagination-sm');
			}
		}

		$('.pagination li a').each(function(i,e){
			if((i+1) <= pag){
				$(e).parent().css('display','block');
			}else{
				$(e).parent().css('display','none');
			}
		});
	}

	$(document).on('ready',function(){
		var width = $(window).width();
		if( width > 768){

			if(width <= 1200){
				tam = 5;
			}else{
				tam = 6;
			}
		}else{
			tam =4;
		}
		Paginacion();

	});

	$('.pagination li a').on('click',function(){
		var cantImg = 0;
		
		$( "#images img" ).each(function(){
  			if($(this).css('display').indexOf('block') >= 0){
  				$(this).css('display','none');
  			}
  			cantImg++;
		});

		var tab = parseInt($(this).text());
		var inicio = ((tab-1)*tam);
		var fin = (cantImg < (tab*tam))? cantImg : tab*tam;
		$( "#images img" ).each(function(i,e){
			if((i>=inicio) && (i<fin)){
				$(e).css('display','block');
			}
		});

	});


$('#images img').on('click',function(){
	if($(this).width() > $(this).height()){
		$('#imgTop').css('width','100%');
		//$('#imgTop').css('height','75%');	
	}else{
		if($(window).width() < 770 ){
			$('#imgTop').css('width','75%');
			//$('#imgTop').css('height','75%');
		}else{
			$('#imgTop').css('width','50%');
			//$('#imgTop').css('height','80%');
		}
	}
	$('#imgTop').attr('src',$(this).attr('src'));
});

$( window ).resize(function() {
var width = $(window).width();
		if( width > 768){

			if(width <= 1200){
				tam = 5;
			}else{
				tam = 6;
			}
		}else{
			tam =4;
		}
		Paginacion();
	
});