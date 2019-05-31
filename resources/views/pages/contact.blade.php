@extends('layouts.app')

@section('title', '| Contact')

@section('stylesheets')

    {{ Html::style('css/new.css') }}

@endsection

@section('content')
	<div class="col-md-9 mx-auto mt-4">
		<h1 class="text-center">Connect with Us</h1>
		<form action="{{ url('contact') }}" method="post">
			{{ csrf_field() }}
		  <div class="form-group">
		    <input type="email" name="email" class="form-control shadow-none mt-5" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter email">
		  </div>
		  <div class="form-group">
		    <input type="text" name="subject" class="form-control shadow-none" id="Subject" placeholder="Enter Subject">
		  </div>
		  <div class="form-group">
		    <textarea id="message" name="message" rows="6" cols="30" class="form-control shadow-none w-100" placeholder="Enter message here..."></textarea>
		  </div>
		  <button type="submit" name="submit" class="btn btn-primary btn-block shadow-none mt-4">Send</button>
		</form>
	</div>
@endsection