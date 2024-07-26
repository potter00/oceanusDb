<?php
include_once '../../../loginBase/bd/conexion.php';
include_once 'funciones.php';
$objeto = new Conexion();
$conexion = $objeto->Conectar();




//recepcion de datos
$datos = json_decode(file_get_contents("php://input"), true);

error_log("Datos recibidos en crudConvenio.php (antes): " . print_r($datos, true));

switch ($datos['opcion']) {
    case 'crearConvenio':
        try {

            $query = "INSERT INTO convenio (fechaInicio, fechaFinal, montoAdicional) VALUES (:fechaInicio, :fechaFin, :montoAdicional)";
            $resultado = $conexion->prepare($query);
            $resultado->bindParam(':fechaInicio', $datos['fechaInicio'], PDO::PARAM_STR);
            $resultado->bindParam(':fechaFin', $datos['fechaFin'], PDO::PARAM_STR);
            $resultado->bindParam(':montoAdicional', $datos['montoAdicional'], PDO::PARAM_STR);
            $resultado->execute();
            $message = 'Convenio creado correctamente';

            //optenemos el id del convenio creado
            $query = "SELECT MAX(idConvenio) as idConvenio FROM convenio";
            $resultado = $conexion->prepare($query);
            $resultado->execute();
            $idConvenio = $resultado->fetch(PDO::FETCH_ASSOC);
            $idConvenio = $idConvenio['idConvenio'];

            //creamos la relacion con el contrato en la tabla contrato_convenio
            $query = "INSERT INTO contrato_convenio (idContrato, idConvenio) VALUES (:idContrato, :idConvenio)";
            $resultado = $conexion->prepare($query);
            $resultado->bindParam(':idContrato', $datos['idContrato'], PDO::PARAM_INT);
            $resultado->bindParam(':idConvenio', $idConvenio, PDO::PARAM_INT);
            $resultado->execute();
            $message = 'Convenio creado correctamente';




        } catch (\Throwable $th) {
            $message = 'Error al crear el convenio' . $th->getMessage();
            if (isset($errores)) {
                $errores[] = $message;
            } else {
                $errores = array($message);
            }
        }

        break;
    case 'eliminarConvenio';
        try {
            $query = "DELETE FROM convenio WHERE idConvenio = :idConvenio";
            $resultado = $conexion->prepare($query);
            $resultado->bindParam(':idConvenio', $datos['idConvenio'], PDO::PARAM_INT);
            $resultado->execute();
            $message = 'Convenio eliminado correctamente';
        } catch (\Throwable $th) {
            $message = 'Error al eliminar el convenio' . $th->getMessage();
            if (isset($errores)) {
                $errores[] = $message;
            } else {
                $errores = array($message);
            }
        }
        //borramos la relacion convenio contrato
        try {
            $query = "DELETE FROM contrato_convenio WHERE idConvenio = :idConvenio";
            $resultado = $conexion->prepare($query);
            $resultado->bindParam(':idConvenio', $datos['idConvenio'], PDO::PARAM_INT);
            $resultado->execute();
            $message = 'Convenio eliminado correctamente';
        } catch (\Throwable $th) {
            $message = 'Error al eliminar el convenio' . $th->getMessage();
            if (isset($errores)) {
                $errores[] = $message;
            } else {
                $errores = array($message);
            }
        }
        break;

    default:
        $message = 'Opción no válida';
        if (isset($errores)) {
            $errores[] = $message;
        } else {
            $errores = array($message);
        }
        break;
}

// Devuelve una respuesta de éxito
header('Content-Type: application/json');
//si algo salio mal, se manda el error y los datos
if (isset($errores)) {
    $response = array(
        'success' => false,
        'message' => $message,
        'data' => $datos,
        'errores' => $errores // Puedes incluir datos adicionales si es necesario
    );
} else {
    $response = array(
        'success' => true,
        'message' => $message,
        'data' => $datos
    );
}

echo json_encode($response);
$conexion = NULL;
?>