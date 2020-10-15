<!DOCTYPE html>
<html>
	<head>
		<title>{{{ $title }}} | {{{ config('app.title') }}}</title>
		<meta charset="utf-8" />
		<link rel="stylesheet" href="{{ asset('/css/bootstrap.css') }}">
		<link rel="stylesheet" href="{{ asset('/css/bootstrap-theme.css') }}">
		<link rel="stylesheet" href="{{ asset('/css/style.css') }}">
		@yield('style')
	</head>
	<body>
		<div class="page-content container">
			<div class="navbar-collapse">
				<ul class="nav navbar-nav navbar-right">
					<li @if(Request::url()==url('/')) class="{{"active"}}" @endif><a href="{{ url('/') }}"><span class="glyphicon glyphicon-home"></span> Home</a></li>
					<li @if(Request::url()==url('/menu/search')) class="{{"active"}}" @endif><a href="{{ url('/menu/search') }}"><span class="glyphicon glyphicon-search"></span> Search</a></li>
					<li @if(Request::url()==url('/cart/list')) class="{{"active"}}" @endif><a href="{{ url('/cart/list') }}"><span class="glyphicon glyphicon-shopping-cart"></span> My Cart</a></li>
				</ul>
			</div>
			<hr/>

			@yield('content')

		</div>
		<script src="{{ asset('/js/jquery.min.js') }}"></script>
		<script src="{{ asset('/js/bootstrap.js') }}"></script>
		<script src="{{ asset('/js/pages/app.js') }}"></script>
		@yield('script')
	</body>
</html>