@extends('layout.master')

@section('content')
<a href="{{url('/admin/order/index')}}" class="pull-right btn-default btn" style="margin-top:30px;"><span class="glyphicon glyphicon-share-alt"></span> Back</a>
<h1><b>{{$customer->email}}</b>'s Order List</h1>
<table class="table table-responsible table-bordered">
	<thead>
		<tr>
			<th>#</th>
			<th>Name</th>
			<th>Category</th>
			<th>Price</th>
			<th>Quantity</th>
			<th>Total</th>
		</tr>
	</thead>
	<tbody>
		@foreach($data as $k=>$item)
		<tr>
			<td>{{$k+1}}</td>
			<td>{{$item['name']}}</td>
			<td>{{$item['category']}}</td>
			<td>{{$item['price']}}$</td>
			<td>{{$item['quantity']}}</td>
			<td><b>{{$item['total']}}$</b></td>
		</tr>
		@endforeach
	</tbody>
	<tfoot>
		<tr>
			<td colspan=5 class="text-right"><b>Total</b></td>
			<td><b>{{$sum}}$</b></td>
		</tr>
	</tfoot>
</table>
<hr/>
<form action="{{url('/admin/order/reply')}}" method="post">
	<input type="hidden" value="{{$customer->id}}" name="customer_id" />
	<input type="hidden" value="{{csrf_token()}}" name="_token" />
	<button class="btn-success btn" type="submit">Manage!!!</button>
</form>

@endsection

