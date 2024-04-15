

<?php
    include_once '../../loginBase/bd/conexion.php';
    $objeto = new Conexion();
    $conexion = $objeto->Conectar();

    $query = "SELECT * FROM empresa";
    $resultado = $conexion->prepare($query);
    $resultado->execute();
    $empresas = $resultado->fetchAll(PDO::FETCH_ASSOC);






    ?>

<div class="container">
    <div>
        <?php include 'botonesNav.php'; ?>
    </div>

    <div style="float: left; width: 60%;">
        <h1>Empresas</h1>
        <table class="table table-sm table-striped table-bordered table-condensed">
            <thead>
                <tr>
                    <th>id</th>
                    <th>Razon Social</th>
                    <th>RFC</th>
                    <th>Representante</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($empresas as $empresa) { 
                    $idEmpresa = $empresa['idEmpresa'] - 1;
                    
                    $direccion = "indexdb.php?table=empresas&idEmpresa=" . $idEmpresa;
                    $razonSocial = $empresa['razonSocial']
                    
                    ?>
                    <tr>
                        <td style="width:15px"><?php echo $empresa['idEmpresa'] ?></td>
                        <td><?php echo '<a  href="' . $direccion . '">'. $razonSocial . '</a> '; ?></td>
                        <td><?php echo $empresa['rfc'] ?></td>
                        <td><?php echo $empresa['representanteLegal'] ?></td>
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
                    <p><strong> <?php echo $empresas[$_GET['idEmpresa']]['razonSocial']?></strong></p>
                    <p><strong>RFC: </strong><?php echo $empresas[$_GET['idEmpresa']]['rfc']?></p>
                    <p><strong>Tipo de Regimen: </strong><?php echo $empresas[$_GET['idEmpresa']]['tipoRegimen']?></p>
                    <p><strong>Representante Legal: </strong><?php echo $empresas[$_GET['idEmpresa']]['representanteLegal']?></p>
                    <p><strong>Correo: </strong><?php echo $empresas[$_GET['idEmpresa']]['correo']?></p>
                    <p><strong>Telefono: </strong><?php echo $empresas[$_GET['idEmpresa']]['telefono']?></p>

                <?php } else { ?>
                    <h5><strong>Informacion de la empresa </strong><i class="fas fa-upload"></i></h5>
                    <p><strong>Razon Social </strong><input type="text" value="<?php echo $empresas[$_GET['idEmpresa']]['razonSocial'] ?>"></p>
                    <p><strong>RFC: </strong><input type="text" value="<?php echo $empresas[$_GET['idEmpresa']]['rfc'] ?>"></p>
                    <p><strong>Tipo de Regimen: </strong><input type="text" value="<?php echo $empresas[$_GET['idEmpresa']]['tipoRegimen'] ?>"></p>
                    <p><strong>Representante Legal: </strong><input type="text" value="<?php echo $empresas[$_GET['idEmpresa']]['representanteLegal'] ?>"></p>
                    <p><strong>Correo: </strong><input type="text" value="<?php echo $empresas[$_GET['idEmpresa']]['correo'] ?>"></p>
                    <p><strong>Telefono: </strong><input type="text" value="<?php echo $empresas[$_GET['idEmpresa']]['telefono'] ?>"></p>
                    <p><button type="submit" class="btn btn-primary">Guardar</button></p>
                <?php } ?>
                






            </div>
        </div>
    </div>
</div>