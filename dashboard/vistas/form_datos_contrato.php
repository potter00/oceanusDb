<div class="form-group">
    <label for="tipoContrato" class="col-form-label">Tipo de contrato: <span class="required">*</span>

        <select id="tipoContrato" name="tipoContrato" class="form-control">
            <option value="indefinido">Indefinido</option>
            <option value="temporal">Temporal</option>
            <option value="obra">Por obra</option>
        </select>
    </label>

</div>
<div class="form-group">
    <label for="estado" class="col-form-label">Estado del empleado: <span class="required">*</span>

        <select id="estado" name="estado" class="form-control">
            <option value="activo">Activo</option>
            <option value="inactivo">Inactivo</option>
            
        </select>
    </label>
</div>
<div class="form-group">
    <label for="fechaInicioContrato">fecha inicio del contrato: </label>
    <input type="date" id="fechaInicioContrato" name="fechaInicioContrato" class="form-control">
</div>
<!-- the cake is a lie-->
<div class="form-group">
    <label for="fechaFinContrato">fecha fin del contrato: </label>
    <input type="date" id="fechaFinContrato" name="fechaFinContrato" class="form-control">
</div>



<div class="button-container">
    <button type="button" class="btn btn-light" onclick="mostrarSeccion(-1)">Anterior</button>
    <button disabled type="button" class="btn btn-light" onclick="mostrarSeccion(1)">Siguiente</button>
    <button type="submit" id="btnGuardar" class="btn btn-dark">Guardar</button>
</div>