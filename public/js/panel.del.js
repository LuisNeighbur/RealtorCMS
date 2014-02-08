$('#webId').focusout(function(){
	if ( ($(this).val()=='') || (!($.isNumeric($(this).val()))) ){
		$(this).css({'background-color':'#f44'});
		$(this).focus();
	}else{
		$(this).css({'background-color':'#fff'});
	}
});

$('#getData').on('click', function(){
	var webId = $("#webId");
	if ( (webId.val()=='') || (!($.isNumeric(webId.val()))) ){
		webId.focus();
		return false;
	}
	var data = $('#data').empty().addClass('loading');
	var peticion = $.getJSON( "/getData/" + webId.val() + '.json');
	peticion.done(function(d){
		data.removeClass('loading');
		if(d.status_code == 200){
			data.append('<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12" style="margin-top:2%;">'+
						'<img class="img-responsive pull-left" src="'+d.data.front_image+'" width="180px"  style="margin-right:1%;">'+
						'<h3>'+d.data.direccion + '(' + d.data.area + ')' + '</h3>'+
						'<p>'+d.data.descripcion+'</p>'+
					'</div>');
			data.append('<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 text-center">'+
							'<div class="btn-group" style="margin-top:5px;">'+
	        					'<a id="sellIt" data-id="'+d.data.id +'"class="btn btn-success">Sell Property</a>'+
  								'<a id="cancel" class="btn btn-primary">Cancel</a></div>'+
  							'</div>');
			data.append('<script src="/js/panel.del.on.js"></script>');
		}else{
			data.append('<div class="alert alert-danger alert-dismissable">'+
  						'<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>'+
  						'<strong>Atencion!</strong> El ID que coloco no pertenece a ninguna propiedad.'+
  						'</div>');
		}
	});
});