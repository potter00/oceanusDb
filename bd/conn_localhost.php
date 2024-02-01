<?php
// Definimos variables con los datos necesarios para la conexion
$servidor = "127.0.0.2";
$baseDatos = "crud_2019";
$usuarioBD = "root";
$passwordBD = "";

// Creamos la conexión
$conn_localhost = mysqli_connect($servidor, $usuarioBD, $passwordBD) 
	or trigger_error(mysqli_error($conn_localhost), E_USER_ERROR);

// Definimos el cotejamiento de la conexion (igual al cotejamiento de la BD)
mysqli_query($conn_localhost, "SET NAMES 'utf8'");

// Seleccionamos la base de datos activa
mysqli_select_db($conn_localhost, $baseDatos);

?>