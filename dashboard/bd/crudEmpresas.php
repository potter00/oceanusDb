<?php
include_once '../../../loginBase/bd/conexion.php';
include_once 'funciones.php';
$objeto = new Conexion();
$conexion = $objeto->Conectar();




//recepcion de datos
$datos = json_decode(file_get_contents("php://input"), true);

//error_log("Datos recibidos en copiaCrud.php (antes): " . print_r($datos, true));

switch ($datos['opcion']) {
    case 'añadirEmpresa':
        $razonSocial = "sin definir";
        $rfc = "sin definir";
        $tipoRegimen = "sin definir";
        $representanteLegal = "sin definir";
        $correo = "sin definir";
        $telefono = "sin definir";
        $logo = "sin definir";

        try {
            //code...

            //preparacion para la insercion
            $consulta = "INSERT INTO empresa (razonSocial, rfc, tipoRegimen, representanteLegal, correo, telefono, logo) VALUES (:razonSocial, :rfc, :tipoRegimen, :representanteLegal, :correo, :telefono, :logo)";
            $resultado = $conexion->prepare($consulta);
            $resultado->execute(
                array(
                    ":razonSocial" => $razonSocial,
                    ":rfc" => $rfc,
                    ":tipoRegimen" => $tipoRegimen,
                    ":representanteLegal" => $representanteLegal,
                    ":correo" => $correo,
                    ":telefono" => $telefono,
                    ":logo" => $logo
                )
            );

            $id = $conexion->lastInsertId();
            $datos['id'] = $id;
            $message = "Empresa añadida correctamente";
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
    case 'editarEmpresa':
        $id = $datos['id'];
        $razonSocial = $datos['razonSocial'];
        $rfc = $datos['rfc'];
        $tipoRegimen = $datos['tipoRegimen'];
        $representanteLegal = $datos['representanteLegal'];
        $correo = $datos['correo'];
        $telefono = $datos['telefono'];
        $logo = $datos['logo'];
        error_log("Datos recibidos en copiaCrud.php (despues): " . print_r($datos, true));

        try {
            //code...

            //preparacion para la insercion
            $consulta = "UPDATE empresa SET razonSocial = :razonSocial, rfc = :rfc, tipoRegimen = :tipoRegimen, representanteLegal = :representanteLegal, correo = :correo, telefono = :telefono, logo = :logo WHERE idEmpresa = :id";
            $resultado = $conexion->prepare($consulta);
            
            $resultado->bindParam(':razonSocial', $razonSocial, PDO::PARAM_STR);
            $resultado->bindParam(':rfc', $rfc, PDO::PARAM_STR);
            $resultado->bindParam(':tipoRegimen', $tipoRegimen, PDO::PARAM_STR);
            $resultado->bindParam(':representanteLegal', $representanteLegal, PDO::PARAM_STR);
            $resultado->bindParam(':correo', $correo, PDO::PARAM_STR);
            $resultado->bindParam(':telefono', $telefono, PDO::PARAM_STR);
            $resultado->bindParam(':logo', $logo, PDO::PARAM_STR);
            $resultado->bindParam(':id', $id, PDO::PARAM_INT);
            
            $resultado->execute();



            $message = "Empresa editada correctamente";
        } catch (PDOException $e) {
            $message = 'Error al procesar los datos: ' . $e->getMessage();
            if (isset($errores)) {
                $errores[] = $message;
            } else {
                $errores = array($message);
            }
        }

        # code...
        break;
    case 'eliminarEmpresa':
        $id = $datos['id'];
        try {
            //code...

            //preparacion para la insercion
            $consulta = "DELETE FROM empresas WHERE id = :id";
            $resultado = $conexion->prepare($consulta);
            $resultado->execute(
                array(
                    ":id" => $id
                )
            );


            $message = "Empresa eliminada correctamente";
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