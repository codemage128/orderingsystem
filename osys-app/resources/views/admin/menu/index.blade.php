@extends('layout.master')

@section('content')
<a href="{{url('/admin/menu/create')}}" class="pull-right btn-default btn btnaction"><span class="glyphicon glyphicon-plus"></span> Add</a>
<h1>Menu List</h1>
<div class="pull-right"><?php echo $menus->appends(['sort' => $sort, 'type' => $type])->render()?></div>
<table class="table table-responsible table-bordered">
	<thead>
		<tr>
			<th>Picture</th>
			<th><a href="{{ url('/admin/menu?sort=name&type='.($sort=='name'?!$type:1).'&page='.$menus->currentPage()) }}">Name</a></th>
			<th><a href="{{ url('/admin/menu?sort=category_id&type='.($sort=='category_id'?!$type:1).'&page='.$menus->currentPage()) }}">Category</a></th>
			<th><a href="{{ url('/admin/menu?sort=price&type='.($sort=='price'?!$type:1).'&page='.$menus->currentPage()) }}">Price</a></th>
			<th></th>
		</tr>
	</thead>
	<tbody>
		@foreach($menus as $menu)
		<tr>
			<td style="width:90px;padding:0;"><img style="width:90px;" src="{{$menu->getFirstPictureUrl()}}" /></td>
			<td>{{$menu->name}}</td>
			<td>{{$menu->getCategory()}}</td>
			<td>{{$menu->price}}$</td>
			<td>
				<a href="{{url('/admin/menu/edit/'.$menu->id)}}" class="btn btn-success"><span class="glyphicon glyphicon-pencil"></span> Edit</a>
				<button class="btn-delete btn btn-danger" data-ajaxurl = "{{url('/admin/menu/delete/'.$menu->id)}}"><span class="glyphicon glyphicon-trash"></span> Delete</button>
			</td>
		</tr>
		@endforeach
	</tbody>
</table>
@endsection

@section('script')
	<script src="{{ asset('/js/admin/menu_list.js') }}"></script>
@endsection