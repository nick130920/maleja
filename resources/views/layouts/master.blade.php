<!doctype html>
<html lang="en">
  <head>
  	 @include('layouts.partials.head')
 <title>@yield('title')</title>
  </head>
  <body>
  		@include('layouts.partials.navbar')

		@section('content')

	 	@show
  
   		@include('layouts.partials.footer')
   		@include('layouts.partials.scripts')
   		@section('scripts')
   		@show
   </body>
</html>
