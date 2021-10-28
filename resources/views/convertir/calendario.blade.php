@extends('layouts.app')

@push("scripts")
    <!--Scripts Calendario-->
    {{-- <link rel="stylesheet" type="text/css" href="{{ asset('css/bootstrap.min.css') }}"> --}}
    <link rel="stylesheet" href="{{ asset('css/calendar.css') }}">
    <link href="{{ asset('css/font-awesome.min.css') }}" rel="stylesheet">
    <script type="text/javascript" src="{{ asset('js/es-ES.js') }}"></script>
    <script src="{{ asset('js/jquery.min.js') }}"></script>
    <script src="{{ asset('js/moment.js') }}"></script>
    <script src="{{ asset('js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('js/bootstrap-datetimepicker.js') }}"></script>
    <link rel="stylesheet" href="{{ asset('css/bootstrap-datetimepicker.min.css') }}" />
    <!--Scripts Calendario-->
@endpush

@section("content")
<!--Section Calendario-->
    <div class="container mx-auto sm:px-4">
        <div class="flex flex-wrap ">
            <!--<div class="page-header"><h4></h4></div>-->
            <div class="pull-left flex items-center"><br>
                <div class="relative inline-flex align-middle">
                    <button class="inline-block align-middle text-center select-none border font-normal whitespace-no-wrap rounded py-1 px-3 leading-normal no-underline bg-blue-600 text-white hover:bg-blue-600" data-calendar-nav="prev"><i class="fa fa-arrow-left"></i>
                    </button>
                    <button class="inline-block align-middle text-center select-none border font-normal whitespace-no-wrap rounded py-1 px-3 leading-normal no-underline" data-calendar-nav="today">Hoy</button>
                    <button class="inline-block align-middle text-center select-none border font-normal whitespace-no-wrap rounded py-1 px-3 leading-normal no-underline bg-blue-600 text-white hover:bg-blue-600" data-calendar-nav="next"><i class="fa fa-arrow-right"></i>
                    </button>
                </div>
                <div class="relative inline-flex align-middle">
                    <button class="inline-block align-middle text-center select-none border font-normal whitespace-no-wrap rounded py-1 px-3 leading-normal no-underline bg-orange-400 text-black hover:bg-orange-500" data-calendar-view="year">Año</button>
                    <button class="inline-block align-middle text-center select-none border font-normal whitespace-no-wrap rounded py-1 px-3 leading-normal no-underline bg-orange-400 text-black hover:bg-orange-500 active" data-calendar-view="month">Mes</button>
                    <button class="inline-block align-middle text-center select-none border font-normal whitespace-no-wrap rounded py-1 px-3 leading-normal no-underline bg-orange-400 text-black hover:bg-orange-500" data-calendar-view="week">Semana</button>
                    <button class="inline-block align-middle text-center select-none border font-normal whitespace-no-wrap rounded py-1 px-3 leading-normal no-underline bg-orange-400 text-black hover:bg-orange-500" data-calendar-view="day">Dia</button>
                </div>
            </div>
            <div class="pull-right flex items-center"><br>
                <button class="inline-block align-middle text-center select-none border font-normal whitespace-no-wrap rounded py-1 px-3 leading-normal no-underline bg-teal-500 text-white hover:bg-teal-600" data-toggle='modal' data-target='#add_evento'>Añadir Evento</button>
            </div>
        </div>
        <br><br><br>
        <div class="flex flex-wrap ">
            <div id="calendar"></div> <!-- Aqui se mostrara nuestro calendario -->

        </div>
        <!--ventana modal para el calendario-->
        <div class="modal opacity-0" id="events-modal">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <a href="#" data-dismiss="modal" style="float: right;"> <i
                                class="glyphicon glyphicon-remove "></i>
                        </a>
                        <br>
                    </div>
                    <div class="modal-body" style="height: 400px">
                        <p>One fine body&hellip;</p>
                    </div>

                </div><!-- /.modal-content -->
            </div><!-- /.modal-dialog -->
        </div><!-- /.modal -->
    </div>
    <script src="{{ asset('js/underscore-min.js') }}"></script>
    <script src="{{ asset('js/calendar.js') }}"></script>
    <script type="text/javascript">
        (function($){
                //creamos la fecha actual
                var date = new Date();
                var yyyy = date.getFullYear().toString();
                var mm = (date.getMonth()+1).toString().length == 1 ? "0"+(date.getMonth()+1).toString() : (date.getMonth()+1).toString();
                var dd  = (date.getDate()).toString().length == 1 ? "0"+(date.getDate()).toString() : (date.getDate()).toString();

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
    </script>
    <div class="modal opacity-0" id="add_evento" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
        aria-hidden="false">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="myModalLabel">Agregar nuevo evento</h4>
                </div>
                <div class="modal-body">
                    <form action="{{ route('calendar') }}" method="POST">
                        @csrf
                        <label for="start">Inicio</label>
                        <div class='relative flex items-stretch w-full date' id='start'>
                            <input type='text' id="start" :value="old('start')" name="start" class="block appearance-none w-full py-1 px-2 mb-1 text-base leading-normal bg-white text-gray-800 border border-gray-200 rounded" required />
                            <span class="py-1 px-2 mb-1 text-base font-normal leading-normal text-gray-900 text-center bg-gray-300 border border-4 border-gray-100 rounded"><span class="glyphicon glyphicon-calendar"></span>
                        </div>
                        <br>
                        <label for="phone_number">Celular</label>
                        <input type='number' name="phone_number" :value="old('phone_number')" id="phone_number" class="block appearance-none w-full py-1 px-2 mb-1 text-base leading-normal bg-white text-gray-800 border border-gray-200 rounded"
                            placeholder="3124567890" />
                        <br>
                        <label for="class">Tipo servicio</label>
                        <select class="block appearance-none w-full py-1 px-2 mb-1 text-base leading-normal bg-white text-gray-800 border border-gray-200 rounded" name="service_id" :value="old('service_id')" required>
                            <option></option>
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
                        <label for="title">Título</label>
                        <input type="text" required :value="old('title')" name="title" class="block appearance-none w-full py-1 px-2 mb-1 text-base leading-normal bg-white text-gray-800 border border-gray-200 rounded" id="title"
                            placeholder="Introduce un título">
                        <br>
                        <label for="body">Evento</label>
                        <textarea id="body" name="event" :value="old('event')" required class="block appearance-none w-full py-1 px-2 mb-1 text-base leading-normal bg-white text-gray-800 border border-gray-200 rounded" rows="3"></textarea>
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
                    <button type="button" class="inline-block align-middle text-center select-none border font-normal whitespace-no-wrap rounded py-1 px-3 leading-normal no-underline bg-red-600 text-white hover:bg-red-700" data-dismiss="modal"><i class="fa fa-times"></i>
                        Cancelar</button>
                    <button type="submit" class="inline-block align-middle text-center select-none border font-normal whitespace-no-wrap rounded py-1 px-3 leading-normal no-underline bg-green-500 text-white hover:bg-green-600"><i class="fa fa-check"></i> Agregar</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
<!--Section Calendario-->
@endsection
