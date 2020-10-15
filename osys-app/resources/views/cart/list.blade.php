@extends('layout.front')

@section('content')
<h1>My Cart</h1>
	@if(isset($list)&&!empty($list))
	<table class="table table-bordered table-responsible">
		<thead>
			<tr>
				<th>Picture</th>
				<th>Name</th>
				<th>Price</th>
				<th>Quantity</th>
				<th>Total Price</th>
				<th></th>
			</tr>
		</thead>
		<tbody>
			
				@foreach($list as $item)
				<tr>
					<td style="width:90px;padding:0;"><a href="{{url('/menu/detail/'.$item['menu_id'])}}"><img src="{{$item['picture']}}" style="width:90px;" /></a></td>
					<td>{{$item['name']}}</td>
					<td>{{$item['price']}}$</td>
					<td>{{$item['quantity']}}</td>
					<td>{{$item['total']}}$</td>
					<td><a class="btn btn-danger" href="{{url('/cart/remove/'.$item['key'])}}">Cancel</a></td>
				</tr>
				@endforeach
		</tbody>
		<tfoot>
			<tr>
				<td colspan="4" class="text-right">Total</td>
				<td>{{$totalPrice}}$</td>
				<td>
					<a href="{{url('/cart/confirm')}}" class="btn btn-warning">Order Now!</a>
				</td>
			</tr>
		</tfoot>
	</table>
	@else
	<div class="alert alert-danger">No items in your cart!</div>
	@endif
@endsection