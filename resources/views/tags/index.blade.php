@extends('layouts.app')

@section('title', '| tags')

@section('stylesheets')

    {{ Html::style('css/new.css') }}

@endsection

@section('content')

	<div class="row">
		<div class="col-md-8">
			<h1>All Tags</h1>
			<table class="table table-bordered table-striped">
				<thead>
					<tr>
						<th>Id</th>
						<th>Name</th>
						<th>Action</th>
					</tr>
				</thead>
				<tbody>
					@foreach($tags as $tag)
						<tr>
							<td>{{ $tag->id }}</td>
							<td>{{ $tag->name }}</td>
							<td>
								<div class="row">
									<div class="ml-3">
										<a href="/tags/{{ $tag->id }}" class="btn btn-success">View</a>
									</div>
									<div class="ml-3">
										<a href="/tags/{{ $tag->id }}/edit" class="btn btn-primary btn-block">Edit</a>
									</div>
									<div class="ml-3">
										{!! Form::open(['action' => ['TagsController@destroy', $tag->id], 'method' => 'DELETE']) !!}

			                                {{ Form::submit('Delete', ['class' => 'btn btn-danger']) }}

			                            {!! Form::close() !!}
									</div>
								</div>
							</td>
						</tr>
					@endforeach	
				</tbody>
			</table>
		</div>
		<div class="col-md-4">
			<h1>Add Tag</h1>
			<div class="py-4">
				{!! Form::open(['action' => 'TagsController@store', 'method' => 'POST']) !!}

					{{ Form::text('name', '', ['class' => 'form-control mb-3', 'placeholder' => 'Enter Tag...']) }}
					{{ Form::submit('Add', ['class' => 'btn btn-primary btn-block']) }}

				{!! Form::close() !!}
			</div>
		</div>

	</div>

@endsection