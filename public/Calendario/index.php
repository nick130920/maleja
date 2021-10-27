<?php


// Definimos nuestra zona horaria
date_default_timezone_set("America/Bogota");
// incluimos el archivo de funciones
include 'funciones.php';

// incluimos el archivo de configuracion
include 'config.php';

// Verificamos si se ha enviado el campo con name from
if (isset($_POST['from'])) {

    // Si se ha enviado verificamos que no vengan vacios
    if ($_POST['from'] != "") {

        // Recibimos el fecha de inicio y la fecha final desde el form
        $Datein                    = date('d/m/Y H:i:s', strtotime($_POST['from']));
        $inicio = _formatear($Datein);
        // y la formateamos con la funcion _formatear

        // Recibimos el fecha de inicio y la fecha final desde el form
        $orderDate                      = date('d/m/Y H:i:s', strtotime($_POST['from']));
        $inicio_normal = $orderDate;
        // y la formateamos con la funcion _formatear


        // Recibimos los demas datos desde el form
        $titulo = evaluar($_POST['title']);

        // y con la funcion evaluar
        $body   = evaluar($_POST['event']);

        // reemplazamos los caracteres no permitidos
        $clase  = evaluar($_POST['class']);


        $celular  = evaluar($_POST['celular']);

        // insertamos el evento
        $query = "INSERT INTO agenda (`title`, `body`, `class`, `start`, `phone`, `inicio_normal`, `user_id`)
        VALUES('$titulo','$body', $clase','$inicio','$celular','$inicio_normal')";

        // Ejecutamos nuestra sentencia sql
        $conexion->query($query) or die('<script type="text/javascript">alert("Sentencia No ejecutada")</script>');

        header("Location:$base_url");


        // Obtenemos el ultimo id insetado
        $im = $conexion->query("SELECT MAX(id) AS id FROM agenda");
        $row = $im->fetch_row();
        $id = trim($row[0]);

        // para generar el link del evento
        $link = "$base_url" . "descripcion_evento.php?id=$id";

        // y actualizamos su link
        $query = "UPDATE agenda SET url = '$link' WHERE id = $id";

        // Ejecutamos nuestra sentencia sql
        $conexion->query($query) or die('<script type="text/javascript">alert("Última Sentencia No ejecutada")</script>');

        // redireccionamos a nuestro calendario
        //header("Location:$base_url");
    }
}

?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="utf-8">
    <title>Calendario</title>
    <link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/calendar.css">
    <link href="css/font-awesome.min.css" rel="stylesheet">
    <script type="text/javascript" src="js/es-ES.js"></script>
    <script src="js/jquery.min.js"></script>
    <script src="js/moment.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/bootstrap-datetimepicker.js"></script>
    <link rel="stylesheet" href="css/bootstrap-datetimepicker.min.css" />

</head>
</head>

<body style="background: white;">
    <div class="container">
        <div class="row">
            <!--<div class="page-header"><h4></h4></div>-->
            <div class="pull-left form-inline"><br>
                <div class="btn-group">
                    <button class="btn btn-primary" data-calendar-nav="prev"><i class="fa fa-arrow-left"></i> </button>
                    <button class="btn" data-calendar-nav="today">Hoy</button>
                    <button class="btn btn-primary" data-calendar-nav="next"><i class="fa fa-arrow-right"></i> </button>
                </div>
                <div class="btn-group">
                    <button class="btn btn-warning" data-calendar-view="year">Año</button>
                    <button class="btn btn-warning active" data-calendar-view="month">Mes</button>
                    <button class="btn btn-warning" data-calendar-view="week">Semana</button>
                    <button class="btn btn-warning" data-calendar-view="day">Dia</button>
                </div>
            </div>
            <div class="pull-right form-inline"><br>
                <button class="btn btn-info" data-toggle='modal' data-target='#add_evento'>Añadir Evento</button>
            </div>
        </div>
        <br><br><br>
        <div class="row">
            <div id="calendar"></div> <!-- Aqui se mostrara nuestro calendario -->

        </div>
        <!--ventana modal para el calendario-->
        <div class="modal fade" id="events-modal">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <a href="#" data-dismiss="modal" style="float: right;"> <i class="glyphicon glyphicon-remove "></i> </a>
                        <br>
                    </div>
                    <div class="modal-body" style="height: 1000px">
                        <p>One fine body&hellip;</p>
                    </div>

                </div><!-- /.modal-content -->
            </div><!-- /.modal-dialog -->
        </div><!-- /.modal -->
    </div>

    <script src="js/underscore-min.js"></script>
    <script src="js/calendar.js"></script>
    <script type="text/javascript">
        (function($) {
            //creamos la fecha actual
            var date = new Date();
            var yyyy = date.getFullYear().toString();
            var mm = (date.getMonth() + 1).toString().length == 1 ? "0" + (date.getMonth() + 1).toString() : (date.getMonth() + 1).toString();
            var dd = (date.getDate()).toString().length == 1 ? "0" + (date.getDate()).toString() : (date.getDate()).toString();

            //establecemos los valores del calendario
            var options = {

                // definimos que los agenda se mostraran en ventana modal
                modal: '#events-modal',

                // dentro de un iframe
                modal_type: 'iframe',

                //obtenemos los agenda de la base de datos
                events_source: 'obtener_eventos.php',

                // mostramos el calendario en el mes
                view: 'month',

                // y dia actual
                day: yyyy + "-" + mm + "-" + dd,


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

                onAfterEventsLoad: function(events) {
                    if (!events) {
                        return;
                    }
                    var list = $('#eventlist');
                    list.html('');

                    $.each(events, function(key, val) {
                        $(document.createElement('li'))
                            .html('<a href="' + val.url + '">' + val.title + '</a>')
                            .appendTo(list);
                    });
                },
                onAfterViewLoad: function(view) {
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

            $('.btn-group button[data-calendar-nav]').each(function() {
                var $this = $(this);
                $this.click(function() {
                    calendar.navigate($this.data('calendar-nav'));
                });
            });

            $('.btn-group button[data-calendar-view]').each(function() {
                var $this = $(this);
                $this.click(function() {
                    calendar.view($this.data('calendar-view'));
                });
            });

            $('#first_day').change(function() {
                var value = $(this).val();
                value = value.length ? parseInt(value) : null;
                calendar.setOptions({
                    first_day: value
                });
                calendar.view();
            });
        }(jQuery));
    </script>

    <div class="modal fade" id="add_evento" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="false">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="myModalLabel">Agregar nuevo evento</h4>
                </div>
                <div class="modal-body">
                    <form action="" method="post">
                        <label for="from">Inicio</label>
                        <div class='input-group date' id='from'>
                            <input type='text' id="from" name="from" class="form-control" readonly />
                            <span class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span>
                        </div>
                        <br>
                        <label for="celular">Celular</label>
                        <input type='number' name="celular" id="celular" class="form-control" placeholder="3124567890"/>
                        <br>
                        <label for="class">Tipo servicio</label>
                        <select class="form-control" name="class" id="">
                            <option></option>
                            <option>corte de dama </option>
                            <option>corte de niños</option>
                            <option>corte de caballeros</option>
                            <option>pedicure</option>
                            <option>manicure</option>
                            <option>Depilacion con cera </option>
                            <option>Maquillaje</option>
                            <option>Trenza</option>
                            <option>peinado niñas </option>
                            <option>peinado damas </option>
                            <option>planchados</option>
                            <option>cepillado</option>
                            <option>Keratina </option>
                            <option>Tintes</option>
                            <option>semipermanentes</option>
                        </select>
                        <br>
                        <label for="nombre">Título</label>
                        <input type="text" required autocomplete="off" name="nombre" class="form-control" id="nombre" placeholder="Introduce un nombre">
                        <br>
                        <label for="body">nota</label>
                        <textarea id="body" name="event" required class="form-control" rows="3"></textarea>

                        <script type="text/javascript">
                            $(function() {
                                $('#from').datetimepicker({
                                    language: 'es',
                                    minDate: new Date()
                                });
                                $('#to').datetimepicker({
                                    language: 'es',
                                    minDate: new Date()
                                });

                            });
                        </script>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-dismiss="modal"><i class="fa fa-times"></i> Cancelar</button>
                    <button type="submit" class="btn btn-success"><i class="fa fa-check"></i> Agregar</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</body>

</html>
