$('#cancel').on('click',function(){
	$('#data').empty();
});
$('#saveIt').on('click', function(){
	if($('#descriptionEs').val()==''){
		$('#descriptionEs').focus();
		return false;
	}
	var msjs = $('#msjs').empty().addClass('loading');
	$('#har_url').val();
	$('body').scrollTop(0)
	var PD = {}
	PD.imgs = {}
	PD.front_image = {}
	var i = 0
	$('.extract').each(function(){
		if($(this).attr('src')){
			PD.imgs[i] = $(this).attr('src')
			i++
		}
		PD[$(this).attr('id')] = $(this).val()
	});
	$.ajax({
  		url: '/admin/add',
		type:'POST',
		timeout: 6000,
		data: {postData: JSON.stringify(PD)},//Aca si vale la pena usar JSON enviado al servidor por la gran cantidad de data
	}).done(function(res) {
  		var url = $('#har_url')
  		if(res.status_code == 200){
  			$('#data').addClass('hide')
  			msjs.removeClass('loading').append('<div id="msj" class="alert alert-success alert-dismissable">'+
  						'<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>'+
  						'Los cambios han sido guardados con exito ;).</div>')
  			$('input[type="text"].form-control.extract, textarea.form-control.extract').each(function(i,e){
				$(this).val('')			
			})
			url.val('')
  		}else if(res.status_code == 304){ //Si el codigo es 304 la propiedad existe en el sistema
			//agregamos el mensaje a #data
			msjs.removeClass('loading').append('<div id="msj" class="alert alert-info alert-dismissable">'+
  							'<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>'+
  							'La propiedad ya existe en el sistema '+
  							'</div>')
			url.val('')
		}else if(res.status_code == 401){ //Si el codigo es 401 la sesion expiro
			//agregamos el mensaje a #data
			msjs.removeClass('loading').append('<div id="msj" class="alert alert-danger alert-dismissable">'+
  							'<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>'+
  							'No estas autorizado por favor '+
  							'<a href="/login">Inicia Sesion</a></div>')
		}
	}).fail(function(){
		msjs.removeClass('loading').append('<div id="msj" class="alert alert-warning alert-dismissable">'+
  							'<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>'+
  							'Error en el sistema contacte al administrador</div>')
	})
});