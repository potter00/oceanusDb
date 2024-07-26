<div style="margin-left: 5%; margin-right: 5%;">
    <?php
    //obtenemos todas las facturas
    include_once '../../loginBase/bd/conexion.php';
    include_once '../../loginBase/dashboard/bd/funcionesdb.php';
    $objeto = new Conexion();
    $conexion = $objeto->Conectar();

    $query = "SELECT * FROM factura";
    $resultado = $conexion->prepare($query);
    $resultado->execute();
    $facturas = $resultado->fetchAll(PDO::FETCH_ASSOC);

    //si la session no existe la iniciamos
    if (!isset($_SESSION)) {
        session_start();
    }
    if (!isset($_SESSION['checkBoxContrato'])) {
        $_SESSION['checkBoxContrato'] = 0;
    }

    foreach ($facturas as $factura) {

        if ($factura['idFactura'] == $_GET['idFactura']) {
            $facturaSeleccionada = $factura;
        }
    }








    ?>


    <div style="float: left; width: 60%;">
        <h1 id="labelEmpresas" style="float: left; width: 60%">Facturas</h1>


        <button style="margin-top: 10px;" type="button" class="btn btn-primary" id="btnFacturaNueva"><i
                class="fas fa-plus"></i> Agregar nuevo elemento</button>
        <br>
        <hr>
        <table class="table table-sm table-striped table-bordered table-condensed" id="tablaFacturas">
            <thead>
                <tr>
                    <th>id</th>
                    <th>Numero Factura</th>
                    <th>importe</th>
                    <th>Nombre</th>
                    <th>Contrato</th>
                    <th>Empresa</th>
                    <th>fecha</th>

                </tr>
            </thead>
            <tbody>
                <?php
                foreach ($facturas as $factura) {
                    if ($_SESSION['checkBoxContrato'] != 0) {
                        $checkBoxContrato = explode(",", $_SESSION['checkBoxContrato']);
                        if (!in_array($factura['idContrato'], $checkBoxContrato)) {
                            continue;
                        }
                    }

                    $ContratoAsociado = ObtenerContrato($factura['idContrato'], $conexion);
                    $direccionContrato = "indexdb.php?table=contratos&idContrato=" . $facturas[0]['idContrato'];

                    $empresaAsociada = ObtenerEmpresa($factura['idEmpresa'], $conexion);
                    $direccionEmpresa = "indexdb.php?tableS=empresas&idEmpresa=" . $facturas[0]['idEmpresa'];
                    ?>
                    <tr>

                        <td style="width:15px"><?php echo $factura['idFactura'] ?></td>
                        <td><?php echo $factura['numero'] ?></td>
                        <td style="width:30px"><?php echo "$" . number_format($factura['importe'], 2) ?></td>
                        <td><?php
                        $direccion = "indexdb.php?table=facturas&idFactura=" . $factura['idFactura'];
                        echo '<a  href="' . $direccion . '">' . $factura['titulo'] . '</a> ';


                        ?></td>
                        <td><?php
                        if ($ContratoAsociado != 'Contrato no encontrado') {
                            echo '<a  href="' . $direccionContrato . '">' . $ContratoAsociado['titulo'] . '</a> ';
                        } else {
                            echo $ContratoAsociado;
                        }
                        ?></td>
                        <td>
                            <?php
                            if ($empresaAsociada != 'Empresa no encontrada') {
                                echo '<a  href="' . $direccionEmpresa . '">' . $empresaAsociada['razonSocial'] . '</a> ';
                            } else {
                                echo $empresaAsociada;
                            }
                            ?>
                        </td>
                        <td style="width:150px"><?php echo $factura['fecha'] ?></td>

                    </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>
    <div style="float: right; width: 35%; margin-left: 20px;">
        <h1><i class="fa fa-info" aria-hidden="true"></i>nformacion</h1>
        <div class="card">
            <div class="card-header">
                <div style="float: left; width: 60%;">
                    <h5 class="card-title"><?php echo $facturaSeleccionada['titulo'] ?></h5>
                    <h6 class="card-subtitle">#<?php echo $facturaSeleccionada['numero'] ?></h6>
                </div>

                <div style="float: right;">
                    <?php
                    if (!isset($_GET['edit'])) {

                        echo '<a class="fas fa-edit" href="indexdb.php?table=facturas&edit=true&idFactura=' . $_GET['idFactura'] . '"></a> <!-- Icono de editar -->';

                    } else {
                        echo '<a class="fas fa-edit" href="indexdb.php?table=facturas&idFactura=' . $_GET['idFactura'] . '"></a> <!-- Icono de editar -->';
                    }

                    if (!isset($_GET['edit'])) {

                        echo '<a class="fas fa-download" href="../' . $facturaSeleccionada['documento'] . '"></a>';

                    } else {
                        echo '<i class="fas fa-upload"></i> <!-- Icono de descarga -->';
                    }

                    ?>
                    <div class="dropdown" style="margin-top: 4px; margin-left:4px; float: right;">
                        <i class="fas fa-cog dropdown-toggle" id="dropdownMenuButton" data-toggle="dropdown"
                            aria-haspopup="true" aria-expanded="false"></i>
                        <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                            <a id="btnEliminarFactura" class="dropdown-item" href="#"><i class="fas fa-trash"></i>
                                Eliminar</a>

                        </div>
                    </div><i class="fas fa-cog"></i> <!-- Icono de configuración -->
                </div>
            </div>
            <div class="card-body" style="line-height: 1.2;">
                <?php
                if (!isset($_GET['edit'])) {
                    ?>
                    <h5><strong>Informacion de la
                            Factura</strong><?php echo '<a class="fas fa-download" href="../' . $facturaSeleccionada['documento'] . '"></a>'; ?>
                    </h5>
                    <p><strong><?php echo $facturaSeleccionada['titulo'] ?></strong></p>
                    <p><strong>Numero de factura: </strong><?php echo $facturaSeleccionada['numero'] ?></p>
                    <p><strong>Fecha de la Factura: </strong><?php echo $facturaSeleccionada['fecha'] ?></p>
                    <p><strong>Importe Total: </strong><?php echo "$" . number_format($facturaSeleccionada['importe'], 2) ?>
                    </p>

                    <p><strong>Contrato Asociado: </strong><?php
                    if ($ContratoAsociado != 'Contrato no encontrado') {
                        echo '<a  href="' . $direccionContrato . '">' . $ContratoAsociado['titulo'] . '</a> ';
                    } else {
                        echo $ContratoAsociado;
                    }
                    ?></p>


                    <p> <strong>Empresa Asociada:</strong>
                        <?php
                        if ($empresaAsociada != 'Empresa no encontrada') {
                            echo '<a  href="' . $direccionEmpresa . '">' . $empresaAsociada['razonSocial'] . '</a> ';
                        } else {
                            echo $empresaAsociada;
                        }


                        ?>

                    </p>

                    <?php
                } else {
                    $contratos = ObtenerTabla('contrato', $conexion);
                    $empresas = ObtenerTabla('empresa', $conexion);

                    ?>
                    <h5 style="max-width: 150px;  float: left; margin-top: 4px;"><strong>Factura</strong>
                    </h5>
                    <button type="button" class="btn btn-sm btnSubirArchivo" data-tipoArchivo="facturas"
                        data-inputFile="inputFileFactura" data-datoExtra="<?php echo $facturaSeleccionada['idContrato'] ?>"
                        data-nombreArchivo="<?php echo 'Factura_' . $facturaSeleccionada['numero'] ?>" data-idContrato="<?php

                             $ContratoAsociado = ObtenerContrato($facturaSeleccionada['idContrato'], $conexion);

                             if ($ContratoAsociado != 'Contrato no encontrado') {
                                 echo $ContratoAsociado['idContrato'];
                             } else {
                                 echo '0';
                             }
                             ?>"><i class="fas fa-upload"></i></button>
                    <input type="file" id="inputFileFactura">
                    <br>
                    <br>
                    <p><strong>Titulo factura </strong><input type="text" id="tituloFactura"
                            value="<?php echo $facturaSeleccionada['titulo'] ?>"></p>
                    <p><strong>Numero de factura: </strong><input type="text" id="numeroFactura"
                            value="<?php echo $facturaSeleccionada['numero'] ?>"></p>
                    <p><strong>Fecha de la Factura: </strong><input type="date" id="fechaFactura"
                            value="<?php echo $facturaSeleccionada['fecha'] ?>"></p>
                    <p><strong>Importe Total: </strong><input type="text" id="importeFactura"
                            value="<?php echo $facturaSeleccionada['importe'] ?>"></p>
                    <p><strong>Contrato Asociado: </strong>

                    </p>
                    <p>Numero contrato: <input type="checkbox" class="checkBoxFacturaContrato"  id="numeroContratoFactura"><select style="max-width: 250px;" id="selectFacturaNumeroContrato">
                        <?php
                        foreach ($contratos as $contrato) {
                            if ($contrato['idContrato'] == $facturaSeleccionada['idContrato']) {
                                # code...
                    
                                echo '<option value="' . $contrato['idContrato'] . '">' . $contrato['numeroContrato'] . '</option>';
                            }
                        }
                        foreach ($contratos as $contrato) {
                            if ($contrato['idContrato'] != $facturaSeleccionada['idContrato']) {
                                # code...
                    
                                echo '<option value="' . $contrato['idContrato'] . '">' . $contrato['numeroContrato'] . '</option>';
                            }
                        }




                        ?>
                    </select></p>
                    <p>Nombre Contrato: <input type="checkbox" class="checkBoxFacturaContrato" data-seleccion="nombre"><select id="selectFacturaContrato">
                        <?php
                        foreach ($contratos as $contrato) {
                            if ($contrato['idContrato'] == $facturaSeleccionada['idContrato']) {
                                # code...
                    
                                echo '<option value="' . $contrato['idContrato'] . '">' . $contrato['titulo'] . '</option>';
                            }
                        }
                        foreach ($contratos as $contrato) {
                            if ($contrato['idContrato'] != $facturaSeleccionada['idContrato']) {
                                # code...
                    
                                echo '<option value="' . $contrato['idContrato'] . '">' . $contrato['titulo'] . '</option>';
                            }
                        }
                        ?>
                    </select></p>
                    
                    <p><strong>Empresa Asociada: </strong>
                        <select id="selectFacturaEmpresa" style="max-width: 250px;">
                            <?php
                            foreach ($empresas as $empresa) {
                                if ($empresa['idEmpresa'] == $facturaSeleccionada['idEmpresa']) {
                                    echo '<option  value="' . $empresa['idEmpresa'] . '">' . $empresa['razonSocial'] . '</option>';
                                }

                            }
                            foreach ($empresas as $empresa) {
                                if ($empresa['idEmpresa'] != $facturaSeleccionada['idEmpresa']) {
                                    echo '<option value="' . $empresa['idEmpresa'] . '">' . $empresa['razonSocial'] . '</option>';
                                }

                            }

                            ?>
                        </select>
                    </p>
                    <button id="btnActualizarFactura" class="btn btn-primary">Guardar</button>
                    <?php
                }
                ?>








            </div>
        </div>
    </div>
</div>
<script>
    <script>
        
            
        
    </script>
</script>