@extends('layouts.app')

@section('title', '| about')

@section('stylesheets')

    {{ Html::style('css/new.css') }}

@endsection

@section('content')

	<div class="row mt-4">
		<div class="col-md-4">
			<img src="images/me.jpeg" class="w-100">
		</div>	
		<div class="col-md-8">
			<h1>Hello there!! I am {{$data['fullname']}}</h1>
			<p>You are welcome to my blog.</p>
			<p>
				I am a certified website-designer and developer who specialises in making websites that are 
				accessible to everyone, easy to use and effective. I try to make them beautiful and memorable. 
				I would like to design and build an attractive, simple website for you that adds value 
				to your business.
				Each site I develop is based on the latest trend design and is SEO friendly. To find about more what I can do, you can check my projects.
			</p>
			<small>Email me at {{$data['email']}}</small>
		</div>
	</div>

@endsection
