//Javascript Document
var lang = [
	{
	"info" : "Information",
	"description" : "Description",
	"price" : "Price",
	"dimension" : "Building SquareFeet",
	"year" : "Year Built",
	"bed" : "Bedrooms",
	"bath" : "Baths",
	"garage" : "Garage",
	"pool" : "Swimming Pool",
	"district" : "School District",
	"elementary" : "Elementary School",
	"middle" : "Middle School",
	"high" : "High School",
	"harLink" : "HAR (Houston Association of Realtors) link"
	},
	{
	"info" : "Informacion",
	"description" : "Descripcion",
	"price" : "Precio",
	"dimension" : "Superficie (m2)",
	"year" : "Año Construccion",
	"bed" : "Dormitorios",
	"bath" : "Baños",
	"garage" : "Garaje",
	"pool" : "Piscina",
	"district" : "Distrito Escolar",
	"elementary" : "Escuela Primaria",
	"middle" : "Escuela Secundaria",
	"high" : "Escuela Terciaria (Bachillerato)",
	"harLink" : "HAR (Asociación de Agentes Inmobiliarios de Houston) link"	
	}
];

//function WorkFor(){
//	$('#workfor').css({'left':(($(window).width() - $('#workfor').width())/2)+'px'});
//}
function Loading(){
	$('body').prepend('<div class="spinner"></div>');
	//$('.spinner').css({ left: (($(window).width() - $('#workfor').width())/2) ,top: ($(window).height() - $('.spinner').height())/2});
	$('.spinner').css({ left: (($(window).width() - 40 )/2) ,top: ($(window).height() - 40)/2});
}
function GetTab(name){
	$.get('/'+name,function(response){
		Loading();
		$('body').prepend(response);
		$('.container').css('display','none');
		$('.front').slideToggle("slow", function(){ $('.spinner').remove();	});
		if ((name=='support') && ($(window).width() < 676)){
			$('#gmap').css('display','none');
		}else{
			$('#gmap').css('display','block');
		}
	});
}
function openLayer(id){
	console.warn("A")
	Loading();
	var imagenes = '';
	var htmll = html;
	var peticion = $.getJSON( "getData/" + id + '.json');
	peticion.done(function(d){
		htmll = htmll.replace('TITULO!',d.data.direccion + '(' + d.data.area + ')' );
		htmll = htmll.replace('IMGTOP!', d.data.imgs[0].url);
		Imgs = d.data.imgs;

		var idioma = (location.href.search('/es')>=0)? 1: 0;
		var dataDesc = (idioma==0)? d.data.descripcion : d.data.descripcionEs;
		var dataSuperficie =(idioma==0)? d.data.dimensionesFeet : d.data.dimensionesMeter;

		var i,pag;
		var pagHtml='';
		if (!(Imgs.length <= 4)){
			for ( i=0;i<4;i++){
				imagenes = imagenes + '<img class="img-thumbnail img-responsive" alt="180x135" src="' + Imgs[i].url + '" style="width: 180px;">';// height: 135px;">';
			}
			
			pag= Math.floor(Imgs.length / 4);
			pag=((Imgs.length % 4)> 0) ? pag+1: pag;
			var classpag =(pag>6)?'pagination pagination-sm':'pagination';
			pagHtml = '<ul class="'+classpag+'" style="display: block;">';
						
			for ( i=1;i<=pag;i++){
				pagHtml = pagHtml +' <li><a>' + i.toString() + '</a></li>';
			}

			pagHtml = pagHtml + '</ul>';

			htmll = htmll.replace('SCRIPT!','<script src="/js/popup.pag.js"></script>');

		}else{
			//en el caso q son menos o igual q 4
			for ( i=0;i<Imgs.length;i++){
				imagenes = imagenes + '<img class="img-thumbnail img-responsive" alt="180x135" src="' + Imgs[i].url + '" style="width: 180px;">';// height: 135px;">';
			}
			htmll = htmll.replace('SCRIPT!','');
		}

		htmll = htmll.replace('PAGINACION!',pagHtml);
		htmll = htmll.replace('IMAGENES!',imagenes);
		htmll = htmll.replace('TINFO!',lang[idioma].info+'<span class="badge pull-right" style="font-family:Arial,sans-serif;">Id: '+d.data.id+'</span>');
		htmll = htmll.replace('INFO!','<b>'+lang[idioma].description+': </b>' + dataDesc + enter + enter + '<b>'+lang[idioma].price+':</b>' + d.data.precio + coma + 
									  '<b>'+lang[idioma].dimension+':</b>' + dataSuperficie + coma + '<b>'+lang[idioma].year+':</b>' + d.data.contruida_anio + enter + 
									  '<b>'+lang[idioma].bed+':</b>' + d.data.dormitorios + coma + '<b>'+lang[idioma].bath+':</b>' + d.data.banios + coma + '<b>'+lang[idioma].garage+':</b>' + d.data.garage + coma + 
									  '<b>'+lang[idioma].pool+':</b>' + d.data.piscina + enter + '<b>'+lang[idioma].district+':</b>' + d.data.distritoEscolar + coma + 
									  '<b>'+lang[idioma].elementary+':</b>' + d.data.escuelaKinder + coma + '<b>'+lang[idioma].middle+':</b>' + d.data.escuelaPrimaria + coma + 
									  '<b>'+lang[idioma].high+':</b>' + d.data.escuelaSecundaria + enter + 
									  '<b>'+lang[idioma].harLink+':</b>' + d.data.url_referencia + enter + enter +
									  '<div class="btn-group btn-group-sm">'+
									  '<a  target="_blank" href="http://www.facebook.com/sharer/sharer.php?s=100&p[url]=' + d.data.permLink + '/' + d.data.id +'&p[images][0]=' + d.data.imgs[0].url + '&p[title]=' + encodeURI(d.data.direccion) + '&p[summary]=' + encodeURI(d.data.descripcion) + '" class="btn facebook effect">Share&nbsp;&nbsp;[ f ]</a>'+
  					                  '<a target="_blank" href="https://twitter.com/intent/tweet?text=House FOR SALE - '+d.data.direccion + '(' + d.data.area + ')&url='+ d.data.permLink +'/'+ d.data.id+'"class="btn twitter effect">[ t ]&nbsp;&nbsp;Tweet</a>'+
            						  '</div>');
		$('body').prepend(htmll);
		$('.container').css('display','none');
		$('.front').slideToggle("slow", function(){ $('.spinner').remove();	});
	});
}
var Imgs;
var html='<div class="front">'+
		'<div class="layer">'+
			'<div class="close closeme" title="Esc">×</div>'+
			'<div class="gtitle">TITULO!</div>'+
			'<div class="row">'+
				'<div id="images" class="col-xs-12 col-sm-4 col-md-3 col-lg-2">'+
					'IMAGENES!'+
					"PAGINACION!"+
				'</div>'+
				'<div class="col-xs-12 col-sm-8 col-md-9 col-lg-10">' +
					'<img id="imgTop" class="img-responsive" src="IMGTOP!" alt="100%x50%" style="height: 75%; width: 100%; display: block;">'+
					'<div class="panel panel-success" style="margin-top:2%;">'+
						'<div class="panel-heading">'+
						  '<h3 class="panel-title">TINFO!</h3>'+
						'</div>'+
						'<div class="panel-body">'+
						  'INFO!'+
						'</div>'+
					'</div>'+
				'</div>'+
			'</div>'+
		'</div>'+
	'</div>'+
	'<script src="/js/popup.js"></script>'+
	'<script src="/js/popup.img.js"></script>'+
	'SCRIPT!';
