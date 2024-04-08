<div class="container">
    <div>
        <?php include 'botonesNav.php'; ?>
    </div>

    <div style="float: left; width: 60%;">
        <h1>Cotizacion</h1>
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
        
        <div class="btn-group" role="group" aria-label="Grupo de botones" style="width: 100%;">
            <button type="button" class="btn btn-primary btn-sm">Detalles</button>
            <button type="button" class="btn btn-primary btn-sm">Personal</button>
            <button type="button" class="btn btn-primary btn-sm">SubContratos</button>

        </div>
        <br>
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
                <h5><strong>Informacion General </strong><i class="fas fa-download"></i></h5>
                <p><Strong>Nombre Completo del Contrato: </Strong> proyecto integrador para el uso comun de areas
                    ecologicas y.... </p>
                <p><Strong>contratante: </Strong> Nombre Contratante</p>
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
                
                <button type="button" class="btn btn-primary btn-sm">Convertir en contrato</button>


            </div>
        </div>
    </div>
</div>