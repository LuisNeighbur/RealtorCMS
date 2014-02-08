$('#images img').on('click',function(){
	if($(this).width() > $(this).height()){
		$('#imgTop').css('width','100%');
		$('#imgTop').css('height','75%');	
	}else{
		if($(window).width() < 770 ){
			$('#imgTop').css('width','75%');
			$('#imgTop').css('height','75%');
		}else{
			$('#imgTop').css('width','50%');
			$('#imgTop').css('height','80%');
		}
	}
	$('#imgTop').attr('src',$(this).attr('src'));
});