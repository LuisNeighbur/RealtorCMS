function ValidURL(url) {
  var pattern =  /(ftp|http|https):\/\/(\w+:{0,1}\w*@)?(\S+)(:[0-9]+)?(\/|\/([\w#!:.?+=&%@!\-\/]))?/;
  return pattern.test(url);
 }

$('#har_url').focusout(function(){
	if ( ($(this).val()=='') || (!(ValidURL($(this).val()))) ){
		$(this).css({'background-color':'#f44'});
		$(this).focus();
	}else{
		$(this).css({'background-color':'#fff'});
	}
});
$('#getData').on('click', function(){
	var url = $("#har_url")
	if ( (url.val()=='') || (!(ValidURL(url.val()))) ){
		url.focus();
		return false;
	}
	var data = $('#data').addClass('hide')
	var msjs = $('#msjs').empty().addClass('loading')
	$('.ajax-upload-dragdrop').remove()
	$.ajax({
		url: '/admin/collector',
		type: 'post',
		dataType: 'json',
		timeout: 15000,
		data: 'har_url=' + url.val()
	}).done(function(a){
		data.removeClass('loading')
		$('#gallery').empty()
		if(a.status_code==200){ //Si el codigo es 200 luz verde ;)
			//agregamos el mensaje a #data
			msjs.removeClass('loading').append('<div id="msj" class="alert alert-success alert-dismissable">'+
  						'<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>'+
  						'Recibi tu solicitud Master y ya tengo tus datos.</div>')
			
			$("#fileuploader").uploadFile({
				url:"/admin/upload",
				returnType: "json",
				multiple:true,
				fileName:"myfile",
				onSuccess: function(f,d){
				$('<div/>').addClass('col-xs-12 col-sm-6 col-md-4 col-lg-3 thumbnail text-center img_panel_box')
					.append('<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>') 
					.append(
							$('<img/>').attr({'src': d.url})
								.addClass('img-thumbnail img-responsive img_panel_thumbnail extract').attr({id:'none'})
					).appendTo('#gallery')
			}})
			if(a.data){
				var d = a.data
				$('input[type="text"].form-control.extract, textarea.form-control.extract').each(function(i,e){
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
			}
			$(d.gallery).each(function(i,e){
				$('<div/>').addClass('col-xs-12 col-sm-6 col-md-4 col-lg-3 thumbnail text-center img_panel_box')
					.append('<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>') 
					.append(
							$('<img/>').attr({'src': e.url})
								.addClass('img-thumbnail img-responsive img_panel_thumbnail extract').attr({id:'none'})
					).appendTo('#gallery')
			})
			data.removeClass('hide')
			$('img.img-thumbnail.img-responsive.img_panel_thumbnail.extract').on('click', function(){
				
			})
		}else if(a.status_code == 400){ //Si el codigo es 400 la url es incorrecta
			//agregamos el mensaje a #data
			msjs.removeClass('loading').append('<div id="msj" class="alert alert-danger alert-dismissable">'+
  							'<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>'+
  							'Error del sistema contacte al administrador!</div>')
			url.focus()
		}else if(a.status_code == 401){ //Si el codigo es 401 la sesion expiro
			//agregamos el mensaje a #data
			msjs.removeClass('loading').append('<div id="msj" class="alert alert-danger alert-dismissable">'+
  							'<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>'+
  							'No estas autorizado por favor '+
  							'<a href="/login">Inicia Sesion</a></div>')
			url.focus()
		}else if(a.status_code == 404){ //Si el codigo es 404 la casa no existe en har
			//agregamos el mensaje a #data
			msjs.removeClass('loading').append('<div id="msj" class="alert alert-warning alert-dismissable">'+
  							'<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>'+
  							'Lo sentimos, no se ha encontrado la propiedad que buscabas, prueba con otra.</div>');
			url.focus()
		}
		//Para ver el json que retorno desde el colector de datos
		//Si la peticion fracasa...
	}).fail(function(){
		msjs.removeClass('loading').append('<div id="msj" class="alert alert-danger alert-dismissable">'+
  							'<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>'+
  							'Error del sistema contacte al administrador!</div>')
	});
	
});
//A modo de demostraccion
$('.example').on('click', function(){
	$('#har_url').val($(this).data('href'))
});