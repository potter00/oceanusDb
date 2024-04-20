<?php
if (!isset($_GET['edit'])) {
    
?>

<h5><strong>Informacion General </strong><i class="fas fa-download"></i></h5>
<p><Strong>Nombre Completo del Contrato: </Strong><?php echo $contratoSeleccionado['nombreContrato'] ?></p>
<p><Strong>contratante: </Strong> <?php echo obtenerNombreEmpresa($contratoSeleccionado['idContratante'],$conexion) ?></p>
<p><Strong>contratado: </Strong><?php echo obtenerNombreEmpresa($contratoSeleccionado['idContratado'],$conexion) ?></p>
<p><Strong>Tipo de contrato: </Strong> <?php echo $contratoSeleccionado['subContrato'] ?> </p>
<p><Strong>Fecha de inicio: </Strong> <?php echo $contratoSeleccionado['inicioContrato'] ?></p>
<p><Strong>Fecha de fin: </Strong> <?php echo $contratoSeleccionado['finContrato'] ?></p>
<?php 

if ($contratoSeleccionado['idConvenio'] != 0) {
    echo '<p><Strong>Convenio: </Strong> 01/01/2023</p>';
}

?>


<p><strong>Monto de Contrato: </strong><?php echo $contratoSeleccionado['montoContrato'] ?></p>
<p><strong>Anticipo: </strong><?php echo $contratoSeleccionado['anticipoContrato'] ?></p>
<hr>


<h5><strong>Fianza De Cumplimiento </strong><i class="fas fa-download"></i></h5>
<p><strong>Fecha de Inicio: </strong><?php echo $datosFianzas['fianzaCumplimiento']['fianzaCumplimientoInicio'] ?></p>
<p><strong>Fecha de Fin: </strong><?php echo $datosFianzas['fianzaCumplimiento']['fianzaCumplimientoFin'] ?></p>
<p><strong>Monto de Fianza: </strong><?php echo $datosFianzas['fianzaCumplimiento']['fianzaCumplimientoMonto'] ?></p>
<p><strong>Numero de poliza: </strong><?php echo $datosFianzas['fianzaCumplimiento']['fianzaCumplimientoPoliza'] ?></p>
<hr>

<h5><strong>Fianza de Anticipo </strong><i class="fas fa-download"></i></h5>
<p><strong>Fecha de Inicio: </strong><?php echo $datosFianzas['fianzaAnticipo']['fianzaAnticipoInicio'] ?></p>
<p><strong>Fecha de Fin: </strong><?php echo $datosFianzas['fianzaAnticipo']['fianzaAnticipoFin'] ?></p>
<p><strong>Monto de Fianza: </strong><?php echo $datosFianzas['fianzaAnticipo']['fianzaAnticipoMonto'] ?></p>
<p><strong>Numero de poliza: </strong><?php echo $datosFianzas['fianzaAnticipo']['fianzaAnticipoPoliza'] ?></p>
<hr>
<h5><strong>Fianza de Vicios Ocultos </strong><i class="fas fa-download"></i></h5>
<p><strong>Fecha de Inicio: </strong><?php echo $datosFianzas['fianzaViciosOcultos']['fianzaViciosOcultosInicio'] ?></p>
<p><strong>Fecha de Fin: </strong><?php echo $datosFianzas['fianzaViciosOcultos']['fianzaViciosOcultosFin'] ?></p>
<p><strong>Monto de Fianza: </strong><?php echo $datosFianzas['fianzaViciosOcultos']['fianzaViciosOcultosMonto'] ?></p>
<p><strong>Numero de poliza: </strong><?php echo $datosFianzas['fianzaViciosOcultos']['fianzaViciosOcultosPoliza'] ?></p>
<hr>
<?php
}else {
   
?>
<h5><strong>Informacion General </strong><i class="fas fa-upload"></i></h5>
<p><Strong>Nombre Completo del Contrato: </Strong> <input value="<?php echo $contratoSeleccionado['nombreContrato'] ?>" type="text"></p>
<p><Strong>contratante: </Strong> <input value="<?php echo obtenerNombreEmpresa($contratoSeleccionado['idContratante'],$conexion) ?>" type="text"></p>
<p><Strong>contratado: </Strong> <input value="<?php echo obtenerNombreEmpresa($contratoSeleccionado['idContratado'],$conexion) ?>" type="text"></p>
<p><Strong>Tipo de contrato: </Strong> 
    <select name="tipo_contrato"value="<?php echo $contratoSeleccionado['subContrato'] ?>" >
        <option value="origen">Origen</option>
        <option value="subcontrato">SubContrato</option>
    </select>
</p>
<p><Strong>Fecha de inicio: </Strong> <input value="<?php echo $contratoSeleccionado['inicioContrato'] ?>" type="date"></p>
<p><Strong>Fecha de fin: </Strong> <input value="<?php echo $contratoSeleccionado['finContrato'] ?>" type="date"></p>

<?php 

if ($contratoSeleccionado['idConvenio'] != 0) {
    echo '<p><Strong>Convenio: </Strong> <input value=" 01/01/2023" type="date"></p>';
}

?>
<p><Strong>Convenio: </Strong> <input value="<?php echo $datosFianzas["a"] ?>" type="date"></p>

<p><strong>Monto de Contrato: </strong><input type="text"></p>
<p><strong>Anticipo: </strong><input value="<?php echo $datosFianzas["a"] ?>" type="text"></p>
<hr>


<h5><strong>Fianza De Cumplimiento </strong><i class="fas fa-upload"></i></h5>
<p><strong>Fecha de Inicio: </strong><input value="<?php echo $datosFianzas["a"] ?>" type="date"></p>
<p><strong>Fecha de Fin: </strong><input value="<?php echo $datosFianzas["a"] ?>" type="date"></p>
<p><strong>Monto de Fianza: </strong><input value="<?php echo $datosFianzas["a"] ?>" type="text"></p>
<p><strong>Numero de poliza</strong><input value="<?php echo $datosFianzas["a"] ?>" type="text"></p>
<hr>

<h5><strong>Fianza de Anticipo </strong><i class="fas fa-upload"></i></h5>
<p><strong>Fecha de Inicio: </strong><input value="<?php echo $datosFianzas["a"] ?>" type="date"></p>
<p><strong>Fecha de Fin: </strong><input value="<?php echo $datosFianzas["a"] ?>" type="date"></p>
<p><strong>Monto de Fianza: </strong><input value="<?php echo $datosFianzas["a"] ?>" type="text"></p>
<p><strong>Numero de poliza</strong><input value="<?php echo $datosFianzas["a"] ?>" type="text"></p>
<hr>
<h5><strong>Fianza de Vicios Ocultos </strong><i class="fas fa-upload"></i></h5>
<p><strong>Fecha de Inicio: </strong><input value="<?php echo $datosFianzas["a"] ?>" type="date"></p>
<p><strong>Fecha de Fin: </strong><input value="<?php echo $datosFianzas["a"] ?>" type="date"></p>
<p><strong>Monto de Fianza: </strong><input value="<?php echo $datosFianzas["a"] ?>" type="text"></p>
<p><strong>Numero de poliza</strong><input value="<?php echo $datosFianzas["a"] ?>" type="text"></p>
<hr>

<?php
}
  
?>