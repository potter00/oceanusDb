<div class="container">
    <div>
        <?php include 'botonesNav.php'; ?>
    </div>

    <div style="float: left; width: 60%;">
        <h1>subContratados</h1>
        <table class="table table-sm table-striped table-bordered table-condensed">
            <thead>
                <tr>
                    <th>id</th>
                    <th>Nombre</th>
                    <th>Empresa</th>

                </tr>
            </thead>
            <tbody>
                <?php for ($i = 1; $i <= 25; $i++) { ?>
                    <tr>
                        <td style="width:15px"><?php echo $i ?></td>
                        <td>PABLOOOO</td>
                        <td style="width:100px">Empresa</td>

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

                        echo '<a class="fas fa-edit" href="indexdb.php?table=personal&edit=true"></a> <!-- Icono de editar -->';

                    } else {
                        echo '<a class="fas fa-edit" href="indexdb.php?table=personal"></a> <!-- Icono de editar -->';
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

                    <h5><strong>Informacion de SubContratado </strong><i class="fas fa-download"></i></h5>
                    <p><strong>Nombre Completo Subcontratao Aqui </strong></p>
                    <p><strong>RFC: </strong>1549612asd5f1as</p>
                    <p><strong>INSS: </strong>156465432165</p>
                    <p><strong>INE: </strong>18215165168</p>
                    <p><strong>CURP: </strong>4654651ASD645sadA</p>
                    <p><strong>Estado: </strong>Activo</p>

                    <?php
                } else {
                    ?>
                    <h5><strong>Informacion de SubContratado </strong><i class="fas fa-upload"></i></h5>
                    <p><strong><input type="text"> </strong></p>
                    <p><strong>RFC: </strong><input type="text"></p>
                    <p><strong>INSS: </strong><input type="text"></p>
                    <p><strong>INE: </strong><input type="text"></p>
                    <p><strong>CURP: </strong><input type="text"></p>
                    <p><strong>Estado: </strong><input type="text"></p>
                    <?php
                }
                ?>





            </div>
        </div>
    </div>
</div>