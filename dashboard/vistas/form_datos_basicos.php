<div class="form-group" style="display: none;">
    <label for="id_usuario" class="col-form-label" >id: <span class="required">*</span> </label>
    <input type="text" class="form-control" id="id_usuario" name="id_usuario" readonly>
</div>
<div class="form-group">
    <label for="nombre" class="col-form-label">Nombre: <span class="required">*</span> </label>
    <input type="text" class="form-control" id="nombre" name="nombre">
</div>
<div class="form-group">
    <label for="fechaNacimiento">fecha de nacimiento: </label>
    <input type="date" id="fechaNacimiento" name="fechaNacimiento" class="form-control" required>
</div>
<div class="form-group">
    <label for="curp" class="col-form-label">Curp: <span class="required">*</span></label>
    <input type="text" class="form-control" id="curp" name="curp">
</div>
<div class="form-group">
    <label for="rfc" class="col-form-label">RFC: <span class="required">*</span></label>
    <input type="text" class="form-control" id="rfc" name="rfc">
</div>
<div class="form-group">
    <label for="numeroFijo" class="col-form-label">Numero de casa:</label>
    <input type="text" class="form-control" id="numeroFijo" name="numeroFijo">
</div>
<div class="form-group">
    <label for="numeroCelular" class="col-form-label">Numero de celular: <span class="required">*</span></label>
    <input type="text" class="form-control" id="numeroCelular" name="numeroCelular">
</div>
<div class="form-group">
    <label for="correo" class="col-form-label">Correo electronico: <span class="required">*</span></label>
    <input type="text" class="form-control" id="correo" name="correo">
</div>
<div class="form-group">
    <label for="direccion" class="col-form-label">Direccion: <span class="required">*</span></label>
    <input type="text" class="form-control" id="direccion" name="direccion">
</div>
<div class="form-group">
    <label for="numeroLicencia" class="col-form-label">Numero licencia:</label>
    <input type="text" class="form-control" id="numeroLicencia" name="numeroLicencia">
</div>
<div class="form-group">
    <label for="numeroPasaporte" class="col-form-label">Nuemero de pasaporte:</label>
    <input type="text" class="form-control" id="numeroPasaporte" name="numeroPasaporte">
</div>
<div class="form-group">
    <label for="fechaIngreso">fecha de Ingreso: </label>
    <input type="date" id="fechaIngreso" name="fechaIngreso" class="form-control" required>
</div>
<div class="button-container">
    <button disabled type="button" class="btn btn-light" onclick="mostrarSeccion(-1)">Anterior</button>
    <button type="button" class="btn btn-light" onclick="mostrarSeccion(1)">Siguiente</button>
</div>