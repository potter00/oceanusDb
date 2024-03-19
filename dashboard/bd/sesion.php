<?php
session_start();



// Crear un array con los datos de sesión
$datosSesion = array(
    'username' => $_SESSION['s_usuario'],
    'rol' => $_SESSION['s_rol'],
    'nombre' => $_SESSION['s_nombre']
);

// Convertir el array a JSON
$jsonDatosSesion = json_encode($datosSesion);

// Devolver los datos de sesión como parte de la respuesta
echo $jsonDatosSesion;
?>
