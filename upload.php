<?php

require_once ('../loginBase/dashboard/bd/funciones.php');
require_once ('../loginBase/dashboard/bd/funcionesdb.php');
require_once ('../loginBase/bd/conexion.php');


//antes de devolver la respuesta cerramos la conexion
$conexion = null;

$objeto = new Conexion();
$conexion = $objeto->Conectar();
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


            //antes de devolver la respuesta cerramos la conexion
            $conexion = null;

            // Devolver la respuesta como JSON
            header('Content-Type: application/json');
            echo json_encode($respuesta);

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

            //antes de devolver la respuesta cerramos la conexion
            $conexion = null;
            header('Content-Type: application/json');
            echo json_encode($respuesta);
            break;
        case 3:
            $configuracion = json_decode(file_get_contents('configuracion.json'), true);
            $id = $datos_recibidos['datos']['personas'][0]['Id'];
            $nombre = $datos_recibidos['datos']['personas'][0]['Nombre'];
            $tipoDocumento = $datos_recibidos['tipoDocumento'];

            // Carpeta donde se guardarán los archivos (asegúrate de tener permisos de escritura)
            $carpetaBase = "./archivos/";
            $carpetaDestino = $carpetaBase . $id . '/';
            $rutaArchivo = $carpetaDestino . $id . '_' . $nombre . '_' . $tipoDocumento . '.pdf';

            $carpetaRelativa = "archivos/" . $id . "/" . $id . '_' . $nombre . '_' . $tipoDocumento . '.pdf';
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

                if ($datos_recibidos['tipoDocumento'] == 'Credencial') {
                    //parte frontal
                    $html = file_get_contents('.\dashboard\Credencial.html');
                    $html = str_replace('{{Nombre}}', $datos_recibidos['datos']['personas'][0]['Nombre'], $html);
                    $html = str_replace('{{Rfc}}', $datos_recibidos['datos']['personas'][0]['Rfc'], $html);
                    $html = str_replace('{{Curp}}', $datos_recibidos['datos']['personas'][0]['Curp'], $html);
                    $html = str_replace('{{NumeroSeguro}}', $datos_recibidos['datos']['medicos'][0]['NumeroSeguro'], $html);
                    $html = str_replace('{{Celular}}', $datos_recibidos['datos']['personas'][0]['NumeroCelular'], $html);
                    $html = str_replace('{{Carrera}}', $datos_recibidos['datos']['academicos'][0]['Carrera'], $html);

                    //parte trasera
                    $html = str_replace('{{TipoSangre}}', $datos_recibidos['datos']['medicos'][0]['TipoSangre'], $html);
                    $html = str_replace('{{AlergiasMedicamentos}}', $datos_recibidos['datos']['medicos'][0]['Alergias'], $html);
                    $html = str_replace('{{EnfermedadesCronicas}}', $datos_recibidos['datos']['medicos'][0]['EnfermedadesCronicas'], $html);
                    $html = str_replace('{{NumeroEmergencia}}', $datos_recibidos['datos']['medicos'][0]['NumeroEmergencia'], $html);
                    $pdf->writeHTML($html, true, false, true, false, '');

                    // Guarda o muestra el PDF

                    $pdf->Output($rutaArchivo, 'F');

                } else {
                    # code...


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
                }


            } catch (\Throwable $th) {
                //throw $th;
                error_log("Error al guardar el archivo: " . $th);
            }



            //antes de devolver la respuesta cerramos la conexion
            $conexion = null;

            header('Content-Type: application/json');
            $respuesta = array('success' => true, 'message' => 'Archivo guardado con éxito', 'ruta' => $carpetaRelativa, 'Id' => $id);

            echo json_encode($respuesta);

            break;

        case 4: //subir archivos de contrato y devolver la ruta donde se guardo
            $id = $_POST['id'];
            $tipoDocumento = $_POST['tipoDocumento'];
            $nombreDocumento = $_POST['nombreDocumento'];  //nombre del documento

            //le añadimos un _ a cada espacion en blanco del nombre del documento
            $nombreDocumento = str_replace(' ', '_', $nombreDocumento);

            // Carpeta donde se guardarán los archivos (asegúrate de tener permisos de escritura)
            $carpetaBase = 'archivos/contratos/';
            $carpetaBaseEmpresas = 'archivos/empresas/';
            switch ($tipoDocumento) {
                case 'contrato':
                    $carpetaDestino = $carpetaBase . $id . '/';
                    break;
                case 'facturas':
                    $carpetaDestino = $carpetaBase . $id . '/facturas/';
                    break;
                case 'fianzas':
                    $carpetaDestino = $carpetaBase . $id . '/fianzas/';
                    break;
                case 'empresa':
                    $carpetaDestino = $carpetaBaseEmpresas;
                    break;
                case 'subContratado';
                    $carpetaDestino = 'archivos/subContratados/';
                    break;
                default:
                    $carpetaDestino = $carpetaBase . $id . '/';
                    break;
            }


            // Crear la carpeta si no existe
            if (!file_exists($carpetaDestino)) {
                mkdir($carpetaDestino, 0777, true);
            }

            // Obtener el nombre original del archivo
            $nombreArchivo = basename($_FILES['archivo']['name']);

            $extension = pathinfo($nombreArchivo, PATHINFO_EXTENSION); // Obtiene la extensión del archivo

            // Construir la ruta completa para guardar el archivo
            $rutaArchivo = $carpetaDestino . $id . '_' . $nombreDocumento . '.' . $extension;
            error_log("extensión: " . $extension);
            error_log("rutaArchivo: " . $rutaArchivo);
            error_log("tipoDocumento: " . $tipoDocumento);
            error_log("nombreDocumento: " . $nombreDocumento);
            // Mover el archivo al destino
            if (isset($_FILES['archivo'])) {
                if (move_uploaded_file($_FILES['archivo']['tmp_name'], $rutaArchivo)) {
                    if ($tipoDocumento == 'contrato') {
                        $message = ActualizarDato('contrato', $rutaArchivo, 'ubicacionContrato', $id, $conexion, 'idContrato');# code...
                    } elseif ($tipoDocumento == 'fianzas') {
                        if ($nombreDocumento == 'Fianza_Cumplimiento') {
                            $message = ActualizarFianzaContrato($id, $rutaArchivo, $conexion, 'fianza_cumplimiento', 'fianzaCumplimientoDoc');
                        } elseif ($nombreDocumento == 'Fianza_Anticipo') {
                            $message = ActualizarFianzaContrato($id, $rutaArchivo, $conexion, 'fianza_anticipo', 'fianzaAnticipoDoc');
                        } elseif ($nombreDocumento == 'Fianza_Vicios_Ocultos') {
                            $message = ActualizarFianzaContrato($id, $rutaArchivo, $conexion, 'fianza_vicios_ocultos', 'fianzaViciosOcultosDoc');
                        }

                    } elseif ($tipoDocumento == 'facturas') {
                        if (isset($_POST['datoExtra'])) {
                            $message = ActualizarFacturaContrato($id, $rutaArchivo, $conexion, 'documento', $_POST['datoExtra']);

                        } else {
                            $message = 'Error no se a proporcionado id de la factura';
                        }

                    } elseif ($tipoDocumento == 'empresa') {
                        error_log("tipoDocumento: " . $tipoDocumento);
                        $message = ActualizarDato('empresa', $rutaArchivo, 'constanciaFiscal', $id, $conexion, 'idEmpresa');# code...
                    } elseif ($tipoDocumento == 'subContratado') {
                        error_log("tipoDocumento: " . $tipoDocumento);
                        $message = ActualizarDato('subcontratados', $rutaArchivo, 'doc', $id, $conexion, 'idSubContratado');# code...
                    }

                    $respuesta = array('success' => true, 'message' => $message, 'ruta' => $rutaArchivo, 'id' => $id);
                } else {
                    // Si el archivo ya existe, cambiar el nombre del archivo existente
                    $nombreArchivoNuevo = uniqid() . '.' . $extension;
                    $rutaArchivoNuevo = $carpetaDestino . $nombreArchivoNuevo;

                    if (rename($rutaArchivo, $rutaArchivoNuevo)) {
                        $respuesta = array('success' => true, 'message' => 'Archivo subido con éxito', 'ruta' => $rutaArchivoNuevo);

                    } else {
                        $respuesta = array('success' => false, 'message' => 'Error al subir el archivo');
                    }
                }
            } else {
                $respuesta = array('success' => false, 'message' => 'No se ha seleccionado ningún archivo');
            }

            //antes de devolver la respuesta cerramos la conexion
            $conexion = null;
            // Devolver la respuesta como JSON
            header('Content-Type: application/json');
            echo json_encode($respuesta);

            break;
        case 5: //crear contratos en base a un excel con los datos

            require 'vendor/autoload.php'; // Carga la librería PHPSpreadSheet
            $dateFormat = new \PhpOffice\PhpSpreadsheet\Shared\Date();
            $reader = new \PhpOffice\PhpSpreadsheet\Reader\Xlsx(); // Crea una instancia de la clase Reader
            $spreadsheet = $reader->load($_FILES['archivo']['tmp_name']); // Carga el archivo Excel
            $sheet = $spreadsheet->getActiveSheet(); // Obtiene la hoja activa




            // Itera sobre las filas y columnas
            foreach ($sheet->getRowIterator() as $fila) {

                $fila = $fila->getRowIndex();
                $numero = $sheet->getCell('A' . $fila)->getValue();

                if ($numero == 'NUM' || $numero == null) {
                    continue;
                }
                $contratante = $sheet->getCell('B' . $fila)->getValue();
                $idContratante = CrearEmpresa($contratante, $conexion);

                $numeroContrato = $sheet->getCell('C' . $fila)->getValue();
                $nombreContrato = $sheet->getCell('D' . $fila)->getValue();


                //si el contrato ya existe no lo crea
                if (ComprobarContrato($nombreContrato, $conexion, $numero)) {
                    continue;
                }

                $direccion = $sheet->getCell('E' . $fila)->getValue();
                $monto = $sheet->getCell('F' . $fila)->getValue();
                $fechaInicio = $sheet->getCell('I' . $fila)->getValue();
                $fechaFin = $sheet->getCell('J' . $fila)->getValue();

                //trasnformamos las fechas de excel a un formato numerico




                //si la fecha esta vacia le asignamos un valor por defecto
                if ($fechaInicio == null || $fechaInicio == '') {

                    $fechaInicio = '0001-01-01';

                } else {

                    $fechaInicio = $dateFormat::excelToDateTimeObject(intVal($fechaInicio))->format('Y-m-d');
                }

                if ($fechaFin == null || $fechaFin == '') {

                    $fechaFin = '0001-01-01';

                } else {
                    $fechaFin = $dateFormat::excelToDateTimeObject(intval($fechaFin))->format('Y-m-d');
                }

                //si el monto no esta en formato numerico le asignamos un valor por defecto
                if (!is_numeric($monto)) {
                    $monto = 0;
                }

                //error_log($monto);

                //se va a crear un titulo para el contrato tomando el nombre de este pero recortandolo a 20 caracteres y añadiendo 3 puntos suspensivos
                $tituloContrato = substr($nombreContrato, 0, 20) . '...';


                error_log('nombre Contrato' . $tituloContrato);
                //creamos el contrato 
                CrearContrato($tituloContrato, $nombreContrato, $numeroContrato, $idContratante, $direccion, $monto, $fechaInicio, $fechaFin, $conexion, $numero);





            }




            $respuesta = 'prueba terminada';
            //antes de devolver la respuesta cerramos la conexion
            $conexion = null;
            // Devolver la respuesta como JSON
            header('Content-Type: application/json');
            echo json_encode($respuesta);

            break;





        case 6: //Generarl un archivo zip de la carpeta de un contrato en especifico
            error_log("entro a la opcion 6");
            $id = $_POST['id'];
            $carpetaBase = 'archivos/contratos/';
            $carpetaDestino = $carpetaBase . $id . '/';
            $zip = new ZipArchive();
            $nombreZip = $carpetaDestino . 'documentos.zip';
            if ($zip->open($nombreZip, ZipArchive::CREATE) === TRUE) {
                $files = new RecursiveIteratorIterator(new RecursiveDirectoryIterator($carpetaDestino));
                foreach ($files as $file) {
                    $file = str_replace('\\', '/', $file);
                    if (is_file($file)) {
                        $zip->addFile($file, str_replace($carpetaDestino, '', $file));
                    }
                }
                $zip->close();
                $respuesta = array('success' => true, 'message' => 'Archivo zip creado con éxito', 'ruta' => $nombreZip);
            } else {
                $respuesta = array('success' => false, 'message' => 'Error al crear el archivo zip');
            }
            error_log('ruta: ' . $nombreZip);
            //antes de devolver la respuesta cerramos la conexion
            $conexion = null;
            // Devolver la respuesta como JSON
            header('Content-Type: application/json');
            echo json_encode($respuesta);

            break;

        default:
            # code...
            break;
    }

} else {
    //antes de devolver la respuesta cerramos la conexion
    $conexion = null;
    //switch para descargar archivos
    $respuesta = array('success' => false, 'message' => 'Acceso denegado');
    header('Content-Type: application/json');
    echo json_encode($respuesta);

}
?>