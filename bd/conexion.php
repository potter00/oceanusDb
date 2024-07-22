<?php
class Conexion
{
    public static function Conectar()
    {
        
        //si los datos ya estan definidos omitir la definicion
        if (defined('servidor') && defined('nombre_bd') && defined('usuario') && defined('password')) {
            return new PDO("mysql:host=" . servidor . ";dbname=" . nombre_bd, usuario, password);
        }


        define('servidor', '127.0.0.1');
        define('nombre_bd', 'crud_2019');
        define('usuario', 'root');
        define('password', '');
        $opciones = array(PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8');
        try {
            $conexion = new PDO("mysql:host=" . servidor . ";dbname=" . nombre_bd, usuario, password, $opciones);
            return $conexion;
        } catch (Exception $e) {
            die("El error de Conexión es :" . $e->getMessage());
        }
    }
}
