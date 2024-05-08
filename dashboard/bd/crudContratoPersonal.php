<?php
include_once '../../../loginBase/bd/conexion.php';
include_once 'funciones.php';
$objeto = new Conexion();
$conexion = $objeto->Conectar();




//recepcion de datos
$datos = json_decode(file_get_contents("php://input"), true);

error_log("Datos recibidos en copiaCrud.php (antes): " . print_r($datos, true));

switch ($datos['opcion']) {
    case 'añadirRelacionContratoPersonal':

        $idContrato = $datos['idContrato'];
        $idPersonal = $datos['idSubContratado'];
        $tipoPersonal = $datos['tipo'];


        try {
            //code...

            //insertamos los datos en la tabla personal_contrato
            $query = "INSERT INTO personal_contrato (idContrato, idPersonal, tipoPersonal) VALUES (:idContrato, :idPersonal, :tipoPersonal)";
            $resultado = $conexion->prepare($query);
            $resultado->execute(
                array(
                    ':idContrato' => $idContrato,
                    ':idPersonal' => $idPersonal,
                    ':tipoPersonal' => $tipoPersonal
                )
            );
            $message = 'Relación contrato-personal añadida correctamente';
        } catch (\Throwable $th) {
            $message = 'Error al añadir la relación contrato-personal' . $th->getMessage();
        }

        break;
    case 'eliminarRelacionContratoPersonal':
        $idContrato = $datos['idContrato'];
        $idPersonal = $datos['idPersonal'];

        try {
            //code...

            //eliminamos los datos en la tabla personal_contrato
            $query = "DELETE FROM personal_contrato WHERE idContrato = :idContrato AND idPersonal = :idPersonal";
            $resultado = $conexion->prepare($query);
            $resultado->execute(
                array(
                    ':idContrato' => $idContrato,
                    ':idPersonal' => $idPersonal
                )
            );
            $message = 'Relación contrato-personal eliminada correctamente';
        } catch (\Throwable $th) {
            $message = 'Error al eliminar la relación contrato-personal' . $th->getMessage();
        }

        break;
    case 'eliminarEmpresa':

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