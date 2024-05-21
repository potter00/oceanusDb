<?php
session_start();

if ($_SESSION["s_usuario"] === null) {
  header("Location: ../index.php");
}
if (isset($_GET['table'])) {

  $table = $_GET['table'];

  if ($table == 'contratos') {

    if (!isset($_GET['idContrato'])) {
      include_once '../../loginBase/bd/conexion.php';
      $objeto = new Conexion();
      $conexion = $objeto->Conectar();
      try {
        $query = "SELECT * FROM contrato";
        $resultado = $conexion->prepare($query);
        $resultado->execute();
        $contratos = $resultado->fetchAll(PDO::FETCH_ASSOC);
        $idContrato = $contratos[0]['idContrato'];

        $conexion = null;
        //redireccionamos a la misma pagina pero con $idEmpresa
        header("Location: indexdb.php?table=contratos&idContrato=$idContrato");
      } catch (Exception $e) {
        error_log($e);
      }
    }

  } elseif ($table == 'personal') {
    error_log("Personal de Contrato");

    if (!isset($_GET['idSubContratado'])) {
      include_once '../../loginBase/bd/conexion.php';
      $objeto = new Conexion();
      $conexion = $objeto->Conectar();
      try {
        $query = "SELECT * FROM subcontratados";
        $resultado = $conexion->prepare($query);
        $resultado->execute();
        $subcontratados = $resultado->fetchAll(PDO::FETCH_ASSOC);
        $idSubContratado = $subcontratados[0]['idSubContratado'];
        error_log($idSubContratado);
        $conexion = null;
        //redireccionamos a la misma pagina pero con $idEmpresa
        header("Location: indexdb.php?table=personal&idSubContratado=$idSubContratado");
      } catch (Exception $e) {
        error_log($e);
      }
    }

  } elseif ($table == 'empresas') {
    if (!isset($_GET['idEmpresa'])) {
      include_once '../../loginBase/bd/conexion.php';
      $objeto = new Conexion();
      $conexion = $objeto->Conectar();

      $query = "SELECT * FROM empresa";
      $resultado = $conexion->prepare($query);
      $resultado->execute();
      $empresas = $resultado->fetchAll(PDO::FETCH_ASSOC);
      $idEmpresa = $empresas[0]['idEmpresa'];

      //redireccionamos a la misma pagina pero con $idEmpresa
      $conexion = null;
      header("Location: indexdb.php?table=empresas&idEmpresa=$idEmpresa");

    }
  } elseif ($table == 'facturas') {

    if (!isset($_GET['idFactura'])) {
      include_once '../../loginBase/bd/conexion.php';
      $objeto = new Conexion();
      $conexion = $objeto->Conectar();

      $query = "SELECT * FROM factura";
      $resultado = $conexion->prepare($query);
      $resultado->execute();
      $facturas = $resultado->fetchAll(PDO::FETCH_ASSOC);
      $idFactura = $facturas[0]['idFactura'];

      //redireccionamos a la misma pagina pero con $idEmpresa
      $conexion = null;
      if ($_GET['idContrato']) {
        header("Location: indexdb.php?table=facturas&idFactura=$idFactura&idContrato=" . $_GET['idContrato']);
      } else {
        header("Location: indexdb.php?table=facturas&idFactura=$idFactura");
      }


    }

  } elseif ($table == 'cotizaciones') {
    if (!isset($_GET['idContrato'])) {
      include_once '../../loginBase/bd/conexion.php';
      $objeto = new Conexion();
      $conexion = $objeto->Conectar();
      try {
        //seleccionamos por contrato pero solo si la columna de subContrato tiene el valor de Cotizacion
        $query = "SELECT * FROM contrato WHERE subContrato = 'Cotizacion'";
        $resultado = $conexion->prepare($query);
        $resultado->execute();
        $contratos = $resultado->fetchAll(PDO::FETCH_ASSOC);
        $idContrato = $contratos[0]['idContrato'];

        $conexion = null;
        //redireccionamos a la misma pagina pero con $idEmpresa
        header("Location: indexdb.php?table=cotizaciones&idContrato=$idContrato");
      } catch (Exception $e) {
        error_log($e);
      }
    }

  } elseif ($table == 'pendientes') {
    error_log("Pendientes");
  } else {
    error_log("No se encontro la tabla");
  }
} else {
  error_log("No se encontro la tabla");
}
?>

