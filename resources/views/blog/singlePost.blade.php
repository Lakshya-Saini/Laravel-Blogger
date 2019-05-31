@extends('layouts.app')

@section('title', "| $post->title")

@section('stylesheets')
    {!! Html::style('css/new.css') !!}
@endsection

@section('content')

	<div class="col-md-11 mx-auto">
        <div class="row">
            <div class="col-md-3">
                <a href="/blog" class="btn btn-primary btn-block">Back to all posts</a>
            </div>
        </div>

        <div class="mt-4">
            @if($post->image)
                <img class="w-100 mb-4" src="/storage/images/{{$post->image}}">
            @else
                <img class="w-100 mb-4" src="/storage/images/noimage.png">
            @endif 
            <h1>{{ $post->title }}</h1>
            <p>{{ $post->description }}</p>
            <p>Posted in: @foreach($tags as $tag) <span class="label">{{ $tag->name }}</span> @endforeach</p>
            <small>Created on: {{ date('M j, Y', strtotime($post->created_at)) }}</small>
        </div>

        <div class="mt-4">
            <i class="fa fa-comment comment-large"></i><h3 class="d-inline ml-2">{{ $post->comment->count() }} Comments</h3>
            <div class="comments">
                @foreach($post->comment as $comment)
                    <div class="row mb-4">
                        <div class="col-md-1">
                            <img src='{{ "https://www.gravatar.com/avatar/" . md5(strtolower(trim($comment->email))) }}' class="author-image">
                        </div>
                        <div class="col-md-11 pl-5">
                            <h4 class="mb-0">{{ $comment->name }}</h4>
                            <small>{{ $comment->created_at }}</small>
                            <p class="mt-2">{{ $comment->comment }}</p>
                        </div>
                    </div>
                @endforeach  
            </div>
        </div>

        <hr>

        <div class="mt-4">

            <h3>Comment</h3>

            {!! Form::open(['action' => ['CommentsController@store', $post->id], 'method' => 'POST']) !!}

                {{ Form::text('name', '', ['class' => 'form-control mb-3', 'placeholder' => 'Enter your name']) }}
                {{ Form::text('email', '', ['class' => 'form-control mb-3', 'placeholder' => 'Enter your email']) }}
                {{ Form::textarea('comment', '', ['class' => 'form-control mb-3', 'placeholder' => 'Enter your message...']) }}
                {{ Form::submit('Add Comment', ['class' => 'btn btn-primary btn-block mb-3']) }}

            {!! Form::close() !!}
        </div>
    </div>

@endsection