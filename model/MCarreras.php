<?php
require_once "Conexion.php";

class MCarreras{

    public function buscar($carrera) {
        $cnx = new Conexion();
        try {
            $conexion = $cnx->conectar();
            $stmt = $conexion->prepare("SELECT * FROM carreras WHERE nombre LIKE :carrera");
            $searchTerm = '%' . $carrera . '%';
            $stmt->bindParam(':carrera', $searchTerm);
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            throw new Exception('Error en el sistema: ' . $e->getMessage());
        } finally {
            $cnx->cerrarConexion();
        }
    }

    public function registrar($clave, $nombre, $fecha_registro) {
        $cnx = new Conexion();

        try {
            $conexion = $cnx->conectar();
            $stmt = $conexion->prepare("INSERT INTO carreras (clave, nombre, fecha_registro) 
            VALUES (:clave, :nombre, :fecha_registro)");
            $stmt->bindParam(':clave', $clave);
            $stmt->bindParam(':nombre', $nombre);
            $stmt->bindParam(':fecha_registro', $fecha_registro);
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
            $stmt = $conexion->prepare("SELECT * FROM carreras ORDER BY id_carrera ASC");
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
            
        } catch (PDOException $e) {
            throw new Exception('Error en el sistema: ' . $e->getMessage());

        } finally {
            $cnx->cerrarConexion();
        }
    }

    public function obtenerPorId($id_carrera) {
        $cnx = new Conexion();
        try {
            $conexion = $cnx->conectar();
            $stmt = $conexion->prepare("SELECT * FROM carreras WHERE id_carrera = :id");
            $stmt->bindParam(':id', $id_carrera);
            $stmt->execute();
            return $stmt->fetch(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            throw new Exception('Error en el sistema: ' . $e->getMessage());
        } finally {
            $cnx->cerrarConexion();
        }
    }

    public function editar($id_carrera, $clave, $nombre, $fecha_registro) {
        $cnx = new Conexion();

        try {
            $conexion = $cnx->conectar();
            $stmt = $conexion->prepare("UPDATE carreras SET clave = :clave, nombre = :nombre, fecha_registro = :fecha_registro WHERE id_carrera = :id");
            $stmt->bindParam(':id', $id_carrera);
            $stmt->bindParam(':clave', $clave);
            $stmt->bindParam(':nombre', $nombre);
            $stmt->bindParam(':fecha_registro', $fecha_registro);
            return $stmt->execute();
            
        } catch (PDOException $e) {
            throw new Exception('Error en el sistema: ' . $e->getMessage());

        } finally {
            $cnx->cerrarConexion();
        }
    }

    public function eliminar($id_carrera) {
        $cnx = new Conexion();
 
        try {
            $conexion = $cnx->conectar();
            $stmt = $conexion->prepare("DELETE FROM carreras WHERE id_carrera = :id");
            $stmt->bindParam(':id', $id_carrera);
            return $stmt->execute();
            
        } catch (PDOException $e) {
            throw new Exception('Error en el sistema: ' . $e->getMessage());

        } finally {
            $cnx->cerrarConexion();
        }
    }
}
?>