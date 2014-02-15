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
	var peticion = $.getJSON( "/getData/" + GetIdFromUrl( $('#prop_url').val() ) + '.json');
	peticion.done(function(d){
		if(d.status_code == 200){
			$('#data').removeClass('hide');
			//var noMostrar = ['id','aid','front_image','imgs','descripcion_short','descripcionEs_short','created_at','updated_at','deleted_at'];
			$.each(d.data, function( index, value ){
  				if(! ($.inArray(index,['id','aid','front_image','imgs','descripcion_short','descripcionEs_short','created_at','updated_at','deleted_at'])>=0) ){
  					if($('#'+index).is('input')){
  						$('#'+index).val(value);
  					}else{//is textArea
  						$('#'+index).val(value);
  					}
  				}
			});
			$('#saveIt').data('id',d.data.id)
			$('#gallery').empty();
			for (var i =0;  i <= (d.data.imgs.length - 1) ; i++) {
				$('<div/>').addClass('col-xs-12 col-sm-6 col-md-4 col-lg-3 thumbnail text-center img_panel_box')
					.append('<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>') 
					.append(
						$('<img/>').attr({'src':  d.data.imgs[i].url})
						.addClass('img-thumbnail img-responsive img_panel_thumbnail')
					).appendTo('#gallery');
			};
			//$.each(d.data.imgs, function( index, value ){
			//		alert(index +': ' + value);
			//});
		}else{
			$('#msjs').append('<div class="alert alert-danger alert-dismissable">'+
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