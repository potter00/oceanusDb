<div class="form-group">
    <label for="alergias" class="col-form-label">Alergias:</label>
    <input type="text" class="form-control" id="alergias" name="alergias">
</div>
<div class="form-group">
    <label for="enfermedadesCronicas" class="col-form-label">Padece alguna enfermedad cronica:</label>
    <input type="text" class="form-control" id="enfermedadesCronicas" name="enfermedadesCronicas">
</div>
<!-- the cake is a lie-->
<div class="form-group">
    <label for="lesiones" class="col-form-label">Lesiones: </label>
    <input type="text" class="form-control" id="lesiones" name="lesiones">
</div>
<div class="form-group">
    <label for="alergiasMedicamentos" class="col-form-label">Alergias a medicamentos:</label>
    <input type="text" class="form-control" id="alergiasMedicamentos" name="alergiasMedicamentos">
</div>
<div class="form-group">
    <label for="numeroSeguro" class="col-form-label">Numero Seguro: <span class="required">*</span></label>
    <input type="text" class="form-control" id="numeroSeguro" name="numeroSeguro">
</div>
<div class="form-group">
    <label for="nombreEmergencia" class="col-form-label">Nombre de la persona en caso de emergencia: <span
            class="required">*</span></label>
    <input type="text" class="form-control" id="nombreEmergencia" name="nombreEmergencia">
</div>
<div class="form-group">
    <label for="relacionEmergencia" class="col-form-label">Relacion con la persona: <span
            class="required">*</span></label>
    <input type="text" class="form-control" id="relacionEmergencia" name="relacionEmergencia">
</div>
<div class="form-group">
    <label for="numeroEmergencia" class="col-form-label">Numero Emergencia: <span class="required">*</span></label>
    <input type="text" class="form-control" id="numeroEmergencia" name="numeroEmergencia">
</div>
<div class="form-group">
    <label for="tipoSangre" class="col-form-label">Tipo de sangre: <span class="required">*</span></label>
    <input type="text" class="form-control" id="tipoSangre" name="tipoSangre">
</div>
<div class="form-group">
    <label for="genero" class="col-form-label">Genero: <span class="required">*</span>

        <select id="genero" name="genero" class="form-control">
            <option value="masculino">Masculino</option>
            <option value="femenino">Femenino</option>
            <option value="otro">Otro</option>
        </select>
    </label>

</div>
<div class="button-container">
    <button type="button" class="btn btn-light" onclick="mostrarSeccion(-1)">Anterior</button>
    <button type="button" class="btn btn-light" onclick="mostrarSeccion(1)">Siguiente</button>
</div>