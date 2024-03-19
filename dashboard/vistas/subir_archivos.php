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
                        <div class="text-center">
                            <input class="fileInputDocumentos" type="file" id="fileInputCredencial"
                                style="width: 200px;">
                            <button id="btnDescargarCredencial"
                                class='btn btn-primary btnDescargarDocumento'>Descargar</button>
                        </div>

                    </td>
                </tr>
                <tr data-id="licencia">
                    <td>Licencia</td>
                    <td>sin cambio</td>
                    <td>
                        <div class='text-center'>
                            <input class="fileInputDocumentos" type="file" id="fileInputLicencia" style="width: 200px;">
                            <button id="btnDescargarLicencia"
                                class='btn btn-primary btnDescargarDocumento'>Descargar</button>
                        </div>
                    </td>
                </tr>
                <tr data-id="pasaporte">
                    <td>Pasaporte</td>
                    <td>sin cambio</td>
                    <td>
                        <div class='text-center'>
                            <input class="fileInputDocumentos" type="file" id="fileInputPasaporte"
                                style="width: 200px;">
                            <button id="btnDescargarPasaporte"
                                class='btn btn-primary btnDescargarDocumento'>Descargar</button>
                        </div>
                    </td>
                </tr>
                <tr data-id="cv">
                    <td>CV</td>
                    <td>sin cambio</td>
                    <td>
                        <div class='text-center'>
                            <input class="fileInputDocumentos" type="file" id="fileInputCV" style="width: 200px;">
                            <button id="btnDescargarCV" class='btn btn-primary btnDescargarDocumento'>Descargar</button>
                        </div>
                    </td>
                </tr>
                <tr data-id="curp">
                    <td>Curp</td>
                    <td>sin cambio</td>
                    <td>
                        <div class='text-center'>
                            <input class="fileInputDocumentos" type="file" id="fileInputCurp" style="width: 200px;">
                            <button id="btnDescargarCurp"
                                class='btn btn-primary btnDescargarDocumento'>Descargar</button>
                        </div>
                    </td>
                </tr>
                <tr data-id="nss">
                    <td>NSS</td>
                    <td>sin cambio</td>
                    <td>
                        <div class='text-center'>
                            <input class="fileInputDocumentos" type="file" id="fileInputInss" style="width: 200px;">
                            <button id="btnDescargarInss"
                                class='btn btn-primary btnDescargarDocumento'>Descargar</button>
                        </div>
                    </td>
                </tr>
                <tr data-id="sat">
                    <td>Constancia SAT</td>
                    <td>sin cambio</td>
                    <td>
                        <div class='text-center'>
                            <input class="fileInputDocumentos" type="file" id="fileInputConstanciaSat"
                                style="width: 200px;">
                            <button id="btnDescargarConstanciaSat"
                                class='btn btn-primary btnDescargarDocumento'>Descargar</button>
                        </div>
                    </td>
                </tr>
                <tr data-id="foto">
                    <td>Foto</td>
                    <td>sin cambio</td>
                    <td>
                        <div class='text-center'>
                            <input class="fileInputDocumentos" type="file" id="fileInputFoto" style="width: 200px;">
                            <button id="btnDescargarFoto"
                                class='btn btn-primary btnDescargarDocumento'>Descargar</button>
                        </div>
                    </td>
                </tr>
                <tr data-id="Acta">
                    <td>Acta de Nacimiento</td>
                    <td>sin cambio</td>
                    <td>
                        <div class='text-center'>
                            <input class="fileInputDocumentos" type="file" id="fileInputActaNacimiento" style="width: 200px;">
                            <button id="btnDescargarActa"
                                class='btn btn-primary btnDescargarDocumento'>Descargar</button>
                        </div>
                    </td>
                </tr>
                <tr data-id="EstadoBanco">
                    <td>Estado cuenta banco</td>
                    <td>sin cambio</td>
                    <td>
                        <div class='text-center'>
                            <input class="fileInputDocumentos" type="file" id="fileInputEstadoCuentaBanco" style="width: 200px;">
                            <button id="btnDescargarEstadoBanco"
                                class='btn btn-primary btnDescargarDocumento'>Descargar</button>
                        </div>
                    </td>
                </tr>
                <tr data-id="AltaSeguro">
                    <td>Alta Seguro</td>
                    <td>sin cambio</td>
                    <td>
                        <div class='text-center'>
                            <input class="fileInputDocumentos" type="file" id="fileInputAltaSeguroSocial" style="width: 200px;">
                            <button id="btnDescargarAltaSeguro"
                                class='btn btn-primary btnDescargarDocumento'>Descargar</button>
                        </div>
                    </td>
                </tr>
                <tr data-id="Cedula">
                    <td>Cedula</td>
                    <td>sin cambio</td>
                    <td>
                        <div class='text-center'>
                            <input class="fileInputDocumentos" type="file" id="fileInputCedulaProfecional" style="width: 200px;">
                            <button id="btnDescargarCedula"
                                class='btn btn-primary btnDescargarDocumento'>Descargar</button>
                        </div>
                    </td>
                </tr>
                <tr data-id="Contrato">
                    <td>Contrato</td>
                    <td>sin cambio</td>
                    <td>
                        <div class='text-center'>
                            <input class="fileInputDocumentos" type="file" id="fileInputCopiaContrato" style="width: 200px;">
                            <button id="btnDescargarContrato"
                                class='btn btn-primary btnDescargarDocumento'>Descargar</button>
                        </div>
                    </td>
                </tr>
                <tr data-id="ComprobanteDomicilio">
                    <td>Comprobante domicilio</td>
                    <td>sin cambio</td>
                    <td>
                        <div class='text-center'>
                            <input class="fileInputDocumentos" type="file" id="fileInputComprobanteDomicilio" style="width: 200px;">
                            <button id="btnDescargarComprobanteDomicilio"
                                class='btn btn-primary btnDescargarDocumento'>Descargar</button>
                        </div>
                    </td>
                </tr>
            </tbody>
        </table>
        <div class='text-center'>
            <div class='btn-group'><button id="btnSubirDocumentosTabla" class='btn btn-primary btnSubirDocumento'>Subir</button>
            </div>

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