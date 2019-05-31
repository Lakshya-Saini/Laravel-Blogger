@extends('layouts.app')

@section('title', '| Edit Post')

@section('stylesheets')

    {!! Html::style('css/select2.min.css') !!}
    {{ Html::style('css/new.css') }}

@endsection

@section('content')

	<div class="col-md-9 mx-auto">
        <div class="row">
            <div class="col-md-9">
                <h1 class="mb-4">Edit Post</h1>
            </div>
            <div class="col-md-3">
                <a href="/home" class="btn btn-primary btn-block">Back to all Posts</a>
            </div>
        </div>


        {{ Form::open(['action' => ['PostsController@update', $post->id], 'method' => 'PUT', 'enctype' => 'multipart/form-data']) }}
            <div class="form-group">
                    {{ Form::label('title', 'Title') }}
                    {{ Form::text('title', $post->title, ['class' => 'form-control', 'placeholder' => 'Enter Title']) }}
            </div>
            <div class="form-group">
                    {{ Form::label('description', 'Description') }}
                    {{ Form::textarea('description', $post->description, ['id' => 'article-ckeditor', 'class' => 'form-control', 'placeholder' => 'Enter Description']) }}
            </div>
            <div class="form-group">
                {{ Form::file('featured_image') }}
            </div>
            <div class="form-group">
                {{ Form::label('category_id', 'Category') }}
                {{ Form::select('category_id', $categories, $post->category_id, ['class' => 'form-control']) }}
            </div>
            <div class="form-group">
                {{ Form::label('slug', 'Slug') }}
                {{ Form::text('slug', $post->slug, ['class' => 'form-control', 'required' => '', 'minlength' => '5', 'maxlength' => '255']) }}
            </div>
            <div class="form-group">
                {{ Form::label('tags', 'Tags:') }}
                {{ Form::select('tags[]', $tags, null, ['class' => 'form-control select2-multi', 'multiple' => 'multiple']) }}
            </div>
            {{ Form::submit('Update', ['class' => 'btn btn-success btn-block mb-4']) }}
        {{ Form::close() }}    
    </div>

@endsection

@section('scripts')

    {!! Html::script('js/select2.min.js') !!}

    <script type="text/javascript">
        
        $(".select2-multi").select2();
        $(".select2-multi").select2().val({!! json_encode($post->tags()->allRelatedIds()) !!}).select();
    
    </script>

@endsection