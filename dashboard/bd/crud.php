<?php
include_once '../bd/conexion.php';
include_once 'funciones.php';
$objeto = new Conexion();
$conexion = $objeto->Conectar();
// Recepción de los datos enviados mediante POST desde el JS   

//Datos personales
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

//Datos medicos
$alergias = isset($_POST['alergias']) ? $_POST['alergias'] : '';
$enfermedadesCronicas = isset($_POST['enfermedadesCronicas']) ? $_POST['enfermedadesCronicas'] : '';
$lesiones = isset($_POST['lesiones']) ? $_POST['lesiones'] : '';
$alergiasMedicamentos = isset($_POST['alergiasMedicamentos']) ? $_POST['alergiasMedicamentos'] : '';
$numeroSeguro = isset($_POST['numeroSeguro']) ? $_POST['numeroSeguro'] : '';
$numeroEmergencia = isset($_POST['numeroEmergencia']) ? $_POST['numeroEmergencia'] : '';
$tipoSangre = isset($_POST['tipoSangre']) ? $_POST['tipoSangre'] : '';

//datos academicos
$cedula = isset($_POST['cedula']) ? $_POST['cedula'] : '';
$carrera = isset($_POST['carrera']) ? $_POST['carrera'] : '';
$expLaboral = isset($_POST['expLaboral']) ? $_POST['expLaboral'] : '';
$certificaciones = isset($_POST['certificaciones']) ? $_POST['certificaciones'] : '';
$gradoEstudio = isset($_POST['gradoEstudio']) ? $_POST['gradoEstudio'] : '';

// También puedes acceder a la variable 'id' y 'opcion' si las enviaste
$id = isset($_POST['id']) ? $_POST['id'] : '';
$opcion = isset($_POST['opcion']) ? $_POST['opcion'] : '';
$datosPost = $_POST;
/*foreach ($datosPost as $clave => $valor) {
    error_log("$clave: $valor");
}
*/
switch ($opcion) {
    case 1: //alta
        //verifica el formato de las fechas
        //compilamos los errores en caso de a ver en un solo string
        error_log("opcion 1");
        $errores = array();

        if (verificarFormatoFecha($fechaIngreso, 'Y-m-d')) {
            $errores[] = "La fecha de ingreso esta correcto";
        }else {
            $errores[] = "La fecha de ingreso no es valida";
        }
        if (verificarFormatoFecha($fechaNacimiento, 'Y-m-d')) {
            $errores[] = "La fecha de nacimiento no es valida";
        }else {
            $errores[] = "La fecha de nacimiento no es valida";
        }

        //verifica la longitud de las cadenas --Inicio
        if (verificarLongitudString($nombre, 50) == false) {
            $errores[] = "El nombre no es valido";

        }
        if (verificarLongitudString($curp, 18) == false) {
            $errores[] = "La curp no es valida";

        }
        if (verificarLongitudString($rfc, 13) == false) {
            $errores[] = "El rfc no es valido";

        }
        if (verificarLongitudString($numeroFijo, 10) == false) {
            $errores[] = "El numero fijo no es valido";

        }
        if (verificarLongitudString($numeroCelular, 10) == false) {
            $errores[] = "El numero celular no es valido";
        }
        if (verificarLongitudString($direccion, 100) == false) {
            $errores[] = "La direccion no es valida";

        }
        if (verificarLongitudString($numeroLicencia, 14) == false) {
            $errores[] = "El numero de licencia no es valido";

        }
        if (verificarLongitudString($numeroPasaporte, 9) == false) {
            $errores[] = "El numero de pasaporte no es valido";

        }



        // Loop through the errors
        foreach ($errores as $error) {
            // Do something with each error
            error_log($error);

        }



        //verifica la longitud de las cadenas --Fin
        //preparacion para la insercion
        $consulta = "INSERT INTO personas (nombre, fechaNacimiento, curp, rfc, numeroFijo, numeroCelular, direccion, numeroLicencia, numeroPasaporte, fechaIngreso) VALUES (:nombre, :fechaNacimiento, :curp, :rfc, :numeroFijo, :numeroCelular, :direccion, :numeroLicencia, :numeroPasaporte, :fechaIngreso)";
        $resultado = $conexion->prepare($consulta);

        //Ejecucion de la insercion con sus medidas de seguridad
        $resultado->bindParam(':nombre', $nombre);
        $resultado->bindParam(':fechaNacimiento', $fechaNacimiento);
        $resultado->bindParam(':curp', $curp);
        $resultado->bindParam(':rfc', $rfc);
        $resultado->bindParam(':numeroFijo', $numeroFijo);
        $resultado->bindParam(':numeroCelular', $numeroCelular);
        $resultado->bindParam(':direccion', $direccion);
        $resultado->bindParam(':numeroLicencia', $numeroLicencia);
        $resultado->bindParam(':numeroPasaporte', $numeroPasaporte);
        $resultado->bindParam(':fechaIngreso', $fechaIngreso);
        $resultado = $conexion->prepare($consulta);
        $resultado->execute();

        $consulta = "SELECT id, nombre, pais, edad FROM personas ORDER BY id DESC LIMIT 1";
        $resultado = $conexion->prepare($consulta);
        $resultado->execute();
        $data = $resultado->fetchAll(PDO::FETCH_ASSOC);
        break;
    case 2: //modificación
        error_log("opcion 2");
        $consulta = "UPDATE personas SET nombre='$nombre', pais='$pais', edad='$edad' WHERE id='$id' ";
        $resultado = $conexion->prepare($consulta);
        $resultado->execute();

        $consulta = "SELECT id, nombre, pais, edad FROM personas WHERE id='$id' ";
        $resultado = $conexion->prepare($consulta);
        $resultado->execute();
        $data = $resultado->fetchAll(PDO::FETCH_ASSOC);
        break;
    case 3: //baja
        error_log("opcion 3");
        $consulta = "DELETE FROM personas WHERE id='$id' ";
        $resultado = $conexion->prepare($consulta);
        $resultado->execute();
        break;
    case 4:
        error_log("opcion 4");
}

print json_encode($data, JSON_UNESCAPED_UNICODE); //enviar el array final en formato json a JS
$conexion = NULL;
