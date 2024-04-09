<div class="container">
    <div>
        <?php include 'botonesNav.php'; ?>
    </div>

    <div style="float: left; width: 60%;">
        <h1>Facturas</h1>
        <table class="table table-sm table-striped table-bordered table-condensed">
            <thead>
                <tr>
                    <th>id</th>
                    <th>Nombre</th>
                    <th>fecha</th>
                    <th>importe</th>
                </tr>
            </thead>
            <tbody>
                <?php for ($i = 1; $i <= 25; $i++) { ?>
                    <tr>
                        <td style="width:15px"><?php echo $i ?></td>
                        <td >nombre</td>
                        <td style="width:150px">0000-00-00</td>
                        <td style="width:30px">$15,325</td>
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

                        echo '<a class="fas fa-edit" href="indexdb.php?table=facturas&edit=true"></a> <!-- Icono de editar -->';

                    } else {
                        echo '<a class="fas fa-edit" href="indexdb.php?table=facturas"></a> <!-- Icono de editar -->';
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
                    <h5><strong>Informacion de la Factura</strong><i class="fas fa-download"></i></h5>
                    <p><strong>Titulo factura aqui </strong></p>
                    <p><strong>Numero de factura: </strong>416165</p>
                    <p><strong>Fecha de la Factura: </strong>00/00/0000</p>
                    <p><strong>Importe Total: </strong>Nombre aqui</p>

                    <?php
                } else {
                    ?>
                    <h5><strong>Informacion de la Factura</strong><i class="fas fa-upload"></i></h5>
                    <p><strong>Titulo factura </strong><input type="text"></p>
                    <p><strong>Numero de factura: </strong><input type="text"></p>
                    <p><strong>Fecha de la Factura: </strong><input type="date"></p>
                    <p><strong>Importe Total: </strong><input type="text"></p>
                    <?php
                }
                ?>








            </div>
        </div>
    </div>
</div>