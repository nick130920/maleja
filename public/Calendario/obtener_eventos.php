<?php



// Incluimos nuestro archivo config
include 'config.php';

// Sentencia sql para traer los agenda desde la base de datos
$sql = "SELECT * FROM agenda";

// Verificamos si existe un dato
if ($conexion->query($sql)->num_rows) {

    // creamos un array
    $datos = array();

    //guardamos en un array multidimensional todos los datos de la consulta
    $i = 0;

    // Ejecutamos nuestra sentencia sql
    $e = $conexion->query($sql);

    while ($row = $e->fetch_array()) // realizamos un ciclo while para traer los agenda encontrados en la base de dato
    {
        // Alimentamos el array con los datos de los agenda
        $datos[$i] = $row;
        $i++;
    }

    // Transformamos los datos encontrado en la BD al formato JSON
    echo json_encode(
        array(
            "success" => 1,
            "result" => $datos
        )
    );
} else {
    // Si no existen agenda mostramos este mensaje.
    echo "No hay datos";
}


?>
{"id":1,"start":"10\/07\/2021 12:36 PM","code":"z7pbco","phone_number":3103850396,"service_id":2,"title":"Bienvenida.","body":"dscdcscsd","url":"\/calendar\/10\/07\/2021 12:36 PMz7pbcoN132","user_id":2,"created_at":"2021-10-07T16:23:11.000000Z","updated_at":"2021-10-07T16:23:11.000000Z"},
{"id":2,"start":"10\/07\/2021 12:36 PM","code":"t71i3d","phone_number":3103850396,"service_id":2,"title":"Bienvenida.","body":"dscdcscsd","url":"\/calendar\/10\/07\/2021 12:36 PMt71i3dN132","user_id":2,"created_at":"2021-10-07T16:23:43.000000Z","updated_at":"2021-10-07T16:23:43.000000Z"},
{"id":3,"start":"10\/07\/2021 12:36 PM","code":"xyteqs","phone_number":3103850396,"service_id":4,"title":"Juntos por la sostenibilidad Ambiental y Social","body":"ladfka","url":"\/calendar\/xyteqs\/N13\/2","user_id":2,"created_at":"2021-10-21T15:25:37.000000Z","updated_at":"2021-10-21T15:25:37.000000Z"},
{"id":4,"start":"10\/22\/2021 9:45 PM","code":"vtbdto","phone_number":3103850396,"service_id":3,"title":"Pobreza y desigualdad escondida","body":"qwe\u0027dqdk\u0027","url":"\/calendar\/vtbdto\/N13\/2","user_id":2,"created_at":"2021-10-23T02:45:50.000000Z","updated_at":"2021-10-23T02:45:50.000000Z"},
{"id":5,"start":"10\/07\/2021 12:36 PM","code":"piwdqi","phone_number":3103850396,"service_id":1,"title":"Juntos por la sostenibilidad Ambiental y Social","body":"asxasx","url":"\/calendar\/piwdqi\/N13\/2","user_id":2,"created_at":"2021-11-04T04:38:58.000000Z","updated_at":"2021-11-04T04:38:58.000000Z"}];
