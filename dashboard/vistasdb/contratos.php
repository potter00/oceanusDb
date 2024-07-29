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

<div style="margin-left: 5%; margin-right: 5%;">



    <div style="float: left; width: 60%;">
        <h1 id="labelEmpresas" style="float: left; width: 60%">Contratos</h1>
        <button style="margin-top: 10px;" type="button" class="btn btn-primary" id="btnContratoNuevo"><i
                class="fas fa-plus"></i> Agregar nuevo elemento</button>
        <hr>
        <h2 style="float: left; margin-right: 5px;">Subir excel</h2>

        <input type="file" id="inputFileExecelContratos">
        <button class="btn btn-sm btn-primary" id="btnInputFileExecelContratos">Subir</button>
        <br><br>
        <hr>

        <table id="tablaContratos" class="table table-sm table-striped table-bordered table-condensed">
            <thead>
                <tr>
                    <th>id</th>
                    <th>Titulo</th>
                    <th>Nombre Del Contrato</th>
                    <th>Numero de contrato</th>
                    
                    <th>Contratante</th>
                    <th>Contratado</th>
                    <th>Tipo de Contrato</th>
                    <th>Inicio Contrato</th>
                    <th>Fin Contrato</th>
                    <th>Monto Contrato</th>
                    <th>Anticipo Contrato</th>
                    <th>SubContratos</th>
                    <th>Vigencia</th>
                    <th>Seleccionar</th>
                    <th>Direccion</th>

                </tr>
            </thead>
            <tbody>
                <?php foreach ($contratos as $contrato) {

                    if (isset($_GET['paginaActual'])) {

                        $direccion = "indexdb.php?table=contratos&idContrato=" . $contrato['idContrato'] . "&seccion=subcontratos&paginaActual=" . $_GET['paginaActual'];
                        $direccionDetalles = "indexdb.php?table=contratos&idContrato=" . $contrato['idContrato'] . "&seccion=detalles&paginaActual=" . $_GET['paginaActual'];
                        $redirreccionContratante = 'indexdb.php?table=empresas&idEmpresa=' . $contratoSeleccionado['idContrato'] . '&paginaActual=' . $_GET['paginaActual'];
                    } else {
                        $direccion = "indexdb.php?table=contratos&idContrato=" . $contrato['idContrato'] . "&seccion=subcontratos";
                        $direccionDetalles = "indexdb.php?table=contratos&idContrato=" . $contrato['idContrato'] . "&seccion=detalles";
                        $redirreccionContratante = 'indexdb.php?table=empresas&idEmpresa=' . $contratoSeleccionado['idContrato'];
                    }

                    if ($contrato['subContrato'] == 'Cotizacion') {
                        continue;
                    }
                    ?>
                    <tr>
                        <td><?php echo $contrato['numeroControl'] ?></td>
                        <td class="text-lowercase">
                            <?php echo '<a class="linkContrato" href="' . $direccionDetalles . '">' . $contrato['titulo'] . '</a> '; ?>
                        </td>

                        <td class="text-lowercase"><?php echo '<a class="linkContrato" href="' . $direccionDetalles . '">' . $contrato['nombreContrato'] . '</a> '; ?></td>
                        <td><?php echo $contrato['numeroContrato'] ?></td>
                        <td class="text-lowercase" style="max-width: 50px;"><?php
                        echo '<a  href="' . $redirreccionContratante . '">' . obtenerNombreEmpresa($contrato['idContratante'], $conexion) . '</a> ';

                        ?></td>
                        <td class="text-lowercase"><?php echo obtenerNombreEmpresa($contrato['idContratado'], $conexion) ?>
                        </td>
                        <td class="text-lowercase"><?php echo $contrato['subContrato'] ?></td>
                       
                        <td><?php echo $contrato['inicioContrato'] ?></td>
                        <td><?php echo $contrato['finContrato'] ?></td>
                        <td><?php echo $contrato['montoContrato'] ?></td>
                        <td><?php echo $contrato['anticipoContrato'] ?></td>
                        <td class="text-lowercase">
                            <?php echo '<a  href="' . $direccion . '">' . 'SubContratos' . '</a> '; ?>
                        </td>

                        <?php

                        $estadoContrato = VerificarFecha($contrato['finContrato']);


                        $conveniosContrato = ObtenerConvenios($contrato['idContrato'], $conexion);
                        $convenios = ObtenerTabla('convenio', $conexion);


                        if ($conveniosContrato != 'Convenios no encontrados') {
                            error_log("Convenios encontrados: " . print_r($conveniosContrato, true));


                            //obtenemos el ultimo convenio de la lista 
                            $convenioContrato = end($conveniosContrato);


                            $convenio = ObtenerFila('convenio', $convenioContrato['idConvenio'], $conexion);

                            $estadoConvenio = VerificarFecha($convenio['fechaFinal']);
                            if ($estadoConvenio == 1) {
                                echo '<td style="color: red;">Vencido</td>';
                                # code...
                            } else {
                                echo '<td style="color: green;">Vigente</td>';
                            }



                        } else {
                            # code...
                    


                            if ($estadoContrato == 1) {
                                echo '<td style="color: red;">Vencido</td>';
                            } else {
                                echo '<td style="color: green;">Vigente</td>';
                            }
                        }








                        //si la sesion no esta iniciada la iniciamos
                        if (!isset($_SESSION)) {
                            session_start();
                        }


                        echo '<td><input data-idContrato="' . $contrato['idContrato'] . '" type="checkbox" name="checkBoxContrato" class="checkBoxContrato"></td>';



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
                    <h5 class="card-title text-lowercase"><a
                            href="<?php echo "detalles_contrato.php?idContrato=" . $contratoSeleccionado['idContrato'] ?>"><?php echo $contratoSeleccionado['nombreContrato'] ?></a>
                    </h5>
                    <h6 class="card-subtitle">Contrato #<?php echo $contratoSeleccionado['numeroContrato'] ?></h6>
                    <h6 class="card-subtitle">Numero de control #<?php echo $contratoSeleccionado['numeroControl'] ?>
                    </h6>
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
                                echo '<a class="fas fa-edit" href="indexdb.php?table=contratos&seccion=subcontratos&idContrato=' . $_GET['idContrato'] . '"></a> <!-- Icono de editar -->';

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

                        if ($contratoSeleccionado['ubicacionContrato'] != null) {
                            # code...
                    
                            echo '<a class="fas fa-download" href="" id="DescargarZipContrato">  </a>';
                        } else {
                            echo '<i class="fas fa-download"></i> <!-- Icono de descarga -->';
                        }
                    }
                    ?>

                    <div class="dropdown" style="margin-top: 4px; margin-left:4px; float: right;">
                        <i class="fas fa-cog dropdown-toggle" id="dropdownMenuButton" data-toggle="dropdown"
                            aria-haspopup="true" aria-expanded="false"></i>
                        <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                            <button id="btnEliminarContrato" class="dropdown-item btn" type="button"><i
                                    class="fas fa-trash"></i>
                                Eliminar</button>
                            <button id="btnCrearConvenio" class="dropdown-item btn" type="button"><i
                                    class="fas fa-plus"></i>
                                Crear Convenio</button>

                        </div>
                    </div> <!-- Icono de configuración -->
                </div>
            </div>
            <div class="card-body" style="line-height: 1.2;">
                <?php
                if (isset($_GET['seccion'])) {
                    // Sanitize the input to prevent potential security issues
                    $seccion = htmlspecialchars($_GET['seccion']);
                    error_log($seccion);

                    // Use forward slashes for paths
                    if ($seccion == 'detalles') {
                        require_once 'Contratos/detalles.php';
                    } elseif ($seccion == 'personal') {
                        require_once 'Contratos/personal.php';
                    } elseif ($seccion == 'subcontratos') {
                        require_once 'Contratos/subcontratos.php';
                    } else {
                        // Handle unexpected 'seccion' values
                        require_once 'Contratos/detalles.php';
                    }
                } else {
                    require_once 'Contratos/detalles.php';
                }

                // Close database connection if it's defined
                if ($conexion !== null) {
                    $conexion = null;
                }
                ?>



            </div>
        </div>
    </div>
</div>
<script>
    // Obtener todos los checkboxes del grupo
    var checkboxes = document.querySelectorAll('.checkBoxContrato');
    /*
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
    */
    // Agregar un listener de evento a cada checkbox
    checkboxes.forEach(function (checkbox) {
        checkbox.addEventListener('change', seleccionUnica);
    });
</script>