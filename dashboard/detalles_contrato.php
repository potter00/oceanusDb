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
include_once '../../loginBase/bd/conexion.php';
include_once '../dashboard/bd/funcionesdb.php';
$objeto = new Conexion();
$conexion = $objeto->Conectar();

$query = "SELECT * FROM contrato";
$resultado = $conexion->prepare($query);
$resultado->execute();
$contratos = $resultado->fetchAll(PDO::FETCH_ASSOC);
foreach ($contratos as $contrato) {
    if ($contrato['idContrato'] == $_GET['idContrato']) {
        $contratoSeleccionado = $contrato;
    }
}

$datosFianzas = obtenerFianzaContrato($contratoSeleccionado['idContrato'], $conexion);




?>

<body>
    <div class="container">

        <div class="data-list">
            <h2>Detalles del Contrato</h2>
            <ul>
                <li><strong>Nombre del Contrato: </strong>
                    <?php echo $contratoSeleccionado['nombreContrato'] ?>
                </li>
                <li><strong>Ubicacion Del Contrato: </strong>
                    <?php echo $contratoSeleccionado['direccion'] ?>
                </li>
                <li><strong>Contratante: </strong>
                    <?php
                    $direccion = "indexdb.php?table=empresas&idEmpresa=" . $contratoSeleccionado['idContratante'];
                    echo '<a  href="' . $direccion . '">' . obtenerNombreEmpresa($contratoSeleccionado['idContratante'], $conexion) . '</a>';


                    ?>
                </li>
                <li><strong>Contratado: </strong>
                    <?php echo obtenerNombreEmpresa($contratoSeleccionado['idContratado'], $conexion) ?>
                </li>
                <li><Strong>Tipo de contrato: </Strong> <?php echo $contratoSeleccionado['subContrato'] ?>
                </li>

                <?php
                if ($contratoSeleccionado['subContrato'] == 'SubContrato') {
                    echo '<li>';
                    $contratoFuente = obtenerContrato($contratoSeleccionado['idContratoFuente'], $conexion);
                    $direccion = "indexdb.php?table=contratos&idContrato=" . $contratoFuente['idContrato'] . "&seccion=detalles";
                    echo '<p><Strong>Contrato Fuente: </Strong><a  href="' . $direccion . '">' . $contratoFuente['titulo'] . '</a> </p>';
                    echo '</li>';
                }


                ?>

                <li><Strong>Fecha de inicio: </Strong> <?php echo $contratoSeleccionado['inicioContrato'] ?>
                </li>
                <li><Strong>Fecha de fin: </Strong> <?php echo $contratoSeleccionado['finContrato'] ?>
                </li>
                <li><strong>Monto de Contrato:
                    </strong><?php echo '$' . number_format($contratoSeleccionado['montoContrato'], 2, '.', ',') ?></li>
                <li><strong>Anticipo:
                    </strong><?php echo '$' . number_format($contratoSeleccionado['anticipoContrato'], 2, '.', ',') ?>
                </li>

            </ul>
            <hr>
            <div class="container">
                <?php

                $conveniosContrato = ObtenerConvenios($_GET['idContrato'], $conexion);
                $convenios = ObtenerTabla('convenio', $conexion);

                if ($conveniosContrato != 'Convenios no encontrados') {
                    error_log("Convenios encontrados: " . print_r($conveniosContrato, true));

                    foreach ($conveniosContrato as $convenioContrato) {
                        $convenio = ObtenerFila('convenio', $convenioContrato['idConvenio'], $conexion);
                        echo '<div>';
                        echo '<h5><strong>Convenio </strong><a class="fas fa-download" href="../' . $convenio['documento'] . '"></a></h5>';
                        echo '<p class="conveniosFechaInicio" data-id="' . $convenio['idConvenio'] . '" ><strong>Fecha Inicio Convenio: </strong>' . $convenio['fechaInicio'] . '</p>';
                        echo '<p class="conveniosFechaFin"><strong>Fecha Fin Convenio: </strong>' . $convenio['fechaFinal'] . '</p>';
                        echo '<p class="conveniosMontoAdicional"><strong>Monto Adicional: </strong>' . number_format($convenio['montoAdicional'], 2, '.', ',') . '</p>';
                        
                        echo '</div>';
                    }

                }

                ?>
            </div>
            <hr>
            <br>

        </div>
    </div>
    <br>
    <div class="container">
        <div class="data-list" style="margin-top: 0px;">

            <h5><strong>Fianza De Cumplimiento
                </strong><?php echo '<a class="fas fa-download" href="../' . $datosFianzas['fianzaCumplimiento']['fianzaCumplimientoDoc'] . '"></a>'; ?></i>
            </h5>
            <ul>

                <li><strong>Fecha de Inicio:
                    </strong><?php echo $datosFianzas['fianzaCumplimiento']['fianzaCumplimientoInicio'] ?></li>
                <li><strong>Fecha de Fin:
                    </strong><?php echo $datosFianzas['fianzaCumplimiento']['fianzaCumplimientoFin'] ?></li>
                <li><strong>Monto de Fianza:
                    </strong><?php echo '$' . number_format($datosFianzas['fianzaCumplimiento']['fianzaCumplimientoMonto'], 2, '.', ',') ?>
                </li>
                <li><strong>Numero de poliza:
                    </strong><?php echo $datosFianzas['fianzaCumplimiento']['fianzaCumplimientoPoliza'] ?></li>
                <li><strong>Aseguradora:
                    </strong><?php echo $datosFianzas['fianzaCumplimiento']['fianzaCumplimientoAseguradora'] ?></li>

            </ul>


        </div>

        <div class="data-list" style="position: top;">
            <h5><strong>Fianza de Anticipo
                </strong><?php echo '<a class="fas fa-download" href="../' . $datosFianzas['fianzaAnticipo']['fianzaAnticipoDoc'] . '"></a>'; ?>
            </h5>
            <ul>
                <li><strong>Fecha de Inicio:
                    </strong><?php echo $datosFianzas['fianzaAnticipo']['fianzaAnticipoInicio'] ?>
                </li>
                <li><strong>Fecha de Fin: </strong><?php echo $datosFianzas['fianzaAnticipo']['fianzaAnticipoFin'] ?>
                </li>
                <li><strong>Monto de Fianza:
                    </strong><?php echo '$' . number_format($datosFianzas['fianzaAnticipo']['fianzaAnticipoMonto'], 2, '.', ',') ?>
                </li>
                <li><strong>Numero de poliza:
                    </strong><?php echo $datosFianzas['fianzaAnticipo']['fianzaAnticipoPoliza'] ?>
                </li>
                <li><strong>Aseguradora:
                    </strong><?php echo $datosFianzas['fianzaAnticipo']['fianzaAnticipoAseguradora'] ?>
                </li>
            </ul>
        </div>
        <div class="data-list">
            <h5><strong>Fianza de Vicios Ocultos
                </strong><?php echo '<a class="fas fa-download" href="../' . $datosFianzas['fianzaViciosOcultos']['fianzaViciosOcultosDoc'] . '"></a>'; ?>
            </h5>
            <ul>
                <li><strong>Fecha de Inicio:
                    </strong><?php echo $datosFianzas['fianzaViciosOcultos']['fianzaViciosOcultosInicio'] ?></li>
                <li><strong>Fecha de Fin:
                    </strong><?php echo $datosFianzas['fianzaViciosOcultos']['fianzaViciosOcultosFin'] ?></li>
                <li><strong>Monto de Fianza:
                    </strong><?php echo '$' . number_format($datosFianzas['fianzaViciosOcultos']['fianzaViciosOcultosMonto'], 2, '.', ',') ?>
                </li>
                <li><strong>Numero de poliza:
                    </strong><?php echo $datosFianzas['fianzaViciosOcultos']['fianzaViciosOcultosPoliza'] ?>
                </li>
                <li><strong>Aseguradora:
                    </strong><?php echo $datosFianzas['fianzaViciosOcultos']['fianzaViciosOcultosAseguradora'] ?>
                </li>
            </ul>


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