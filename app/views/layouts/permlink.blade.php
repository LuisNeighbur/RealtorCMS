@section('content')
<div class="gtitle" style="width:100%;min-height:1.5em;max-height:1.5em;">{{ $articles['data']['direccion'] }}({{ $articles['data']['area'] }})</div>   
<div class="row">
	<div id="images" class="col-xs-12 col-sm-4 col-md-3 col-lg-2">
		@foreach($articles['data']['imgs'] as $article)
			<img class="img-thumbnail img-responsive" alt="180x135" src="{{ $article['url'] }}" style="width: 180px;">
		@endforeach
		<ul class="pagination" style="display: block;"> 
			<?php 	
				$cantImg = count($articles['data']['imgs']);
				$cantTabs = $cantImg / 4;
				if(($cantImg % 4) > 0){
					$cantTabs++;
				}
				for($i=1;$i<=$cantTabs;$i++){
					echo '<li><a>'.$i.'</a></li>';
				}
			?>
		</ul>
	</div>
	<div class="col-xs-12 col-sm-8 col-md-9 col-lg-10">
		<img id="imgTop" class="img-responsive" src="{{ $articles['data']['imgs'][0]['url'] }}" alt="100%x50%" style="width: 100%; display: block;">
		<div class="panel panel-success" style="margin-top:2%;">
			<div class="panel-heading">
				<h3 class="panel-title">{{Lang::get('messages.info')}}<span class="badge pull-right" style="font-family:Arial,sans-serif;">Id: {{$articles['data']['id']}}</span></h3>
			</div>
			<div class="panel-body">
				<b>{{Lang::get('messages.description')}}: </b>
				@if(App::getLocale() == 'en')
  					{{ $articles['data']['descripcion_short'] }}
  				@else
  					{{ $articles['data']['descripcionEs_short'] }}
  				@endif
				<br><br>
				<b>{{Lang::get('messages.price')}}:</b>{{ $articles['data']['precio'] }} , <b>{{Lang::get('messages.dimension')}}:</b><?php if (Lang::get('messages.sold')=='SOLD'){ echo $articles['data']['dimensionesFeet']; }else{ echo $articles['data']['dimensionesMeter']; } ?> , <b>{{Lang::get('messages.year')}}:</b>{{ $articles['data']['contruida_anio'] }}<br>
				<b>{{Lang::get('messages.bed')}}:</b>{{ $articles['data']['dormitorios'] }} , <b>{{Lang::get('messages.bath')}}:</b>{{ $articles['data']['banios'] }} , <b>{{Lang::get('messages.garage')}}:</b>{{ $articles['data']['garage'] }} , <b>{{Lang::get('messages.pool')}}:</b>{{ $articles['data']['piscina'] }}<br>
				<b>{{Lang::get('messages.district')}}:</b>{{ $articles['data']['distritoEscolar'] }} , <b>{{Lang::get('messages.elementary')}}:</b>{{ $articles['data']['escuelaKinder'] }} , <b>{{Lang::get('messages.middle')}}:</b>{{ $articles['data']['escuelaPrimaria'] }} , <b>{{Lang::get('messages.high')}}:</b>{{ $articles['data']['escuelaSecundaria'] }}<br>
				<b>{{Lang::get('messages.harLink')}}:</b> {{ HTML::link($articles['data']['url_referencia']) }}<br><br>
				<div class="btn-group btn-group-sm">
					<a  target="_blank" href="http://www.facebook.com/sharer/sharer.php?s=100&p[url]={{ $articles['data']['permLink'] }}/{{ $articles['data']['id'] }}&p[images][0]={{ $articles['data']['front_image'] }}&p[title]=<?php echo urlencode($articles['data']['direccion']);?>&p[summary]=<?php echo urlencode($articles['data']['descripcion']);?>" class="btn facebook effect">Share&nbsp;&nbsp;[ f ]</a>
  					<a target="_blank" href="https://twitter.com/intent/tweet?text=House FOR SALE - {{ $articles['data']['direccion'] }}&url={{ $articles['data']['permLink'] }}/{{ $articles['data']['id'] }}" class="btn twitter effect">[ t ]&nbsp;&nbsp;Tweet</a>
  				</div>
			</div>
		</div>
	</div>
</div>
{{ HTML::script('/js/permLink.js') }}
@endsection