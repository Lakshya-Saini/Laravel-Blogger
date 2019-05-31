@extends('layouts.app')

@section('title', "| $tag->name")

@section('stylesheets')

	{!! Html::style('css/new.css') !!}

@endsection

@section('content')

	<div class="container">
		<div class="row">
			<div class="col-md-10">
				<h1 class="d-inline">{{ $tag->name }}</h1><span class="ml-3">{{ $tag->posts->count() }} posts</span>
			</div>
		</div>
		@if($tag->posts->count() > 0)
			<div class="row">
				<table class="table table-bordered table-hovered m-3">
					<thead>
						<tr>
							<th>Id</th>
							<th>Name</th>
							<th>Tags</th>
							<th>Actions</th>
						</tr>
					</thead>
					<tbody>
						@foreach($tag->posts as $post)
							<tr>
								<td>{{ $post->id }}</td>
								<td>{{ $post->title }}</td>
								<td>
									@foreach($post->tags as $tag)
										<span class="label">{{ $tag->name }}</span>
									@endforeach
								</td>
								<td><a href="/posts/{{ $post->id }}" class="btn btn-primary">View</a></td>
							</tr>
						@endforeach
					</tbody>
				</table>
			</div>
		@else
			<div class="mt-3">
				<h5>No Posts...</h5>
			</div>	
		@endif	
	</div>

@endsection