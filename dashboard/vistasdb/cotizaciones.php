<div class="container">
    

    <div style="float: left; width: 60%;">
        <h1>Cotizacion</h1>
        <table class="table table-sm table-striped table-bordered table-condensed">
        <thead>
                <tr>
                    <th>id</th>
                    <th>Titulo</th>
                    <th>Contratante</th>
                    <th>Fecha Inicio</th>
                </tr>
            </thead>
            <tbody>
                <?php for ($i = 1; $i <= 25; $i++) { ?>
                    <tr>
                        <td style="width:15px"><?php echo $i ?></td>
                        <td>titulo <?php echo $i ?></td>
                        <td>contratante <?php echo $i ?></td>
                        <td style="width:150px">0000-00-00</td>
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
                    <?php
                    if (!isset($_GET['edit'])) {

                        echo '<a class="fas fa-edit" href="indexdb.php?table=cotizaciones&edit=true"></a> <!-- Icono de editar -->';

                    } else {
                        echo '<a class="fas fa-edit" href="indexdb.php?table=cotizaciones"></a> <!-- Icono de editar -->';
                    }

                    if (!isset($_GET['edit'])) {

                        echo '<i class="fas fa-download"></i> <!-- Icono de descarga -->';

                    } else {
                        echo '<i class="fas fa-upload"></i> <!-- Icono de descarga -->';
                    }

                    ?>
                    <i class="fas fa-cog"></i> <!-- Icono de configuración -->
                </div>
            </div>
            <div class="card-body" style="line-height: .8;">
                <?php
                if (!isset($_GET['edit'])) {
                    ?>
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
                <?php } else { ?>
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
                    
                <?php } ?>


            </div>
        </div>
    </div>
</div>