<?php
require_once "Conexion.php";

class MCiclosEscolares{

    public function buscar($ciclo) {
        $cnx = new Conexion();
        try {
            $conexion = $cnx->conectar();
            $stmt = $conexion->prepare("SELECT * FROM ciclos_escolares WHERE nombre LIKE :ciclo OR fecha_inicio LIKE :ciclo OR fecha_fin LIKE :ciclo OR estado LIKE :ciclo");
            $searchTerm = '%' . $ciclo . '%';
            $stmt->bindParam(':ciclo', $searchTerm);
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            throw new Exception('Error en el sistema: ' . $e->getMessage());
        } finally {
            $cnx->cerrarConexion();
        }
    }

     public function registrar($nombre, $fecha_inicio, $fecha_fin, $estado) {
        $cnx = new Conexion();

        try {
            $conexion = $cnx->conectar();
            $stmt = $conexion->prepare("INSERT INTO ciclos_escolares (nombre, fecha_inicio, fecha_fin, estado) 
            VALUES (:nombre, :fecha_inicio, :fecha_fin, :estado)");
            $stmt->bindParam(':nombre', $nombre);
            $stmt->bindParam(':fecha_inicio', $fecha_inicio);
            $stmt->bindParam(':fecha_fin', $fecha_fin);
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
            $stmt = $conexion->prepare("SELECT * FROM ciclos_escolares ORDER BY id_ciclo ASC");
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
            
        } catch (PDOException $e) {
            throw new Exception('Error en el sistema: ' . $e->getMessage());

        } finally {
            $cnx->cerrarConexion();
        }
    }

    public function obtenerPorId($id_ciclo) {
        $cnx = new Conexion();
        try {
            $conexion = $cnx->conectar();
            $stmt = $conexion->prepare("SELECT * FROM ciclos_escolares WHERE id_ciclo = :id_ciclo");
            $stmt->bindParam(':id_ciclo', $id_ciclo);
            $stmt->execute();
            return $stmt->fetch(PDO::FETCH_ASSOC);
            
        } catch (PDOException $e) {
            throw new Exception('Error en el sistema: ' . $e->getMessage());

        } finally {
            $cnx->cerrarConexion();
        }
    }

    public function editar($id_ciclo, $nombre, $fecha_inicio, $fecha_fin, $estado) {
        $cnx = new Conexion();
        try {
            $conexion = $cnx->conectar();
            $stmt = $conexion->prepare("UPDATE ciclos_escolares SET nombre = :nombre, fecha_inicio = :fecha_inicio, fecha_fin = :fecha_fin, estado = :estado WHERE id_ciclo = :id_ciclo");
            $stmt->bindParam(':id_ciclo', $id_ciclo);
            $stmt->bindParam(':nombre', $nombre);
            $stmt->bindParam(':fecha_inicio', $fecha_inicio);
            $stmt->bindParam(':fecha_fin', $fecha_fin);
            $stmt->bindParam(':estado', $estado);
            return $stmt->execute();
            
        } catch (PDOException $e) {
            throw new Exception('Error en el sistema: ' . $e->getMessage());
        } finally {
            $cnx->cerrarConexion();
        }
    }

    public function eliminar($id_ciclo) {
        $cnx = new Conexion();
        try {
            $conexion = $cnx->conectar();
            $stmt = $conexion->prepare("DELETE FROM ciclos_escolares WHERE id_ciclo = :id_ciclo");
            $stmt->bindParam(':id_ciclo', $id_ciclo);
            return $stmt->execute();
            
        } catch (PDOException $e) {
            throw new Exception('Error en el sistema: ' . $e->getMessage());
        } finally {
            $cnx->cerrarConexion();
        }
    }
}
?>