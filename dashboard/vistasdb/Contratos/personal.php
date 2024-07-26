<?php


//solicitamos los datos de la tabla personal_contrato
$relaciones = ObtenerTabla('personal_contrato', $conexion);
$personales = ObtenerTabla('SubContratados', $conexion);
$personalesOceanus = ObtenerTabla('personas', $conexion);
$idContrato = $_GET['idContrato'];

$listaPersonales = array();

//filtramos los datos de la tabla personal_contrato para obtener solo los que corresponden al contrato actual
foreach ($relaciones as $relacion) {

    if ($relacion['idContrato'] == $idContrato) {

        $listaPersonales[] = $relacion;


    }


}
$listaNombresTipos = array();
for ($i = 0; $i < count($listaPersonales); $i++) {

    $idPersonal = $listaPersonales[$i]['idPersonal'];
    $tipoPersonal = $listaPersonales[$i]['tipoPersonal'];
    $nombre = '';
    $tipo = '';
    foreach ($personales as $personal) {
        if ($personal['idSubContratado'] == $idPersonal) {
            $nombre = $personal['nombre'];
            $tipo = 'Terceros';
        }
    }
    foreach ($personalesOceanus as $personal) {
        if ($personal['Id'] == $idPersonal) {
            $nombre = $personal['Nombre'];
            $tipo = 'Oceanus';
        }
    }
    $listaNombresTipos[] = array('nombre' => $nombre, 'tipo' => $tipo, 'idPersonal' => $idPersonal, 'idRelacion' => $listaPersonales[$i]['idRelacionContrato']);


}

error_log(print_r($listaNombresTipos, true));


if (!isset($_GET['edit'])) {


    ?>
    <h5><strong>Personal</strong></h5>
    <table class="table table-sm table-striped table-bordered table-condensed text-center">
        <thead>
            <tr>
                <th>Nombre</th>
                <th>Personal de</th>

            </tr>
        </thead>
        <tbody>
            <?php

            foreach ($listaNombresTipos as $personal) {
                if ($personal['tipo'] == 'Terceros') {
                    $direccion = "indexdb.php?table=personal&idPersonal=" . $personal['idPersonal'];
                    echo '<tr>';
                    
                    echo '<td><a href="' . $direccion . '">' . $personal['nombre'] . '</a></td>';
                    echo '<td>Terceros</td>';
                    echo '</tr>';
                } else {
                    $direccion = "detalles_usuario.php?id=" . $personal['idPersonal'];
                    echo '<tr>';
                    
                    echo '<td><a href="' . $direccion . '">' . $personal['nombre'] . '</a></td>';
                    echo '<td>Oceanus</td>';
                    echo '</tr>';
                }
            }


            ?>


        </tbody>
    </table>

    <?php
} else {
    ?>
    <h5><strong>Añadir Personal</strong></h5>
    <p>Personal de terceros</p>
    <select style="max-width: 160px;" id="selectPersonalTerceros">

        <?php
        $personales = ObtenerTabla('SubContratados', $conexion);
        $personalesOceanus = ObtenerTabla('personas', $conexion);
        foreach ($personales as $personal) {
            echo '<option value="' . $personal['idSubContratado'] . '">' . $personal['nombre'] . '</option>';
        }

        ?>
    </select>


    <button class="btn sm btn-primary" id="btnNuevaRelacionContratoPersonalTerceros">Añadir Nuevo</button>
    <br>
    <br>
    <p>Personal de Oceanus</p>
    <select style="max-width: 160px;" id="selectPersonalOceanus">

        <?php

        $personalesOceanus = ObtenerTabla('personas', $conexion);
        foreach ($personalesOceanus as $personal) {
            echo '<option value="' . $personal['Id'] . '">' . $personal['Nombre'] . '</option>';
        }

        ?>
    </select>


    <button class="btn sm btn-primary" id="btnNuevaRelacionContratoPersonalOceanus">Añadir Nuevo</button>
    <br>
    <hr>

    <table class="table table-sm table-striped table-bordered table-condensed text-center">
        <thead>
            <tr>
                
                <th>Nombre</th>
                <th>Personal de</th>
                <th>
                    <i class="fas fa-trash"></i>
                </th>
            </tr>
        </thead>
        <tbody>

            <?php

            foreach ($listaNombresTipos as $personal) {

                if ($personal['tipo'] == 'Terceros') {
                    $direccion = "indexdb.php?table=personal&idPersonal=" . $personal['idPersonal'];
                    echo '<tr>';
                    
                    echo '<td><a href="' . $direccion . '">' . $personal['nombre'] . '</a></td>';
                    echo '<td>Terceros</td>';
                    echo '<td><button class="btn btn-danger btn-sm btnEliminarRelacionContratoPersonal" data-tipo="Terceros" data-id="' . $personal['idPersonal'] . '">Eliminar</button></td>';
                    echo '</tr>';
                } else {
                    $direccion = "detalles_usuario.php?id=" . $personal['idPersonal'];
                    echo '<tr>';
                    
                    echo '<td><a href="' . $direccion . '">' . $personal['nombre'] . '</a></td>';
                    echo '<td>Oceanus</td>';
                    echo '<td><button class="btn btn-danger btn-sm btnEliminarRelacionContratoPersonal" data-tipo="Oceanus" data-id="' . $personal['idPersonal'] . '">Eliminar</button></td>';
                    echo '</tr>';
                }




            }


            ?>
        </tbody>
    </table>
    <?php
}
?>