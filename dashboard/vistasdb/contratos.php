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

<div class="container">


    <div style="float: left; width: 60%;">
        <h1 id="labelEmpresas" style="float: left; width: 60%">Contratos</h1>
        <button style="margin-top: 10px;" type="button" class="btn btn-primary" id="btnContratoNuevo"><i
                class="fas fa-plus"></i> Agregar nuevo elemento</button>
        <hr>
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
                    <th>SubContratos</th>
                    <th>Seleccionar</th>
                    <th>Direccion</th>

                </tr>
            </thead>
            <tbody>
                <?php foreach ($contratos as $contrato) {
                    $direccion = "indexdb.php?table=contratos&idContrato=" . $contrato['idContrato'] . "&seccion=subcontratos";
                    $direccionDetalles = "indexdb.php?table=contratos&idContrato=" . $contrato['idContrato'] . "&seccion=detalles";

                    ?>
                    <tr>
                        <td><?php echo $contrato['idContrato'] ?></td>
                        <td><?php echo '<a  href="' . $direccionDetalles . '">' . $contrato['titulo'] . '</a> '; ?></td>

                        <td><?php echo $contrato['nombreContrato'] ?></td>
                        <td><?php echo obtenerNombreEmpresa($contrato['idContrato'], $conexion) ?></td>
                        <td><?php echo obtenerNombreEmpresa($contrato['idContratado'], $conexion) ?></td>
                        <td><?php echo $contrato['subContrato'] ?></td>
                        <td><?php echo $contrato['numeroContrato'] ?></td>
                        <td><?php echo $contrato['inicioContrato'] ?></td>
                        <td><?php echo $contrato['finContrato'] ?></td>
                        <td><?php echo $contrato['montoContrato'] ?></td>
                        <td><?php echo $contrato['anticipoContrato'] ?></td>
                        <td><?php echo '<a  href="' . $direccion . '">' . 'SubContratos' . '</a> '; ?></td>

                        <?php
                        //si la sesion no esta iniciada la iniciamos
                        if (!isset($_SESSION)) {
                            session_start();
                        }

                        if ($_SESSION['checkBoxContrato'] == $contrato['idContrato']) {

                            echo '<td><input type="checkbox" name="checkBoxContrato" class="checkBoxContrato" checked></td>';
                        } else {
                            echo '<td><input type="checkbox" name="checkBoxContrato" class="checkBoxContrato"></td>';


                        }

                        ?>
                        <td><?php echo $contrato['direccion'] ?></td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>
    <div style="float: right; width: 35%; margin-left: 20px;">
        <h1><i class="fa fa-info" aria-hidden="true"></i>nformacion</h1>

        <div class="btn-group" role="group" aria-label="Grupo de botones" style="width: 100%;">
            <?php
            $redirreccionDetalles = 'indexdb.php?table=contratos&seccion=detalles&idContrato=' . $contratoSeleccionado['idContrato'];
            $redirreccionPersonal = 'indexdb.php?table=contratos&seccion=personal&idContrato=' . $contratoSeleccionado['idContrato'];
            $redirreccionSubcontratos = 'indexdb.php?table=contratos&seccion=subcontratos&idContrato=' . $contratoSeleccionado['idContrato'];

            echo '<a href="' . $redirreccionDetalles . '" class="btn btn-primary">Detalles</a>';
            echo '<a href="' . $redirreccionPersonal . '" class="btn btn-primary">Personal</a>';
            echo '<a href="' . $redirreccionSubcontratos . '" class="btn btn-primary">SubContrados</a>';
            ?>

        </div>
        <br>
        <div class="card">
            <div class="card-header">
                <div style="float: left; width: 60%;">
                    <h5 class="card-title"><?php echo $contratoSeleccionado['titulo'] ?></h5>
                    <h6 class="card-subtitle">Contrato #<?php echo $contratoSeleccionado['numeroContrato'] ?></h6>
                </div>
                <div style="float: right;">
                    <?php
                    if (!isset($_GET['edit'])) {


                        if (isset($_GET['seccion'])) {

                            if ($_GET['seccion'] == 'detalles') {
                                echo '<a class="fas fa-edit" href="indexdb.php?table=contratos&seccion=detalles&edit=true&idContrato=' . $_GET['idContrato'] . '"></a> <!-- Icono de editar -->';
                            } elseif ($_GET['seccion'] == 'personal') {
                                echo '<a class="fas fa-edit" href="indexdb.php?table=contratos&seccion=personal&edit=true&idContrato=' . $_GET['idContrato'] . '"></a> <!-- Icono de editar -->';
                            } elseif ($_GET['seccion'] == 'subcontratos') {
                                echo '<a class="fas fa-edit" href="indexdb.php?table=contratos&seccion=subcontratos&edit=true&idContrato=' . $_GET['idContrato'] . '"></a> <!-- Icono de editar -->';

                            }

                        } else {
                            echo '<a class="fas fa-edit" href="indexdb.php?table=contratos&seccion=detalles&edit=true&idContrato=' . $_GET['idContrato'] . '"></a> <!-- Icono de editar -->';
                        }
                    } else {
                        if (isset($_GET['seccion'])) {

                            if ($_GET['seccion'] == 'detalles') {
                                echo '<a class="fas fa-edit" href="indexdb.php?table=contratos&seccion=detalles&idContrato=' . $_GET['idContrato'] . '"></a> <!-- Icono de editar -->';
                            } elseif ($_GET['seccion'] == 'personal') {
                                echo '<a class="fas fa-edit" href="indexdb.php?table=contratos&seccion=personal&idContrato=' . $_GET['idContrato'] . '"></a> <!-- Icono de editar -->';
                            } elseif ($_GET['seccion'] == 'subcontratos') {
                                echo '<a class="fas fa-edit" href="indexdb.php?table=contratos&seccion=subcontratos&idContrato=' . $_GET['idContrato'] . '"></a> <!-- Icono de editar -->';

                            }

                        } else {
                            echo '<a class="fas fa-edit" href="indexdb.php?table=contratos&seccion=detalles&edit=false&idContrato=' . $_GET['idContrato'] . '"></a> <!-- Icono de editar -->';
                        }
                    }
                    ?>
                    <?php
                    if (isset($_GET['edit'])) {
                        echo '<i class="fas fa-upload"></i>';
                    } else {
                        echo '<i class="fas fa-download"></i> <!-- Icono de descarga -->';
                    }
                    ?>

                    <div class="dropdown" style="margin-top: 4px; margin-left:4px; float: right;">
                        <i class="fas fa-cog dropdown-toggle" id="dropdownMenuButton" data-toggle="dropdown"
                            aria-haspopup="true" aria-expanded="false"></i>
                        <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                            <a id="btnEliminarContrato" class="dropdown-item" href="#"><i class="fas fa-trash"></i>
                                Eliminar</a>
                            <a id="btnCrearConvenio" class="dropdown-item" href="#"><i class="fas fa-plus"></i>
                                Crear Convenio</a>

                        </div>
                    </div> <!-- Icono de configuración -->
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
<script>
    // Obtener todos los checkboxes del grupo
    var checkboxes = document.querySelectorAll('.checkBoxContrato');

    // Función para desactivar los demás checkboxes cuando uno es seleccionado
    function seleccionUnica() {
        // Iterar sobre cada checkbox
        checkboxes.forEach(function (checkbox) {
            // Si el checkbox actual no es el que se ha seleccionado, desactívalo
            if (checkbox !== this) {
                checkbox.disabled = this.checked;
            }
        }, this);
    }

    // Agregar un listener de evento a cada checkbox
    checkboxes.forEach(function (checkbox) {
        checkbox.addEventListener('change', seleccionUnica);
    });
</script>