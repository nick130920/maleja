@extends('layouts.app')

@section('template_title')
    Create producto
@endsection

@section('content')
    <div class="panel-body">
        <section class="content container-fluid">
            <div class="row d-flex justify-content-center">
                <div class="col-md-6">
                    @includeif('partials.errors')
                    <div class="card card-default">
                        <div class="card-header">
                            <span class="card-title">Crear producto</span>
                            <div class="card-body">
                                <form method="POST" action="{{ route('/producto/store') }}" role="form"
                                    enctype="multipart/form-data">
                                    @csrf
                                    @include('producto.form')
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
        </section>

    </div>
@endsection
