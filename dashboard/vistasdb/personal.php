<?php
include_once '../../loginBase/bd/conexion.php';
$objeto = new Conexion();
$conexion = $objeto->Conectar();

$query = "SELECT * FROM subcontratados";
$resultado = $conexion->prepare($query);
$resultado->execute();
$subcontratados = $resultado->fetchAll(PDO::FETCH_ASSOC);
foreach ($subcontratados as $subcontratado) {
    if ($subcontratado['idSubContratado'] == $_GET['idSubContratado']) {
        $subContratadoSeleccionado = $subcontratado;
    }
}



?>






<div class="container">
    <div>
        <?php include 'botonesNav.php'; ?>
    </div>

    <div style="float: left; width: 60%;">
        <h1 style="float: left; width: 60%;">subContratados</h1>
        <button style="margin-top: 10px;" type="button" class="btn btn-primary" id="btnSubContratadoNuevo"><i
                class="fas fa-plus"></i> Agregar nuevo elemento</button>
        <hr>
        <table id="tablaSubContratados" class="table table-sm table-striped table-bordered table-condensed">
            <thead>
                <tr>
                    <th>id</th>
                    <th>Nombre</th>
                    <th>Rfc</th>
                    <th>Inss</th>
                    <th>Ine</th>
                    <th>Curp</th>
                    <th>Estado</th>

                </tr>
            </thead>
            <tbody>
                <?php foreach ($subcontratados as $subcontratado) {
                    $idSubContratado = $subcontratado['idSubContratado'];
                    $direccion = "indexdb.php?table=personal&idSubContratado=" . $idSubContratado;
                    $nombreSubcontratado = $subcontratado['nombre'];

                    ?>
                    <tr>
                        <td style="width:15px"><?php echo $subcontratado['idSubContratado'] ?></td>
                        <td><?php echo '<a  href="' . $direccion . '">' . $nombreSubcontratado . '</a> ' ?></td>
                        <td><?php echo $subcontratado['rfc'] ?></td>
                        <td><?php echo $subcontratado['inss'] ?></td>
                        <td><?php echo $subcontratado['ine'] ?></td>
                        <td><?php echo $subcontratado['curp'] ?></td>
                        <td><?php echo $subcontratado['estado'] ?></td>

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

                        echo '<a class="fas fa-edit" href="indexdb.php?table=personal&edit=true&idSubContratado=' . $_GET['idSubContratado'] . '"></a> <!-- Icono de editar -->';

                    } else {
                        echo '<a class="fas fa-edit" href="indexdb.php?table=personal&idSubContratado=' . $_GET['idSubContratado'] . '"></a> <!-- Icono de editar -->';
                    }

                    if (!isset($_GET['edit'])) {

                        echo '<i class="fas fa-download"></i> <!-- Icono de descarga -->';

                    } else {
                        echo '<i class="fas fa-upload"></i> <!-- Icono de descarga -->';
                    }

                    ?>

                    <div style="float: right;">


                        <div class="dropdown" style="margin-top: 4px; margin-left: 4px;">
                            <i class="fas fa-cog dropdown-toggle" id="dropdownMenuButton" data-toggle="dropdown"
                                aria-haspopup="true" aria-expanded="false"></i>
                            <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                <a id="btnEliminarPersonal" class="dropdown-item" href="#"><i class="fas fa-trash"></i> Eliminar</a>
                                
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card-body" style="line-height: .8;">

                <?php
                if (!isset($_GET['edit'])) {




                    ?>

                    <h5><strong>Informacion de SubContratado </strong><i class="fas fa-download"></i></h5>
                    <p><strong><?php echo $subContratadoSeleccionado['nombre'] ?> </strong></p>
                    <p><strong>RFC: </strong><?php echo $subContratadoSeleccionado['rfc'] ?></p>
                    <p><strong>INSS: </strong><?php echo $subContratadoSeleccionado['inss'] ?></p>
                    <p><strong>INE: </strong><?php echo $subContratadoSeleccionado['ine'] ?></p>
                    <p><strong>CURP: </strong><?php echo $subContratadoSeleccionado['curp'] ?></p>
                    <p><strong>Estado: </strong><?php echo $subContratadoSeleccionado['estado'] ?></p>

                    <?php
                } else {
                    ?>
                    <h5><strong>Informacion de SubContratado </strong><i class="fas fa-upload"></i></h5>
                    <p><strong>Nombre:<input type="text" id="personalNombre"
                                value="<?php echo $subContratadoSeleccionado['nombre'] ?>"> </strong></p>
                    <p><strong>RFC: </strong><input type="text" id="personalRFC"
                            value="<?php echo $subContratadoSeleccionado['rfc'] ?>"></p>
                    <p><strong>INSS: </strong><input type="text" id="personalInss"
                            value="<?php echo $subContratadoSeleccionado['inss'] ?>"></p>
                    <p><strong>INE: </strong><input type="text" id="personalIne"
                            value="<?php echo $subContratadoSeleccionado['ine'] ?>"></p>
                    <p><strong>CURP: </strong><input type="text" id="personalCurp"
                            value="<?php echo $subContratadoSeleccionado['curp'] ?>"></p>
                    <p><strong>Estado: </strong>
                        <select name="estado" id="personalEstado">
                            <option value="activo" <?php if ($subContratadoSeleccionado['estado'] == 'activo')
                                echo 'selected'; ?>>Activo</option>
                            <option value="inactivo" <?php if ($subContratadoSeleccionado['estado'] == 'inactivo')
                                echo 'selected'; ?>>Inactivo</option>
                        </select>
                    </p>
                    <button type="submit" id="btnActualizarPersonal" class="btn btn-primary">Guardar</button>
                    <?php
                }

                $conexion = null;
                ?>





            </div>
        </div>
    </div>
</div>