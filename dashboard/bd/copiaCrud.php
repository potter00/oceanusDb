<?php
include_once '../bd/conexion.php';
include_once 'funciones.php';
$objeto = new Conexion();
$conexion = $objeto->Conectar();




//recepcion de datos
$datos = json_decode(file_get_contents("php://input"), true);


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
        
        break;

    default:
        # code...
        break;
}

// Devuelve una respuesta de éxito
header('Content-Type: application/json');
$response = array(
    'success' => true,
    'message' => $message,
    'data' => $datos // Puedes incluir datos adicionales si es necesario
);
error_log("Datos recibidos en copiaCrud.php (después): " . print_r($response, true));
echo json_encode($response);
?>