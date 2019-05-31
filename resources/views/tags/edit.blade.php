@extends('layouts.app')

@section('title', "| Edit Tag")

@section('stylesheets')

    {{ Html::style('css/new.css') }}

@endsection

@section('content')

	<div class="col-md-6 mx-auto">
		{!! Form::open(['action' => ['TagsController@update', $tag->id], 'method' => 'PUT']) !!}

			{{ Form::text('name', $tag->name, ['class' => 'form-control mb-3', 'placeholder' => 'Enter Tag...']) }}
			{{ Form::submit('Update', ['class' => 'btn btn-primary btn-block']) }}

		{!! Form::close() !!}
	</div>

@endsection