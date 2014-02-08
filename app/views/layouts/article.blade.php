@section('content')
@foreach($articles as $article)
<div class="col-xs-12 col-sm-6 col-md-4 col-lg-3 thumbnail text-center box" Style="padding:1%;">
	@if($article['deleted_at']!=='0000-00-00 00:00:00')
	<span style="font-size:1em; position:absolute;" class="label label-warning"><h3><span class="glyphicon glyphicon-certificate"></span></h3>{{ Lang::get('messages.sold') }}</span>
	@endif
  	<img class="img-thumbnail img-responsive" alt="140x140" style="width: 100%; height: auto;" src="{{ $article['front_image'] }}" />
  	<h2>{{{ $article['direccion'] }}}</h2>
  	<p>
  		@if(App::getLocale() == 'en')
  			{{{ $article['descripcion_short'] }}}
  		@else
  			{{{ $article['descripcionEs_short'] }}}
  		@endif
  	</p>
  	<p><a class="btn btn-default view-more" href="{{ $article['permLink'] }}/{{ $article['id'] }}" data-id="{{ $article['id'] }}" role="button">{{ Lang::get('messages.view_more') }}.</a></p>
</div><!-- /.col-lg-4 -->
@endforeach
@show