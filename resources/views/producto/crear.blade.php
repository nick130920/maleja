@extends('layouts.app')

@section('template_title')
    Create Service
@endsection

@section('content')
<div class="panel-body">
 
    {{ $message=Session::get('message') }} @include('alerts.request')
 
    <section class="example mt-4">
 
        <div class="card-body">
                        <form method="POST" action="{{ route('producto.store') }}"  role="form" enctype="multipart/form-data">
                            @csrf

                            @include('producto.form')

                        </form>
                    </div>
    </section>
 
</div>
@endsection
