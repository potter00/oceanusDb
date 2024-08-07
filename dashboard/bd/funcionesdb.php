<?php
function obtenerNombreEmpresa($id, $conn)
{

    try {


        $stmt = $conn->prepare('SELECT razonSocial FROM empresa WHERE idEmpresa = :id');
        $stmt->bindParam(':id', $id);
        $stmt->execute();

        $result = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($result) {
            return $result['razonSocial'];
        } else {
            return 'Empresa no encontrada';
        }
    } catch (PDOException $e) {
        return 'Error al conectar con la base de datos: ' . $e->getMessage();
    }
}

function obtenerFianzaContrato($idContrato, $conn)
{
    //optenemos el id de la finaza conforme al id del contrato 
    $datos = array();
    try {
        $stmt = $conn->prepare('SELECT idFianza FROM contrato_fianza WHERE idContrato = :id');
        $stmt->bindParam(':id', $idContrato);
        $stmt->execute();

        $result = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($result) {
            $idFianza = $result['idFianza'];
        } else {
            return 'Fianza no encontrada';
        }
    } catch (\Throwable $th) {
        //throw $th;
        return 'Error al conectar con la base de datos: ' . $th->getMessage();
    }





    try {


        $stmt = $conn->prepare('SELECT * FROM fianzas WHERE idFianzas = :id');
        $stmt->bindParam(':id', $idFianza);
        $stmt->execute();

        $result = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($result) {
            $idFianzaCumplimiento = $result['fianzaCumplimiento'];
            $idFianzaAnticipo = $result['fianzaAnticipo'];
            $idFianzaVicios = $result['fianzaViciosOcultos'];

        } else {
            return 'Fianzas no encontrada';
        }
    } catch (PDOException $e) {
        return 'Error al conectar con la base de datos: ' . $e->getMessage();
    }

    try {


        $stmt = $conn->prepare('SELECT * FROM fianza_cumplimiento WHERE idFianzaCumplimiento = :id');
        $stmt->bindParam(':id', $idFianzaCumplimiento);
        $stmt->execute();

        $result = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($result) {
            $datos['fianzaCumplimiento'] = $result;
        } else {
            return 'Fianza de cumplimiento no encontrada';
        }
    } catch (PDOException $e) {
        return 'Error al conectar con la base de datos: ' . $e->getMessage();

    }

    try {

        $stmt = $conn->prepare('SELECT * FROM fianza_anticipo WHERE idFianzaAnticipo = :id');
        $stmt->bindParam(':id', $idFianzaAnticipo);
        $stmt->execute();

        $result = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($result) {
            $datos['fianzaAnticipo'] = $result;
        } else {
            return 'Fianza de anticipo no encontrada';
        }


    } catch (PDOException $e) {
        return 'Error al conectar con la base de datos: ' . $e->getMessage();
    }

    try {

        $stmt = $conn->prepare('SELECT * FROM fianza_vicios_ocultos WHERE idFianzaViciosOcultos = :id');
        $stmt->bindParam(':id', $idFianzaVicios);
        $stmt->execute();

        $result = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($result) {
            $datos['fianzaViciosOcultos'] = $result;
        } else {
            return 'Fianza de vicios ocultos no encontrada';
        }
    } catch (PDOException $e) {
        return 'Error al conectar con la base de datos: ' . $e->getMessage();
    }

    return $datos;

}

function ObtenerDatosColumna($tabla, $columna, $id, $nombreIdentificador, $conn)
{
    try {
        $stmt = $conn->prepare('SELECT ' . $columna . ' FROM ' . $tabla . ' WHERE ' . $nombreIdentificador . ' = :id');
        $stmt->bindParam(':id', $id);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        if ($result) {
            return $result;
        } else {
            return 'Empresa no encontrada';
        }

    } catch (PDOException $e) {
        return 'Error al conectar con la base de datos: ' . $e->getMessage();
    }



}

function ObtenerTiempoRestante($fecha)
{
    $fechaActual = date('Y-m-d');
    $fechaVencimiento = $fecha;
    $fechaActual = strtotime($fechaActual);
    $fechaVencimiento = strtotime($fechaVencimiento);
    $diferencia = $fechaVencimiento - $fechaActual;
    $dias = floor($diferencia / (60 * 60 * 24));
    return $dias;
}

