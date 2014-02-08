<!DOCTYPE html>
<html lang="es">
	<head>
		<meta charset="utf-8" />
		<link rel="shortcut icon" href="/images/favicon.ico">
		<link rel="apple-touch-icon" href="/images/apple-touch-icon.png">
		<link rel="apple-touch-icon" sizes="72x72" href="/images/apple-touch-icon-72x72.png">
		<link rel="apple-touch-icon" sizes="114x114" href="/images/apple-touch-icon-114x114.png">
		<title>Admin Panel</title>
		{{ HTML::style('/css/bootstrap.skin.min.css') }}
		{{ HTML::style('/css/panel.css') }}
		{{ HTML::style('/css/uploadfile.css') }}
		{{ HTML::script('/js/jquery-1.10.2.min.js') }}
		{{ HTML::script('/js/jquery.uploadfile.min.js') }}
		@yield('head')
	</head>
	<body>
		
		<div id="container" class="container">
			{{ $content }}
		</div>
		{{ HTML::script('js/bootstrap.min.js') }}
	</body>
</html>