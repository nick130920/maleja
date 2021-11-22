<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'SALON DE BELLEZA MALEJA') }}</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}"></script>
    <script src="{{ asset('/alertify/alertify.min.js')}}"></script>
   

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->

    <link href="{{ asset('/css/app.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('/css/new.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('css/bootstrap.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{asset('/alertify/css/themes/semantic.min.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('/alertify/css/alertify.min.css')}}">
    @stack("scripts")


</head>
<body>
    @if ($message = Session::get('success'))
        <script type="text/javascript">
            window.onload = function alerta() {
                alertify.set('notifier','position', 'top-right');
                alertify.notify ("{{ $message }}",'success', 4, function(){});
            };
        </script>
    @endif
    @if ($errors->any())
    <script type="text/javascript">
        window.onload = function alerta() {
            alertify.set('notifier','position', 'top-right');
            @foreach ($errors->all() as $error)
            alertify.notify ("{{ $error }}",'error', 4, function(){});
            @endforeach
        };
    </script>
    @endif
    @include('layouts.nav')
    <div id="app">
        @yield('content')
        {{-- <main class="py-4">
        </main> --}}
    </div>

</body>
</html>
