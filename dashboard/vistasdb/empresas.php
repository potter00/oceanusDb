<?php
include_once '../../loginBase/bd/conexion.php';
include_once '../../loginBase/dashboard/bd/funcionesdb.php';
$objeto = new Conexion();
$conexion = $objeto->Conectar();

$query = "SELECT * FROM empresa";
$resultado = $conexion->prepare($query);
$resultado->execute();
$empresas = $resultado->fetchAll(PDO::FETCH_ASSOC);
$empresaResultante = 0;
foreach ($empresas as $empresa) {
    if ($empresa['idEmpresa'] == $_GET['idEmpresa']) {
        $empresaResultante = $empresa;
    }
}

//si la session no existe la iniciamos
if (!isset($_SESSION)) {
    session_start();
}




?>

<div class="container">


    <div style="float: left; width: 60%;">
        <h1 id="labelEmpresas" style="float: left; width: 60%">Empresas</h1>


        <button style="margin-top: 10px;" type="button" class="btn btn-primary" id="btnEmpresaNuevo"><i
                class="fas fa-plus"></i> Agregar nuevo elemento</button>
        <br>
        <hr>

        <table id="tablaEmpresas" class="table table-sm table-striped table-bordered table-condensed">
            <thead>
                <tr>
                    <th>id</th>
                    <th>Razon Social</th>
                    <th>RepresentanteLegal</th>
                    <th>RFC</th>
                    <th>Tipo de Regimen</th>
                    <th>Contacto</th>
                    <th>Correo</th>
                    <th>Telefono</th>
                    <th>Correo Facturacion</th>
                    <th>Numero de cuenta</th>
                    <th>Banco</th>
                    <th>Fecha Vencimiento Constancia</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($empresas as $empresa) {
                    $idEmpresa = $empresa['idEmpresa'];

                    $direccion = "indexdb.php?table=empresas&idEmpresa=" . $idEmpresa;
                    $razonSocial = $empresa['razonSocial']

                        ?>
                    <tr>
                        <td style="width:15px"><?php echo $empresa['idEmpresa'] ?></td>
                        <td><?php echo '<a  href="' . $direccion . '">' . $razonSocial . '</a> '; ?></td>
                        <td><?php echo $empresa['representanteLegal'] ?></td>
                        <td><?php echo $empresa['rfc'] ?></td>
                        <td><?php echo $empresa['tipoRegimen'] ?></td>
                        <td><?php echo $empresa['nombreContacto'] ?></td>
                        <td><?php echo $empresa['correo'] ?></td>
                        <td><?php echo $empresa['telefono'] ?></td>
                        <td><?php echo $empresa['numeroCuenta'] ?></td>
                        <td><?php echo $empresa['banco'] ?></td>
                        <td><?php echo $empresa['fechaVencimientoConstancia'] ?></td>
                        <td></td>
                    </tr>
                <?php } ?>
            </tbody>

        </table>
    </div>
    <div style="float: right; width: 35%; margin-left: 20px;">
        <h1><i class="fa fa-info" aria-hidden="true"></i>nformacion</h1>
        <div class="card">
            <div class="card-header">
                <div style="float: left; width: 65%;">
                    <h5 class="card-title"><?php echo $empresaResultante['razonSocial'] ?></h5>
                    <h6 class="card-subtitle"><?php echo $empresaResultante['tipoRegimen'] ?></h6>
                </div>
                <div style="float: right;">
                    <?php
                    if (!isset($_GET['edit'])) {

                        $direcion = "indexdb.php?table=empresas&edit=true&idEmpresa=" . $_GET['idEmpresa'];
                        echo '<a class="fas fa-edit" href="' . $direcion . '"></a> <!-- Icono de editar -->';



                    } else {

                        $direccion = "indexdb.php?table=empresas&idEmpresa=" . $_GET['idEmpresa'];
                        echo '<a class="fas fa-edit" href="' . $direccion . '"></a> <!-- Icono de editar -->';


                    }

                    if (!isset($_GET['edit'])) {

                        echo '<i class="fas fa-download"></i> <!-- Icono de descarga -->';

                    } else {
                        echo '<i class="fas fa-upload"></i> <!-- Icono de descarga -->';
                    }

                    ?>
                    <div class="dropdown" style="margin-top: 4px; margin-left:4px; float: right;">
                        <i class="fas fa-cog dropdown-toggle" id="dropdownMenuButton" data-toggle="dropdown"
                            aria-haspopup="true" aria-expanded="false"></i>
                        <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                            <a id="btnEliminarEmpresa" class="dropdown-item" href="#"><i class="fas fa-trash"></i>
                                Eliminar</a>

                        </div>
                    </div>
                </div>
            </div>
            <div class="card-body" style="line-height: .8;">
                <?php
               




                if (!isset($_GET['edit'])) {
                    ?>
                    <h5><strong>Informacion de la empresa </strong><i class="fas fa-download"></i></h5>
                    <br>
                    <p><strong> <?php echo $empresaResultante['razonSocial'] ?></strong></p>
                    <p><strong>Representante Legal: </strong><?php echo $empresaResultante['representanteLegal'] ?></p>
                    <hr>
                    <h5><strong>Datos de Facturacion</strong></h5>
                    <br>
                    <p><strong>RFC: </strong><?php echo $empresaResultante['rfc'] ?></p>
                    <p><strong>Tipo de Regimen: </strong><?php echo $empresaResultante['tipoRegimen'] ?></p>
                    <p><strong>Numero De Cuenta/Clave: </strong><?php echo $empresaResultante['numeroCuenta'] ?></p>
                    <p><strong>Banco: </strong><?php echo $empresaResultante['banco'] ?></p>
                    <p><strong>Correo Facturacion: </strong><?php echo $empresaResultante['correoFacturacion'] ?></p>
                    <p><strong>Fecha Vencimiento Constancia: </strong><?php echo $empresaResultante['fechaVencimientoConstancia'] ?></p>
                    <p><Strong>Tiempo hasta el vencimiento: </Strong><?php echo ObtenerTiempoRestante($empresaResultante['fechaVencimientoConstancia'])  ?> dias</p>

                    <hr>
                    <h5><strong>Contacto</strong></h5>
                    <br>
                    <p><strong>Contacto: </strong><?php echo $empresaResultante['nombreContacto'] ?></p>
                    <p><strong>Correo: </strong><?php echo $empresaResultante['correo'] ?></p>
                    <p><strong>Telefono: </strong><?php echo $empresaResultante['telefono'] ?></p>

                <?php } else { ?>
                    <h5><strong>Informacion de la empresa </strong><i class="fas fa-download"></i></h5>
                    <br>
                    <p><strong>Razon Social </strong><input type="text" id="empresaRazonSocial" value="<?php echo $empresaResultante['razonSocial'] ?>"></p>
                    <p><strong>Representante Legal: </strong><input type="text" id="empresaRepresentantes" value="<?php echo $empresaResultante['representanteLegal'] ?>"></p>
                    <hr>
                    <h5><strong>Datos de Facturacion</strong></h5>
                    <br>
                    <p><strong>RFC: </strong><input type="text" id="empresaRFC" value="<?php echo $empresaResultante['rfc'] ?>"></p>
                    <p><strong>Tipo de Regimen: </strong><input type="text" id="empresaTipoRegimen" value="<?php echo $empresaResultante['tipoRegimen'] ?>"></p>
                    <p><strong>Numero De Cuenta: </strong><input type="text" id="empresaNumeroCuenta" value="<?php echo $empresaResultante['numeroCuenta'] ?>"></p>
                    <p><strong>Banco: </strong><input type="text" id="empresaBanco" value="<?php echo $empresaResultante['banco'] ?>"></p>
                    <p><strong>Correo Facturacion: </strong><input type="text" id="empresaCorreoFacturacion" value="<?php echo $empresaResultante['correoFacturacion'] ?>"></p>
                    <p><strong>Fecha Vencimiento Constancia: </strong><input type="date" id="empresaFechaVencimientoConstancia" value="<?php echo $empresaResultante['fechaVencimientoConstancia'] ?>"></p>
                    

                    <hr>
                    <h5><strong>Contacto</strong></h5>
                    <br>
                    <p><strong>Contacto: </strong><input type="text" id="empresaNombreContacto" value="<?php echo $empresaResultante['nombreContacto'] ?>"></p>
                    <p><strong>Correo: </strong><input type="text" id="empresaCorreo" value="<?php echo $empresaResultante['correo'] ?>"></p>
                    <p><strong>Telefono: </strong><input type="text" id="empresaTelefono" value="<?php echo $empresaResultante['telefono'] ?>"></p>
                    <hr>
                    <p><strong>Url Del Logo: </strong><input type="text" value="<?php echo $empresaResultante['logo'] ?>" id="empresaLogo"></p>
                    <button id="btnGuardarEmpresa" class="btn btn-primary">Guardar</button>

                <?php }
                $conexion = null;
                ?>







            </div>
        </div>
    </div>
</div>