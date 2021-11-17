@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Dashboard') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    {{ __('Te has logueado!') }}
                    <div class="row justify-content-center">
                        <div class="col-md-4">
                            <a class="text-reset text-decoration-none hover-up" href="{{ url('/services') }}">
                                <div class="card">
                                    <div class="card-header">{{ __('Servicios') }}</div>
                                    <div class="card-body">
                                        <img src="{{ asset('/img/servicios.jpg') }}" width="" alt="servicio">
                                    </div>
                                </div>
                            </a>
                        </div>
                        <div class="col-md-4">
                            <a class="text-reset text-decoration-none hover-up" href="{{ url('/calendar') }}">
                                <div class="card">
                                    <div class="card-header">{{ __('Calendario') }}</div>
                                    <div class="card-body">
                                        <img src="{{ asset('/img/creador-de-calendarios.png') }}" width="" alt="calendario">
                                    </div>
                                </div>
                            </a>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection
