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


