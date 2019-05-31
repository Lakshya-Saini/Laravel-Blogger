@extends('layouts.app')

@section('title', '| Create Post')

@section('stylesheets')

    {!! Html::style('css/select2.min.css') !!}
    {{ Html::style('css/new.css') }}

@endsection

@section('content')
    <div class="col-md-9 mx-auto">
        <h1>Create Posts</h1>

        {{ Form::open(['action' => 'PostsController@store', 'method' => 'POST', 'enctype' => 'multipart/form-data']) }}
            <div class="form-group">
                {{ Form::label('title', 'Title') }}
                {{ Form::text('title', '', ['class' => 'form-control', 'placeholder' => 'Enter Title']) }}
            </div>
            <div class="form-group">
                {{ Form::label('description', 'Description') }}
                {{ Form::textarea('description', '', ['id' => 'article-ckeditor', 'class' => 'form-control', 'placeholder' => 'Enter Description']) }}
            </div>
            <div class="form-group">
                {{ Form::file('featured_image') }}
            </div>
            <div class="form-group">
                {{ Form::label('category_id', 'Category') }}
                <select class="form-control" name="category_id">
                    @foreach($categories as $category)
                        <option value="{{ $category->id }}">{{ $category->name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group">
                {{ Form::label('tags', 'Tags') }}
                <select class="form-control select2-multi" name="tags[]" multiple="multiple">
                    @foreach($tags as $tag)
                        <option value="{{ $tag->id }}">{{ $tag->name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group">
                {{ Form::label('slug', 'Slug') }}
                {{ Form::text('slug', '', ['class' => 'form-control', 'required' => '', 'minlength' => '5', 'maxlength' => '255']) }}
            </div>
            {{ Form::submit('Submit', ['class' => 'btn btn-primary']) }}
        {{ Form::close() }}
    </div>    
@endsection

@section('scripts')

    {!! Html::script('js/select2.min.js') !!}

    <script type="text/javascript">
        
            $(".select2-multi").select2();
    
    </script>

@endsection