function ObtenerContrato($idContrato, $conn)
{
    try {
        $stmt = $conn->prepare('SELECT * FROM contrato WHERE idContrato = :id');
        $stmt->bindParam(':id', $idContrato);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        if ($result) {
            return $result;
        } else {
            return 'Contrato no encontrado';
        }
    } catch (PDOException $e) {
        return 'Error al conectar con la base de datos: ' . $e->getMessage();
    }
}
function ObtenerFactura($idFactura, $conn)
{
    try {
        $stmt = $conn->prepare('SELECT * FROM factura WHERE idFactura = :id');
        $stmt->bindParam(':id', $idFactura);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        if ($result) {
            return $result;
        } else {
            return 'Factura no encontrada';
        }
    } catch (PDOException $e) {
        return 'Error al conectar con la base de datos: ' . $e->getMessage();
    }
}

function ObtenerEmpresa($idEmpresa, $conn)
{
    try {
        $stmt = $conn->prepare('SELECT * FROM empresa WHERE idEmpresa = :id');
        $stmt->bindParam(':id', $idEmpresa);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        if ($result) {
            return $result;
        } else {
            return 'Empresa no encontrada';
        }
    } catch (PDOException $e) {
        return 'Error al conectar con la base de datos: ' . $e->getMessage();
    }
}

function ObtenerTabla($tabla, $conn)
{
    try {
        $stmt = $conn->prepare('SELECT * FROM ' . $tabla);
        $stmt->execute();
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        if ($result) {
            return $result;
        } else {
            return 'Tabla no encontrada';
        }
    } catch (PDOException $e) {
        return 'Error al conectar con la base de datos: ' . $e->getMessage();
    }
}

//funcion guardar un dato en una tabla
function GuardarDato($tabla, $datos, $columna, $conn)
{


    try {
        $stmt = $conn->prepare('INSERT INTO ' . $tabla . ' (' . $columna . ') VALUES (' . $datos . ')');
        $stmt->execute();
        return 'Dato guardado correctamente';
    } catch (PDOException $e) {
        return 'Error al conectar con la base de datos: ' . $e->getMessage();
    }

}

//funcion actualizar un dato en una tabla
function ActualizarDato($tabla, $datos, $columna, $id, $conn, $nombreIdentificador)
{
    try {
        $stmt = $conn->prepare('UPDATE ' . $tabla . ' SET ' . $columna . ' = :datos WHERE ' . $nombreIdentificador . ' = :id');
        $stmt->bindParam(':id', $id);
        $stmt->bindParam(':datos', $datos);
        error_log($stmt->queryString);
        $stmt->execute();
        $message = 'Se actualizo la tabla ' . $tabla . ' con los datos ' . $datos . ' en la columna ' . $columna . ' con el id ' . $id;
        return $message;
    } catch (PDOException $e) {
        return 'Error al conectar con la base de datos: ' . $e->getMessage();
    }
}

