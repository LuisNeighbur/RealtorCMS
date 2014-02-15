@section('content')
@foreach($articles['data'] as $article)
<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12" style="margin-top:2%;">

	<img class="img-responsive pull-left" src="{{ $article['front_image'] }}" width="180px" style="margin-right:1%;">
	<h3>{{ $article['direccion'] }}({{ $article['area'] }})</h3>
	<p>
		@if(App::getLocale() == 'en')
  			{{ $article['descripcion'] }}
  		@else
  			{{ $article['descripcionEs'] }}
  		@endif
	</p>
	<p class="text-center"><a class="btn btn-default view-more" href="{{ $article['permLink'] }}/{{ $article['id'] }}" data-id="{{ $article['id'] }}" role="button">{{Lang::get('messages.view_more')}}.</a></p>
</div>
@endforeach
@endsection