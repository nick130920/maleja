@extends('layouts.app')

@push('scripts')
    <!--Scripts Calendario-->
    <link href="https://fonts.googleapis.com/css?family=Lato:300,400,700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">

    <link rel="stylesheet" href="{{ asset('css/bootstrap.css') }}">
    <link rel="stylesheet" href="{{ asset('css/calendar.css') }}">




<!--Scripts Calendario-->
@endpush
@section('content')
    <script type="text/javascript">
        var eventos = @json($citas);
    </script>
    <section>
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="content w-100">
                        <div class="calendar-container">
                            <div class="calendar">
                                <div class="year-header">
                                    <span class="left-button fa fa-chevron-left" id="prev"> </span>
                                    <span class="year" id="label"></span>
                                    <span class="right-button fa fa-chevron-right" id="next"> </span>
                                </div>
                                <table class="months-table w-100">
                                    <tbody>
                                        <tr class="months-row">
                                            <td class="month">Ene</td>
                                            <td class="month">Feb</td>
                                            <td class="month">Mar</td>
                                            <td class="month">Abr</td>
                                            <td class="month">May</td>
                                            <td class="month">Jun</td>
                                            <td class="month">Jul</td>
                                            <td class="month">Ago</td>
                                            <td class="month">Sep</td>
                                            <td class="month">Oct</td>
                                            <td class="month">Nov</td>
                                            <td class="month">Dic</td>
                                        </tr>
                                    </tbody>
                                </table>

                                <table class="days-table w-100">
                                    <td class="day">Dom</td>
                                    <td class="day">Lun</td>
                                    <td class="day">Mar</td>
                                    <td class="day">Mie</td>
                                    <td class="day">Jue</td>
                                    <td class="day">Fri</td>
                                    <td class="day">Sab</td>
                                </table>
                                <div class="frame">
                                    <table class="dates-table w-100">
                                        <tbody class="tbody">
                                        </tbody>
                                    </table>
                                </div>
                                <button class="button" id="add-button">Agregar Cita</button>
                            </div>
                        </div>
                        <div class="events-container">

                        </div>
                        <div class="hidden">
                            <form id="form-posponer" action="{{ route('calendar') }}"method='POST'>@csrf
                            </form>
                            <button type='button' class='mx-4 bg-info button' id='posponer'>Posponer</button>
                        </div>

                        <div class="dialog" id="dialog">
                            <h2 class="dialog-header"> Crear una cita </h2>
                            <div class="form-container" align="center" style="margin-top: 0">
                                <form action="{{ route('calendar') }}" method="POST">
                                    @csrf
                                    <label for="title" class="form-label">quien solicita</label>
                                    <input type="text" required :value="old('title')" name="title" class="input" style="margin-bottom: 10px"
                                        id="title">
                                    <label class="form-label" id="valueFromMyButton" for="count">fecha y hora</label>

                                    {{-- <input type="time" name="time" id="time" class="input" style="margin-bottom: 10px" >
                                    <input type="number" name="month" id="month" class="input" style="margin-bottom: 10px" >
                                    <input type="number" name="year" id="year" class="input" style="margin-bottom: 10px" > --}}

                                    <input type='number' min="2022-01-01" max="2200-12-31" id="start" name="start" class="input" style="margin-bottom: 10px" required />

                                    <label for="phone_number" class="form-label">Celular</label>
                                    <input type='number' name="phone_number" :value="old('phone_number')" id="phone_number" class="input" style="margin-bottom: 10px" placeholder="Ejemplo: 3124567890" />
                                    <label for="class" class="form-label">Tipo servicio</label>
                                    <select style="background: #000;" class="input-select" aria-label="Default select example" name="service_id"
                                        :value="old('service_id')" require>
                                        <option></option>
                                        @foreach ($servicios as $servicio)
                                            <option style="color: #999" value={{ $servicio->id }}>{{ $servicio->name }}
                                                {{ $servicio->time }}</option>
                                        @endforeach
                                    </select>
                                    <br>
                                    <label for="body" class="form-label">Evento</label>
                                    <textarea id="body" name="event" :value="old('event')" required class="input"
                                        rows="3" style="margin-top: 0px; margin-bottom: 10px; height: 55px;"></textarea>
                                    <input type="button" value="Cancel" class="button" id="cancel-button">
                                    <button type="submit" class="button button-white" id="ok-button"><i class="fa fa-check"></i>OK</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
    </section>
    
    <script src="{{ asset('js/underscore-min.js') }}"></script>
    <script src="{{ asset('js/calendar.js') }}"></script>
    <script src="{{ asset('js/jquery.min.js') }}"></script>
    <script src="{{ asset('js/moment.js') }}"></script>
    <script src="{{ asset('js/bootstrap.min.js') }}"></script>
    <style>
        #start::-webkit-calendar-picker-indicator {
            color: transparent;
            background: transparent;
            z-index: 10;
            width: 10%
        }
        #start::after {
            background: none;
            display: block;
            font-family: 'FontAwesome';
            width: 1px;
            content: '\f073';
            position: relative;
            right: 20px;
        }</style>
@endsection