//funcion para actializar un dato de una tabla de fianza conforme el id de un contrato
function ActualizarFianzaContrato($idContrato, $datos, $conn, $tipoFianza, $columnaFianza)
{

    try {
        $stmt = $conn->prepare('SELECT idFianza FROM contrato_fianza WHERE idContrato = :id');
        $stmt->bindParam(':id', $idContrato);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        if ($result) {
            $idFianza = $result['idFianza'];
        } else {
            error_log('Fianza no encontrada');
            return 'Fianza no encontrada';
        }
    } catch (PDOException $e) {
        error_log('Error al conectar con la base de datos par aobtener la relacion de fianza contrato: ' . $e->getMessage());
        return 'Error al conectar con la base de datos: ' . $e->getMessage();
    }

    //obtenemos la fianza correspondiente
    try {
        error_log('SELECT * FROM fianzas WHERE ' . $tipoFianza . ' = :id');
        $stmt = $conn->prepare('SELECT * FROM fianzas WHERE idFianzas = :id');
        $stmt->bindParam(':id', $idFianza);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        if ($result) {
            $datosFianza = $result;
        } else {
            return 'Fianza no encontrada';
        }
    } catch (PDOException $e) {
        error_log('Error al conectar con la base de datos para obtener la fianza: ' . $e->getMessage());
        return 'Error al conectar con la base de datos: ' . $e->getMessage();

    }

    //obtenemos el id de cada fianza 
    $idFianzaCumplimiento = $datosFianza['fianzaCumplimiento'];
    $idFianzaAnticipo = $datosFianza['fianzaAnticipo'];
    $idFianzaVicios = $datosFianza['fianzaViciosOcultos'];
    error_log('antes de entrar a fianza cumplimiento');
    error_log($tipoFianza);
    //actualizamos la fianza correspondiente
    if ($tipoFianza == 'fianza_cumplimiento') {
        error_log('entro a fianza cumplimiento');
        try {
            error_log('UPDATE ' . $tipoFianza . ' SET ' . $columnaFianza . ' = :datos WHERE idFianzaCumplimiento = :id');
            $stmt = $conn->prepare('UPDATE ' . $tipoFianza . ' SET ' . $columnaFianza . ' = :datos WHERE idFianzaCumplimiento = :id');

            $stmt->bindParam(':datos', $datos);
            $stmt->bindParam(':id', $idFianzaCumplimiento);
            $stmt->execute();
            $message = 'Se actualizo la tabla ' . $tipoFianza . ' con los datos ' . $datos . ' en la columna ' . $columnaFianza . ' con el id ' . $idFianzaCumplimiento;
            return $message;
        } catch (PDOException $e) {
            error_log('Error al conectar con la base de datos: ' . $e->getMessage());
            return 'Error al conectar con la base de datos: ' . $e->getMessage();
        }
    } elseif ($tipoFianza == 'fianza_anticipo') {
        try {
            $stmt = $conn->prepare('UPDATE ' . $tipoFianza . ' SET ' . $columnaFianza . ' = :datos WHERE idFianzaAnticipo = :id');
            $stmt->bindParam(':datos', $datos);
            $stmt->bindParam(':id', $idFianzaAnticipo);
            $stmt->execute();
            $message = 'Se actualizo la tabla ' . $tipoFianza . ' con los datos ' . $datos . ' en la columna ' . $columnaFianza . ' con el id ' . $idFianzaAnticipo;
            return $message;
        } catch (PDOException $e) {
            error_log('Error al conectar con la base de datos: ' . $e->getMessage());
            return 'Error al conectar con la base de datos: ' . $e->getMessage();
        }
    } elseif ($tipoFianza == 'fianza_vicios_ocultos') {
        try {
            $stmt = $conn->prepare('UPDATE ' . $tipoFianza . ' SET ' . $columnaFianza . ' = :datos WHERE idFianzaViciosOcultos = :id');
            $stmt->bindParam(':datos', $datos);
            $stmt->bindParam(':id', $idFianzaVicios);
            $stmt->execute();
            $message = 'Se actualizo la tabla ' . $tipoFianza . ' con los datos ' . $datos . ' en la columna ' . $columnaFianza . ' con el id ' . $idFianzaVicios;
            return $message;
        } catch (PDOException $e) {
            error_log('Error al conectar con la base de datos: ' . $e->getMessage());
            return 'Error al conectar con la base de datos: ' . $e->getMessage();
        }
    }



}

//funcion para actualizar un dato de la tabla factura conforme al id de un contrato asociado
function ActualizarFacturaContrato($idContrato, $datos, $conn, $columnaFactura, $idFactura)
{

    //actualizamos el dato de la factura gracias a su identificador idFactura
    try {
        $stmt = $conn->prepare('UPDATE factura SET ' . $columnaFactura . ' = :datos WHERE idFactura = :id');
        $stmt->bindParam(':datos', $datos);
        $stmt->bindParam(':id', $idFactura);

        $stmt->execute();
        $message = 'Se actualizo la tabla factura con los datos ' . $datos . ' en la columna ' . $columnaFactura . ' con el id ' . $idFactura;
        return $message;
    } catch (PDOException $e) {
        return 'Error al conectar con la base de datos: ' . $e->getMessage();
    }

}

//funcion para la creacion de una empresa solamente con su razon social y devolvemos el id de esta y si la razon social ya existe devolvemos el id de la empresa
function CrearEmpresa($razonSocial, $conn)
{
    try {
        $stmt = $conn->prepare('SELECT idEmpresa FROM empresa WHERE razonSocial = :razonSocial');
        $stmt->bindParam(':razonSocial', $razonSocial);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        if ($result) {
            return $result['idEmpresa'];
        } else {
            $stmt = $conn->prepare('INSERT INTO empresa (razonSocial) VALUES (:razonSocial)');
            $stmt->bindParam(':razonSocial', $razonSocial);
            $stmt->execute();
            $stmt = $conn->prepare('SELECT idEmpresa FROM empresa WHERE razonSocial = :razonSocial');
            $stmt->bindParam(':razonSocial', $razonSocial);
            $stmt->execute();
            $result = $stmt->fetch(PDO::FETCH_ASSOC);
            return $result['idEmpresa'];
        }
    } catch (PDOException $e) {
        return 'Error al conectar con la base de datos: ' . $e->getMessage();
    }

}

