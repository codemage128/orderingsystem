@extends('layout.front')

@section('style')
	<link rel="stylesheet" href="{{ asset('/plugins/bootstrap-toastr/toastr.css') }}" />
@endsection

@section('content')
	<input type="hidden" id="menu_id" value="{{$menu->id}}" />
	<div class="col-md-9" style="float">
		<div style="padding:30px;">
			<div class="no-padding left" style="width:250px;">
				<div class="menu-order">
					<img class="photo" src="{{$menu->getFirstPictureUrl()}}" />						
					<div class="action">
						<button type="button" data-ajaxurl="{{url('/cart/add')}}" class="btn btn-success">Add to cart</button>
					</div>
				</div>
			</div>
			
			<h1>{{$menu->name}}</h1>
			<img src="{{$menu->getRatingImageUrl()}}" />
			<h2 class="price">{{$menu->price}}$</h2>
			<h2 class="category">{{$menu->getCategory()}}</h2>
			<span style="font-size:12pt;">
				{{$menu->description}}
			</span>
		</div>
	</div>
	
	<div class="col-md-3" style="float">
		@foreach ($menu->getPictures() as $menuPicture)
			@if($menuPicture->disp_order > 0)
			<div class="" style="width:200px;">
				<div class="menu-order-show">
					<img class="photo" src="{{$menuPicture->getPicture()->getAbsolutePictureUrl()}}" />	
				</div>
			</div>	
			@endif
		@endforeach
	</div>
@endsection

@section('script')
	<script src="{{ asset('/plugins/bootstrap-toastr/toastr.js') }}"></script>
	<script src="{{ asset('/js/pages/detail.js') }}"></script>
@endsection