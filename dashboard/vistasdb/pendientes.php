<div class="container">
    <div>
        <?php include 'botonesNav.php'; ?>
    </div>

    <div style="float: left; width: 60%;">
        <h1>Pendientes</h1>
        <table class="table table-sm table-striped table-bordered table-condensed">
            <thead>
                <tr>
                    <th>Campo 1</th>
                    <th>Campo 2</th>
                    <th>Campo 3</th>
                    <th>Campo 4</th>
                </tr>
            </thead>
            <tbody>
                <?php for ($i = 1; $i <= 25; $i++) { ?>
                    <tr>
                        <td>Dato 1</td>
                        <td>Dato 2</td>
                        <td>Dato 3</td>
                        <td>Dato 4</td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>
    <div style="float: right; width: 35%; margin-left: 20px;">
        <h1><i class="fa fa-info" aria-hidden="true"></i>nformacion</h1>
        <div class="card">
            <div class="card-header">
                <div style="float: left; width: 60%;">
                    <h5 class="card-title">Título</h5>
                    <h6 class="card-subtitle">Subtítulo</h6>
                </div>
                <div style="float: right;">
                    <i class="fas fa-edit"></i> <!-- Icono de editar -->
                    <i class="fas fa-download"></i> <!-- Icono de descarga -->
                    <i class="fas fa-cog"></i> <!-- Icono de configuración -->
                </div>
            </div>
            <div class="card-body" style="line-height: .8;">
                
                <p><strong>Descripcion: </strong>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nullam auctor, nunc at tincidunt ultricies, velit nunc tincidunt nunc, id lacinia nunc nunc eu nunc. Sed euismod, mauris id aliquet ultrices, nunc nunc tincidunt nunc, id lacinia nunc nunc eu nunc. Sed euismod, mauris id aliquet ultrices.</p>
                <p><strong>Fecha: </strong>00-00-0000</p>
                <p><strong>Tiempo Restante: </strong>4 dias 8 horas</p>
                <p><strong>Estado: </strong>Sin atender</p>
                <p><strong>Referencia aqui: </strong></p>
                

                




            </div>
        </div>
    </div>
</div>