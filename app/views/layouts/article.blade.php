@section('content')
@foreach($articles as $article)
<div class="col-xs-12 col-sm-6 col-md-4 col-lg-3 thumbnail text-center box" Style="padding:1%;">
	<!--Cartelito VENDIDO-->
	@if(!$article['deleted_at'])
	<span style="font-size:1em; position:absolute;" class="label label-warning"><h3><span class="glyphicon glyphicon-certificate"></span></h3>{{Lang::get('messages.sold')}}</span>
	@endif
  	<img class="img-thumbnail img-responsive" alt="140x140" style="width: 100%; height: auto;" src="{{ $article['front_image'] }}">
 	<!-- data-src="holder.js/140x140" este script solo se usa para crear el cuadro de placeholder o relleno para los imgs vacios-->
  	<h2>{{{ $article['direccion'] }}}</h2>
  	<p><?php if(Lang::get('messages.sold')=='SOLD'){echo substr($article['descripcion'],0,200) . '...';}else{echo substr($article['descripcionEs'],0,200) . '...';} ?></p>
  	<p><a class="btn btn-default view-more" href="{{ $article['permLink'] }}/{{ $article['id'] }}" data-id="{{ $article['id'] }}" role="button">{{Lang::get('messages.view_more')}}.</a></p>
</div><!-- /.col-lg-4 -->
@endforeach
@show