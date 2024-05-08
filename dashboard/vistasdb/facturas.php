<div class="container">
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
        <h1>Facturas</h1>
        <table class="table table-sm table-striped table-bordered table-condensed" id="tablaFacturas">
            <thead>
                <tr>
                    <th>id</th>
                    <th>Nombre</th>
                    <th>Contrato</th>
                    <th>Empresa</th>
                    <th>fecha</th>
                    <th>importe</th>
                </tr>
            </thead>
            <tbody>
                <?php
                foreach ($facturas as $factura) {
                    if ($_SESSION['checkBoxContrato'] != 0) {
                        if ($factura['idContrato'] != $_SESSION['checkBoxContrato']) {
                            continue;
                        }
                    }

                    $ContratoAsociado = ObtenerContrato($factura['idContrato'], $conexion);
                    $direccionContrato = "indexdb.php?table=contratos&idContrato=" . $facturas[0]['idContrato'];

                    $empresaAsociada = ObtenerEmpresa($factura['idEmpresa'], $conexion);
                    $direccionEmpresa = "indexdb.php?table=empresas&idEmpresa=" . $facturas[0]['idEmpresa'];
                    ?>
                    <tr>

                        <td style="width:15px"><?php echo $factura['idFactura'] ?></td>
                        <td><?php echo $factura['titulo'] ?></td>
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
                        <td style="width:150px"><?php echo $facturas[0]['fecha'] ?></td>
                        <td style="width:30px"><?php echo $facturas[0]['importe'] ?></td>
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
                    <h5 class="card-title">Título</h5>
                    <h6 class="card-subtitle">Subtítulo</h6>
                </div>
                <div style="float: right;">
                    <?php
                    if (!isset($_GET['edit'])) {

                        echo '<a class="fas fa-edit" href="indexdb.php?table=facturas&edit=true"></a> <!-- Icono de editar -->';

                    } else {
                        echo '<a class="fas fa-edit" href="indexdb.php?table=facturas"></a> <!-- Icono de editar -->';
                    }

                    if (!isset($_GET['edit'])) {

                        echo '<i class="fas fa-download"></i> <!-- Icono de descarga -->';

                    } else {
                        echo '<i class="fas fa-upload"></i> <!-- Icono de descarga -->';
                    }

                    ?>
                    <i class="fas fa-cog"></i> <!-- Icono de configuración -->
                </div>
            </div>
            <div class="card-body" style="line-height: .8;">
                <?php
                if (!isset($_GET['edit'])) {
                    ?>
                    <h5><strong>Informacion de la Factura</strong><i class="fas fa-download"></i></h5>
                    <p><strong><?php echo $facturaSeleccionada['titulo'] ?></strong></p>
                    <p><strong>Numero de factura: </strong><?php echo $facturaSeleccionada['numero'] ?></p>
                    <p><strong>Fecha de la Factura: </strong><?php echo $facturaSeleccionada['fecha'] ?></p>
                    <p><strong>Importe Total: </strong><?php echo $facturaSeleccionada['importe'] ?></p>

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
                    ?>
                    <h5><strong>Informacion de la Factura</strong><i class="fas fa-upload"></i></h5>
                    <p><strong>Titulo factura </strong><input type="text"></p>
                    <p><strong>Numero de factura: </strong><input type="text"></p>
                    <p><strong>Fecha de la Factura: </strong><input type="date"></p>
                    <p><strong>Importe Total: </strong><input type="text"></p>
                    <?php
                }
                ?>








            </div>
        </div>
    </div>
</div>