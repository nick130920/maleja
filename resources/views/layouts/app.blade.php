<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <title>{{ config('app.name', 'SALON DE BELLEZA MALEJA') }}</title>

        <!-- Fonts -->
        <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap">

        <!-- Styles -->
        <link rel="stylesheet" href="{{ asset('css/app.css') }}">

        <link rel="stylesheet" type="text/css" href="{{asset('/alertify/css/themes/semantic.min.css')}}">
        <link rel="stylesheet" type="text/css" href="{{asset('/alertify/css/alertify.min.css')}}">

        <!-- Scripts -->
        <script src="{{ asset('js/app.js') }}" defer></script>
        <script src="{{asset('/alertify/alertify.min.js')}}"></script>
        @stack("scripts")
    </head>
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
    <body class="font-sans antialiased">
        <div class="min-h-screen bg-gray-100">
            @include('layouts.navigation')

            <!-- Page Heading -->
           
            <!-- Page Content -->
            <main>
                {{ $slot }}
            </main>
        </div>
    </body>
</html>
