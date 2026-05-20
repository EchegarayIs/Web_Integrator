<?php
require_once "Conexion.php";

class MJustificantes{

    public function consultarJustificantes() {
        $cnx = new Conexion();

        try {
            $conexion = $cnx->conectar();
            $stmt = $conexion->prepare("
            
            SELECT j.*, a.nombre AS nombre_alumno, a.app AS apellido_paterno_alumno, a.apm AS apellido_materno_alumno
            FROM justificantes j
            INNER JOIN alumnos a ON j.id_alumno = a.id_alumno
            ORDER BY j.fecha_solicitud DESC
            
            ");
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
            
        } catch (PDOException $e) {
            throw new Exception('Error en el sistema: ' . $e->getMessage());

        } finally {
            $cnx->cerrarConexion();
        }   
    }

    public function aceptarJustificante($id, $fechaResolucion) {
        $cnx = new Conexion();

        try {
            $conexion = $cnx->conectar();
            $stmt = $conexion->prepare("
                UPDATE justificantes SET estado = 1, fecha_resolucion = :fechaResolucion
                WHERE id_justificante = :id
                ");
            $stmt->bindParam(':id', $id);
            $stmt->bindParam(':fechaResolucion', $fechaResolucion);
            return $stmt->execute();
            
        } catch (PDOException $e) {
            throw new Exception('Error en el sistema: ' . $e->getMessage());

        } finally {
            $cnx->cerrarConexion();
        }   
    }

    public function rechazarJustificante($id, $fechaResolucion) {
        $cnx = new Conexion();

        try {
            $conexion = $cnx->conectar();
            $stmt = $conexion->prepare("
                UPDATE justificantes SET estado = 0, fecha_resolucion = :fechaResolucion
                WHERE id_justificante = :id
                ");
            $stmt->bindParam(':id', $id);
            $stmt->bindParam(':fechaResolucion', $fechaResolucion);
            return $stmt->execute();
            
        } catch (PDOException $e) {
            throw new Exception('Error en el sistema: ' . $e->getMessage());

        } finally {
            $cnx->cerrarConexion();
        }   
    }

    public function mantenerPendienteJustificante($id) {
        $cnx = new Conexion();

        try {
            $conexion = $cnx->conectar();
            $stmt = $conexion->prepare("
                UPDATE justificantes SET estado = 2, fecha_resolucion = NULL
                WHERE id_justificante = :id
                ");
            $stmt->bindParam(':id', $id);
            return $stmt->execute();
            
        } catch (PDOException $e) {
            throw new Exception('Error en el sistema: ' . $e->getMessage());

        } finally {
            $cnx->cerrarConexion();
        }   
    }

}
