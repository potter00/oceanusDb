<div class='text-center'>
    <div class='btn-group'>
        <?php if ($_SESSION['s_rol'] == 'admin') {
            error_log('El usuario es admin')
            ?>
            <button class='btn btn-primary btnEditar'>Editar</button>
            <button class='btn btn-danger btnBorrar'>Borrar</button>
            <?php
        }else{
            error_log('El usuario no es admin')
        } ?>
        <button class='btn btn-secondary btnOpciones' data-toggle='dropdown' aria-haspopup='true'
            aria-expanded='false'>Opciones</button>
        <div class='dropdown-menu' aria-labelledby='opcionesDropdown'>
            <a class='dropdown-item btnSubirArchivo' href='#'>Subir Archivo</a>
            <a class='dropdown-item btnDescargarArchivo' href='#'>Descargar Archivo</a>
            <a class='dropdown-item btnGenerarReporte' href='#'>Generar Reporte</a>
            <a class='dropdown-item btnGenerarCredencial' href='#'>Generar Credencial</a>
            <a class='dropdown-item btnDetalles' href='#'>Detalles</a>
        </div>
    </div>
</div>