<?php require_once "vistasdb/parte_superior.php" ?>
<!--INICIO del cont principal-->

<div style="line-height: 1.2;">
    <?php
    if (isset($_GET['table'])) {

        $table = $_GET['table'];

        if ($table == 'contratos') {
            require_once "vistasdb/contratos.php";
        } elseif ($table == 'personal') {

            require_once "vistasdb/personal.php";
        } elseif ($table == 'empresas') {
            require_once "vistasdb/empresas.php";
        } elseif ($table == 'facturas') {
            require_once "vistasdb/facturas.php";
        } elseif ($table == 'cotizaciones') {
            require_once "vistasdb/cotizaciones.php";
        } elseif ($table == 'pendientes') {
            require_once "vistasdb/pendientes.php";
        } else {
            require_once "vistasdb/contratos.php";


        }
    } else {
        require_once "vistasdb/contratos.php";
    }





    ?>

</div>



<!--FIN del cont principal-->
<?php require_once "vistasdb/parte_inferior.php" ?>