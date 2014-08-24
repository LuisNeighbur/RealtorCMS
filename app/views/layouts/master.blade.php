<html lang="{{ App::getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <meta name="description" content="">
    <meta name="author" content="">
    
	<link rel="shortcut icon" href="/images/favicon.ico">
	<link rel="apple-touch-icon" href="/images/apple-touch-icon.png">
	<link rel="apple-touch-icon" sizes="72x72" href="/images/apple-touch-icon-72x72.png">
	<link rel="apple-touch-icon" sizes="114x114" href="/images/apple-touch-icon-114x114.png">

    <title>Realtor CMS</title>

    <!-- Bootstrap core CSS -->
   	<link  rel="stylesheet" href="/css/bootstrap.skin.min.css">
    <link  rel="stylesheet" href="/css/style.css">
    {{ HTML::script('https://code.jquery.com/jquery-1.10.2.min.js') }}
    <!-- Just for debugging purposes. Don't actually copy this line! -->
    <!--[if lt IE 9]><script src="../../docs-assets/js/ie8-responsive-file-warning.js"></script><![endif]-->

    <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>>
      {{ HTML::script('https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.j') }}
      {{ HTML::script('https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js') }}
    <![endif]-->
  </head>

  <body>
    <div class="container">
	  <div class="page-header">
	   
         <!-- <div id ="workfor" class="ribbon text-center"  data-container="body" data-toggle="popover" data-placement="bottom" data-content="Some data about the company you work for !" title="Company Name (click to see more)"><strong>I work for...</strong></div>-->
	  
	   <div class="row marketing">
		<h1><span class="glyphicon glyphicon-home"></span> Realtor CMS
	    
		<div class="btn-group pull-right">
		  <a href="/en" type="button" class="btn btn-primary">English</a>
		  <a type="button" class="btn btn-default disabled"><span class="glyphicon glyphicon-flag"></span></a>
		  <a href="/es/" type="button" class="btn btn-primary">Espa&ntilde;ol</a>
		</div>
		</h1>
		
	   </div>	
	  </div>
	  
      <div class="header">
        <ul class="nav nav-tabs nav-justified">
          <li class="active"><a href="/">{{ Lang::get('messages.home') }}</a></li>
          <li id='about'><a href="#/about/">{{ Lang::get('messages.about') }}</a></li>
          <li class="dropdown">
				<a class="dropdown-toggle" data-toggle="dropdown" href="#" title="">
				{{ Lang::get('messages.benefits') }}<span class="caret"></span>
				</a>
				<ul class="dropdown-menu">
					<li id='buy'><a href="#/buy/">{{ Lang::get('messages.buyers') }}</a></li>
					<li class="divider"></li>
					<li id='sell'><a href="#/sell/">{{ Lang::get('messages.sellers') }}</a></li>
				</ul>
          </li>
          <li id='center'><a href="#/center/">{{ Lang::get('messages.resource_center') }}</a></li>
		  <li class="dropdown">
				<a class="dropdown-toggle" data-toggle="dropdown" href="#" title="">
				{{ Lang::get('messages.relocating') }} <span class="caret"></span>
				</a>
				<ul class="dropdown-menu">
					<li id='support'><a href="#/support/">{{ Lang::get('messages.support') }}</a></li>
					<li class="divider"></li>
					<li id='adv'><a href="#/adv/" title="Opportunities, Education &amp; Entertainment">{{ Lang::get('messages.advantages') }}</a></li>
				</ul>
          </li>
          <li id='contact'><a href="#/contact/">{{ Lang::get('messages.contact') }}</a></li>
        </ul>
      </div>

      <div class="jumbotron">
				
		<blockquote style="background-color: rgba(0,0,0,0.45); clear: both; overflow: auto;">
			<img class"img-top img-responsive" style="background-color:transparent !important;" src="/images/top.png"/>
			<p>"{{ Lang::get('messages.phrase')}} (281) 702-2985."</p>
			<small><cite title="Franco R. Thoma"><span class="glyphicon glyphicon-user"></span> Franco R. Thoma</cite></small>
		</blockquote>
		<div class="input-group input-group-sm">
			<span class="input-group-addon"><span class="glyphicon glyphicon-search"></span></span>
			<input type="text" id="buscar" class="form-control" placeholder="Search for a house">
		</div>
        
      </div>

      <div id="page" class="row marketing" Style="width:90%;margin-left:5%;margin-right:5%;">
        <div class="row">
        	@yield('content')
		</div>
		
      </div>
	  <hr class="featurette-divider">
      <div class="footer">
        <p>Web site made by <a href="http://iglove.com.uy" target="_blank">Luciano Thoma</a> &amp; <a href="http://www.encom.uy" target="_blank">Luis Neighbur</a> (Powered by <a class="patners" href="http://laravel.com/" target="_blank">Laravel</a>-<a class="patners" href="http://getbootstrap.com" target="_blank">Bootstrap</a>)
        <span class="pull-right">
        	<a href="https://www.facebook.com/#" target="_blank"><img class="img-rounded img-responsive pull-left social" src="/images/glyphicons_social_30_facebook.png"></a>
        	<a href="https://www.linkedin.com/#" target="_blank"><img class="img-rounded img-responsive pull-left social" src="/images/glyphicons_social_17_linked_in.png"></a>
        </span>
        </p>
      </div>

    </div> <!-- /container -->


    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script>
    $('#buscar').on('keypress', function(e){
    	if((e.which==13) && ($(this).val()!='') ){
    		window.location = '/search?q=' + encodeURI($(this).val());
    	}
    });
    </script>
    {{ HTML::script('/js/bootstrap.min.js') }}
    {{-- HTML::script('/js/holder.js') --}}
    {{HTML::script('/js/tabs.'.App::getLocale().'.js')}}
	{{ HTML::script('/js/logic.js') }}
</body>
</html>