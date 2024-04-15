<?php require_once "vistasdb/parte_superior.php" ?>
<!--INICIO del cont principal-->


<?php
if (isset ($_GET['table'])) {

    $table = $_GET['table'];
    error_log($table);
    if ($table == 'contratos') {
        require_once "vistasdb/contratos.php";
    } elseif ($table == 'personal') {
        error_log("Personal");
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
}else{
    require_once "vistasdb/contratos.php";
}





?>





<!--FIN del cont principal-->
<?php require_once "vistasdb/parte_inferior.php" ?>