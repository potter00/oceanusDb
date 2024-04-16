<?php
include_once '../../../loginBase/bd/conexion.php';
include_once 'funciones.php';
$objeto = new Conexion();
$conexion = $objeto->Conectar();




//recepcion de datos
$datos = json_decode(file_get_contents("php://input"), true);

//error_log("Datos recibidos en copiaCrud.php (antes): " . print_r($datos, true));

switch ($datos['opcion']) {
    case 'añadirPersonal':
        $nombre = "sin definir";
        $rfc = "sin definir";
        $inss = "sin definir";
        $ine = "sin definir";
        $curp = "sin definir";
        $estado = "activo";
        try {
            //code...

            $consulta = "INSERT INTO subcontratados (nombre, rfc, inss, ine, curp, estado) VALUES (:nombre, :rfc, :inss, :ine, :curp, :estado)";
            $resultado = $conexion->prepare($consulta);
            $resultado->execute(
                array(
                    ":nombre" => $nombre,
                    ":rfc" => $rfc,
                    ":inss" => $inss,
                    ":ine" => $ine,
                    ":curp" => $curp,
                    ":estado" => $estado
                )
            );

            $id = $conexion->lastInsertId();
            $datos['idSubContratado'] = $id;
            $message = "SubContratado añadido correctamente";
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
    case 'editarPersonal':
        $id = $datos['idSubContratado'];
        $nombre = $datos['nombre'];
        $rfc = $datos['rfc'];
        $inss = $datos['inss'];
        $ine = $datos['ine'];
        $curp = $datos['curp'];
        $estado = $datos['estado'];
        try {
            //code...

            //preparacion para la insercion
            $consulta = "UPDATE subcontratados SET nombre = :nombre, rfc = :rfc, inss = :inss, ine = :ine, curp = :curp, estado = :estado WHERE idSubContratado = :id";
            $resultado = $conexion->prepare($consulta);
            $resultado->execute(
                array(
                    ":nombre" => $nombre,
                    ":rfc" => $rfc,
                    ":inss" => $inss,
                    ":ine" => $ine,
                    ":curp" => $curp,
                    ":estado" => $estado,
                    ":id" => $id
                )
            );

            $message = "SubContratado editado correctamente";
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
    case 'eliminarPersonal':
        $id = $datos['idSubContratado'];
        try {
            //code...

            //preparacion para la insercion
            $consulta = "DELETE FROM subcontratados WHERE idSubContratado = :id";
            $resultado = $conexion->prepare($consulta);
            $resultado->execute(
                array(
                    ":id" => $id
                )
            );

            $message = "SubContratado eliminado correctamente";
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