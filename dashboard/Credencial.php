<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Credencial de Empleado</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-image: url('imagen_de_fondo.jpg');
            /* Ruta de la imagen de fondo */
            background-size: cover;
            /* Ajustar la imagen al tamaño del contenedor */
        }

        /* Estilos para la credencial frontal */
        .frontal {
            border: 2px solid #007bff;
            /* Color del borde */
            width: 85.6mm;
            /* Ancho de la credencial */
            height: 54mm;
            /* Altura de la credencial */
            margin: 20px auto;
            background-color: #fff;
            /* Color de fondo */
            /* background-image: url('img/11.jpg'); /* Ruta de la imagen de fondo */
            background-size: cover;
            /* Ajustar la imagen al tamaño del contenedor */
            background-position: center;
            /* Centrar la imagen de fondo */
            background-repeat: no-repeat;
            /* Evitar que la imagen de fondo se repita */
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            display: flex;
            position: relative;
        }


        .titulo {
            position: absolute;
            top: 5pt;
            left: 50%;
            transform: translateX(-50%);
            background-color: #007bff;
            /* Color de fondo del título */
            color: #fff;
            /* Color del texto del título */
            padding: 3px 6px;
            border-radius: 3px;
            width: calc(100% - 20px);
            /* Ancho del título con un margen de 10px en ambos lados */
            text-align: center;
            /* Centrar el texto del título */
        }

        .titulo h2 {
            margin: 0;
            font-size: 10px;
            /* Tamaño del texto del título */
        }


        .datos-frontal {
            margin-top: 15px;
            /* Reducir el margen superior */
            margin-bottom: 15px;
            /* Reducir el margen inferior */
            margin-left: 20px;
            /* Centrar el contenedor del texto */
            margin-right: 1px;
            /* Centrar el contenedor del texto */
            font-size: 10px;
            /* Tamaño del texto */
            text-align: left;
            /* Alinear el texto a la izquierda */
            padding: 10px;
            /* Ajustar el relleno */
            background-color: rgb(255, 255, 255);
            /* Fondo opaco */
            line-height: 1;
            /* Reducir el espacio entre líneas */
            width: 80%;
        }

        .logo {
            position: absolute;
            top: -2px;
            /* Ajusta la distancia desde la parte superior */
            left: 7px;
            /* Ajusta la distancia desde el lado izquierdo */
            z-index: 1;
            /* Asegura que esté sobre otros elementos */
        }

        .logo img {
            width: 50px;
            /* Ancho deseado del logo */
            height: auto;
            /* Altura automática para mantener la proporción */
        }

        .foto {
            width: 120px;
            height: 120px;
            border: 5px;
            overflow: hidden;
            /* Para recortar la imagen */
            margin: 60px auto;
            /* Margen superior e inferior automático y margen lateral auto para centrar */
            margin-left: 30px;
            /* Margen en el lado izquierdo */
        }

        .foto img {
            width: 85%;
            /* Hacer que la imagen de la foto ocupe todo el espacio del contenedor */
            height: 85%;
            /* Hacer que la imagen de la foto ocupe todo el espacio del contenedor */
            object-fit: cover;
            /* Escalar la imagen para que cubra todo el contenedor */
        }


        .qr-container {
            position: absolute;
            margin-left: 220px;
            /* Alinear el contenedor del QR hacia la derecha */
            margin-top: 30px;
            /* Alinear el contenedor del QR hacia abajo */
            margin-bottom: 2mm;
            /* Agregar un margen inferior */
            margin-right: 2mm;
            /* Agregar un margen derecho */
        }


        .qr {
            width: 20mm;
            /* Ancho del QR */
            height: 20mm;
            /* Altura del QR */
            /*background-color: #007bff; /* Color de fondo del contenedor del QR */
            display: flex;
            justify-content: center;
            align-items: center;
            color: #fff;
            /* Color del texto del QR */
            font-size: 6px;
            /* Tamaño del texto del QR */
            border-radius: 3px;
        }





        /* Estilos para la credencial reversa */
        .reverso {
            border: 2px solid #007bff;
            /* Color del borde */
            width: 85.6mm;
            /* Ancho de la credencial */
            height: 54mm;
            /* Altura de la credencial */
            margin: 20px auto;
            background-color: #fff;
            /* Color de fondo */
            background-image: url('img/oceanus-logo.svg');
            /* Ruta de la imagen de fondo */
            background-size: 50%;
            /* Ajustar la imagen al tamaño del contenedor */
            background-position: center;
            /* Centrar la imagen de fondo */
            background-repeat: no-repeat;
            /* Evitar que la imagen de fondo se repita */
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            display: flex;
            position: relative;
        }


        .datos-reverso {
            font-size: 8px;
            /* Tamaño del texto */
            text-align: left;
            /* Alinear el texto a la izquierda */
            padding: 15px;
            /* Ajustar el relleno */
            line-height: 1;
            /* Reducir el espacio entre líneas */
            background-color: rgba(255, 255, 255, 0.861);
            /* Fondo opaco */
            width: 100%;

        }

        .reverso {
            /* Tus estilos existentes */
            position: relative;
            /* Establecemos posición relativa para los elementos hijos posicionados absolutamente */
        }

        .firma {
            position: absolute;
            /* Posicionamos la firma de manera absoluta */
            bottom: -14px;
            /* Colocamos la firma 20px desde el borde inferior */
            right: 60px;
            /* Colocamos la firma 20px desde el borde derecho */
            text-align: center;
            /* Centramos el texto */
            width: 200px;
            /* Ancho del espacio de la firma */
        }

        .linea-firma {
            display: block;
            width: 100%;
            /* Ancho de la línea */
            height: 2px;
            /* Grosor de la línea */
            background-color: #000;
            /* Color de la línea */
            margin: 0 auto 10px;
            /* Espacio debajo de la línea */
        }
    </style>
