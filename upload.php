<?php

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $opcion = $_POST['opcion'];
    switch ($opcion) {
        case 1:
            $id = $_POST['id'];
            $nombre = $_POST['nombre'];
            $tipoDocumento = $_POST['tipoDocumento'];

            // Carpeta donde se guardarán los archivos (asegúrate de tener permisos de escritura)
            $carpetaBase = 'archivos/';
            $carpetaDestino = $carpetaBase . $id . '/';

            // Crear la carpeta si no existe
            if (!file_exists($carpetaDestino)) {
                mkdir($carpetaDestino, 0777, true);
            }

            // Obtener el nombre original del archivo
            $nombreArchivo = basename($_FILES['archivo']['name']);

            $extension = pathinfo($nombreArchivo, PATHINFO_EXTENSION); // Obtiene la extensión del archivo
            if ($extension == 'pdf') {
                # code...

                // Construir la ruta completa para guardar el archivo
                $rutaArchivo = $carpetaDestino . $id . '_' . $nombre . '_' . $tipoDocumento . '.' . $extension;
                error_log("extensión: " . $extension);
                // Mover el archivo al destino
                if (move_uploaded_file($_FILES['archivo']['tmp_name'], $rutaArchivo)) {
                    $respuesta = array('success' => true, 'message' => 'Archivo subido con éxito', 'ruta' => $rutaArchivo);
                } else {
                    $respuesta = array('success' => false, 'message' => 'Error al subir el archivo');
                }

                // Devolver la respuesta como JSON
                header('Content-Type: application/json');
                echo json_encode($respuesta);
            } else {
                $respuesta = array('success' => false, 'message' => 'Error al subir el archivo, extensión no permitida');
                header('Content-Type: application/json');
                echo json_encode($respuesta);
            }
            break;
        case 2: //eliminacion de carpeta
            $id = $_POST['id'];
            $carpetaBase = 'archivos/';
            $carpetaDestino = $carpetaBase . $id . '/';
            if (file_exists($carpetaDestino)) {
                $respuesta = array('success' => true, 'message' => 'Carpeta eliminada con éxito');
                $files = glob($carpetaDestino . '*', GLOB_MARK); //GLOB_MARK adds a slash to directories returned
                foreach ($files as $file) {
                    unlink($file);
                }
                rmdir($carpetaDestino);
            } else {
                $respuesta = array('success' => false, 'message' => 'Error al eliminar la carpeta');
            }
            header('Content-Type: application/json');
            echo json_encode($respuesta);
            break;

        default:
            # code...
            break;
    }

} else {

    $respuesta = array('success' => false, 'message' => 'Acceso denegado');
    header('Content-Type: application/json');
    echo json_encode($respuesta);
}
?>