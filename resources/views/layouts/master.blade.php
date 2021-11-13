<!doctype html>
<html lang="en">
  <head>
  	@include('layouts.partials.head')
 	<title>@yield('title')</title>
  </head>
  <body>
  		@include('layouts.partials.navbar')
		@yield('content')

   		@include('layouts.partials.footer')
   		@include('layouts.partials.scripts')
   		@stack('scripts')
  </body>
</html>
