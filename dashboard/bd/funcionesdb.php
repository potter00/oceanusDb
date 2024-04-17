<?php 
function obtenerNombreEmpresa($id,$conn) {
    
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

