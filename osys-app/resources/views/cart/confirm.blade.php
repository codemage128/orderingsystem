@extends('layout.front')

@section('content')
<h1>Confirmation</h1>
			
			<table class="table table-bordered table-responsible">
				<thead>
					<tr>
						<th>Picture</th>
						<th>Name</th>
						<th>Price</th>
						<th>Quantity</th>
						<th>Total Price</th>
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
					</tr>
					@endforeach
				</tbody>
				<tfoot>
					<tr>
						<td colspan="4" class="text-right">Total</td>
						<td>{{$totalPrice}}$</td>
					</tr>
				</tfoot>
			</table>

			<form action="{{url('/cart/confirm')}}" method="post" class="form-horizontal form-bordered">
				<input type="hidden" name="_token" value="{{ csrf_token() }}">
				<div class="form-body">
					<div class="form-group">
						<label class="control-label col-md-3">Your Email Address</label>
						@if(count($errors->get('email'))>0)
						<div class="col-md-4 has-error">
						@else
						<div class="col-md-4">
						@endif
							<input class="form-control" name="email" placeholder="john@order.com" value="{{old('email')}}" type="text" />
							<span class="text-danger">
							{{$errors->first('email')}}
							</span>
						</div>
					</div>					
				</div>
				<div class="form-actions">
					<div class="row">
						<div class="col-md-offset-3 col-md-9">
							<button type="submit" class="btn btn-warning"><span class="glyphicon glyphicon-ok"></span> Confirm</button>
							<a href="{{url('/cart/list')}}" class="btn btn-success"><span class="glyphicon glyphicon-share-alt"></span> Back</a>
						</div>
					</div>
				</div>
			</form>
@endsection