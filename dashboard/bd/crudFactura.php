<?php
include_once '../../../loginBase/bd/conexion.php';
include_once 'funciones.php';
$objeto = new Conexion();
$conexion = $objeto->Conectar();




//recepcion de datos
$datos = json_decode(file_get_contents("php://input"), true);

error_log("Datos recibidos en crudFactura.php (antes): " . print_r($datos, true));

switch ($datos['opcion']) {
    case 'añadirFactura':

        //insertamos una factura vacia en la base de datos en la tabla factura y obtenemos el id
        $titulo = "sin definir";
        try {
            //code...

            $query = "INSERT INTO factura (titulo) VALUES (:titulo)";
            $resultado = $conexion->prepare($query);
            $resultado->execute(
                array(
                    ':titulo' => $titulo
                )
            );


            $id = $conexion->lastInsertId();
            $datos['id'] = $id;
            $message = "Factura añadida correctamente";
        } catch (\Throwable $th) {
            $message = 'Error al procesar los datos: ' . $th->getMessage();
            if (isset($errores)) {
                $errores[] = $message;
            } else {
                $errores = array($message);
            }
        }


        # code...
        break;
    case 'editarFactura':

        $id = $datos['idFactura'];
        $titulo = $datos['titulo'];
        $fecha = $datos['fecha'];
        $importe = $datos['importe'];
        $idContrato = $datos['idContrato'];
        $idEmpresa = $datos['idEmpresa'];
        $numero = $datos['numero'];

        error_log($id);
        error_log($titulo);
        error_log($fecha);
        error_log($importe);
        error_log($idContrato);
        error_log($idEmpresa);
        error_log($numero);


        try {
            //code...

            //actualizamos los datos en la tabla factura
            $query = "UPDATE factura SET titulo = :titulo, fecha = :fecha, importe = :importe, idContrato = :idContrato, idEmpresa = :idEmpresa, numero = :numero WHERE idFactura = :id";
            $resultado = $conexion->prepare($query);
            $resultado->execute(
                array(
                    ':titulo' => $titulo,
                    ':fecha' => $fecha,
                    ':importe' => $importe,
                    ':idContrato' => $idContrato,
                    ':idEmpresa' => $idEmpresa,
                    ':id' => $id,
                    ':numero' => $numero
                )
            );
            $message = 'Factura actualizada correctamente';
        } catch (\Throwable $th) {
            $message = 'Error al actualizar la factura' . $th->getMessage();
            error_log($message);
            if (isset($errores)) {
                $errores[] = $message;
            } else {
                $errores = array($message);
            }
        }



        break;
    case 'eliminarFactura':
        # code...

        $id = $datos['idFactura'];

        try {
            //code...

            //eliminamos los datos en la tabla factura
            $query = "DELETE FROM factura WHERE idFactura = :id";
            $resultado = $conexion->prepare($query);
            $resultado->execute(
                array(
                    ':id' => $id
                )
            );
            $message = 'Factura eliminada correctamente';
        } catch (\Throwable $th) {
            $message = 'Error al eliminar la factura' . $th->getMessage();
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

error_log("Datos recibidos en crudFactura.php (despues): " . print_r($datos, true));


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