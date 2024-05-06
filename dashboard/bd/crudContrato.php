<?php
include_once '../../../loginBase/bd/conexion.php';
include_once 'funciones.php';
include_once 'funcionesdb.php';
$objeto = new Conexion();
$conexion = $objeto->Conectar();




//recepcion de datos
$datos = json_decode(file_get_contents("php://input"), true);

error_log("Datos recibidos en copiaCrud.php (antes): " . print_r($datos, true));

switch ($datos['opcion']) {
    case 'añadirPersonal':


        # code...
        break;
    case 'editarContrato':
        //actualizamos los datos de la tabla contrato
        try {
            //code...

            $query = "UPDATE contrato SET titulo = :titulo, nombreContrato = :nombreContrato, idContratante = :idContratante, idContratado = :idContratado, subContrato = :subContrato, idContratoFuente = :idContratoFuente, numeroContrato = :numeroContrato, inicioContrato = :inicioContrato, finContrato = :finContrato, idConvenio = :idConvenio, montoContrato = :montoContrato, anticipoContrato = :anticipoContrato WHERE idContrato = :idContrato";
            $resultado = $conexion->prepare($query);
            $resultado->bindParam(':titulo', $datos['titulo'], PDO::PARAM_STR);
            $resultado->bindParam(':nombreContrato', $datos['nombreContrato'], PDO::PARAM_STR);
            $resultado->bindParam(':idContratante', $datos['contratante'], PDO::PARAM_INT);
            $resultado->bindParam(':idContratado', $datos['contratado'], PDO::PARAM_INT);
            $resultado->bindParam(':subContrato', $datos['tipoContrato'], PDO::PARAM_STR);
            $resultado->bindParam(':idContratoFuente', $datos['contratoFuente'], PDO::PARAM_INT);
            $resultado->bindParam(':numeroContrato', $datos['numero'], PDO::PARAM_STR);
            $resultado->bindParam(':inicioContrato', $datos['fechaInicio'], PDO::PARAM_STR);
            $resultado->bindParam(':finContrato', $datos['fechaFin'], PDO::PARAM_STR);
            $resultado->bindParam(':idConvenio', $datos['convenio'], PDO::PARAM_INT);
            $resultado->bindParam(':montoContrato', $datos['monto'], PDO::PARAM_STR);
            $resultado->bindParam(':anticipoContrato', $datos['anticipo'], PDO::PARAM_STR);
            $resultado->bindParam(':idContrato', $datos['idContrato'], PDO::PARAM_INT);
            $resultado->execute();
        } catch (\Throwable $th) {
            $message = 'Error al actualizar contrato:' . $th->getMessage();
            error_log($message);
            if (isset($errores)) {
                $errores[] = $message;
            } else {
                $errores = array($message);
            }
        }

        $fianzas =  obtenerFianzaContrato($datos['idContrato'], $conexion);

        //actualizamos los datos de la tabla fianza_cumplimiento
        try {
            //code...

            $query = "UPDATE fianza_cumplimiento SET fianzaCumplimientoMonto = :montoFianza, fianzaCumplimientoInicio = :fechaInicio, fianzaCumplimientoFin = :fechaFin, fianzaCumplimientoPoliza = :poliza, fianzaCumplimientoAseguradora = :aseguradora WHERE idFianzaCumplimiento = :idFianzaCumplimiento";
            $resultado = $conexion->prepare($query);
            $resultado->bindParam(':montoFianza', $datos['fianzaCumplimiento']['monto'], PDO::PARAM_STR);
            $resultado->bindParam(':fechaInicio', $datos['fianzaCumplimiento']['inicio'], PDO::PARAM_STR);
            $resultado->bindParam(':fechaFin', $datos['fianzaCumplimiento']['fin'], PDO::PARAM_STR);
            $resultado->bindParam(':idFianzaCumplimiento', $fianzas['fianzaCumplimiento']['idFianzaCumplimiento'], PDO::PARAM_INT);
            $resultado->bindParam(':poliza', $datos['fianzaCumplimiento']['poliza'], PDO::PARAM_STR);
            $resultado->bindParam(':aseguradora', $datos['fianzaCumplimiento']['aseguradora'], PDO::PARAM_STR);

            $resultado->execute();
        } catch (\Throwable $th) {
            $message = 'Error al actualizar fianza de cumplimiento:' . $th->getMessage();
            if (isset($errores)) {
                $errores[] = $message;
            } else {
                $errores = array($message);
            }
        }
        
        $message = 'Contrato actualizado correctamente';
        # code...
        break;
    case 'eliminarPersonal':

        # code...
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