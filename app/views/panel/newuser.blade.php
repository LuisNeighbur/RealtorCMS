@extends('panel.panel')
@section('head')
@endsection
@section('panel')
<div id="form">
	<div class="form-signin" role="form">
	   	<h2 class="form-signin-heading">Nuevo Usuario</h2>
	    <input id="user" name="user" type="text" class="form-control" placeholder="Usuario" autofocus="">
	    <input id="pass" name="pass" type="password" class="form-control" placeholder="Contraseña">
		<input id="repass" name="repass" type="password" class="form-control" placeholder="Repetir Contraseña">
		<button id="new" class="btn btn-lg btn-primary btn-block" type="submit">Crear</button>
	</div>
	<div id="msjs"></div>
	<!--Este div corrije el error de flotacion de las imagenes en la galeria-->
	<div class="clearfix"></div>
</div>
{{ HTML::script('/js/panel.newuser.js') }}
@endsection