@foreach($articles['data'] as $article)
<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12" style="margin-top:2%;">

	<img class="img-responsive pull-left" src="IMAGEN" width="180px" style="margin-right:1%;">
	<h3>{{ $article['direccion'] }}({{ $article['area'] }})</h3>
	<p><?php if (Lang::get('messages.sold')=='SOLD'){ echo $article['descripcion']; }else{ echo $article['descripcionEs']; } ?></p>
	<p class="text-center"><a class="btn btn-default view-more" href="PERM_LINK" data-id="IDPROP" role="button">{{Lang::get('messages.view_more')}}.</a></p>
</div>
@endforeach