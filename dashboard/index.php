<?php require_once "vistas/parte_superior.php" ?>

<!--INICIO del cont principal-->
<div class="container">
    <h1>Contenido principal</h1>



    <?php
    include_once '.\bd\conexion.php';
    $objeto = new Conexion();
    $conexion = $objeto->Conectar();

    $consulta = "SELECT id, nombre, numeroCelular, fechaNacimiento FROM personas";
    $resultado = $conexion->prepare($consulta);
    $resultado->execute();
    $data = $resultado->fetchAll(PDO::FETCH_ASSOC);
    ?>


    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <button id="btnNuevo" type="button" class="btn btn-success" data-toggle="modal">Nuevo</button>
            </div>
        </div>
    </div>
    <br>
    <div class="container">
        <div class="row">
            <div class="col-lg-12">

                <div class="table-responsive">
                    <table id="tablaPersonas" class="table table-striped table-bordered table-condensed"
                        style="width:100%">
                        <thead class="text-center">
                            <tr>
                                <th>Id</th>
                                <th>Nombre</th>
                                <th>Celular</th>
                                <th>fecha nacimiento</th>
                                <th>Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            foreach ($data as $dat) {
                                ?>
                                <tr>
                                    <td class="idEmpleado">
                                        <?php echo $dat['id'] ?>
                                    </td>
                                    <td>
                                        <?php echo $dat['nombre'] ?>
                                    </td>
                                    <td>
                                        <?php echo $dat['numeroCelular'] ?>
                                    </td>
                                    <td>
                                        <?php echo $dat['fechaNacimiento'] ?>
                                    </td>
                                    <td></td>
                                </tr>
                                <?php
                            }
                            ?>

                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <!--Modal para CRUD-->
    <div class="modal fade" id="modalCRUD" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel"></h5>
                    <button id="btnCerrarModalCrud" type="button" class="close" data-dismiss="modal" aria-label="Close" ><span
                            aria-hidden="true" >&times;</span>
                    </button>
                </div>
                <!--Start form "personas"-->
                <?php require_once "vistas/form_personas.php" ?>
                <!--End form personas-->
            </div>
        </div>
    </div>
    <!--End Modal para CRUD-->
    <!--Start Modal para subir archivos-->
    <div class="modal fade" id="modalSubir" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel"></h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                            aria-hidden="true">&times;</span>
                    </button>
                </div>
                <!--Start form "subir_archivos"-->

                <?php require_once "vistas/subir_archivos.php" ?>
                <!--End form subir_archivos-->
            </div>
        </div>
    </div>
    <!--End Modal para subir archivos-->
    <!--Modal para descargar-->

    <div class="modal fade" id="modalBajar" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel"></h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                            aria-hidden="true">&times;</span>
                    </button>
                </div>
                <!--Start  "descargar"-->

                <?php require_once "vistas/descargar_archivo.php" ?>
                <!--End Descargar-->
            </div>
        </div>
    </div>

    <!--End Modal para descargar-->

</div>
<!--FIN del cont principal-->
<?php require_once "vistas/parte_inferior.php" ?>