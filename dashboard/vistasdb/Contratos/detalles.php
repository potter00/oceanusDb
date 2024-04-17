<?php
if (!isset($_GET['edit'])) {
    
?>

<h5><strong>Informacion General </strong><i class="fas fa-download"></i></h5>
<p><Strong>Nombre Completo del Contrato: </Strong><?php echo $contratoSeleccionado['nombreContrato'] ?></p>
<p><Strong>contratante: </Strong> <?php echo obtenerNombreEmpresa($contratoSeleccionado['idContratante'],$conexion) ?></p>
<p><Strong>contratado: </Strong> Nombre Contratado</p>
<p><Strong>Tipo de contrato: </Strong> Origen </p>
<p><Strong>Fecha de inicio: </Strong> 01/01/2021</p>
<p><Strong>Fecha de fin: </Strong> 01/01/2022</p>
<p><Strong>Convenio: </Strong> 01/01/2023</p>

<p><strong>Monto de Contrato: </strong>1268352153168</p>
<p><strong>Anticipo: </strong>156465432165</p>
<hr>


<h5><strong>Fianza De Cumplimiento </strong><i class="fas fa-download"></i></h5>
<p><strong>Fecha de Inicio: </strong>01/01/2021</p>
<p><strong>Fecha de Fin: </strong>01/01/2022</p>
<p><strong>Monto de Fianza: </strong>156465432165</p>
<p><strong>Numero de poliza</strong>182168</p>
<hr>

<h5><strong>Fianza de Anticipo </strong><i class="fas fa-download"></i></h5>
<p><strong>Fecha de Inicio: </strong>01/01/2021</p>
<p><strong>Fecha de Fin: </strong>01/01/2022</p>
<p><strong>Monto de Fianza: </strong>156465432165</p>
<p><strong>Numero de poliza</strong>182168</p>
<hr>
<h5><strong>Fianza de Vicios Ocultos </strong><i class="fas fa-download"></i></h5>
<p><strong>Fecha de Inicio: </strong>01/01/2021</p>
<p><strong>Fecha de Fin: </strong>01/01/2022</p>
<p><strong>Monto de Fianza: </strong>156465432165</p>
<p><strong>Numero de poliza</strong>182168</p>
<hr>
<?php
}else {
   
?>
<h5><strong>Informacion General </strong><i class="fas fa-upload"></i></h5>
<p><Strong>Nombre Completo del Contrato: </Strong> <input type="text"></p>
<p><Strong>contratante: </Strong> <input type="text"></p>
<p><Strong>contratado: </Strong> <input type="text"></p>
<p><Strong>Tipo de contrato: </Strong> 
    <select name="tipo_contrato">
        <option value="origen">Origen</option>
        <option value="subcontrato">SubContrato</option>
    </select>
</p>
<p><Strong>Fecha de inicio: </Strong> <input type="date"></p>
<p><Strong>Fecha de fin: </Strong> <input type="date"></p>
<p><Strong>Convenio: </Strong> <input type="date"></p>

<p><strong>Monto de Contrato: </strong><input type="text"></p>
<p><strong>Anticipo: </strong><input type="text"></p>
<hr>


<h5><strong>Fianza De Cumplimiento </strong><i class="fas fa-upload"></i></h5>
<p><strong>Fecha de Inicio: </strong><input type="date"></p>
<p><strong>Fecha de Fin: </strong><input type="date"></p>
<p><strong>Monto de Fianza: </strong><input type="text"></p>
<p><strong>Numero de poliza</strong><input type="text"></p>
<hr>

<h5><strong>Fianza de Anticipo </strong><i class="fas fa-upload"></i></h5>
<p><strong>Fecha de Inicio: </strong><input type="date"></p>
<p><strong>Fecha de Fin: </strong><input type="date"></p>
<p><strong>Monto de Fianza: </strong><input type="text"></p>
<p><strong>Numero de poliza</strong><input type="text"></p>
<hr>
<h5><strong>Fianza de Vicios Ocultos </strong><i class="fas fa-upload"></i></h5>
<p><strong>Fecha de Inicio: </strong><input type="date"></p>
<p><strong>Fecha de Fin: </strong><input type="date"></p>
<p><strong>Monto de Fianza: </strong><input type="text"></p>
<p><strong>Numero de poliza</strong><input type="text"></p>
<hr>

<?php
}
  
?>