<?php
include_once '../bd/conexion.php';
include_once 'funciones.php';
$objeto = new Conexion();
$conexion = $objeto->Conectar();




//recepcion de datos
$datos = json_decode(file_get_contents("php://input"), true);
error_log("Datos recibidos en copiaCrud.php (antes): " . print_r($datos, true));

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

        //Datos medicos
        $alergias = $datos['alergias'];
        $enfermedadesCronicas = $datos['enfermedadesCronicas'];
        $lesiones = $datos['lesiones'];
        $alergiasMedicamentos = $datos['alergiasMedicamentos'];
        $numeroSeguro = $datos['numeroSeguro'];
        $numeroEmergencia = $datos['numeroEmergencia'];
        $tipoSangre = $datos['tipoSangre'];

        //datos academicos
        $cedula = $datos['cedula'];
        $carrera = $datos['carrera'];
        $expLaboral = $datos['expLaboral'];
        $certificaciones = $datos['certificaciones'];
        $gradoEstudios = $datos['gradoEstudios'];
        //verificamos que los datos sean validos --inicio


        //Verificamos que el nombre sea valido
        if (!preg_match("/^[a-zA-Z-' ]*$/", $nombre) || strlen($nombre) < 3 || strlen($nombre) > 50) {
            $message = 'El nombre no es valido';
            if (isset($errores)) {
                $errores[] = $message;
            } else {
                $errores = array($message);
            }
        }
        //Verificamos que la fecha de nacimiento sea valida
        if (!verificarFormatoFecha($fechaNacimiento, 'Y-m-d')) {
            $message = 'La fecha de nacimiento no es valida';
            if (isset($errores)) {
                $errores[] = $message;
            } else {
                $errores = array($message);
            }
        }
        //Verificamos que la curp sea valida
        if (!verificarLongitudString($curp, 18)) {
            $message = 'La curp no es valida';
            if (isset($errores)) {
                $errores[] = $message;
            } else {
                $errores = array($message);
            }
        }
        //Verificamos que el rfc sea valido
        if (!verificarLongitudString($rfc, 13)) {
            $message = 'El rfc no es valido';
            if (isset($errores)) {
                $errores[] = $message;
            } else {
                $errores = array($message);
            }
        }
        //Verificamos que el numero celular sea valido
        if (!verificarLongitudString($numeroCelular, 10)) {
            $message = 'El numero celular no es valido';
            if (isset($errores)) {
                $errores[] = $message;
            } else {
                $errores = array($message);
            }
        }
        //Verificamos que la direccion sea valida
        if (strlen($direccion) < 10) {
            $message = 'La direccion no es valida';
            if (isset($errores)) {
                $errores[] = $message;
            } else {
                $errores = array($message);
            }
        }
        //verificamos que la fecha de ingreso sea valida
        if (!verificarFormatoFecha($fechaIngreso, 'Y-m-d')) {
            $message = 'La fecha de ingreso no es valida';
            if (isset($errores)) {
                $errores[] = $message;
            } else {
                $errores = array($message);
            }
        }

        //verificamos numero de seguro
        if (!verificarLongitudString($numeroSeguro, 11)) {
            $message = 'El numero de seguro no es valido';
            if (isset($errores)) {
                $errores[] = $message;
            } else {
                $errores = array($message);
            }
        }
        //verificamos numero de emergencia
        if (!verificarLongitudString($numeroEmergencia, 10)) {
            $message = 'El numero de emergencia no es valido';
            if (isset($errores)) {
                $errores[] = $message;
            } else {
                $errores = array($message);
            }
        }
        //verificamos tipo de sangre

        if (!verificarTipoSangre($tipoSangre)) {
            $message = 'El tipo de sangre no es valido';
            if (isset($errores)) {
                $errores[] = $message;
            } else {
                $errores = array($message);
            }
        }

        //verificamos cedula
        if (strlen($cedula) < 7 || strlen($cedula) > 8) {
            $message = 'La cedula no es valida';
            if (isset($errores)) {
                $errores[] = $message;
            } else {
                $errores = array($message);
            }
        }

        //verificamos carrera
        if (strlen($carrera) === "NA" || strlen($carrera) < 5 || strlen($carrera) > 50) {
            $message = 'La carrera no es valida';
            if (isset($errores)) {
                $errores[] = $message;
            } else {
                $errores = array($message);
            }
        }
        //verificamos grado de estudios
        if (strlen($gradoEstudios) === "NA" || strlen($gradoEstudios) < 5 || strlen($gradoEstudios) > 50) {
            $message = 'El grado de estudios no es valido';
            if (isset($errores)) {
                $errores[] = $message;
            } else {
                $errores = array($message);
            }
        }
        if (isset($errores)) {
            $message = 'Uno o mas campos no son validos';

        } else {
            # code...


            //preparacion para la insercion
            $consulta = "INSERT INTO personas (nombre, fechaNacimiento, curp, rfc, numeroFijo, numeroCelular, direccion, numeroLicencia, numeroPasaporte, fechaIngreso) VALUES (:nombre, :fechaNacimiento, :curp, :rfc, :numeroFijo, :numeroCelular, :direccion, :numeroLicencia, :numeroPasaporte, :fechaIngreso)";
            $resultado = $conexion->prepare($consulta);

            try {
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
                $resultado->execute();

                $message = 'Datos procesados con exito';
            } catch (PDOException $e) {
                $message = 'Error al procesar los datos: ' . $e->getMessage();
            }

            //un vez los datos insertados buscamos el id del ultimo registro
            try {
                $consulta = "SELECT MAX(id) AS ultima_id FROM personas";
                $resultado = $conexion->prepare($consulta);
                $resultado->execute();


            } catch (PDOException $e) {
                $message = 'Error al ejecutar la consulta buscar por id: ' . $e->getMessage();
            }
            $data = $resultado->fetchAll(PDO::FETCH_ASSOC);
            $ultimaId = $data[0]['ultima_id'];


            //insersion datos medicos
            $consulta = "INSERT INTO datosmedicos (idEmpleado, Alergias, EnfermedadesCronicas, Lesiones, AlergiasMedicamentos, NumeroSeguro, NumeroEmergencia, TipoSangre) VALUES (:idEmpleado, :alergias, :enfermedadesCronicas, :lesiones, :alergiasMedicamentos, :numeroSeguro, :numeroEmergencia, :tipoSangre)";
            $resultado = $conexion->prepare($consulta);
            try {
                //Ejecucion de la insercion con sus medidas de seguridad
                $resultado->bindParam(':idEmpleado', $ultimaId);
                $resultado->bindParam(':alergias', $alergias);
                $resultado->bindParam(':enfermedadesCronicas', $enfermedadesCronicas);
                $resultado->bindParam(':lesiones', $lesiones);
                $resultado->bindParam(':alergiasMedicamentos', $alergiasMedicamentos);
                $resultado->bindParam(':numeroSeguro', $numeroSeguro);
                $resultado->bindParam(':numeroEmergencia', $numeroEmergencia);
                $resultado->bindParam(':tipoSangre', $tipoSangre);
                $resultado->execute();

                $message = 'Datos procesados con exito';
            } catch (PDOException $e) {
                $message = 'Error al procesar los datos: ' . $e->getMessage();
            }

            //insersion datos academicos
            $consulta = "INSERT INTO formacademica (idEmpleado, Cedula, Carrera, ExpLaboral, Certificaciones, GradoEstudios) VALUES (:idEmpleado, :cedula, :carrera, :expLaboral, :certificaciones, :gradoEstudio)";
            $resultado = $conexion->prepare($consulta);
            try {
                //Ejecucion de la insercion con sus medidas de seguridad
                $resultado->bindParam(':idEmpleado', $ultimaId);
                $resultado->bindParam(':cedula', $cedula);
                $resultado->bindParam(':carrera', $carrera);
                $resultado->bindParam(':expLaboral', $expLaboral);
                $resultado->bindParam(':certificaciones', $certificaciones);
                $resultado->bindParam(':gradoEstudio', $gradoEstudios);
                $resultado->execute();

                $message = 'Datos procesados con exito';
            } catch (PDOException $e) {
                $message = 'Error al procesar los datos: ' . $e->getMessage();

            }

            //fin de la insercion
        }
        break;
    case 2: //borrado
        # code...
        $id = $datos['id'];
        
        //Eliminacion datos personales

        try {
            $consulta = "DELETE FROM personas WHERE id = :id";
            $resultado = $conexion->prepare($consulta);
            $resultado->bindParam(':id', $id);
            $resultado->execute();
            $message = 'Datos eliminados con exito';
        } catch (PDOException $e) {
            $message = 'Error al eliminar los datos: ' . $e->getMessage();
            if (isset($errores)) {
                $errores[] = $message;
            } else {
                $errores = array($message);
            }
        }

        //Eliminacion datos medicos
        try {
            $consulta = "DELETE FROM datosmedicos WHERE idEmpleado = :id";
            $resultado = $conexion->prepare($consulta);
            $resultado->bindParam(':id', $id);
            $resultado->execute();
            $message = 'Datos eliminados con exito';
        } catch (PDOException $e) {
            $message = 'Error al eliminar los datos: ' . $e->getMessage();
            if (isset($errores)) {
                $errores[] = $message;
            } else {
                $errores = array($message);
            }
        }

        //Eliminacion datos academicos
        try {
            $consulta = "DELETE FROM formacademica WHERE idEmpleado = :id";
            $resultado = $conexion->prepare($consulta);
            $resultado->bindParam(':id', $id);
            $resultado->execute();
            $message = 'Datos eliminados con exito';
        } catch (PDOException $e) {
            $message = 'Error al eliminar los datos: ' . $e->getMessage();
            if (isset($errores)) {
                $errores[] = $message;
            } else {
                $errores = array($message);
            }

        }
        break;
    default:
        $message = 'Opcion no valida';
        break;
}

// Devuelve una respuesta de éxito
header('Content-Type: application/json');
//si algo salio mal, se manda el error y los datos
if (isset($errores)) {
    $response = array(
        'success' => true,
        'message' => $message,
        'data' => $datos,
        'errores' => $errores // Puedes incluir datos adicionales si es necesario
    );
} else {
    $response = array(
        'success' => false,
        'message' => $message,
        'data' => $datos
    );
}
error_log("Datos recibidos en copiaCrud.php (después): " . print_r($response, true));
echo json_encode($response);
$conexion = NULL;
?>