<?php require_once "vistas/parte_superior.php" ?>

<!--INICIO del cont principal-->
<div class="container">
    <h1>Contenido principal</h1>



    <?php
    include_once '../../loginBase/bd/conexion.php';
    $objeto = new Conexion();
    $conexion = $objeto->Conectar();

    $consulta = "SELECT id, nombre, numeroCelular, fechaNacimiento FROM personas";
    $resultado = $conexion->prepare($consulta);
    $resultado->execute();
    $data = $resultado->fetchAll(PDO::FETCH_ASSOC);
    ?>


    <div style="margin-left: 5%; margin-right: 5%;">
        <div class="row">
            <div style="margin-left: 5%; margin-right: 5%;">

                <button id="btnActualizar" type="button" class="btn btn-primary" data-toggle="modal">Actualizar
                    Tabla</button>
                <?php if ($_SESSION["s_rol"] == "admin") { ?>

                    <button id="btnNuevo" type="button" class="btn btn-success" data-toggle="modal">Nuevo</button>
                    <button id="btnSubirExcel" type="button" class="btn btn-primary" data-toggle="modal">SubirExcel</button>
                    <div id="loader" style="display: none;">
                        <i class="fas fa-spinner fa-spin"></i> Procesando datos...
                    </div>
                    <input class="fileInputExcel" type="file" id="fileInputExcel">
                <?php } ?>
                <div>
                    <!-- drag handle -->
                    <span class="handle">
                        <i class="fas fa-ellipsis-v"></i>
                        <i class="fas fa-ellipsis-v"></i>
                    </span>
                    <!-- checkbox -->
                    <div class="icheck-primary d-inline ml-2">
                        <input type="checkbox" value="" name="todo1" id="todoCheck1">
                        <label for="todoCheck1"></label>
                    </div>
                    <!-- todo text -->
                    <span class="text">Mostrar inactivos </span>
                </div>



            </div>
        </div>
    </div>
    <br>
    <div class="container">
        <div class="row">
            <div class="col-lg-12">

                <div class="table-responsive">
                    <table id="tablaPersonas" class="table table-sm table-striped table-bordered table-condensed"
                        style="width:100%">
                        <thead class="text-center">
                            <tr>
                                <th>Id</th>
                                <th width=50%>Nombre</th>
                                <th>Fecha Nacimiento</th>
                                <th>Curp</th>
                                <th>RFC</th>
                                <th>INE</th>
                                <th>Estado Civil</th>
                                <th>Numero Fijo</th>
                                <th>Correo</th>
                                <th>Numero Celular</th>
                                <th>Direccion</th>
                                <th>Numero de licencia</th>
                                <th>Numero Pasaporte</th>
                                <th>Fecha Ingreso</th>
                                <th>Estado</th>
                                <th>Tipo de contrato</th>
                                <th>Inicio Contrato</th>
                                <th>Fin Contrato</th>
                                <th>Acciones</th>
                            </tr>
                        </thead>
                        <tbody>




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
                    <button id="btnCerrarModalCrud" type="button" class="close" data-dismiss="modal"
                        aria-label="Close"><span aria-hidden="true">&times;</span>
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