//funcion para comprobar si un contrato ya existe en la base de datos por su nombre retorna true si existe y false si no existe
function ComprobarContrato($nombreContrato, $conn, $numeroControl)
{
    try {
        $stmt = $conn->prepare('SELECT idContrato FROM contrato WHERE nombreContrato = :nombreContrato');
        $stmt->bindParam(':nombreContrato', $nombreContrato);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        /*if ($result) {
            return true;
        } else {
            return false;
        }*/
    } catch (PDOException $e) {
        return 'Error al conectar con la base de datos: ' . $e->getMessage();
    }

    //si el numero de control es igual a 0 se asigna el nuevo numero de control
    try {
        $stmt = $conn->prepare('SELECT numeroControl FROM contrato WHERE nombreContrato = :nombreContrato');
        $stmt->bindParam(':nombreContrato', $nombreContrato);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        if ($result) {
            if ($result['numeroControl'] == 0) {
                $stmt = $conn->prepare('UPDATE contrato SET numeroControl = :numeroControl WHERE nombreContrato = :nombreContrato');
                $stmt->bindParam(':nombreContrato', $nombreContrato);
                $stmt->bindParam(':numeroControl', $numeroControl);
                $stmt->execute();
            }
        }
        if ($result) {
            return true;
        } else {
            return false;
        }

    } catch (PDOException $e) {
        return 'Error al conectar con la base de datos: ' . $e->getMessage();
    }
}

//funcion para la creacion de un contrato
function CrearContrato($tituloContrato, $nombreContrato, $numeroContrato, $idContratante, $direccion, $monto, $fechaInicio, $fechaFin, $conexion, $numeroControl)
{
    //insertamos los datos de la tabla contrato y obtenemos el id del contrato
    try {
        //code...
        $query = "INSERT INTO contrato (nombreContrato, numeroContrato, idContratante, direccion, montoContrato, inicioContrato, finContrato, titulo, numeroControl) VALUES (:nombreContrato, :numeroContrato, :idContratante, :direccion, :monto, :fechaInicio, :fechaFin, :tituloContrato, :numeroControl)";
        $resultado = $conexion->prepare($query);
        $resultado->bindParam(':nombreContrato', $nombreContrato, PDO::PARAM_STR);
        $resultado->bindParam(':numeroContrato', $numeroContrato, PDO::PARAM_STR);
        $resultado->bindParam(':idContratante', $idContratante, PDO::PARAM_INT);
        $resultado->bindParam(':direccion', $direccion, PDO::PARAM_STR);
        $resultado->bindParam(':monto', $monto, PDO::PARAM_STR);
        $resultado->bindParam(':fechaInicio', $fechaInicio, PDO::PARAM_STR);
        $resultado->bindParam(':fechaFin', $fechaFin, PDO::PARAM_STR);
        $resultado->bindParam(':tituloContrato', $tituloContrato, PDO::PARAM_STR);
        $resultado->bindParam(':numeroControl', $numeroControl, PDO::PARAM_INT);
        $resultado->execute();
        $idContrato = $conexion->lastInsertId();

        //insertamos los datos de la tabla fianza_cumplimiento y obtenemos el id de la fianza
        $query = "INSERT INTO fianza_cumplimiento (fianzaCumplimientoMonto) VALUES (000)";
        $resultado = $conexion->prepare($query);
        $resultado->execute();
        $idFianzaCumplimiento = $conexion->lastInsertId();

        //insertamos los datos de la tabla fianza_anticipo y obtenemos el id de la fianza
        $query = "INSERT INTO fianza_anticipo (fianzaAnticipoMonto) VALUES (000)";
        $resultado = $conexion->prepare($query);
        $resultado->execute();
        $idFianzaAnticipo = $conexion->lastInsertId();

        //insertamos los datos de la tabla fianza_vicios_ocultos y obtenemos el id de la fianza
        $query = "INSERT INTO fianza_vicios_ocultos (fianzaViciosOcultosMonto) VALUES (000)";
        $resultado = $conexion->prepare($query);
        $resultado->execute();
        $idFianzaViciosOcultos = $conexion->lastInsertId();

        //insertamos los datos en la table fianzas y obtenemos el id de la fianza
        $query = "INSERT INTO fianzas (fianzaCumplimiento, fianzaAnticipo, fianzaViciosOcultos) VALUES (:idFianzaCumplimiento, :idFianzaAnticipo, :idFianzaViciosOcultos)";
        $resultado = $conexion->prepare($query);
        $resultado->bindParam(':idFianzaCumplimiento', $idFianzaCumplimiento, PDO::PARAM_INT);
        $resultado->bindParam(':idFianzaAnticipo', $idFianzaAnticipo, PDO::PARAM_INT);
        $resultado->bindParam(':idFianzaViciosOcultos', $idFianzaViciosOcultos, PDO::PARAM_INT);
        $resultado->execute();
        $idFianza = $conexion->lastInsertId();

        //insertamos los datos en la table contrato_fianza y obtenemos el id de la fianza
        $query = "INSERT INTO contrato_fianza (idContrato, idFianza) VALUES (:idContrato, :idFianza)";
        $resultado = $conexion->prepare($query);
        $resultado->bindParam(':idContrato', $idContrato, PDO::PARAM_INT);
        $resultado->bindParam(':idFianza', $idFianza, PDO::PARAM_INT);
        $resultado->execute();




    } catch (\Throwable $th) {
        error_log('Error al conectar con la base de datos: ' . $th->getMessage());
    }
}

