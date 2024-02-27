<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Datos Completos</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f4f4f4; /* Color de fondo */
        }
        .container {
            max-width: 2159px;
            height: 1000px;
            margin: 0 auto;
            padding: 20px;
            background-color: #fff; /* Color de fondo del contenedor */
            border-radius: 8px; /* Bordes redondeados */
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1); /* Sombra */
            display: flex; /* Utilizamos flexbox para alinear los elementos */
        }
        .sidebar {
            background-color: #007bff85; /* Color de fondo de la barra lateral */
            padding: 20px; /* Espacio interno */
            border-radius: 8px 0 0 8px; /* Bordes redondeados solo en la esquina izquierda */
            flex: 1; /* La barra lateral ocupará todo el espacio disponible */
            color: #000000; /* Color del texto */
        }
        .main-content {
            flex: 2; /* El contenido principal ocupará dos veces el espacio de la barra lateral */
            padding: 20px; /* Espacio interno */
        }
        h1 {
            font-size: 30px;
            margin-bottom: 10px;
            text-align: center; /* Centrar el título */
            color: #333; /* Color del texto */
        }
        p {
            margin-bottom: 5px;
            color: #666; /* Color del texto */
        }
        .section {
          margin-top: 20px;
            margin-bottom: 20px; /* Añadir espacio entre secciones */
        }
        .datos {
            margin-bottom: 10px; /* Ajustar espacio entre títulos de sección y lista de datos */
            font-size: 20px; /* Tamaño de fuente para los títulos de sección */
            color: #007bff; /* Color para los títulos de sección */
        }
        ul {
            list-style-type: none; /* Quitar viñetas de la lista */
            padding: 0; /* Eliminar relleno de la lista */
            margin: 0; /* Eliminar margen de la lista */
        }
        ul li {
            margin-bottom: 5px; /* Espacio entre elementos de la lista */
            color: #333; /* Color del texto */
        }
        .logo{
          position: absolute;
          width: 5%;
        }
        .sidebar img{
    width: 150px;
    height: 150px;
    border: 20px ;
    overflow: hidden; /* Para recortar la imagen */
    margin: 60px auto; /* Margen superior e inferior automático y margen lateral auto para centrar */
    margin-left: 45px; /* Margen en el lado izquierdo */
    margin-top: 30px; /* Alinear el contenedor de la imagen hacia abajo */
    margin-bottom: 2mm; /* Agregar un margen inferior */
    margin-right: 2mm;
    border-radius: 8px; /* Bordes redondeados */
}



    </style>
</head>
<?php
//obtencion de id usuario
$id = $_GET['id'];
//pedimos datos del usuario conforme su id
include_once '..\bd\conexion.php';
include_once '..\bd\funciones.php';
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

//si no hay imagen de usuario usamos una por defecto
if ($dataDocumentos == null) {
    $dataDocumentos[0]['Foto'] = "../img/user.png";
}else{
  $dataDocumentos[0]['Foto'] = "../../" . $dataDocumentos[0]['Foto'];
}


$rutaImagenUsuario = $dataDocumentos[0]['Foto'];



$edad = calcularEdad($dataPersonas[0]['FechaNacimiento']);




?>
<body>
    <div class="container">
        <div class="sidebar">
            <h1><?php echo $dataPersonas[0]['Nombre']?></h1>
            <img src="<?php echo $rutaImagenUsuario?>" alt="Foto de perfil" >
            <p>Edad: <?php echo $edad?></p>
            <p>Carrera: <?php echo $dataAcademicos[0]['Carrera']?></p>
            <p>Dirección: <?php echo $dataPersonas[0]['Direccion']?></p>
            <p>Teléfono: <?php echo $dataPersonas[0]['NumeroCelular']?></p>
            <p>Genero: <?php echo $dataMedicos[0]['Genero']?></p>
        </div>
        <div class="main-content">
          <img src="../img/oceanus-logo.svg" alt="Logo" class="logo">
            <h1 class="logo-title">Reporte de Empleado</h1>
            <div class="section">
                <h2 class="datos">Datos Médicos</h2>
                <ul>
                    <li>Alergias: <?php echo $dataMedicos[0]['Alergias']?></li>
                    <li>Enfermedades: <?php echo $dataMedicos[0]['EnfermedadesCronicas']?></li>
                    <li>Lesiones: <?php echo $dataMedicos[0]['Lesiones']?></li>
                    <li>NSS: <?php echo $dataMedicos[0]['NumeroSeguro']?></li>
                    <li>Nombre para llamar a emergencia: <?php echo $dataMedicos[0]['NombreEmergencia']?></li>
                    <li>Número de Emergencia: <?php echo $dataMedicos[0]['NumeroEmergencia']?></li>
                    <li>Tipo de Sangre: <?php echo $dataMedicos[0]['TipoSangre']?></li>
                </ul>
            </div>

            <div class="section">
                <h2 class="datos">Datos Personales</h2>
                <ul>
                    <li>Fecha de Nacimiento: <?php echo $dataPersonas[0]['FechaNacimiento']?></li>
                    <li>CURP: <?php echo $dataPersonas[0]['Curp']?></li>
                    <li>RFC: <?php echo $dataPersonas[0]['Rfc']?></li>
                    <li>Número: <?php echo $dataPersonas[0]['NumeroCelular']?></li>
                    <li>Dirección: <?php echo $dataPersonas[0]['Direccion']?></li>
                    <li>Licencia: <?php echo $dataPersonas[0]['NumeroLicencia']?></li>
                    <li>Pasaporte: <?php echo $dataPersonas[0]['NumeroPasaporte']?></li>
                    <li>Fecha de Ingreso: <?php echo $dataPersonas[0]['FechaIngreso']?></li>
                </ul>
            </div>

            <div class="section">
                <h2 class="datos">Datos Académicos</h2>
                <ul>
                    <li>Carrera: <?php echo $dataAcademicos[0]['Carrera']?></li>
                    <li>Cédula: <?php echo $dataAcademicos[0]['Cedula']?></li>
                    <li>Experiencia Laboral: <?php echo $dataAcademicos[0]['ExpLaboral']?></li>
                    <li>Certificaciones: <?php echo $dataAcademicos[0]['Certificaciones']?></li>
                    <li>Grado de Estudios: <?php echo $dataAcademicos[0]['GradoEstudios']?></li>
                </ul>
            </div>
        </div>
    </div>
</body>
</html>
