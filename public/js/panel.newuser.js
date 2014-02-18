$('#user').focusout(function(){
	if ($(this).val()==''){
		$(this).css({'background-color':'#f44'});
		$(this).focus();
	}else{
		$(this).css({'background-color':'#fff'});
	}
});
$('#pass').focusout(function(){
	if ($(this).val()==''){
		$(this).css({'background-color':'#f44'});
		$(this).focus();
	}else{
		$(this).css({'background-color':'#fff'});
	}
});
$('#newpass').focusout(function(){
	if ( ($(this).val()=='') || ($(this).val()!=$('#pass').val()) ){
		$(this).css({'background-color':'#f44'});
		$(this).focus();
	}else{
		$(this).css({'background-color':'#fff'});
	}
});
$('#new').on('click',function(){
	if( ($('#user').val=='') || ($('#pass').val=='') || ($('#repass').val=='') ){
		return false
	}
	if( $('#pass').val() != $('#repass').val() ){
		return false;
	}
	var peticion = $.ajax({
		url:'/admin/newUser',
		type:'POST',
		data:'user='+$('#user').val()+'&pass='+$('#pass').val()+'&repass='+$('#repass').val()
	});
	peticion.done(function (d){
		if(d.status_code==200){
			$('#msjs').append('<div id="msj" class="alert alert-success alert-dismissable">'+
  							'<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>'+
  							'Usuario generado con exito.</div>');
			$('.form-signin input').val('');
		}else if(d.status_code == 500){
			$('#msjs').append('<div id="msj" class="alert alert-danger alert-dismissable">'+
  							'<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>'+
  							'Error en el sistema, comuniquese con el administrador.</div>');
		}else if(d.status_code == 400){
			$('#msjs').append('<div id="msj" class="alert alert-warning alert-dismissable">'+
  							'<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>'+
  							'El usuario debe tener una longitud minima de 6 caracteres.<br>'+
  							'El password debe tener una longitud minima de 6 caracteres, solo puede contener letras y digitos(A-Z a-z 0-9).</div>');
		}else{
			$('#msjs').append('<div id="msj" class="alert alert-warning alert-dismissable">'+
  							'<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>'+
  							'Usuario ya existente, seleccione otro nombre de usuario.</div>');
		}
	});
	peticion.fail(function (){
		$('#msjs').append('<div id="msj" class="alert alert-danger alert-dismissable">'+
  							'<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>'+
  							'Error en el sistema, comuniquese con el administrador.</div>');		
	});
});