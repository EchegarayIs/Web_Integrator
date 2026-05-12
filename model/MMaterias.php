<?php
require_once "Conexion.php";

class MMaterias{

    public function buscar($materia) {
        $cnx = new Conexion();
        try {
            $conexion = $cnx->conectar();
            $stmt = $conexion->prepare("SELECT * FROM materias WHERE nombre_materia LIKE :materia OR creditos LIKE :materia OR clave_materia LIKE :materia OR horas_semana LIKE :materia OR estado LIKE :materia");
            $searchTerm = '%' . $materia . '%';
            $stmt->bindParam(':materia', $searchTerm);
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            throw new Exception('Error en el sistema: ' . $e->getMessage());
        } finally {
            $cnx->cerrarConexion();
        }
    }

    public function registrar($clave_materia, $nombre_materia, $creditos, $horas_semana, $estado) {
        $cnx = new Conexion();

        try {
            $conexion = $cnx->conectar();
            $stmt = $conexion->prepare("INSERT INTO materias (clave_materia, nombre_materia, creditos, horas_semana, estado) 
            VALUES (:clave_materia, :nombre_materia, :creditos, :horas_semana, :estado)");
            $stmt->bindParam(':clave_materia', $clave_materia);
            $stmt->bindParam(':nombre_materia', $nombre_materia);
            $stmt->bindParam(':creditos', $creditos);
            $stmt->bindParam(':horas_semana', $horas_semana);
            $stmt->bindParam(':estado', $estado);
            return $stmt->execute();
            
        } catch (PDOException $e) {
            throw new Exception('Error en el sistema: ' . $e->getMessage());
        } finally {
            $cnx->cerrarConexion();
        }
    }

    public function consultar() {
        $cnx = new Conexion();
        try {
            $conexion = $cnx->conectar();
            $stmt = $conexion->prepare("SELECT * FROM materias ORDER BY id_materia ASC");
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
            
        } catch (PDOException $e) {
            throw new Exception('Error en el sistema: ' . $e->getMessage());

        } finally {
            $cnx->cerrarConexion();
        }
    }

    public function obtenerPorId($id_materia) {
        $cnx = new Conexion();
        try {
            $conexion = $cnx->conectar();
            $stmt = $conexion->prepare("SELECT * FROM materias WHERE id_materia = :id");
            $stmt->bindParam(':id', $id_materia);
            $stmt->execute();
            return $stmt->fetch(PDO::FETCH_ASSOC);
            
        } catch (PDOException $e) {
            throw new Exception('Error en el sistema: ' . $e->getMessage());
        } finally {
            $cnx->cerrarConexion();
        }
    }

    public function editar($id_materia, $clave_materia, $nombre_materia, $creditos, $horas_semana, $estado) {
        $cnx = new Conexion();
        try {
            $conexion = $cnx->conectar();
            $stmt = $conexion->prepare("UPDATE materias SET clave_materia = :clave_materia, nombre_materia = :nombre_materia, 
            creditos = :creditos, horas_semana = :horas_semana, estado = :estado WHERE id_materia = :id");
            $stmt->bindParam(':id', $id_materia);
            $stmt->bindParam(':clave_materia', $clave_materia);
            $stmt->bindParam(':nombre_materia', $nombre_materia);
            $stmt->bindParam(':creditos', $creditos);
            $stmt->bindParam(':horas_semana', $horas_semana);
            $stmt->bindParam(':estado', $estado);
            return $stmt->execute();
            
        } catch (PDOException $e) {
            throw new Exception('Error en el sistema: ' . $e->getMessage());
        } finally {
            $cnx->cerrarConexion();
        }
    }

    public function eliminar($id_materia) {
        $cnx = new Conexion();
        try {
            $conexion = $cnx->conectar();
            $stmt = $conexion->prepare("DELETE FROM materias WHERE id_materia = :id");
            $stmt->bindParam(':id', $id_materia);
            return $stmt->execute();
            
        } catch (PDOException $e) {
            throw new Exception('Error en el sistema: ' . $e->getMessage());
        } finally {
            $cnx->cerrarConexion();
        }
    }
}
?>