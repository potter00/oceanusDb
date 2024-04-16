

<?php
    include_once '../../loginBase/bd/conexion.php';
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





    ?>

<div class="container">
    <div>
        <?php include 'botonesNav.php'; ?>
    </div>

    <div style="float: left; width: 60%;">
        <h1 id="labelEmpresas" style="float: left; width: 60%">Empresas</h1>
        
        
        <button style="margin-top: 10px;" type="button" class="btn btn-primary" id="btnEmpresaNuevo"><i class="fas fa-plus"></i> Agregar nuevo elemento</button>
        <br><br><hr>
        
        <table id="tablaEmpresas" class="table table-sm table-striped table-bordered table-condensed">
            <thead>
                <tr>
                    <th>id</th>
                    <th>Razon Social</th>
                    <th>RFC</th>
                    <th>Tipo de Regimen</th>
                    <th>Representante</th>
                    <th>Correo</th>
                    <th>Telefono</th>
                    
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
                        <td><?php echo '<a  href="' . $direccion . '">'. $razonSocial . '</a> '; ?></td>
                        <td><?php echo $empresa['rfc'] ?></td>
                        <td><?php echo $empresa['tipoRegimen'] ?></td>
                        <td><?php echo $empresa['representanteLegal'] ?></td>
                        <td><?php echo $empresa['correo'] ?></td>
                        <td><?php echo $empresa['telefono'] ?></td>
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
                    <i class="fas fa-cog"></i> <!-- Icono de configuración -->
                </div>
            </div>
            <div class="card-body" style="line-height: .8;">
                <?php
                
                



                if (!isset($_GET['edit'])) {
                    ?>
                    <h5><strong>Informacion de la empresa </strong><i class="fas fa-download"></i></h5>
                    <p><strong> <?php echo $empresaResultante['razonSocial'] ?></strong></p>
                    <p><strong>RFC: </strong><?php echo $empresaResultante['rfc']?></p>
                    <p><strong>Tipo de Regimen: </strong><?php echo $empresaResultante['tipoRegimen']?></p>
                    <p><strong>Representante Legal: </strong><?php echo $empresaResultante['representanteLegal']?></p>
                    <p><strong>Correo: </strong><?php echo $empresaResultante['correo']?></p>
                    <p><strong>Telefono: </strong><?php echo $empresaResultante['telefono']?></p>

                <?php } else { ?>
                    <h5><strong>Informacion de la empresa </strong><i class="fas fa-upload"></i></h5>
                    <p><strong>Razon Social </strong><input type="text" id="empresaRazonSocial" value="<?php echo $empresaResultante['razonSocial'] ?>"></p>
                    <p><strong>RFC: </strong><input type="text" id="empresaRFC" value="<?php echo $empresaResultante['rfc'] ?>"></p>
                    <p><strong>Tipo de Regimen: </strong><input type="text" id="empresaTipoRegimen" value="<?php echo $empresaResultante['tipoRegimen'] ?>"></p>
                    <p><strong>Representante Legal: </strong><input type="text" id="empresaRepresentante" value="<?php echo $empresaResultante['representanteLegal'] ?>"></p>
                    <p><strong>Correo: </strong><input type="text" id="empresaCorreo" value="<?php echo $empresaResultante['correo'] ?>"></p>
                    <p><strong>Telefono: </strong><input type="text" id="empresaTelefono" value="<?php echo $empresaResultante['telefono'] ?>"></p>
                    <p><strong>url del logo: </strong><input type="text" id="empresaLogo" value="<?php echo $empresaResultante['logo'] ?>"></p>
                    <p><button type="submit" class="btn btn-primary" id="btnGuardarEmpresa">Guardar</button></p>
                    
                
                    <?php } ?>
                






            </div>
        </div>
    </div>
</div>