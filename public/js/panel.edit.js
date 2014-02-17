function ValidURL(url) {
  var pattern =  /(ftp|http|https):\/\/(\w+:{0,1}\w*@)?(\S+)(:[0-9]+)?(\/|\/([\w#!:.?+=&%@!\-\/]))?/;
  return pattern.test(url);
 }

function GetIdFromUrl(url){
	var pattern =/(\/)?([0-9]+)$/;
	var arr = pattern.exec(url);
	return arr[2];
}

$('#prop_url').focusout(function(){
	if ( ($(this).val()=='') || ( (!(ValidURL($(this).val()))) && (!($.isNumeric($(this).val()))) ) ){
		$(this).css({'background-color':'#f44'});
		$(this).focus();
	}else{
		$(this).css({'background-color':'#fff'});
	}
});

$('.example').on('click', function(){
	$('#prop_url').val($(this).data('href'))
});

$('#getData').on('click', function(){
	
	if ( ($('#prop_url').val()=='') || ( (!(ValidURL($('#prop_url').val()))) && (!($.isNumeric($('#prop_url').val()))) ) ){
		$(this).css({'background-color':'#f44'});
		$(this).focus();
		return false;
	}
	var msjs = $('#msjs').empty().addClass('loading');
	var peticion = $.getJSON( "/getData/" + GetIdFromUrl( $('#prop_url').val() ) + '.json');
	peticion.done(function(a){
		msjs.removeClass('loading');
		if(a.status_code == 200){
			$('#data').removeClass('hide');
			//var noMostrar = ['id','aid','front_image','imgs','descripcion_short','descripcionEs_short','created_at','updated_at','deleted_at'];
			/*$.each(a.data, function( index, value ){
  				if(! ($.inArray(index,['id','aid','front_image','imgs','descripcion_short','descripcionEs_short','created_at','updated_at','deleted_at'])>=0) ){
  					if($('#'+index).is('input')){
  						$('#'+index).val(value);
  					}else{//is textArea
  						$('#'+index).val(value);
  					}
  				}
			});*/
			var d = a.data
			$('input[type="text"].form-control.extract, textarea.form-control.extract, input[type="hidden"].form-control.extract').each(function(i,e){
				for( var a in d ){
					if(typeof(d[a]) == 'object'){
						for(var e in d[a]){
							if($(this).attr('id') == e.toString()){
								$(this).val(d[a][e].toString())
							}
						}
					}
					if($(this).attr('id') == a.toString()){
							$(this).val(d[a].toString())
					}	
				}
			})
			
			$('#saveIt').data('id',d.id)
			$('#gallery').empty();
			/*
			for (var i =0;  i <= (a.data.imgs.length - 1) ; i++) {
				$('<div/>').addClass('col-xs-12 col-sm-6 col-md-4 col-lg-3 thumbnail text-center img_panel_box')
					.append('<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>') 
					.append(
						$('<img/>').attr({'src':  d.data.imgs[i].url})
						.addClass('img-thumbnail img-responsive img_panel_thumbnail')
					).appendTo('#gallery');
			};*/
			if(d.imgs){
				$(d.imgs).each(function(i,e){
					$('<div/>').addClass('col-xs-12 col-sm-6 col-md-4 col-lg-3 thumbnail text-center img_panel_box')
						.append('<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>') 
						.append(
							$('<img/>').attr({'src': e.url})
								.addClass('img-thumbnail img-responsive img_panel_thumbnail extract').attr({id:'none'})
						).appendTo('#gallery')

				})
			}
		}else{
			msjs.append('<div class="alert alert-danger alert-dismissable">'+
  						'<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>'+
  						'<strong>Atencion!</strong> El ID que coloco no pertenece a ninguna propiedad.'+
  						'</div>');
		}
	});
});
$('#cancel').on('click',function(){
		$('#gallery').empty();
		$('#data').addClass('hide');
})
$('#saveIt').on('click', function(){
	if($('#descriptionEs').val()==''){
		$('#descriptionEs').focus();
		return false;
	}
	var msjs = $('#msjs').empty().addClass('loading');
	$('#har_url').val();
	$('body').scrollTop(0)
	var PD = {}
	PD.id = $(this).data('id');
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
  		url: '/admin/edit',
		type:'POST',
		timeout: 6000,
		data: {postData: JSON.stringify(PD)},//Aca si vale la pena usar JSON enviado al servidor por la gran cantidad de data
	}).done(function(res) {
  		var url = $('#prop_url')
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