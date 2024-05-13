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
function GuardarDato($tabla, $datos, $columna ,  $conn)
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
function ActualizarDato($tabla, $datos, $columna, $id, $conn)
{
    try {
        $stmt = $conn->prepare('UPDATE ' . $tabla . ' SET ' . $datos . ' WHERE ' . $columna . ' = :id');
        $stmt->bindParam(':id', $id);
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
    }elseif ($tipoFianza == 'fianza_anticipo') {
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
    }elseif ($tipoFianza == 'fianza_vicios_ocultos') {
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



