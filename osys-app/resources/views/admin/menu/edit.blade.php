@extends('layout.master')

@section('content')
<a href="{{url('/admin/menu')}}" class="pull-right btn-default btn btnaction"><span class="glyphicon glyphicon-share-alt"></span> Back</a>
<h1>Edit a Menu</h1>
<div class="row">
	<div class="col-md-6">
		<div class="panel panel-primary">
			<div class="panel-heading">
				<h3 class="panel-title">Menu</h3>
			</div>
			<div class="panel-body">
				@if (count($errors) > 0)
					<div class="alert alert-danger">
						<strong>Whoops!</strong> There were some problems with your input.<br><br>
						<ul>
							@foreach ($errors->all() as $error)
								<li>{{ $error }}</li>
							@endforeach
						</ul>
					</div>
				@endif
				<form action="{{url('/admin/menu/edit')}}" method="post" class="form-horizontal form-bordered" enctype="multipart/form-data">
					<div class="form-body">
						<div class="form-group">
							<label class="control-label col-md-3">Category</label>
							<div class="col-md-9">
								<select name="data[category_id]" class="form-control">
									@foreach($categories as $category)
										<option @if($category->id == $menu->category_id){{"selected"}}@endif value="{{$category->id}}">{{$category->name}}</option>
									@endforeach
								</select>
							</div>
						</div>
						<div class="form-group">
							<label class="control-label col-md-3">Name</label>
							<div class="col-md-9">
								<input type="text" name="data[name]" value="{{$menu->name}}" class="form-control" />
							</div>
						</div>
						<div class="form-group">
							<label class="control-label col-md-3">Price</label>
							<div class="col-md-9">
								<input type="text" name="data[price]" value="{{$menu->price}}" class="form-control" />
							</div>
						</div>
						<div class="form-group">
							<label class="control-label col-md-3">Description</label>
							<div class="col-md-9">
								<textarea type="text" name="data[description]" class="form-control">{{$menu->description}}</textarea>
							</div>
						</div>
						<!--
						<div class="form-group">
							<label class="control-label col-md-3">Picture</label>
							<div class="col-md-9">
								<input type="file" name="file" class="pull-left" />
							</div>
						</div>
						-->
					</div>
					<div class="form-actions">
						<input type="hidden" id="token" name="_token" value="{{ csrf_token() }}">
						<input type="hidden" name="data[id]" value="{{ $menu->id }}">
						<div id="pictures">
						@if(!empty(old('picture')))
							@foreach(old('picture') as $id)
							<input type="hidden" id="picture-{{$id}}" value="{{$id}}" name="picture[{{$id}}]" />
							<input type="hidden" id="url-{{$id}}" value="{{old('url.'.$id)}}" name="url[{{$id}}]" />
							@endforeach
						@endif
						</div>
						<div class="row">
							<div class="col-md-offset-3 col-md-9">
								<button type="submit" class="btn btn-warning"><span class="glyphicon glyphicon-ok"></span> Save</button>
							</div>
						</div>
					</div>
				</form>
			</div>
		</div>
	</div>
	<div class="col-md-6">
		<div class="panel panel-info">
			<div class="panel-heading">
				<h3 class="panel-title">Pictures</h3>
			</div>
			<div class="panel-body">
				<form id="picture-form">
					<input type="file" name="picture" id="file" class="pull-left" />
				</form>
				<button	data-uploadurl="{{url('/admin/menu/upload')}}"
						data-deleteurl="{{url('/admin/menu/deletepicture')}}"
						id="add-picture-btn" type="button" class="btn btn-sm btn-success"><span class="glyphicon glyphicon-plus "></span> Add</button>
				<hr/>
				<table id="picture-table" class="table table-responsible table-bordered">
					<thead>
						<tr>
							<th style="width:100px;">#</th>
							<th style="width:200px;">Picture</th>
							<!--<th>Description</th>-->
							<th></th>
						</tr>
					</thead>
					<tbody>
						@foreach($menu->getPictures() as $picture)
						<tr>
							<td></td>
							<td><img src="{{ asset('/uploaded/'.$picture->getPicture()->url) }}" style="width:100%;" /></td>
							<td><button data-id="{{$picture->picture_id}}" class="btn btn-danger delbtn"><span class="glyphicon glyphicon-trash"></span> Delete</button></td>
						</tr>
						@endforeach

					@if(!empty(old('picture')))
						@foreach(old('picture') as $id)
						<tr>
							<td></td>
							<td><img src="{{old('url.'.$id)}}" style="width:100%;" /></td>
							<td><button data-id="{{$id}}" class="btn btn-danger delbtn"><span class="glyphicon glyphicon-trash"></span> Delete</button></td>
						</tr>
						@endforeach
					@endif
					</tbody>
				</table>
			</div>
		</div>
	</div>
</div>
@endsection

@section('script')
	<script src="{{ asset('/js/admin/menu.js') }}"></script>
@endsection