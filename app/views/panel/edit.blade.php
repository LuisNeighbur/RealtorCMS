@extends('panel.panel')
@section('head')
@endsection
@section('panel')
<div id="form">
	<div class="input-group">
		<span class="input-group-addon">Link Property</span>
		<input type="text" id="prop_url"class="form-control" placeholder="Example: http://franco.encom.uy/-nbsp-5519-lynbrook-dr--houston--tx-77056-/3" required />
	</div>
	<button id="getData" type="button" class="btn btn-danger btn-sm" style="margin-top:5px;">Obtener Datos !</button>
	<button class="example btn btn-primary" data-href="http://franco.encom.uy/-nbsp-5519-lynbrook-dr--houston--tx-77056-/3">Ejemplo 1</button> 
	<button class="example btn btn-primary" data-href="http://franco.encom.uy/-nbsp-4033-university-blvd--west-university--tx-77005-/1">Ejemplo 2</button>
	<div id="msjs"></div>
	<div id="data"class="hide">
		<div id="fileuploader">Subir</div>
		<h3 style="text-align:center;">INFORMATION</h3>
	    <div>
	        <label>Permanent Link - domain.com/whatyouput/PropertyWebId</label>
	        <input type="text" class="form-control extract" id="permLink" value="" required>
	    </div>
  		<div>
  			<label>Description English</label>
	        <textarea class="form-control extract" id="descripcion" rows="5"></textarea>
	    </div>
		<div>
			<label>Description Spanish</label>
	        <textarea class="form-control extract" id="descripcionEs" rows="5" placeholder="Write spanish description, please."></textarea>
	    </div>				
		<div>
			<label>City-Area</label>
	        <input type="text" class="form-control extract" id="area" value="" required />
	    </div>
		<div>
			<label>Address</label>
	        <input type="text" class="form-control extract" id="direccion" value="" required />
	    </div>
		<div>
			<label>Price</label>
	        <input type="text" class="form-control extract" id="precio" value="" required />
	       </div>
		<div>
			<label>Building SquareFeet</label>
	          <input type="text" class="form-control extract" id="dimensionesFeet" value="" required="">
	    </div>
	    <div>
	    	<label>Building SquareMeter</label>
	    	<input type="text" class="form-control extract" id="dimensionesMeter" value="" required />
	    </div>
	    <div>
	        <label>Build Year</label>
	        <input type="text" class="form-control extract" id="contruida_anio" value="" required="">
	    </div>
	    <div>
	        <label>Beedrooms</label>
	        <input type="text" class="form-control extract" id="dormitorios" value="" required />
	    </div>
	    <div>
	        <label>Baths</label>
	        <input type="text" class="form-control extract" id="banios" value="" required />
	    </div>
	    <div>
	        <label>Garage</label>
	        <input type="text" class="form-control extract" id="garage" value="" required />
	    </div>
	    <div>
	       	<label>Swimming Pool</label>
	        <input type="text" class="form-control extract" id="piscina" value="" required="">
	    </div>
	    <div>
	       	<label>School District</label>
	        <input type="text" class="form-control extract" id="distritoEscolar" value="" required />
	    </div>
	    <div>
	        <label>Elementary School</label>
	        <input type="text" class="form-control extract" id="escuelaKinder" value="" required />
	    </div>
	    <div>
	        <label>Middle School</label>
	        <input type="text" class="form-control extract" id="escuelaPrimaria" value="" required />
	    </div>
	    <div>
	       	<label>High School</label>
	        <input type="text" class="form-control extract" id="escuelaSecundaria" value="" required />
	    </div>
	    <div>
	       	<label>HAR Reference Link</label>
	        <input type="text" class="form-control extract" id="url_referencia" value="" required />
	    </div>
	    <div id='gallery'></div>
	    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 text-center">
			<div class="btn-group" style="margin-top:5px;">
	        	<a id="saveIt" class="btn btn-success">Save Property</a>
  				<a id="cancel" class="btn btn-primary">Cancel</a>
  			</div>
  		</div>
	</div>
	<!--Este div corrije el error de flotacion de las imagenes en la galeria-->
	<div class="clearfix"></div>
</div>
{{ HTML::script('/js/panel.edit.js') }}
@endsection