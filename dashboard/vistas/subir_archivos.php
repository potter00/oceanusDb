<style>
    .section {
        display: none;
    }

    .section.active {
        display: block;
    }

    .required {
        color: #e74c3c;
        /* Color rojo */
        margin-left: 5px;
    }
</style>


<div class="modal-body">
    <!-- Sección 1 -->
    <div class="section active" id="seccion1">
        <table id="tablaDocumentos" class="table table-striped table-bordered table-condensed" style="width:100%">
            <thead class="text-center">
                <tr>
                    <th>Documento</th>
                    <th>Estado</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                <tr data-id="credencial">
                    <td>Credencial</td>
                    <td>sin cambio</td>
                    <td>
                        <div class='text-center'>
                            <div class='btn-group'><button class='btn btn-primary btnSubirDocumento'>Subir</button>
                            <button class='btn btn-danger btnBorrarDocumento'>Borrar</button></div>
                        </div>
                    </td>
                </tr>
                <tr data-id="licencia">
                    <td>Licencia</td>
                    <td>Sin cambio</td>
                    <td>
                        <div class='text-center'>
                            <div class='btn-group'><button class='btn btn-primary btnSubirDocumento'>Subir</button><button
                                    class='btn btn-danger btnBorrarDocumento'>Borrar</button></div>
                        </div>
                    </td>
                </tr>
                <tr data-id="pasaporte">
                    <td>Pasaporte</td>
                    <td>Sin cambio</td>
                    <td>
                        <div class='text-center'>
                            <div class='btn-group'><button class='btn btn-primary btnSubirDocumento'>Subir</button><button
                                    class='btn btn-danger btnBorrarDocumento'>Borrar</button></div>
                        </div>
                    </td>
                </tr>
                <tr data-id="cv">
                    <td>CV</td>
                    <td >Sin cambio</td>
                    <td>
                        <div class='text-center'>
                            <div class='btn-group'><button class='btn btn-primary btnSubirDocumento'>Subir</button><button
                                    class='btn btn-danger btnBorrarDocumento'>Borrar</button></div>
                        </div>
                    </td>
                </tr>
                <tr data-id="curp">
                    <td>Curp</td>
                    <td>Sin cambio</td>
                    <td>
                        <div class='text-center'>
                            <div class='btn-group'><button class='btn btn-primary btnSubirDocumento'>Subir</button><button
                                    class='btn btn-danger btnBorrarDocumento'>Borrar</button></div>
                        </div>
                    </td>
                </tr>
                <tr data-id="nss">
                    <td>NSS</td>
                    <td>Sin cambio</td>
                    <td>
                        <div class='text-center'>
                            <div class='btn-group'><button class='btn btn-primary btnSubirDocumento'>Subir</button><button
                                    class='btn btn-danger btnBorrarDocumento'>Borrar</button></div>
                        </div>
                    </td>
                </tr>
                <tr data-id="sat">
                    <td>Constancia SAT</td>
                    <td>Sin cambio</td>
                    <td>
                        <div class='text-center'>
                            <div class='btn-group'><button class='btn btn-primary btnSubirDocumento'>Subir</button><button
                                    class='btn btn-danger btnBorrarDocumento'>Borrar</button></div>
                        </div>
                    </td>
                </tr>
            </tbody>
        </table>


    </div>

    <!-- Sección 2 -->
    <div class="section" id="seccion2">
        <h1>Datos Medicos</h1>
        <?php require_once "vistas/form_datos_medicos.php" ?>
    </div>

    <!-- Sección 3 -->
    <div class="section" id="seccion3">
        <h1>Datos Academicos</h1>
        <?php require_once "vistas/form_datos_academicos.php" ?>
    </div>



</div>

<script>
    var currentSection = 0;
    var sections = document.getElementsByClassName('section');
    console.log("sections");
    function mostrarSeccion(n) {
        sections[currentSection].classList.remove('active');
        currentSection = Math.min(Math.max(currentSection + n, 0), sections.length - 1);
        sections[currentSection].classList.add('active');

    }
</script>