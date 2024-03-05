<?php
class Conexion
{
    public static function Conectar()
    {


        $configuracion = json_decode(file_get_contents(__DIR__ . "\..\..\configuracion.json"), true);


        define('servidor', $configuracion['database']['host']);
        define('nombre_bd', $configuracion['database']['database_name']);
        define('usuario', $configuracion['database']['username']);
        define('password', $configuracion['database']['password']);
        $opciones = array(PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8');
        try {
            $conexion = new PDO("mysql:host=" . servidor . "; dbname=" . nombre_bd, usuario, password, $opciones);
            return $conexion;
        } catch (Exception $e) {
            echo "Configuracion: ".$configuracion;
            die("El error de Conexión es: " . $e->getMessage());
            
        }
    }

    // Ejemplo de uso


    // Realiza operaciones con la conexión, por ejemplo:
    // $result = $conexion->query('SELECT * FROM mi_tabla');
    // ...

    // Cierra la conexión cuando hayas terminado de usarla

}