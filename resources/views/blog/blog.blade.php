@extends('layouts.app')

@section('title', '| blog')

@section('stylesheets')

    {{ Html::style('css/new.css') }}

@endsection

@section('content')
    <div class="row">
        <div class="col-md-12">
            <h1 class="mb-4">All Posts</h1>

            @foreach($posts as $post)

                <div class=" py-4">
                    <div class="row">
                        <div class="col-md-4">
                            @if($post->image)
                                <img class="w-100 h-100 mb-4" src="/storage/images/{{$post->image}}">
                            @else
                                <img class="w-100 h-100 mb-4" src="/storage/images/noimage.png">
                            @endif 
                        </div>
                        <div class="col-md-8">
                            <h2>{{ $post->title }}</h2>
                            <p>{{ substr($post->description, 0, 250) }}{{ strlen($post->description) > 250 ? "...." : "" }}</p>
                            <small>Written by {{ $post->user->name }} on {{ date('M j, Y', strtotime($post->created_at)) }}</small>
                            <p class="mt-3"><a href="{{ url('blog/' . $post->slug) }}" class="read-button btn btn-primary">Read More</a></p>
                        </div>
                    </div>
                </div>

            @endforeach

            <div class="col-md-2 mx-auto">
            	{{ $posts->links() }}
            </div>
        </div>    
    </div>    
    
@endsection