<!DOCTYPE html>
<html lang="en">

<head>

  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">

  <title>Oceanus DB</title>

  <!-- Custom fonts for this template-->
  <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
  <link
    href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
    rel="stylesheet">

  <!-- Custom styles for this template-->
  <link href="css/sb-admin-2.min.css" rel="stylesheet">

  <!--datables CSS básico-->
  <link rel="stylesheet" type="text/css" href="vendor/datatables/datatables.min.css" />
  <!--datables estilo bootstrap 4 CSS-->
  <link rel="stylesheet" type="text/css" href="vendor/datatables/DataTables-1.10.18/css/dataTables.bootstrap4.min.css">
  <link href="../plugins/select2-4.0.13/dist/css/select2.min.css" rel="stylesheet" />


</head>

<body id="page-top">

  <!-- Page Wrapper -->
  <div id="wrapper">

    <!-- Sidebar -->
    <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion toggled" id="accordionSidebar">

      <!-- Sidebar - Brand -->
      <a class="sidebar-brand d-flex align-items-center justify-content-center" href="index.php">
        <div class="sidebar-brand-icon ">
          <i><img src="..\dashboard\img\oceanus-logo.svg" alt="" width="60px"></i>
        </div>
        <div class="sidebar-brand-text mx-3">Oceanus DB <sup></sup></div>
      </a>

      <!-- Divider -->
      <hr class="sidebar-divider my-0">

      <!-- Nav Item - Dashboard -->
      <li class="nav-item active">
        <a class="nav-link" href="index.php">
          <i class="fas fa-fw fa-users"></i>
          <span>Personal</span></a>
      </li>


      <!-- Divider -->
      <hr class="sidebar-divider">

      <!-- Heading -->
      <div class="sidebar-heading">
        Interface
      </div>

      <!--Nav Item - Pages Collapse Menu
      <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="true"
          aria-controls="collapseTwo">
          <i class="fas fa-fw fa-database"></i>
          <span>Contratos</span>
        </a>
        <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
          <div class="bg-white py-2 collapse-inner rounded">
            <h6 class="collapse-header">Secciones:</h6>
            <a class="collapse-item" href="indexdb.php?table=personal">Personal de Terceros</a>
            <a class="collapse-item" href="indexdb.php?table=empresas">Empresas</a>
            <a class="collapse-item" href="indexdb.php?table=contratos">Contratos</a>
            <a class="collapse-item" href="indexdb.php?table=facturas">Facturas</a>
            <a class="collapse-item" href="indexdb.php?table=cotizaciones">Cotizaciones</a>
            <a class="collapse-item" href="indexdb.php?table=pendientes">Pendientes</a>
          </div>
        </div>
      </li>
      -->
      <li class="nav-item ">
        <button class="nav-link btn" id="btnColapSideBar">
          <i class="fas fa-fw fa-file-contract"></i>
          <span>Contratos</span>
        </button>
      </li>


      <div style="border-left: 10px double #7F98E4;" id="menuContratos">
        <li class="nav-item">
          <a class="nav-link" href="indexdb.php?table=contratos">
            <i class="fas fa-fw fa-file-contract"></i>
            <span>Contratos</span></a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="indexdb.php?table=empresas">
            <i class="fas fa-fw fa-building"></i>
            <span>Empresas</span></a>
        </li>
        <li>
        <li class="nav-item">
          <a class="nav-link" href="indexdb.php?table=facturas">
            <i class="fas fa-fw fa-file-invoice"></i>
            <span>Facturas</span></a>

        </li>
        <li class="nav-item">
          <a class="nav-link" href="indexdb.php?table=personal">
            <i class="fas fa-fw fa-users"></i>
            <span>Personal de Terceros</span></a>

        </li>
        <li>
        <li class="nav-item">
          <a class="nav-link" href="indexdb.php?table=cotizaciones">
            <i class="fas fa-fw fa-file-invoice"></i>
            <span>Cotizaciones</span></a>

        </li>
        <li>
        <!--
        <li class="nav-item">
          <a class="nav-link" href="indexdb.php?table=pendientes">
            <i class="fas fa-bell fa-fw"></i>
            <span>Pendientes</span></a>
        </li>
        -->


      </div>




      <!-- Divider -->
      <hr class="sidebar-divider d-none d-md-block">

      <!-- Sidebar Toggler (Sidebar) -->
      <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
      </div>

    </ul>
    <!-- End of Sidebar -->

    <!-- Content Wrapper -->
    <div id="content-wrapper" class="d-flex flex-column">

      <!-- Main Content -->
      <div id="content">

        <!-- Topbar -->
        <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">

          <!-- Sidebar Toggle (Topbar) -->
          <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
            <i class="fa fa-bars"></i>
          </button>



          <!-- Topbar Navbar -->
          <ul class="navbar-nav ml-auto">

            <!-- Nav Item - Search Dropdown (Visible Only XS) -->
            <li class="nav-item dropdown no-arrow d-sm-none">
              <a class="nav-link dropdown-toggle" href="#" id="searchDropdown" role="button" data-toggle="dropdown"
                aria-haspopup="true" aria-expanded="false">
                <i class="fas fa-search fa-fw"></i>
              </a>
              <!-- Dropdown - Messages -->
              <div class="dropdown-menu dropdown-menu-right p-3 shadow animated--grow-in"
                aria-labelledby="searchDropdown">
                <form class="form-inline mr-auto w-100 navbar-search">
                  <div class="input-group">
                    <input type="text" class="form-control bg-light border-0 small" placeholder="Search for..."
                      aria-label="Search" aria-describedby="basic-addon2">
                    <div class="input-group-append">
                      <button class="btn btn-primary" type="button">
                        <i class="fas fa-search fa-sm"></i>
                      </button>
                    </div>
                  </div>
                </form>
              </div>
            </li>

            <!-- Nav Item - Alerts -->
            <li class="nav-item dropdown no-arrow mx-1" style="display = none">
              <a class="nav-link dropdown-toggle" href="#" id="alertsDropdown" role="button" data-toggle="dropdown"
                aria-haspopup="true" aria-expanded="false">
                <i class="fas fa-bell fa-fw"></i>

                <span class="badge badge-danger badge-counter">3+</span>
              </a>


            </li>

            <!-- Nav Item - Messages -->


            <div class="topbar-divider d-none d-sm-block"></div>

            <!-- Nav Item - User Information -->
            <li class="nav-item dropdown no-arrow">
              <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown"
                aria-haspopup="true" aria-expanded="false">
                <div style="min-height: 30px ;">
                  <span class="badge" id="rolUsuario">
                    <?php
                    $rol = $_SESSION["s_rol"];
                    $rol = trim($rol);
                    if ($rol == "admin") {
                      echo "Administrador";
                    } else {
                      echo "Usuario";
                    }

                    ?>

                  </span>
                  <span class="mr-2 d-none d-lg-inline text-gray-600 small">
                    <?php echo $_SESSION["s_usuario"]; ?>
                  </span>

                </div>
                <!--                <img class="img-profile rounded-circle" src="https://source.unsplash.com/QAB-WJcbgJk/60x60">-->
                <img class="img-profile rounded-circle" src="img/user.png">
              </a>
              <!-- Dropdown - User Information -->
              <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="userDropdown">


                <!---->
                <a class="dropdown-item" href="#">
                  <i class="fas fa-cogs fa-sm fa-fw mr-2 text-gray-400"></i>
                  Settings
                </a>
                <a class="dropdown-item" href="#">
                  <i class="fas fa-list fa-sm fa-fw mr-2 text-gray-400"></i>
                  Activity Log
                </a>

                <div class="dropdown-divider"></div>
                <a class="dropdown-item" href="#" data-toggle="modal" data-target="#logoutModal">
                  <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                  Cerrar Sesión
                </a>
              </div>
            </li>

          </ul>

        </nav>
        <!-- End of Topbar -->