<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
   @include('partials.header')
   @yield('stylesheets')
</head>
<body>
    <div id="app">
        @include('partials.navbar')

        <div class="col-md-11 mx-auto mt-4">
        	@include('partials.messages')
            @yield('content')
        </div>
    </div>

    @include('partials.scripts')
    @yield('scripts')

</body>
</html>
