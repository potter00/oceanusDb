<?php
// Verifica si se ha recibido una solicitud POST
error_log("en funciones");
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    error_log("en post");
    // Recoge las variables del formulario
    $nombre = isset($_POST['nombre']) ? $_POST['nombre'] : '';
    $fechaNacimiento = isset($_POST['fechaNacimiento']) ? $_POST['fechaNacimiento'] : '';
    $curp = isset($_POST['curp']) ? $_POST['curp'] : '';
    $rfc = isset($_POST['rfc']) ? $_POST['rfc'] : '';
    $numeroFijo = isset($_POST['numeroFijo']) ? $_POST['numeroFijo'] : '';
    $numeroCelular = isset($_POST['numeroCelular']) ? $_POST['numeroCelular'] : '';
    $direccion = isset($_POST['direccion']) ? $_POST['direccion'] : '';
    $numeroLicencia = isset($_POST['numeroLicencia']) ? $_POST['numeroLicencia'] : '';
    $numeroPasaporte = isset($_POST['numeroPasaporte']) ? $_POST['numeroPasaporte'] : '';
    $fechaIngreso = isset($_POST['fechaIngreso']) ? $_POST['fechaIngreso'] : '';

    // También puedes acceder a la variable 'id' y 'opcion' si las enviaste
    $id = isset($_POST['id']) ? $_POST['id'] : '';
    $opcion = isset($_POST['opcion']) ? $_POST['opcion'] : '';

    // Ahora puedes realizar operaciones con estas variables, como insertar en la base de datos, actualizar, etc.

    // Ejemplo de inserción en una base de datos (ajusta según tu estructura de base de datos)
    // $conexion = new mysqli("tu_servidor", "tu_usuario", "tu_contraseña", "tu_base_de_datos");
    // $sql = "INSERT INTO tu_tabla (nombre, fechaNacimiento, curp, rfc, numeroFijo, numeroCelular, direccion, numeroLicencia, numeroPasaporte, fechaIngreso) VALUES ('$nombre', '$fechaNacimiento', '$curp', '$rfc', '$numeroFijo', '$numeroCelular', '$direccion', '$numeroLicencia', '$numeroPasaporte', '$fechaIngreso')";
    // $conexion->query($sql);
    
    // Puedes imprimir un mensaje de éxito o cualquier otra respuesta que desees
    $respuesta = array('mensaje' => 'Datos recibidos y procesados correctamente');
    echo json_encode($respuesta);
    error_log(print_r($respuesta));
   
    
} else {
    // Si la solicitud no es POST, puedes manejarlo según tus necesidades
    // Por ejemplo, podrías imprimir un mensaje de error o redirigir al usuario
    $respuesta = array('mensaje' => 'Error: La solicitud no es de tipo POST');
    echo json_encode($respuesta);
    error_log(print_r($respuesta));
}

