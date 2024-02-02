<?php include_once 'main.js'; ?>
<div class="form-group">
    <label for="cedula" class="col-form-label">Cedula profecional</label>
    <input type="text" class="form-control" id="cedula">
</div>
<div class="form-group">
    <label for="carrera" class="col-form-label">Carrera</label>
    <input type="text" class="form-control" id="carrera">
</div>
<div class="form-group">
    <label for="expLaboral" class="col-form-label">Experencia laboral</label>
    <input type="text" class="form-control" id="expLaboral">
</div>
<div class="form-group">
    <label for="cetificaciones" class="col-form-label">Certificaciones</label>
    <input type="text" class="form-control" id="cetificaciones">
</div>
<div class="form-group">
    <label for="gradoEstudios" class="col-form-label">GradoEstudios</label>
    <input type="text" class="form-control" id="gradoEstudios">
</div>

<div class="modal-footer">
    <button class="btn btn-light" onclick="mostrarSeccion(-1)">Anterior</button>
    <button type="button" class="btn btn-dark" onclick="guardarDatos()">Guardar</button>
</div>
