<?php
if (!isset($_GET['edit'])) {

        ?>

        <h5><strong>Informacion General </strong><i class="fas fa-download"></i></h5>
        <p><Strong>Nombre Completo del Contrato: </Strong><?php echo $contratoSeleccionado['nombreContrato'] ?></p>
        <p><strong>Direccion del Contrato: </strong><?php echo $contratoSeleccionado['direccion'] ?> </p>
        <p><Strong>contratante: </Strong>
                <?php
                $direccion = "indexdb.php?table=empresas&idEmpresa=" . $contratoSeleccionado['idContratante'];
                echo '<a  href="' . $direccion . '">' . obtenerNombreEmpresa($contratoSeleccionado['idContratante'], $conexion) . '</a>';


                ?>
        </p>
        <p><Strong>contratado: </Strong><?php echo obtenerNombreEmpresa($contratoSeleccionado['idContratado'], $conexion) ?></p>
        <p><Strong>Tipo de contrato: </Strong> <?php echo $contratoSeleccionado['subContrato'] ?> </p>
        <?php
        if ($contratoSeleccionado['subContrato'] == 'SubContrato') {
                $contratoFuente = obtenerContrato($contratoSeleccionado['idContratoFuente'], $conexion);
                $direccion = "indexdb.php?table=contratos&idContrato=" . $contratoFuente['idContrato'] . "&seccion=detalles";
                echo '<p><Strong>Contrato Fuente: </Strong><a  href="' . $direccion . '">' . $contratoFuente['titulo'] . '</a> </p>';
        }


        ?>


        <p><Strong>Fecha de inicio: </Strong> <?php echo $contratoSeleccionado['inicioContrato'] ?></p>
        <p><Strong>Fecha de fin: </Strong> <?php echo $contratoSeleccionado['finContrato'] ?></p>

        <p><strong>Monto de Contrato: </strong><?php echo $contratoSeleccionado['montoContrato'] ?></p>
        <p><strong>Anticipo: </strong><?php echo $contratoSeleccionado['anticipoContrato'] ?></p>
        <hr>
        <?php

        if ($contratoSeleccionado['idConvenio'] != 0) {



                ?>

                <h5><strong>Convenio </strong><i class="fas fa-download"></i></h5>
                <p><strong>Fecha Inicio Convenio: </strong>0000-00-00</p>
                <p><strong>Fecha Fin Convenio: </strong>0000-00-00</p>
                <p><strong>Monto Adicional: </strong>456463165</p>
                <hr>

                <?php

        }

        ?>

        <h5><strong>Fianza De Cumplimiento </strong><i class="fas fa-download"></i></h5>
        <p><strong>Fecha de Inicio: </strong><?php echo $datosFianzas['fianzaCumplimiento']['fianzaCumplimientoInicio'] ?></p>
        <p><strong>Fecha de Fin: </strong><?php echo $datosFianzas['fianzaCumplimiento']['fianzaCumplimientoFin'] ?></p>
        <p><strong>Monto de Fianza: </strong><?php echo $datosFianzas['fianzaCumplimiento']['fianzaCumplimientoMonto'] ?></p>
        <p><strong>Numero de poliza: </strong><?php echo $datosFianzas['fianzaCumplimiento']['fianzaCumplimientoPoliza'] ?></p>
        <p><strong>Aseguradora: </strong><?php echo $datosFianzas['fianzaCumplimiento']['fianzaCumplimientoAseguradora'] ?></p>
        <hr>

        <h5><strong>Fianza de Anticipo </strong><i class="fas fa-download"></i></h5>
        <p><strong>Fecha de Inicio: </strong><?php echo $datosFianzas['fianzaAnticipo']['fianzaAnticipoInicio'] ?></p>
        <p><strong>Fecha de Fin: </strong><?php echo $datosFianzas['fianzaAnticipo']['fianzaAnticipoFin'] ?></p>
        <p><strong>Monto de Fianza: </strong><?php echo $datosFianzas['fianzaAnticipo']['fianzaAnticipoMonto'] ?></p>
        <p><strong>Numero de poliza: </strong><?php echo $datosFianzas['fianzaAnticipo']['fianzaAnticipoPoliza'] ?></p>
        <p><strong>Aseguradora: </strong><?php echo $datosFianzas['fianzaAnticipo']['fianzaAnticipoAseguradora'] ?></p>
        <hr>
        <h5><strong>Fianza de Vicios Ocultos </strong><i class="fas fa-download"></i></h5>
        <p><strong>Fecha de Inicio: </strong><?php echo $datosFianzas['fianzaViciosOcultos']['fianzaViciosOcultosInicio'] ?></p>
        <p><strong>Fecha de Fin: </strong><?php echo $datosFianzas['fianzaViciosOcultos']['fianzaViciosOcultosFin'] ?></p>
        <p><strong>Monto de Fianza: </strong><?php echo $datosFianzas['fianzaViciosOcultos']['fianzaViciosOcultosMonto'] ?></p>
        <p><strong>Numero de poliza: </strong><?php echo $datosFianzas['fianzaViciosOcultos']['fianzaViciosOcultosPoliza'] ?>
        </p>
        <p><strong>Aseguradora: </strong><?php echo $datosFianzas['fianzaViciosOcultos']['fianzaViciosOcultosAseguradora'] ?>
        </p>
        <hr>
        <?php
} else {

        ?>
        <h5><strong>Informacion General </strong><i class="fas fa-upload"></i></h5>
        <p><Strong>Titulo del Contrato: </Strong> <input id="contratoTitulo"
                        value="<?php echo $contratoSeleccionado['titulo'] ?>" type="text"></p>
        <p><Strong>Nombre Completo del Contrato: </Strong> <input id="contratoNombreContrato"
                        value="<?php echo $contratoSeleccionado['nombreContrato'] ?>" type="text"></p>
        <p><strong>Direccion del Contrato: </strong> <input id="contratoDireccion"
                        value="<?php echo $contratoSeleccionado['direccion'] ?>" type="text"></p>
        <p><Strong>Numero Contrato: </Strong> <input id="contratoNumero"
                        value="<?php echo $contratoSeleccionado['numeroContrato'] ?>" type="text"></p>
        <p><Strong>contratante: </Strong>
                <select name="contratante" id="contratoContratante">+
                        <?php
                        $query = "SELECT * FROM empresa";
                        $resultado = $conexion->prepare($query);
                        $resultado->execute();
                        $empresas = $resultado->fetchAll(PDO::FETCH_ASSOC);
                        foreach ($empresas as $empresa) {
                                echo '<option value="' . $empresa['idEmpresa'] . '"';
                                if ($empresa['idEmpresa'] == $contratoSeleccionado['idContratante']) {
                                        echo 'selected';
                                }
                                echo '>' . $empresa['razonSocial'] . '</option>';
                        }
                        ?>

                </select>
        </p>
        <p><Strong>contratado: </Strong>Oceanus</p>
        <p><Strong>Tipo de contrato: </Strong>
                <select name="tipo_contrato" id="contratoTipoContrato"
                        value="<?php echo $contratoSeleccionado['subContrato'] ?>">
                        <option value="Contrato Origen">Origen</option>
                        <option value="SubContrato">SubContrato</option>
                </select>
        </p>
        <p><Strong>Contrato Fuente: </Strong>
                <select name="contratante" id="contratoFuente">
                        <option value="0">--Sin Contrato Fuente--</option>
                        <?php

                        foreach ($contratos as $contrato) {
                                echo '<option value="' . $contrato['idContrato'] . '"';
                                if ($contrato['idContrato'] == $contratoSeleccionado['idContratoFuente']) {
                                        echo 'selected';
                                }
                                echo '>' . $contrato['titulo'] . '</option>';
                        }
                        ?>

                </select>
        </p>

        <p><Strong>Fecha de inicio: </Strong> <input id="contratoInicio"
                        value="<?php echo $contratoSeleccionado['inicioContrato'] ?>" type="date">
        </p>
        <p><Strong>Fecha de fin: </Strong> <input id="contratoFin" value="<?php echo $contratoSeleccionado['finContrato'] ?>"
                        type="date"></p>

        <?php

        if ($contratoSeleccionado['idConvenio'] != 0) {
                echo '<p><Strong>Convenio: </Strong> <input id="contratoConvenio" value=" 00/00/0000" type="date"></p>';
        } else {
                echo '<p><Strong>Convenio: </Strong> <input id="contratoConvenio" type="date"></p>';
        }

        ?>


        <p><strong>Monto de Contrato: </strong><input type="text" id="contratoMonto"
                        value="<?php echo $contratoSeleccionado['montoContrato'] ?>">
        </p>
        <p><strong>Anticipo: </strong><input id="contratoAnticipo"
                        value="<?php echo $contratoSeleccionado['anticipoContrato'] ?>" type="text"></p>
        <hr>
        <?php

        if ($contratoSeleccionado['idConvenio'] != 0) {



                ?>

                <h5><strong>Convenio </strong><i class="fas fa-download"></i></h5>
                <p><strong>Fecha Inicio Convenio: </strong></p>
                <p><strong>Fecha Fin Convenio: </strong>0000-00-00</p>
                <p><strong>Monto Adicional: </strong>456463165</p>
                <hr>

                <?php

        }

        ?>




        <h5><strong>Fianza De Cumplimiento </strong><i class="fas fa-upload"></i></h5>
        <p><strong>Fecha de Inicio: </strong><input id="contratoFianzaCumplimientoInicio"
                        value="<?php echo $datosFianzas["fianzaCumplimiento"]['fianzaCumplimientoInicio'] ?>" type="date"></p>
        <p><strong>Fecha de Fin: </strong><input id="contratoFianzaCumplimientoFin"
                        value="<?php echo $datosFianzas["fianzaCumplimiento"]['fianzaCumplimientoFin'] ?>" type="date"></p>
        <p><strong>Monto de Fianza: </strong><input id="contratoFianzaCumplimientoMonto"
                        value="<?php echo $datosFianzas["fianzaCumplimiento"]['fianzaCumplimientoMonto'] ?>" type="text"></p>
        <p><strong>Numero de poliza</strong><input id="contratoFianzaCumplimientoPoliza"
                        value="<?php echo $datosFianzas["fianzaCumplimiento"]['fianzaCumplimientoPoliza'] ?>" type="text"></p>
        <p><strong>Aseguradora</strong><input id="contratoFianzaCumplimientoAseguradora"
                        value="<?php echo $datosFianzas["fianzaCumplimiento"]['fianzaCumplimientoAseguradora'] ?>" type="text">
        </p>
        <hr>

        <h5><strong>Fianza de Anticipo </strong><i class="fas fa-upload"></i></h5>
        <p><strong>Fecha de Inicio: </strong><input id="contratoFianzaAnticipoInicio"
                        value="<?php echo $datosFianzas["fianzaAnticipo"]['fianzaAnticipoInicio'] ?>" type="date"></p>
        <p><strong>Fecha de Fin: </strong><input id="contratoFianzaAnticipoFin"
                        value="<?php echo $datosFianzas["fianzaAnticipo"]['fianzaAnticipoFin'] ?>" type="date"></p>
        <p><strong>Monto de Fianza: </strong><input id="contratoFianzaAnticipoMonto"
                        value="<?php echo $datosFianzas["fianzaAnticipo"]['fianzaAnticipoMonto'] ?>" type="text"></p>
        <p><strong>Numero de poliza</strong><input id="contratoFianzaAnticipoPoliza"
                        value="<?php echo $datosFianzas["fianzaAnticipo"]['fianzaAnticipoPoliza'] ?>" type="text"></p>
        <p><strong>Aseguradora</strong><input id="contratoFianzaAnticipoAseguradora"
                        value="<?php echo $datosFianzas["fianzaAnticipo"]['fianzaAnticipoAseguradora'] ?>" type="text"></p>
        <hr>
        <h5><strong>Fianza de Vicios Ocultos </strong><i class="fas fa-upload"></i></h5>
        <p><strong>Fecha de Inicio: </strong><input id="contratoFianzaViciosOcultosInicio"
                        value="<?php echo $datosFianzas["fianzaViciosOcultos"]['fianzaViciosOcultosInicio'] ?>" type="date"></p>
        <p><strong>Fecha de Fin: </strong><input id="contratoFianzaViciosOcultosFin"
                        value="<?php echo $datosFianzas["fianzaViciosOcultos"]['fianzaViciosOcultosFin'] ?>" type="date"></p>
        <p><strong>Monto de Fianza: </strong><input id="contratoFianzaViciosOcultosMonto"
                        value="<?php echo $datosFianzas["fianzaViciosOcultos"]['fianzaViciosOcultosMonto'] ?>" type="text"></p>
        <p><strong>Numero de poliza</strong><input id="contratoFianzaViciosOcultosPoliza"
                        value="<?php echo $datosFianzas["fianzaViciosOcultos"]['fianzaViciosOcultosPoliza'] ?>" type="text"></p>
        <p><strong>Aseguradora</strong><input id="contratoFianzaViciosOcultosAseguradora"
                        value="<?php echo $datosFianzas["fianzaViciosOcultos"]['fianzaViciosOcultosAseguradora'] ?>"
                        type="text"></p>

        <hr>

        <button id="btnActualizarContrato" class="btn btn-primary">Guardar</button>
        <?php
}

?>