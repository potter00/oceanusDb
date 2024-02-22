<?php
require_once('TCPDF-main\tcpdf.php');
require_once('.\dashboard\bd\funciones.php');
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $datos_recibidos = json_decode(file_get_contents("php://input"), true);
    
    if (isset($_POST['opcion'])) {
        $opcion = $_POST['opcion'];
    } else {
        $opcion = $datos_recibidos['opcion'];
    }
    error_log("opcion: " . $opcion);
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
            if ($extension == 'pdf' || $extension == 'jpg' || $extension == 'jpeg' || $extension == 'png' || $extension == 'webp') {
                # code...
                $nombre = trim($nombre);
                // Construir la ruta completa para guardar el archivo
                $rutaArchivo = $carpetaDestino . $id . '_' . $nombre . '_' . $tipoDocumento . '.' . $extension;
                error_log("extensión: " . $extension);
                error_log("rutaArchivo: " . $rutaArchivo);
                // Mover el archivo al destino
                if (move_uploaded_file($_FILES['archivo']['tmp_name'], $rutaArchivo)) {
                    $respuesta = array('success' => true, 'message' => 'Archivo subido con éxito', 'ruta' => $rutaArchivo, 'id' => $id);
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
        case 3:
            $configuracion = json_decode(file_get_contents('configuracion.json'), true);
            $id = $datos_recibidos['datos']['personas'][0]['Id'];
            $nombre = $datos_recibidos['datos']['personas'][0]['Nombre'];
            $tipoDocumento = $datos_recibidos['tipoDocumento'];

            // Carpeta donde se guardarán los archivos (asegúrate de tener permisos de escritura)
            $carpetaBase = $configuracion['ruta_archivos'];
            $carpetaDestino = $carpetaBase . $id . '/';
            $rutaArchivo = $carpetaDestino . $id . '_' . $nombre . '_' . $tipoDocumento . '.pdf';
            
            $carpetaRelativa = "archivos/".$id ."/". $id . '_' . $nombre . '_' . $tipoDocumento . '.pdf';
            // Crear la carpeta si no existe
            if (!file_exists($carpetaDestino)) {
                mkdir($carpetaDestino, 0777, true);
            }
            //error_log("datos_recibidos: " . json_encode($datos_recibidos));
            try {
            // Crea una instancia de TCPDF
            $pdf = new TCPDF();

            // Agrega una página al PDF
            $pdf->AddPage();

            // Plantilla HTML (puedes cargar desde un archivo o definirla aquí)
            $html = file_get_contents('dashboard\vistas\plantilla_datos_completos.html');
            
            // Reemplaza los marcadores de posición con los datos reales
            $html = str_replace('{{nombre}}', $datos_recibidos['datos']['personas'][0]['Nombre'], $html);
            $html = str_replace('{{fechaNacimiento}}', $datos_recibidos['datos']['personas'][0]['FechaNacimiento'], $html);
            $html = str_replace('{{curp}}', $datos_recibidos['datos']['personas'][0]['Curp'], $html);
            $html = str_replace('{{rfc}}', $datos_recibidos['datos']['personas'][0]['Rfc'], $html);
            $html = str_replace('{{numero}}', $datos_recibidos['datos']['personas'][0]['NumeroCelular'], $html);
            $html = str_replace('{{direccion}}', $datos_recibidos['datos']['personas'][0]['Direccion'], $html);
            $html = str_replace('{{licencia}}', $datos_recibidos['datos']['personas'][0]['NumeroLicencia'], $html);
            $html = str_replace('{{pasaporte}}', $datos_recibidos['datos']['personas'][0]['NumeroPasaporte'], $html);
            $html = str_replace('{{fechaIngreso}}', $datos_recibidos['datos']['personas'][0]['FechaIngreso'], $html);
            //Datos médicos
            $html = str_replace('{{alergias}}', $datos_recibidos['datos']['medicos'][0]['Alergias'], $html);
            $html = str_replace('{{enfermedades}}', $datos_recibidos['datos']['medicos'][0]['EnfermedadesCronicas'], $html);
            $html = str_replace('{{lesiones}}', $datos_recibidos['datos']['medicos'][0]['Lesiones'], $html);
            $html = str_replace('{{alergiasMedicamentos}}', $datos_recibidos['datos']['medicos'][0]['AlergiasMedicamentos'], $html);
            $html = str_replace('{{inss}}', $datos_recibidos['datos']['medicos'][0]['NumeroSeguro'], $html);
            $html = str_replace('{{numeroEmergencia}}', $datos_recibidos['datos']['medicos'][0]['NumeroEmergencia'], $html);
            $html = str_replace('{{tipoSangre}}', $datos_recibidos['datos']['medicos'][0]['TipoSangre'], $html);
            
            //datos academicos
            $html = str_replace('{{cedula}}', $datos_recibidos['datos']['academicos'][0]['Cedula'], $html);
            $html = str_replace('{{carrera}}', $datos_recibidos['datos']['academicos'][0]['Carrera'], $html);
            $html = str_replace('{{expLaboral}}', $datos_recibidos['datos']['academicos'][0]['ExpLaboral'], $html);
            $html = str_replace('{{certificaciones}}', $datos_recibidos['datos']['academicos'][0]['Certificaciones'], $html);
            $html = str_replace('{{gradoEstudios}}', $datos_recibidos['datos']['academicos'][0]['GradoEstudios'], $html);
            
            $edad = calcularEdad($datos_recibidos['datos']['personas'][0]['FechaNacimiento']);

            $html = str_replace('{{edad}}', $edad, $html);


            // Agrega el contenido HTML al PDF
            $pdf->writeHTML($html, true, false, true, false, '');

            // Guarda o muestra el PDF
            
                $pdf->Output($rutaArchivo, 'F');
            } catch (\Throwable $th) {
                //throw $th;
                error_log("Error al guardar el archivo: " . $th);
            }
            
            
            
            header('Content-Type: application/json');
            $respuesta = array('success' => true, 'message' => 'Archivo guardado con éxito', 'ruta' => $carpetaRelativa, 'Id' => $id);
            
            echo json_encode($respuesta);
            
            break;

        default:
            # code...
            break;
    }

} else {

    //switch para descargar archivos
    $respuesta = array('success' => false, 'message' => 'Acceso denegado');
    header('Content-Type: application/json');
    echo json_encode($respuesta);

}
?>