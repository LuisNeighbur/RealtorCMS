	function IsEmail(email) {
  		var regex = /^([a-zA-Z0-9_.+-])+\@(([a-zA-Z0-9-])+\.)+([a-zA-Z0-9]{2,4})+$/;
  		return regex.test(email);
	}

	function EmptyStr(obj){
		var color = ($(obj).val()=='')?'#f44':'#fff';
		$(obj).css('background-color',color);
		return false;
	}

	$("#cancel").on('click',function(){
		$("#name").val('');
		$("#name").css('background-color','#fff');
		$("#email").val('');
		$("#email").css('background-color','#fff');
		$("#content").val('');
		$("#content").css('background-color','#fff');
		$("body").focus();
	});
	
	$("#sendIt").on('click',function(e){
		e.preventDefault(); 
		if (!(($('#name').val()=='')||($('#email').val()=='')||($('#content').val()==''))){
			if (!(IsEmail($('#email').val()))){
				$('#email').css('background-color','#f44');
			}else{
				var peticion = $.ajax({
					url:'contact/send',
					//data:$('#formulario').serialize(),
					data:'name=' + $('#name').val() + '&email=' + $('#email').val() + '&choice=' + $('#choice').val() + '&content=' + $('#content').val(),
					type:'post',
					dataType: 'json'
				});
				peticion.done(function(d){
					if($('#msj')!='undefined'){$('#msj').remove();}
					var msj = 	'<div id="msj" class="alert alert-' + d.clase + ' alert-dismissable">'+
  									'<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>'+
  									d.texto +
  								'</div>';
					$('.panel-body').append(msj);
					//if(d.clase=='success'){ $("#cancel").click(); }
				});
			}	
		}
	});


	$('#name').focusout(function(){
		EmptyStr(this);
	});
	$('#email').focusout(function(){
		EmptyStr(this);
		var email = $(this).val();
		if (!(IsEmail(email))){
			$(this).css('background-color','#f44');
		}
	});
	$('#content').focusout(function(){
		EmptyStr(this);
	});