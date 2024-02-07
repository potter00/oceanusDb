<?php
function verificarFormatoFecha($fecha, $formato) {
    $dateTime = DateTime::createFromFormat($formato, $fecha);
    return $dateTime && $dateTime->format($formato) === $fecha;
}
function verificarLongitudString($cadena, $longitud) {
    return strlen($cadena) === $longitud;
}
function verificarTipoSangre($tipoSangre) {
    $tiposValidos = array("A+", "A-", "B+", "B-", "AB+", "AB-", "O+", "O-","a+", "a-", "b+", "b-", "ab+", "ab-", "o+", "o-");
    return in_array($tipoSangre, $tiposValidos);
}