</head>
<?php
//obtencion de id usuario
$id = $_GET['id'];
//pedimos datos del usuario conforme su id
include_once '../../loginBase/bd/conexion.php';
$objeto = new Conexion();
$conexion = $objeto->Conectar();

$consulta = "SELECT * FROM personas WHERE id = $id";
$resultado = $conexion->prepare($consulta);
$resultado->execute();
$dataPersonas = $resultado->fetchAll(PDO::FETCH_ASSOC);

//optenemos los datos medicos
$consulta = "SELECT * FROM datosmedicos WHERE idEmpleado = $id";
$resultado = $conexion->prepare($consulta);
$resultado->execute();
$dataMedicos = $resultado->fetchAll(PDO::FETCH_ASSOC);

//optenemos los datos academicos
$consulta = "SELECT * FROM formacademica WHERE idEmpleado = $id";
$resultado = $conexion->prepare($consulta);
$resultado->execute();
$dataAcademicos = $resultado->fetchAll(PDO::FETCH_ASSOC);

//optenemos los datos de documentos
$consulta = "SELECT * FROM documentacion WHERE idEmpleado = $id";
$resultado = $conexion->prepare($consulta);
$resultado->execute();
$dataDocumentos = $resultado->fetchAll(PDO::FETCH_ASSOC);


if ($dataDocumentos[0]['Foto'] == 'sin cambio') {
    $dataDocumentos[0]['Foto'] = ".\dashboard\img\user.png";
}
if ($dataPersonas[0]['TipoContrato'] == 'indefinido') {
    $dataPersonas[0]['FinContrato'] = 'Indefinido';
}

$rutaImagenUsuario = $dataDocumentos[0]['Foto'];
$rutaImagenUsuario = "..\\" . $rutaImagenUsuario;

