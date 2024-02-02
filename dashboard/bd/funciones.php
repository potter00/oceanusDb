<?php
function verificarFormatoFecha($fecha, $formato) {
    $dateTime = DateTime::createFromFormat($formato, $fecha);
    return $dateTime && $dateTime->format($formato) === $fecha;
}
function verificarLongitudString($cadena, $longitud) {
    return strlen($cadena) === $longitud;
}

