<div class="container">
    <div>
        <?php include 'botonesNav.php'; ?>
    </div>

    <div style="float: left; width: 60%;">
        <h1>subContratados</h1>
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
                <h5><strong>Informacion de SubContratado </strong><i class="fas fa-download"></i></h5>
                <p><strong>Nombre Completo Subcontratao Aqui </strong></p>
                <p><strong>RFC: </strong>1549612asd5f1as</p>
                <p><strong>INSS: </strong>156465432165</p>
                <p><strong>INE: </strong>18215165168</p>
                <p><strong>CURP: </strong>4654651ASD645sadA</p>
                <p><strong>Estado: </strong>Activo</p>

                




            </div>
        </div>
    </div>
</div>