//generamos un archivo vfc con los datos del usuario para el codigo qr
$archivo = fopen("qr.txt", "w") or die("No se puede abrir el archivo");
$txt = "Nombre: " . $dataPersonas[0]['Nombre'] . "\n";
fwrite($archivo, $txt);
$txt = "RFC: " . $dataPersonas[0]['Rfc'] . "\n";
fwrite($archivo, $txt);
$txt = "NSS: " . $dataMedicos[0]['NumeroSeguro'] . "\n";
fwrite($archivo, $txt);
$txt = "CURP: " . $dataPersonas[0]['Curp'] . "\n";
fwrite($archivo, $txt);
$txt = "Puesto: " . $dataAcademicos[0]['Carrera'] . "\n";
fwrite($archivo, $txt);
$txt = "Celular: " . $dataPersonas[0]['NumeroCelular'] . "\n";
fwrite($archivo, $txt);
$txt = "Vigencia: " . $dataPersonas[0]['InicioContrato'] . " - " . $dataPersonas[0]['FinContrato'] . "\n";
fwrite($archivo, $txt);
fclose($archivo);

//generamos el codigo qr
require 'phpqrcode/qrlib.php';
QRcode::png("qr.txt", "img/QROceanus.png", QR_ECLEVEL_L, 3, 3);





?>

<body>
    <!-- Credencial Frontal -->
    <div class="frontal">
        <div class="logo">
            <img src="./img/oceanus-logo.svg" alt="Logo de la Empresa">
        </div>
        <div class="foto">
            <img src="<?php echo $rutaImagenUsuario ?>" alt="Foto del Empleado">
        </div>
        <div class="titulo">
            <h2> OCEANUS SUPERVISION Y PROYECTOS</h2>
        </div>

        <div class="datos-frontal">

            <p><strong>NOMBRE COMPLETO:</strong></p>
            <p>
                <?php echo $dataPersonas[0]['Nombre'] ?>
            </p>
            <p><strong>RFC:</strong>
                <?php echo $dataPersonas[0]['Rfc'] ?>
            </p>
            <p><strong>NSS:</strong>
                <?php echo $dataMedicos[0]['NumeroSeguro'] ?>
            </p>
            <p><strong>CURP:</strong>
                <?php echo $dataPersonas[0]['Curp'] ?>
            </p>
            <p><strong>Puesto:</strong>
                <?php echo $dataAcademicos[0]['Carrera'] ?>
            </p>
            <p><strong>Celular:</strong>
                <?php echo $dataPersonas[0]['NumeroCelular'] ?>
            </p>
            <?php 
            if ($dataPersonas[0]['TipoContrato'] != 'indefinido') {
                echo '<p><strong>Vigencia: </strong>'.$dataPersonas[0]['InicioContrato'].' - '.$dataPersonas[0]['FinContrato'].'</p>';
            }else {
                echo '<p><strong>Vigencia: </strong>'.$dataPersonas[0]['InicioContrato'].' - Indefinido</p>';
            }
            

            ?>
            
        </div>
        
    </div>

    <!-- Credencial Reversa -->
    <div class="reverso">
        <div class="datos-reverso">
            <p><strong>Sexo:</strong> Masculino</p>
            <p><strong>Tipo de Sangre:</strong>
                <?php echo $dataMedicos[0]['TipoSangre'] ?>
            </p>
            <p><strong>Alergias a Medicamentos:</strong>
                <?php echo $dataMedicos[0]['AlergiasMedicamentos'] ?>
            </p>
            <p><strong>Padecimientos Médicos:</strong>
                <?php echo $dataMedicos[0]['EnfermedadesCronicas'] ?>
            </p>
            <p><strong>EN CASO DE EMERGENCIA LLAMAR A:</strong></p>
            <p><?php echo $dataMedicos[0]['NombreEmergencia'] ?></p>
            <p><strong>NUMERO DE TELEFONO:</strong>
                <?php echo $dataMedicos[0]['NumeroEmergencia'] ?>
            </p>
            <p><strong></strong></p>
        </div>
        <div class="qr-container">
            <div class="qr">
                <!-- Insertar aquí el código QR -->
                <img src="img/QROceanus.png" alt="Código QR">
            </div> <!-- QR Code -->
        </div>
        <div class="firma">
            <span class="linea-firma"></span> <!-- Línea para la firma -->
            <!-- Insertar aquí el espacio para la firma -->
            <p><strong> FIRMA </strong></p>
        </div>
    </div>