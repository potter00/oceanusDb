<?php
include_once '../bd/conexion.php';
$objeto = new Conexion();
$conexion = $objeto->Conectar();
// Recepción de los datos enviados mediante POST desde el JS   

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
$datosPost = $_POST;
foreach ($datosPost as $clave => $valor) {
    error_log( "$clave: $valor");
}

switch ($opcion) {
    case 1: //alta
        $consulta = sprintf("INSERT INTO personas (nombre, fechaNacimiento, curp, rfc, numeroFijo, numeroCelular, direccion, numeroLicencia, numeroPasaporte, fechaIngreso) VALUES ('%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s')",
                mysqli_real_escape_string($conexion,$nombre),
            );
        $consulta = "INSERT INTO personas (nombre, fechaNacimiento, curp, rfc, numeroFijo, numeroCelular, direccion, numeroLicencia, numeroPasaporte, fechaIngreso) VALUES ('$nombre', '$fechaNacimiento', '$curp', '$rfc', '$numeroFijo', '$numeroCelular', '$direccion', '$numeroLicencia', '$numeroPasaporte', '$fechaIngreso')";
        $resultado = $conexion->prepare($consulta);
        $resultado->execute();

        $consulta = "SELECT id, nombre, pais, edad FROM personas ORDER BY id DESC LIMIT 1";
        $resultado = $conexion->prepare($consulta);
        $resultado->execute();
        $data = $resultado->fetchAll(PDO::FETCH_ASSOC);
        break;
    case 2: //modificación
        $consulta = "UPDATE personas SET nombre='$nombre', pais='$pais', edad='$edad' WHERE id='$id' ";
        $resultado = $conexion->prepare($consulta);
        $resultado->execute();

        $consulta = "SELECT id, nombre, pais, edad FROM personas WHERE id='$id' ";
        $resultado = $conexion->prepare($consulta);
        $resultado->execute();
        $data = $resultado->fetchAll(PDO::FETCH_ASSOC);
        break;
    case 3: //baja
        $consulta = "DELETE FROM personas WHERE id='$id' ";
        $resultado = $conexion->prepare($consulta);
        $resultado->execute();
        break;
    case 4:
        error_log("Los datos son/n");
        error_log($nombre);
        error_log($fechaNacimiento);
        error_log("fin de los datos/n");
}

print json_encode($data, JSON_UNESCAPED_UNICODE); //enviar el array final en formato json a JS
$conexion = NULL;
