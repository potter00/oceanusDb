<?php
include_once '../bd/conexion.php';
include_once 'funciones.php';
$objeto = new Conexion();
$conexion = $objeto->Conectar();
error_log("dentro de crud.php");


// Recepción de los datos enviados mediante POST desde el JS
$datos = json_decode(file_get_contents("php://input"), true);


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



switch ($datos['opcion']) {
    case 1: //alta
        //recopilamos los datos necesarios para la operacion
        //Datos personales
        $nombre = $datos['nombre'];
        $fechaNacimiento = $datos['fechaNacimiento'];
        $curp = $datos['curp'];
        $rfc = $datos['rfc'];
        $numeroFijo = $datos['numeroFijo'];
        $numeroCelular = $datos['numeroCelular'];
        $direccion = $datos['direccion'];
        $numeroLicencia = $datos['numeroLicencia'];
        $numeroPasaporte = $datos['numeroPasaporte'];
        $fechaIngreso = $datos['fechaIngreso'];

        //verifica el formato de las fechas
        //compilamos los errores en caso de a ver en un solo string
        error_log("opcion 1");
        $errores = array();

        if (verificarFormatoFecha($fechaIngreso, 'Y-m-d')) {
            error_log("La fecha de ingreso es valida");
        } else {
            $errores[] = "La fecha de ingreso no es valida";
        }
        if (verificarFormatoFecha($fechaNacimiento, 'Y-m-d')) {
            error_log("La fecha de nacimiento es valida");
        } else {
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



        if ($errores == null) {
            error_log("No hay errores");

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
            
            header('Content-Type: application/json');
            $response = array(
                'success' => true,
                'message' => 'Datos procesados con exito',
                'data' => $datos // Puedes incluir datos adicionales si es necesario
            );
            break;
        }else{
            header('Content-Type: application/json');
            $response = array(
                'success' => false,
                'message' => 'Datos no procesados',
                'data' => $datos // Puedes incluir datos adicionales si es necesario
            );
            break;
        }


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

// Devuelve una respuesta de éxito


$conexion = NULL;
