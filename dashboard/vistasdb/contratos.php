

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



?>

<div class="container">
    <div>
        <?php include 'botonesNav.php'; ?>
    </div>

    <div style="float: left; width: 60%;">
        <h1>Contratos</h1>
        <table id="tablaContratos" class="table table-sm table-striped table-bordered table-condensed">
            <thead>
                <tr>
                    <th>id</th>
                    <th>Titulo</th>
                    <th>Nombre Del Contrato</th>
                    <th>Contratante</th>
                    <th>Contratado</th>
                    <th>Tipo de Contrato</th>
                    <th>Numero de contrato</th>
                    <th>Inicio Contrato</th>
                    <th>Fin Contrato</th>
                    <th>Monto Contrato</th>
                    <th>Anticipo Contrato</th>
                    
                </tr>
            </thead>
            <tbody>
                <?php foreach ($contratos as $contrato) { ?>
                    <tr>
                        <td><?php echo $contrato['idContrato'] ?></td>
                        <td><?php echo $contrato['titulo'] ?></td>
                        <td><?php echo $contrato['nombreContrato'] ?></td>
                        <td><?php echo obtenerNombreEmpresa($contrato['idContrato'],$conexion) ?></td>
                        <td><?php echo obtenerNombreEmpresa($contrato['idContratado'],$conexion) ?></td>
                        <td><?php echo $contrato['subContrato'] ?></td>
                        <td><?php echo $contrato['numeroContrato'] ?></td>
                        <td><?php echo $contrato['inicioContrato'] ?></td>
                        <td><?php echo $contrato['finContrato'] ?></td>
                        <td><?php echo $contrato['montoContrato'] ?></td>
                        <td><?php echo $contrato['anticipoContrato'] ?></td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>
    <div style="float: right; width: 35%; margin-left: 20px;">
        <h1><i class="fa fa-info" aria-hidden="true"></i>nformacion</h1>

        <div class="btn-group" role="group" aria-label="Grupo de botones" style="width: 100%;">
            <a href="indexdb.php?table=contratos&seccion=detalles" class="btn btn-primary">Detalles</a>
            <a href="indexdb.php?table=contratos&seccion=personal" class="btn btn-primary">Personal</a>
            <a href="indexdb.php?table=contratos&seccion=subcontratos" class="btn btn-primary">SubContrados</a>

        </div>
        <br>
        <div class="card">
            <div class="card-header">
                <div style="float: left; width: 60%;">
                    <h5 class="card-title">Título</h5>
                    <h6 class="card-subtitle">Subtítulo</h6>
                </div>
                <div style="float: right;">
                    <?php
                    if (!isset($_GET['edit'])) {
                        
                    
                        if (isset($_GET['seccion']) ) {

                            if ($_GET['seccion'] == 'detalles') {
                                echo '<a class="fas fa-edit" href="indexdb.php?table=contratos&seccion=detalles&edit=true"></a> <!-- Icono de editar -->';
                            } elseif ($_GET['seccion'] == 'personal') {
                                echo '<a class="fas fa-edit" href="indexdb.php?table=contratos&seccion=personal&edit=true"></a> <!-- Icono de editar -->';
                            } elseif ($_GET['seccion'] == 'subcontratos') {
                                echo '<a class="fas fa-edit" href="indexdb.php?table=contratos&seccion=subcontratos&edit=true"></a> <!-- Icono de editar -->';

                            }

                        } else {
                            echo '<a class="fas fa-edit" href="indexdb.php?table=contratos&seccion=detalles&edit=true"></a> <!-- Icono de editar -->';
                        }
                    }else {
                        if (isset($_GET['seccion'])) {

                            if ($_GET['seccion'] == 'detalles') {
                                echo '<a class="fas fa-edit" href="indexdb.php?table=contratos&seccion=detalles"></a> <!-- Icono de editar -->';
                            } elseif ($_GET['seccion'] == 'personal') {
                                echo '<a class="fas fa-edit" href="indexdb.php?table=contratos&seccion=personal"></a> <!-- Icono de editar -->';
                            } elseif ($_GET['seccion'] == 'subcontratos') {
                                echo '<a class="fas fa-edit" href="indexdb.php?table=contratos&seccion=subcontratos"></a> <!-- Icono de editar -->';

                            }

                        } else {
                            echo '<a class="fas fa-edit" href="indexdb.php?table=contratos&seccion=detalles&edit=false"></a> <!-- Icono de editar -->';
                        }
                    }
                    ?>
                    <?php 
                    if (isset($_GET['edit'])) {
                        echo '<i class="fas fa-upload"></i>';
                    }else {
                        echo '<i class="fas fa-download"></i> <!-- Icono de descarga -->';
                    }
                    ?>
                    
                    <i class="fas fa-cog"></i> <!-- Icono de configuración -->
                </div>
            </div>
            <div class="card-body" style="line-height: .8;">
                <?php

                if (isset($_GET['seccion'])) {
                    error_log($_GET['seccion']);
                    if ($_GET['seccion'] == 'detalles') {
                        require_once 'Contratos\detalles.php';
                    } elseif ($_GET['seccion'] == 'personal') {
                        require_once 'Contratos\personal.php';
                    } elseif ($_GET['seccion'] == 'subcontratos') {
                        require_once 'Contratos\subcontratos.php';
                    }

                } else {
                    require_once 'Contratos\detalles.php';
                }

                $conexion = null;
                ?>


            </div>
        </div>
    </div>
</div>