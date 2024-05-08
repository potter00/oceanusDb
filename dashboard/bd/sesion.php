<?php
session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Obtener el valor del checkbox de la solicitud POST
    $estadoCheckbox = $_POST['estado'];

    // Guardar el estado del checkbox en la variable de sesión
    $_SESSION['checkBoxContrato'] = $estadoCheckbox;
    error_log("El estado del checkbox es: " . $estadoCheckbox);
    error_log("El estado del checkbox en la variable de sesión es: " . $_SESSION['checkBoxContrato']);
    
}


