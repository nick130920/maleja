@extends('layouts.app')

@push('scripts')
    <!--Scripts Calendario-->
    <link href="https://fonts.googleapis.com/css?family=Lato:300,400,700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">

    <link rel="stylesheet" href="{{ asset('css/bootstrap.css') }}">
    {{-- <link href="{{ asset('css/font-awesome.min.css') }}" rel="stylesheet"> --}}
    {{-- <script type="text/javascript" src="{{ asset('js/es-ES.js') }}"></script> --}}

    <!--Scripts Calendario-->
@endpush

@section('content')

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
                                            <td class="month">Jan</td>
                                            <td class="month">Feb</td>
                                            <td class="month">Mar</td>
                                            <td class="month">Apr</td>
                                            <td class="month">May</td>
                                            <td class="month">Jun</td>
                                            <td class="month">Jul</td>
                                            <td class="month">Aug</td>
                                            <td class="month">Sep</td>
                                            <td class="month">Oct</td>
                                            <td class="month">Nov</td>
                                            <td class="month">Dec</td>
                                        </tr>
                                    </tbody>
                                </table>

                                <table class="days-table w-100">
                                    <td class="day">Sun</td>
                                    <td class="day">Mon</td>
                                    <td class="day">Tue</td>
                                    <td class="day">Wed</td>
                                    <td class="day">Thu</td>
                                    <td class="day">Fri</td>
                                    <td class="day">Sat</td>
                                </table>
                                <div class="frame">
                                    <table class="dates-table w-100">
                                        <tbody class="tbody">
                                        </tbody>
                                    </table>
                                </div>
                                <button class="button" id="add-button">Add Event</button>
                            </div>
                        </div>
                        <div class="events-container">
                        </div>
                        <div class="dialog" id="dialog">
                            <h2 class="dialog-header"> Crear una cita </h2>
                            <div class="form-container" align="center" style="margin-top: 0">
                                <form action="{{ route('calendar') }}" method="POST">
                                    @csrf
                                    <label for="title" class="form-label">Título</label>
                                    <input type="text" required :value="old('title')" name="title" class="input" style="margin-bottom: 10px"
                                        id="title">
                                    <label class="form-label" id="valueFromMyButton" for="count">Inicio</label>
                                    <input type='text' id="start" :value="old('start')" name="start" class="input" style="margin-bottom: 10px"
                                        required />
                                    <label for="phone_number" class="form-label">Celular</label>
                                    <input type='number' name="phone_number" :value="old('phone_number')" id="phone_number"
                                        class="input" style="margin-bottom: 10px" placeholder="3124567890" />
                                    <label for="class" class="form-label">Tipo servicio</label>
                                    <select style="background: #000;" class="input-select" aria-label="Default select example" name="service_id"
                                        :value="old('service_id')" require>
                                        <option></option>
                                        @foreach ($servicios as $servicio)
                                            <option style="color: #999" value={{ $servicio->id }}>{{ $servicio->name }}
                                                {{ $servicio->time }}</option>
                                        @endforeach
                                        <option style="color: #999" value="1">corte de dama</option>
                                        <option style="color: #999" value="2">corte de niños</option>
                                        <option style="color: #999" value="3">corte de caballeros</option>
                                        <option style="color: #999" value="4">pedicure</option>
                                        <option style="color: #999" value="5">manicure</option>
                                        <option style="color: #999" value="6">Depilacion con cera </option>
                                        <option style="color: #999" value="7">Maquillaje</option>
                                        <option style="color: #999" value="8">Trenza</option>
                                        <option style="color: #999" value="9">peinado niñas </option>
                                        <option style="color: #999" value="10">peinado damas </option>
                                        <option style="color: #999" value="11">planchados</option>
                                        <option style="color: #999" value="12">cepillado</option>
                                        <option style="color: #999" value="13">Keratina </option>
                                        <option style="color: #999" value="14">Tintes</option>
                                        <option style="color: #999" value="15">semipermanentes</option>
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
    <!--Section Calendario-->
    {{-- <div class="container"> --}}
    {{-- <div class="row">
            <!--<div class="page-header"><h4></h4></div>-->
            <div class="float-xs-start form-inline"><br>
                <div class="btn-group">
                    <button class="btn btn-primary" data-calendar-nav="prev"><i class="fa fa-arrow-left"></i>
                    </button>
                    <button class="btn" data-calendar-nav="today">Hoy</button>
                    <button class="btn btn-primary" data-calendar-nav="next"><i class="fa fa-arrow-right"></i>
                    </button>
                </div>
                <div class="btn-group">
                    <button class="btn btn-warning" data-calendar-view="year">Año</button>
                    <button class="btn btn-warning active" data-calendar-view="month">Mes</button>
                    <button class="btn btn-warning" data-calendar-view="week">Semana</button>
                    <button class="btn btn-warning" data-calendar-view="day">Dia</button>
                </div>
            </div>
            <div class="float-xs-end form-inline"><br>
                <button class="btn btn-info" data-bs-toggle='modal' data-bs-target='#add_evento'>Añadir Evento</button>
            </div>
        </div>
        <br><br><br> --}}
    {{-- <div class="row">
            <div id="calendar"></div> <!-- Aqui se mostrara nuestro calendario -->

        </div> --}}
    <!--ventana modal para el calendario-->
    {{-- <div class="modal fade" id="events-modal">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <a href="#" data-bs-dismiss="modal" style="float: right;"> <i
                                class="glyphicon glyphicon-remove "></i>
                        </a>
                        <br>
                    </div>
                    <div class="modal-body" style="height: 400px">
                        <p>One fine body&hellip;</p>
                    </div>

                </div><!-- /.modal-content -->
            </div><!-- /.modal-dialog -->
        </div><!-- /.modal --> --}}
    {{-- </div> --}}
    <script src="{{ asset('js/underscore-min.js') }}"></script>
    <script src="{{ asset('js/calendar.js') }}"></script>
    <script src="{{ asset('js/jquery.min.js') }}"></script>
    <script src="{{ asset('js/moment.js') }}"></script>
    <script src="{{ asset('js/bootstrap.min.js') }}"></script>
    {{-- <script type="text/javascript">
        (function($){
                //creamos la fecha actual
                var date = new Date();
                var yyyy = date.getFullYear().toString();
                var mm = (date.getMonth()+1).toString().length == 1 ? "0"+(date.getMonth()+1).toString() : (date.getMonth()+1).toString();
                var dd  = (date.getDate()).toString().length == 1 ? "0"+(date.getDate()).toString() : (date.getDate()).toString();

                var citas = @json($citas);
                //establecemos los valores del calendario
                var options = {

                    // definimos que los agenda se mostraran en ventana modal
                    modal: '#events-modal',

                        // dentro de un iframe
                        modal_type:'iframe',

                        //obtenemos los agenda de la base de datos
                        events_source: 'obtener_eventos.php',

                        // mostramos el calendario en el mes
                        view: 'month',

                        // y dia actual
                        day: yyyy+"-"+mm+"-"+dd,


                        // definimos el idioma por defecto
                        language: 'es-ES',

                        //Template de nuestro calendario
                        tmpl_path: 'tmpls/',
                        tmpl_cache: false,


                        // Hora de inicio
                        time_start: '08:00',

                        // y Hora final de cada dia
                        time_end: '22:00',

                        // intervalo de tiempo entre las hora, en este caso son 30 minutos
                        time_split: '30',

                        // Definimos un ancho del 100% a nuestro calendario
                        width: '100%',

                        onAfterEventsLoad: function(events)
                        {
                            if(!events)
                            {
                                return;
                            }
                            var list = $('#eventlist');
                            list.html('');

                            $.each(events, function(key, val)
                            {
                                $(document.createElement('li'))
                                .html('<a href="' + val.url + '">' + val.title + '</a>')
                                .appendTo(list);
                            });
                        },
                        onAfterViewLoad: function(view)
                        {
                            $('#page-header').text(this.getTitle());
                            $('.btn-group button').removeClass('active');
                            $('button[data-calendar-view="' + view + '"]').addClass('active');
                        },
                        classes: {
                            months: {
                                general: 'label'
                            }
                        }
                    };


                // id del div donde se mostrara el calendario
                var calendar = $('#calendar').calendar(options);

                $('.btn-group button[data-calendar-nav]').each(function()
                {
                    var $this = $(this);
                    $this.click(function()
                    {
                        calendar.navigate($this.data('calendar-nav'));
                    });
                });

                $('.btn-group button[data-calendar-view]').each(function()
                {
                    var $this = $(this);
                    $this.click(function()
                    {
                        calendar.view($this.data('calendar-view'));
                    });
                });

                $('#first_day').change(function()
                {
                    var value = $(this).val();
                    value = value.length ? parseInt(value) : null;
                    calendar.setOptions({first_day: value});
                    calendar.view();
                });
            }(jQuery));
    </script> --}}
    {{-- <div class="modal fade" id="add_evento" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
        aria-hidden="false">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="myModalLabel">Agregar nuevo evento</h4>
                </div>
                <div class="modal-body">
                    <form action="{{ route('calendar') }}" method="POST">
                        @csrf
                        <label for="start" class="form-label">Inicio</label>
                        <div class='input-group date' id='start'>
                            <input type='text' id="start" :value="old('start')" name="start" class="form-control" aria-label="Recipient" aria-describedby="basicoo" required />
                            <span id="basic-addon2" class="input-group-addon"><span  class="glyphicon glyphicon-calendar"></span>
                            <span class="input-group-text" id="basicoo">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-calendar-week-fill"
                                    viewBox="0 0 16 16">
                                    <path
                                        d="M4 .5a.5.5 0 0 0-1 0V1H2a2 2 0 0 0-2 2v1h16V3a2 2 0 0 0-2-2h-1V.5a.5.5 0 0 0-1 0V1H4V.5zM16 14V5H0v9a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2zM9.5 7h1a.5.5 0 0 1 .5.5v1a.5.5 0 0 1-.5.5h-1a.5.5 0 0 1-.5-.5v-1a.5.5 0 0 1 .5-.5zm3 0h1a.5.5 0 0 1 .5.5v1a.5.5 0 0 1-.5.5h-1a.5.5 0 0 1-.5-.5v-1a.5.5 0 0 1 .5-.5zM2 10.5a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 .5.5v1a.5.5 0 0 1-.5.5h-1a.5.5 0 0 1-.5-.5v-1zm3.5-.5h1a.5.5 0 0 1 .5.5v1a.5.5 0 0 1-.5.5h-1a.5.5 0 0 1-.5-.5v-1a.5.5 0 0 1 .5-.5z">
                                    </path>
                                </svg>
                            </span>
                        </div>
                        <br>
                        <label for="phone_number" class="form-label">Celular</label>
                        <input type='number' name="phone_number" :value="old('phone_number')" id="phone_number" class="form-control"
                            placeholder="3124567890" />
                        <br>
                        <label for="class" class="form-label">Tipo servicio</label>
                        <select class="form-select" aria-label="Default select example" name="service_id" :value="old('service_id')" required>
                            <option></option>
                            @foreach ($servicios as $servicio)
                                <option value={{ $servicio->id  }}>{{ $servicio->name  }} {{$servicio->time}}</option>
                            @endforeach
                            <option value="1">corte de dama</option>
                            <option value="2">corte de niños</option>
                            <option value="3">corte de caballeros</option>
                            <option value="4">pedicure</option>
                            <option value="5">manicure</option>
                            <option value="6">Depilacion con cera </option>
                            <option value="7">Maquillaje</option>
                            <option value="8">Trenza</option>
                            <option value="9">peinado niñas </option>
                            <option value="10">peinado damas </option>
                            <option value="11">planchados</option>
                            <option value="12">cepillado</option>
                            <option value="13">Keratina </option>
                            <option value="14">Tintes</option>
                            <option value="15">semipermanentes</option>
                        </select>
                        <br>
                        <label for="title" class="form-label">Título</label>
                        <input type="text" required :value="old('title')" name="title" class="form-control" id="title"
                            placeholder="Introduce un título">
                        <br>
                        <label for="body" class="form-label">Evento</label>
                        <textarea id="body" name="event" :value="old('event')" required class="form-control" rows="3"></textarea>
                        <script type="text/javascript">
                            $(function () {
                            $('#start').datetimepicker({
                                language: 'es',
                                minDate: new Date()
                            });
                        });
                        </script>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal"><i class="fa fa-times"></i>
                        Cancelar</button>
                    <button type="submit" class="btn btn-success"><i class="fa fa-check"></i> Agregar</button>
                    </form>
                </div>
            </div>
        </div>
    </div> --}}
    <!--Section Calendario-->
@endsection