var enter = '<br>';
var coma = ' , ';

$(document).on("ready",function(){
$( window ).resize(function() {
		//WorkFor();
		/*if ($(window).width() <= 768){
			$('.pagination').css('display','none');
		}else{
			$('.pagination').css('display','block');
		}*/
		if ($('#gmap').length > 0){ 
			if($(window).width() < 676){
				$('#gmap').css('display','none');
			}else{
				$('#gmap').css('display','block');
			}
		}

		$('.box').css('height','auto');
		var max = '';
		$('div .row div').each(function(){		
			if ( ($(this).hasClass('box')) && ($(this).css('height') > max) ){
				max=$(this).css('height');
			}
		});
		$('.box').css('height',max);
});

$('#workfor').on("click",function(){$(this).popover();});

$('.btn-default').on("click",function(){
	openLayer($(this).data('id'));	
});


$('#about').on("click",function(){
	GetTab('knowme');
});
$('#buy').on("click",function(){
	GetTab('buy');
});
$('#sell').on("click",function(){
	GetTab('sell');
});
$('#support').on("click",function(){
	GetTab('support');
});
$('#adv').on("click",function(){
	GetTab('adv');
});
$('#contact').on("click",function(){
	GetTab('contact');
});
$('#center').on("click",function(){
	GetTab('center');
});

var hash = window.location.hash;
if (hash != ''){

hash = hash.substring( hash.indexOf('#')+1 );
hash = hash.substring(hash.indexOf('/') + 1);
var action = hash.substring(0,hash.indexOf('/'));
if(action=='description'){ 	openLayer( hash.substring(hash.indexOf('/')+1));	}
if((action=='about') || (action=='buy') || (action=='sell') || (action=='support') || (action=='adv') || (action=='contact') || (action=='center')){	$( "#" + action ).click(); }

}

});

$('.view-more').on('click', function(e) {
	e.preventDefault()
})

$(window).load(function() {
 	var max = '';
	$('div .row div').each(function(){		
		if ( ($(this).hasClass('box')) && ($(this).css('height') > max) ){
			max=$(this).css('height');
		}
	});
	$('.box').css('height',max);
});