@extends('layout.front')

@section('style')
	<link rel="stylesheet" href="{{ asset('/plugins/ion.rangeslider/css/ion.rangeSlider.css') }}" />
	<link rel="stylesheet" href="{{ asset('/plugins/ion.rangeslider/css/ion.rangeSlider.skinNice.css') }}" />
@endsection

@section('content')
	<div class="search-box">
		<div id="search-form" class="in">
			<div class="form-group">
				<label>Category</label>
				<select id="category" class="form-control">
					<option value="-1">All</option>
					@foreach($categories as $category)
					<option value="{{$category->id}}">{{$category->name}}</option>
					@endforeach
				</select>
			</div>
			<div class="clearfix"></div>
			<div class="form-group mt10">
				<label>Price</label>
				<div class="price">
					<input id="price-range" type="text" name="price_range"/>
				</div>
			</div>
			<div class="clearfix"></div>
		</div>
		<button type="button" id="search-toggle" class="btn btn-success right mt10" data-toggle="collapse" data-target="#search-form">Search Option<span class="glyphicon glyphicon-arrow-up"></span></button>
		<div class="clearfix"></div>
	</div>
	
	
	<div class="row" id="result" data-ajaxurl="{{url('/menu/jsondata')}}">
		
		
	</div>
@endsection

@section('script')
	<script src="{{ asset('/plugins/ion.rangeslider/js/ion.rangeSlider.min.js') }}"></script>
	<script src="{{ asset('/js/pages/search.js') }}"></script>
@endsection