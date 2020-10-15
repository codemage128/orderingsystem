@extends('layout.front')

@section('style')
	<link rel="stylesheet" type="text/css" href="{{asset('/plugins/rs-plugin/css/settings.css')}}" media="screen" />
@endsection

@section('content')
	<div class="fullwidthbanner-container" style="margin-bottom:30px;">
		<div class="fullwidthbanner">
			<ul>
				<!-- THE BOXSLIDE EFFECT EXAMPLES  WITH LINK ON THE MAIN SLIDE EXAMPLE -->
				<li data-transition="boxslide" data-slotamount="7">
					<img src="{{asset('/images/slider-1.jpg')}}">
				</li>
				<li data-transition="boxslide" data-slotamount="7">
					<img src="{{asset('/images/slider-2.jpg')}}">
				</li>
				<li data-transition="boxslide" data-slotamount="7">
					<img src="{{asset('/images/slider-3.jpg')}}">
				</li>
			</ul>
			<div class="tp-bannertimer tp-bottom"></div>
		</div>
	</div>
	
	<div class="row">

		@foreach($menus as $menu)
		<div class="col-md-4">
			<div class="menu-item">
				<div class="picture">
					<img class="photo" src="{{$menu['picture']}}" />
					<img class="rating" src="{{$menu['rating']}}" />
				</div>
				<div class="detail">
					<a href="{{url('/menu/detail/'.$menu['id'])}}" class="orderbtn right">Detail</a>

					<span class="name">{{$menu['name']}}</span><br/>
					<span class="price">{{$menu['price']}}$</span>
				</div>
			</div>
		</div>
		@endforeach
	</div>
@endsection

@section('script')
	<script src="{{asset('/plugins/rs-plugin/js/jquery.themepunch.tools.min.js')}}"></script>
    <script src="{{asset('/plugins/rs-plugin/js/jquery.themepunch.revolution.min.js')}}"></script>
    <script src="{{asset('/js/pages/home.js')}}"></script>
@endsection
