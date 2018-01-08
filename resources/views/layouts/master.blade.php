<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
	<title>@yield('title')</title>

	<!-- Fonts -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.4.0/css/font-awesome.min.css" rel='stylesheet' type='text/css'>
    <link href="https://fonts.googleapis.com/css?family=Lato:100,300,400,700" rel='stylesheet' type='text/css'>

	<!-- Styles -->
	<link rel="stylesheet" type="text/css" href="/css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="/css/app.css">
	@yield('css')
</head>
<body>
	@include('partials.navbar')

	@yield('content')

	@include('partials.footer')

	<!-- JavaScripts -->
	<script type="text/javascript" src="/js/jquery-1.12.0.min.js"></script>
	<script type="text/javascript" src="/js/bootstrap.min.js"></script>
	@yield('js')
</body>
</html>