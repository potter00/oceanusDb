<?php require_once "vistas/parte_superior.php" ?>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mi Página con Imagen y Campos de Datos</title>
    <style>
        /* Estilos para alinear la imagen y los campos de datos */
        .container {
            display: flex;
            align-items: center;
        }

        .image {
            flex: 1;
            padding-right: 20px;
        }

        .data-fields {
            flex: 3;
        }

        .data-list {
            flex: 3;
        }
    </style>
</head>
<?php
//obtencion de id usuario
$id = $_GET['id'];
//pedimos datos del usuario conforme su id
include_once '.\bd\conexion.php';
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

try {

    $consulta = "SELECT * FROM documentacion WHERE idEmpleado = $id";
    $resultado = $conexion->prepare($consulta);
    $resultado->execute();
    $dataDocumentos = $resultado->fetchAll(PDO::FETCH_ASSOC);
} catch (\Throwable $th) {
    error_log($th);
}
//optenemos los datos de documentos

//si no hay imagen de usuario usamos una por defecto
if ($dataDocumentos[0]['Foto'] == 'sin cambio') {
    $dataDocumentos[0]['Foto'] = ".\dashboard\img\user.png";
}


$rutaImagenUsuario = $dataDocumentos[0]['Foto'];
$rutaImagenUsuario = "..\\" . $rutaImagenUsuario;




?>

<body>
    <div class="container">
        <div class="image">
            <img src="<?php echo $rutaImagenUsuario ?>" alt="Imagen de Usuario" width="262.75px" height="240.55px"
                style="border-radius: 20px;">
        </div>
        <div class="data-list">
            <h2>Datos del Usuario</h2>
            <ul>
                <li><strong>Nombre: </strong>
                    <?php echo $dataPersonas[0]['Nombre'] ?>
                </li>
                <li><strong>Fecha Nacimiento: </strong>
                    <?php echo $dataPersonas[0]['FechaNacimiento'] ?>
                </li>
                <li><strong>Teléfono: </strong>
                    <?php echo $dataPersonas[0]['NumeroCelular'] ?>
                </li>
                <li><strong>Carrera: </strong>
                    <?php echo $dataAcademicos[0]['Carrera'] ?>
                </li>
                <li><strong>Grado Academico: </strong>
                    <?php echo $dataAcademicos[0]['GradoEstudios'] ?>
                </li>
            </ul>
            <br>
            <div class='btn-group'>
                <button class='btn btn-primary btnEditar'>Editar</button>
                <button class='btn btn-primary btnGenerarCredencial'>Generar Credencial</button>
                <button class="btn btn-primary btnGenerarReporte">Generar Reporte</button>
                <button class='btn btn-danger btnBorrar'>Borrar</button>
            </div>
        </div>
    </div>
    <br>
    <div class="container">
        <div class="data-list" style="margin-top: 0px;">

            <h2>Datos Personales</h2>
            <ul>
                <li><strong>Nombre: </strong>
                    <?php echo $dataPersonas[0]['Nombre'] ?>
                </li>
                <li><strong>Fecha Nacimiento: </strong>
                    <?php echo $dataPersonas[0]['FechaNacimiento'] ?>
                </li>
                <li><strong>Curp: </strong>
                    <?php echo $dataPersonas[0]['Curp'] ?>
                </li>
                <li><strong>RFC: </strong>
                    <?php echo $dataPersonas[0]['Rfc'] ?>
                </li>
                <li><strong>Numero Fijo: </strong>
                    <?php echo $dataPersonas[0]['NumeroFijo'] ?>
                </li>
                <li><strong>Numero Celular: </strong>
                    <?php echo $dataPersonas[0]['NumeroCelular'] ?>
                </li>
                <li><strong>Direccion: </strong>
                    <?php echo $dataPersonas[0]['Direccion'] ?>
                </li>
                <li><strong>Numero Licencia:</strong>
                    <?php echo $dataPersonas[0]['NumeroLicencia'] ?>
                </li>
                <li><strong>Numero Pasaporte: </strong>
                    <?php echo $dataPersonas[0]['NumeroPasaporte'] ?>
                </li>
                <li><strong>Fecha Ingreso: </strong>
                    <?php echo $dataPersonas[0]['FechaIngreso'] ?>
                </li>
            </ul>


        </div>

        <div class="data-list" style="position: top;">
            <h2>Datos Medicos</h2>
            <ul>
                <li><strong>Alergias: </strong>
                    <?php echo $dataMedicos[0]['Alergias'] ?>
                </li>
                <li><strong>Enfermedades Cronicas: </strong>
                    <?php echo $dataMedicos[0]['EnfermedadesCronicas'] ?>
                </li>
                <li><strong>Lesiones: </strong>
                    <?php echo $dataMedicos[0]['Lesiones'] ?>
                </li>
                <li><strong>Alergias a Medicamentos: </strong>
                    <?php echo $dataMedicos[0]['AlergiasMedicamentos'] ?>
                </li>
                <li><strong>Numero de Seguro: </strong>
                    <?php echo $dataMedicos[0]['NumeroSeguro'] ?>
                </li>
                <li><strong>Nombre de la persona para llamada a emergencia: </strong>
                    <?php echo $dataMedicos[0]['NombreEmergencia'] ?>
                </li>
                <li><strong>Numero Emergencia: </strong>
                    <?php echo $dataMedicos[0]['NumeroEmergencia'] ?>
                </li>
                <li><strong>Tipo de Sangre: </strong>
                    <?php echo $dataMedicos[0]['TipoSangre'] ?>
                </li>
                <li><strong>Genero: </strong>
                    <?php echo $dataMedicos[0]['Genero'] ?>
                </li>
            </ul>
            <br><br><br>

        </div>
        <div class="data-list">
            <h2>Datos Academicos</h2>
            <ul>
                <li><strong>Numero de Cedula: </strong>
                    <?php echo $dataAcademicos[0]['Cedula'] ?>
                </li>
                <li><strong>Carrera: </strong>
                    <?php echo $dataAcademicos[0]['Carrera'] ?>
                </li>
                <li><strong>Experiencia laboral: </strong>
                    <?php echo $dataAcademicos[0]['ExpLaboral'] ?>
                </li>
                <li><strong>Certificaciones:</strong>
                    <?php echo $dataAcademicos[0]['Certificaciones'] ?>
                </li>
                <li><strong>Grado de Estudios: </strong>
                    <?php echo $dataAcademicos[0]['GradoEstudios'] ?>
                </li>

            </ul>
            <br><br><br><br><br>

        </div>

    </div>

    <div class="container">

    </div>
    <!--Modal para CRUD-->
    <div class="modal fade" id="modalCRUD" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel"></h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                            aria-hidden="true">&times;</span>
                    </button>
                </div>
                <!--Start form "personas"-->
                <?php require_once "vistas/form_personas.php" ?>
                <!--End form personas-->
            </div>
        </div>
    </div>
    <!--End Modal para CRUD-->
</body>

<?php require_once "vistas/parte_inferior.php" ?>