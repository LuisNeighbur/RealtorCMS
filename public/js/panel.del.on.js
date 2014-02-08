$('#cancel').on('click',function(){
	$('#data').empty();
});
$('#sellIt').on('click', function(){
	var txt =$(this).html();
	$('#sellIt').html('Procesando');
	$.ajax({
		  		url: '/admin/del',
				type:'POST',
				timeout: 4000,
				data: 'id='+$(this).data('id')
			}).done(function(d){
				$('#sellIt').html('Sell Property');
				if($('#msj')!='undefined'){$('#msj').remove();}
		  		if(d.status_code == 200){
		  			$('#data').append('<div id="msj" class="alert alert-success alert-dismissable col-xs-12 col-sm-12 col-md-12 col-lg-12" style="margin-top:5px;">'+
  						'<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>'+
  						'Los cambios han sido realizados con exito ;).</div>');
		  		}else if(d.status_code == 401){
		  			$('#data').append('<div id="msj" class="alert alert-danger alert-dismissable col-xs-12 col-sm-12 col-md-12 col-lg-12" style="margin-top:5px;">'+
  							'<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>'+
  							'No estas autorizado por favor '+
  							'<a href="/login">Inicia Sesion</a></div>');
		  		}else{
		  			$('#data').append('<div id="msj" class="alert alert-warning alert-dismissable col-xs-12 col-sm-12 col-md-12 col-lg-12" style="margin-top:5px;">'+
  							'<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>'+
  							'No existe la propiedad o a ocurrido un error.</div>');
		  		}
			}).fail(function(){
				$('#sellIt').html('Sell Property');
				if($('#msj')!='undefined'){$('#msj').remove();}
				$('#data').append('<div id="msj" class="alert alert-warning alert-dismissable col-xs-12 col-sm-12 col-md-12 col-lg-12" style="margin-top:5px;">'+
  							'<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>'+
  							'Error en el sistema contacte al administrador</div>');
			});
});