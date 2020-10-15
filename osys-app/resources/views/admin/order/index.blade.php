@extends('layout.master')

@section('content')
<h1>Order List</h1>
	@if(!empty($data))
	<table class="table table-responsible table-bordered">
		<thead>
			<tr>
				<th>Customer</th>
				<th>Ordered Time</th>
				<th></th>
			</tr>
		</thead>
		<tbody>
			@foreach($data as $item)
			<tr>
				<td>{{$item['email']}}</td>
				<td>{{$item['update_datetime']}}</td>
				<td>
					<a class="btn-delete btn btn-success" href="{{url('/admin/order/reply/'.$item['id'])}}"><span class="glyphicon glyphicon-share-alt"></span> Reply</a>
				</td>
			</tr>
			@endforeach
		</tbody>
	</table>
	@else
	<div class="alert alert-warning">No orders!</div>
	@endif
@endsection

