@extends('layouts.app')

@section('title', '| View Post')

@section('stylesheets')

	{!! Html::style('css/new.css') !!}

@endsection

@section('content')

	<div class="row">
        <div class="col-md-9">
            <h1 class="mb-4">View Post</h1>
        </div>
        <div class="col-md-3">
            <a href="/home" class="btn btn-primary btn-block">Back to all posts</a>
        </div>
    </div>

	<div>
		@if($post->image)
            <img class="w-100 mb-4" src="/storage/images/{{$post->image}}">
        @else
            <img class="w-100 mb-4" src="/storage/images/noimage.png">
        @endif 
		<h3>{{$post->title}}</h3>
		<p>{{$post->description}}</p>
		<p>URL: <a href="{{ route('blog.single', $post->slug) }}">{{ url('blog/' . $post->slug) }}</a></p>
		<p>Category: {{ $post->category->name }}</p>

		<div class="tags mb-3">
			Tags:
	    	@foreach($post->tags as $tag)
				<span class="label">{{ $tag->name }}</span>
	    	@endforeach
	    </div>

	    <small>Created on {{ date('M j, Y', strtotime($post->created_at)) }}</small>

	</div>

	<i class="fa fa-comment comment-large"></i><h3 class="d-inline ml-2">{{ $post->comment->count() }} Comments</h3>

	<table class="table table-bordered table-hovered mt-4">
		<thead>
			<tr>
				<th>Id</th>
				<th>Name</th>
				<th>Comment</th>
				<th>Action</th>
			</tr>
		</thead>
		<tbody>
			@foreach($post->comment as $comment)
				<tr>
					<td>{{ $comment->id }}</td>
					<td>{{ $comment->name }}</td>
					<td>{{ $comment->comment }}</td>
					<td><a href="{{ route('comments.destroy', $comment->id) }}"><i class="fa fa-trash trash-icon"></i></a></td>
				</tr>
			@endforeach	
		</tbody>
	</table>

@endsection