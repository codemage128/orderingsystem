<!DOCTYPE html>
<html>
	<head>
		<title>Administrator Page</title>
		<meta charset="utf-8" />
		<meta name="csrf-token" content="{{ csrf_token() }}" />
		<link rel="stylesheet" href="{{ asset('/css/bootstrap.css') }}">
		<link rel="stylesheet" href="{{ asset('/css/bootstrap-theme.css') }}">
		<link rel="stylesheet" href="{{ asset('/css/dashboard.css') }}">
		@yield('style')
	</head>
	<body>
		<nav class="navbar navbar-inverse navbar-fixed-top">
		  <div class="container-fluid">
			<div class="navbar-header">
			  <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
				<span class="sr-only">Toggle navigation</span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
			  </button>
			  <a class="navbar-brand" href="{{url('/')}}">Ordering System</a>
			</div>
			<div id="navbar" class="navbar-collapse collapse">
			  <ul class="nav navbar-nav navbar-right">
				@if (!Auth::guest())
					<!--
					<li><a href="{{ url('/auth/login') }}">Login</a></li>
					-->
					<li><a href="{{ url('/auth/register') }}">Register</a></li>
					<li><a href="{{ url('/auth/logout') }}">Logout</a></li>
				@endif
			  </ul>
			  <!--			  
			  <form class="navbar-form navbar-right">
				<input type="text" class="form-control" placeholder="Search...">
			  </form>
			  -->
			</div>
		  </div>
		</nav>
		
		<div class="container-fluid">
			<div class="row">
				<div class="col-sm-3 col-md-2 sidebar">
				  <ul class="nav nav-sidebar">
					<li @if(Request::url()==url('/admin/menu')) class="{{"active"}}" @endif><a href="{{url('/admin/menu')}}">Menu Management</a></li>
					<li @if(Request::url()==url('/admin/order')) class="{{"active"}}" @endif><a href="{{url('/admin/order')}}">Order List</a></li>
					<li @if(Request::url()==url('/admin/order/history')) class="{{"active"}}" @endif><a href="{{url('/admin/order/history')}}">History</a></li>
					<li @if(Request::url()==url('/admin/category')) class="{{"active"}}" @endif><a href="{{url('/admin/category')}}">Category Management</a></li>
				  </ul>
				</div>
				<div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
					@yield('content')
				</div>
			</div>
		</div>
		
		<script src="{{ asset('/js/jquery.min.js') }}"></script>
		<script src="{{ asset('/js/bootstrap.js') }}"></script>
		@yield('script')
	</body>
</html>