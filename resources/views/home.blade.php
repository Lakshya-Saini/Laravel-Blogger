@extends('layouts.app')

@section('stylesheets')

    {{ Html::style('css/new.css') }}

@endsection

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="row">
                <div class="col-md-9">
                    <h1 class="mb-4 d-inline">Dashboard</h1>
                    <p class="d-inline label ml-2">{{ $posts->count() }} posts</p class="d-inline label ml-2">
                </div>
                <div class="col-md-3">
                    <a href="/posts/create" class="btn btn-primary btn-block">Create Post</a>
                </div>
            </div>

            @foreach($posts as $post)

                <div class="py-4">
                    <div class="row">
                        <div class="col-md-4">
                            @if($post->image)
                                <img class="w-100 h-100" src="/storage/images/{{$post->image}}">
                            @else
                                <img class="w-100 h-100" src="/storage/images/noimage.png">
                            @endif        
                        </div>
                        <div class="col-md-8">
                            <h2>{{ $post->title }}</h2>
                            <p>{{ substr($post->description ,0, 250) }}{{ strlen($post->description) > 250 ? "...." : "" }}</p>
                            <small>Written by {{ auth()->user()->name }} on {{ date('M j, Y', strtotime($post->created_at)) }}</small>
                            <div class="row col-md-6 p-0 mt-3">
                                <div class="col-md-4">
                                    <a href="/posts/{{$post->id}}" class="btn btn-primary btn-block">View</a>
                                </div>
                                <div class="col-md-4">
                                    <a href="/posts/{{$post->id}}/edit" class="btn btn-success btn-block">Edit</a>
                                </div>
                                <div class="col-md-4">
                                    {!! Form::open(['action' => ['PostsController@destroy', $post->id], 'method' => 'DELETE']) !!}

                                        {{ Form::submit('Delete', ['class' => 'btn btn-danger btn-block']) }}

                                    {!! Form::close() !!}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            @endforeach

        </div>
    </div>
</div>
@endsection
