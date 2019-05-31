@extends('layouts.app')

@section('title', '| category')

@section('stylesheets')

    {{ Html::style('css/new.css') }}

@endsection

@section('content')

	<div class="row">
		<div class="col-md-8">
			<h1>All Categories</h1>
			<table class="table table-bordered table-striped">
				<thead>
					<tr>
						<th>Id</th>
						<th>Name</th>
						<th>Action</th>
					</tr>
				</thead>
				<tbody>
					@foreach($categories as $category)
						<tr>
							<td>{{ $category->id }}</td>
							<td>{{ $category->name }}</td>
							<td>
								{!! Form::open(['action' => ['CategoryController@destroy', $category->id], 'method' => 'DELETE']) !!}

	                                {{ Form::submit('Delete', ['class' => 'btn btn-danger']) }}

	                            {!! Form::close() !!}
							</td>
						</tr>
					@endforeach	
				</tbody>
			</table>
		</div>
		<div class="col-md-4">
			<h1>Add Category</h1>
			<div class="py-4">
				{!! Form::open(['action' => 'CategoryController@store', 'method' => 'POST']) !!}

					{{ Form::text('name', '', ['class' => 'form-control mb-3', 'placeholder' => 'Enter Category...']) }}
					{{ Form::submit('Add', ['class' => 'btn btn-primary btn-block']) }}

				{!! Form::close() !!}
			</div>
		</div>
	</div>

@endsection