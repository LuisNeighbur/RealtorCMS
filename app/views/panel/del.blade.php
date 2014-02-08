@extends('panel.panel')
@section('head')
@endsection
@section('panel')
<div id="form">
	<div class="input-group">
		<span class="input-group-addon">ID Propiedad</span>
		<input type="text" id="webId" class="form-control" placeholder="Ejemplo: http://domain.com/#/description/{id-integer}" required />
	</div>
	<button id="getData" type="button" class="btn btn-primary btn-sm" style="margin-top:5px;">Quitar propiedad.</button>
	<div id="data"></div>
	<!--Este div corrije el error de flotacion de las imagenes en la galeria-->
	<div class="clearfix"></div>
</div>
{{ HTML::script('/js/panel.del.js') }}
@endsection