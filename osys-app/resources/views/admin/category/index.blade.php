@extends('layout.master')

@section('content')
<button id="btn-add" class="btn btn-default pull-right btnaction"><span class="glyphicon glyphicon-plus"></span> Add</button>
<button id="btn-save" class="btn btn-default pull-right btnaction"><span class="glyphicon glyphicon-floppy-disk"></span> Save</button>
<h1>Category Management</h1>
<table id="category-list" class="table table-responsible table-bordered" data-ajaxurl="{{url('/admin/category/save')}}">
	<thead>
		<tr>
			<th>No.</th>
			<th>Name</th>
			<th></th>
		</tr>
	</thead>
	<tbody>
		@foreach($categories as $category)
		<tr>
			<td class="index"></td>
			<td class="edit"><input type="hidden" value="{{$category->id}}" /><input type="text" value="{{$category->name}}" /></td>
			<td></td>
		</tr>
		@endforeach
	</tbody>
</table>
@endsection

@section('script')
	<script src="{{ asset('/js/admin/category.js') }}"></script>
@endsection