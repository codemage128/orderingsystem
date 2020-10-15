@extends('layout.master')

@section('content')
<h1>History</h1>
	@if(!empty($orders->first()))
	<div class="pull-right"><?=$orders->appends(['sort' => $sort, 'type' => $type])->render();?></div>
	<table class="table table-responsible table-bordered table-hover table-striped">
		<thead>
			<tr>
				<th>#</th>
				<th><a href="{{ url('/admin/order/history?sort=customer_id&type='.($sort=='customer_id'?!$type:1).'&page='.$orders->currentPage()) }}">Customer</a></th>
				<th><a href="{{ url('/admin/order/history?sort=menu_id&type='.($sort=='menu_id'?!$type:1).'&page='.$orders->currentPage()) }}">Menu</a></th>
				<th><a href="{{ url('/admin/order/history?sort=quantity&type='.($sort=='quantity'?!$type:1).'&page='.$orders->currentPage()) }}">Quantity</a></th>
				<th><a href="{{ url('/admin/order/history?sort=update_datetime&type='.($sort=='update_datetime'?!$type:1).'&page='.$orders->currentPage()) }}">Updated DateTime</a></th>
				<th><a href="{{ url('/admin/order/history?sort=status_id&type='.($sort=='status_id'?!$type:1).'&page='.$orders->currentPage()) }}">Status</a></th>
			</tr>
		</thead>
		<tbody>
			@foreach($orders as $k=>$order)
			<tr @if($order->getMenu()->deleted) class="text-danger" @endif>
				<td>{{$indexOffset+$k+1}}</td>
				<td>{{$order->getCustomerEmailAddress()}}</td>
				<td>{{$order->getMenu()->name}}</td>
				<td>{{$order->quantity}}</td>
				<td>{{$order->update_datetime}}</td>
				<td><span class="label label-sm label-success">{{$order->getStatusName()}}</span></td>
			</tr>
			@endforeach
		</tbody>
	</table>
	@else
	<div class="alert alert-warning">No history data!</div>
	@endif
@endsection