//funcion para pedir convenios relacionados a un contrato
function ObtenerConvenios($idContrato, $conn)
{
    try {
        $stmt = $conn->prepare('SELECT idConvenio FROM contrato_convenio WHERE idContrato = :id');
        $stmt->bindParam(':id', $idContrato);
        $stmt->execute();
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        if ($result) {
            return $result;
        } else {
            return 'Convenios no encontrados';
        }
    } catch (PDOException $e) {
        return 'Error al conectar con la base de datos: ' . $e->getMessage();
    }
}

//funcion para optener un fila de una tabla mediante su id
function ObtenerFila($tabla, $id, $conn)
{
    try {
        $stmt = $conn->prepare('SELECT * FROM ' . $tabla . ' WHERE id' . $tabla . ' = :id');
        $stmt->bindParam(':id', $id);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        if ($result) {
            return $result;
        } else {
            return 'Fila no encontrada';
        }
    } catch (PDOException $e) {
        return 'Error al conectar con la base de datos: ' . $e->getMessage();
    }
}

//funcion para ver si una fecha  apasado o no
function VerificarFecha($fecha)
{

    $fechaActual = date('Y-m-d');
    $fechaVencimiento = $fecha;
    $fechaActual = strtotime($fechaActual, 0);
    $fechaVencimiento = strtotime($fechaVencimiento, 0);


    if ($fechaActual > $fechaVencimiento) {
        return true;
    } else {
        return false;
    }
}

//funcion para crear una card con los datos de un contrato
function CrearCardContrato($idContrato, $conn)
{

    $contrato = ObtenerContrato($idContrato, $conn);
    $empresa = ObtenerEmpresa($contrato['idContratante'], $conn);

    error_log('contrato: ' . print_r($contrato, true));
    error_log('empresa: ' . print_r($empresa, true));

    $html = '
    <div class="col-md-4 mb-4">
    <div class="card">
    <div class="card-header">
        <div>
            <h5 class="card-title
            ">' . $contrato['titulo'] . '</h5>
            <h6 class="card-subtitle">' . $empresa['razonSocial'] . '</h6>
        </div>
       
    </div>
    <div class="card-body" style="line-height: 1.2;">
        <p><strong>Numero de contrato: </strong>' . $contrato['numeroContrato'] . '</p>
        <p><strong>Fecha de inicio: </strong>' . $contrato['inicioContrato'] . '</p>
        <p><strong>Fecha de fin: </strong>' . $contrato['finContrato'] . '</p>
    </div>
</div>
</div>';
    return $html;
}

//funcion para dividir un string a un array con un delimitador
function DividirString($string, $delimitador)
{
    $array = explode($delimitador, $string);
    return $array;
}

//funcion para verificar si un estring es igual a cualquier elemento de un array
function VerificarString($string, $array)
{
    for ($i = 0; $i < count($array); $i++) {
        error_log('string: ' . $string);
        error_log('array: ' . print_r($array, true));
        if ($string == $array[$i]) {
            return true;
        }
    }
    return false;
}


