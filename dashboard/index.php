<?php require_once "vistas/parte_superior.php"?>

<!--INICIO del cont principal-->
<div class="container">
    <h1>Contenido principal</h1>
    
    
    
 <?php
include_once '.\bd\conexion.php';
$objeto = new Conexion();
$conexion = $objeto->Conectar();

$consulta = "SELECT id, nombre, numeroCelular, fechaNacimiento FROM personas";
$resultado = $conexion->prepare($consulta);
$resultado->execute();
$data=$resultado->fetchAll(PDO::FETCH_ASSOC);
?>


<div class="container">
        <div class="row">
            <div class="col-lg-12">            
            <button id="btnNuevo" type="button" class="btn btn-success" data-toggle="modal">Nuevo</button>    
            </div>    
        </div>    
    </div>    
    <br>  
<div class="container">
        <div class="row">
                <div class="col-lg-12">
                    <div class="table-responsive">        
                        <table id="tablaPersonas" class="table table-striped table-bordered table-condensed" style="width:100%">
                        <thead class="text-center">
                            <tr>
                                <th>Id</th>
                                <th>Nombre</th>
                                <th>Celular</th>                                
                                <th>fecha nacimiento</th>  
                                <th>Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php                            
                            foreach($data as $dat) {                                                        
                            ?>
                            <tr>
                                <td><?php echo $dat['id'] ?></td>
                                <td><?php echo $dat['nombre'] ?></td>
                                <td><?php echo $dat['numeroCelular'] ?></td>
                                <td><?php echo $dat['fechaNacimiento'] ?></td>    
                                <td></td>
                            </tr>
                            <?php
                                }
                            ?>                                
                        </tbody>        
                       </table>                    
                    </div>
                </div>
        </div>  
    </div>    
      
<!--Modal para CRUD-->
<div class="modal fade" id="modalCRUD" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel"></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span>
                </button>
            </div>
            <!---->
        <form id="formPersonas">    
            <div class="modal-body">
                <div class="form-group">
                <label for="nombre" class="col-form-label">Nombre:</label>
                <input type="text" class="form-control" id="nombre">
                <!--type="text" id="nombre" name="nombre" required-->
                </div>
                <div class="form-group">
                <label for="fechaNacimiento" class="col-form-label">Fecha nacimiento:</label>
                <input type="text" class="form-control" id="fechaNacimiento">
                </div>                
                <div class="form-group">
                <label for="curp" class="col-form-label">Curp:</label>
                <input type="text" class="form-control" id="curp">
                </div>
                <div class="form-group">
                    <label for="rfc" class="col-form-label">RFC</label>
                    <input type="text" class="form-control" id="rfc">
                </div>
                <div class="form-group">
                    <label for="numeroFijo" class="col-form-label">Numero de casa</label>
                    <input type="text" class="form-control" id="numeroFijo">
                </div>
                <div class="form-group">
                    <label for="numeroCelular" class="col-form-label">Numero de celular</label>
                    <input type="text" class="form-control" id="numeroCelular">
                </div>
                <div class="form-group">
                    <label for="direccion" class="col-form-label">Direccion</label>
                    <input type="text" class="form-control" id="direccion">
                </div>
                <div class="form-group">
                    <label for="numeroLicencia" class="col-form-label">Numero licencia</label>
                    <input type="text" class="form-control" id="numeroLicencia">
                </div>
                <div class="form-group">
                    <label for="numeroPasaporte" class="col-form-label">Nuemero de pasaporte</label>
                    <input type="text" class="form-control" id="numeroPasaporte">
                </div>
                <div class="form-group">
                    <label for="fechaIngreso" class="col-form-label">Fecha de ingreso</label>
                    <input type="text" class="form-control" id="fechaIngreso">
                </div>                  
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-light" data-dismiss="modal">Cancelar</button>
                <button type="submit" id="btnGuardar" class="btn btn-dark">Guardar</button>
            </div>
        </form>    
        </div>
    </div>
</div>  
      
    
    
</div>
<!--FIN del cont principal-->
<?php require_once "vistas/parte_inferior.php"?>