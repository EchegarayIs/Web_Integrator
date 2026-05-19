<?php
require_once "Conexion.php";

class MGrupos{
    public function buscar($grupo) {
        $cnx = new Conexion();
        try {
            $conexion = $cnx->conectar();
            $stmt = $conexion->prepare("SELECT * FROM grupos WHERE nombre_grupo LIKE :grupo OR semestre LIKE :grupo OR capacidad LIKE :grupo OR turno LIKE :grupo");
            $searchTerm = '%' . $grupo . '%';
            $stmt->bindParam(':grupo', $searchTerm);
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            throw new Exception('Error en el sistema: ' . $e->getMessage());
        } finally {
            $cnx->cerrarConexion();
        }
    }

     public function registrar($nombre_grupo, $semestre, $capacidad, $turno, $id_ciclo, $id_materia) {
        $cnx = new Conexion();

        try {
            $conexion = $cnx->conectar();
            $stmt = $conexion->prepare("INSERT INTO grupos (nombre_grupo, semestre, capacidad, turno, id_ciclo, id_materia) 
            VALUES (:nombre_grupo, :semestre, :capacidad, :turno, :id_ciclo, :id_materia)");
            $stmt->bindParam(':nombre_grupo', $nombre_grupo);
            $stmt->bindParam(':semestre', $semestre);
            $stmt->bindParam(':capacidad', $capacidad);
            $stmt->bindParam(':turno', $turno);
            $stmt->bindParam(':id_ciclo', $id_ciclo);
            $stmt->bindParam(':id_materia', $id_materia);
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
            $stmt = $conexion->prepare("SELECT g.*, m.nombre_materia, c.nombre 
                                        FROM grupos g JOIN materias m ON g.id_materia = m.id_materia 
                                                    JOIN ciclos_escolares c ON g.id_ciclo = c.id_ciclo 
                                                    ORDER BY g.id_grupo ASC");
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
            
        } catch (PDOException $e) {
            throw new Exception('Error en el sistema: ' . $e->getMessage());

        } finally {
            $cnx->cerrarConexion();
        }
    }

    public function obtenerCiclos() {
        $cnx = new Conexion();
        try {
            $conexion = $cnx->conectar();
            $stmt = $conexion->prepare("SELECT id_ciclo, nombre FROM ciclos_escolares ORDER BY nombre ASC");
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            throw new Exception('Error en el sistema: ' . $e->getMessage());
        } finally {
            $cnx->cerrarConexion();
        }
    }

    public function obtenerMaterias() {
        $cnx = new Conexion();
        try {
            $conexion = $cnx->conectar();
            $stmt = $conexion->prepare("SELECT id_materia, nombre_materia FROM materias ORDER BY nombre_materia ASC");
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            throw new Exception('Error en el sistema: ' . $e->getMessage());
        } finally {
            $cnx->cerrarConexion();
        }
    }

    public function obtenerPorId($id_grupo) {
        $cnx = new Conexion();
        try {
            $conexion = $cnx->conectar();
            $stmt = $conexion->prepare("SELECT * FROM grupos WHERE id_grupo = :id");
            $stmt->bindParam(':id', $id_grupo);
            $stmt->execute();
            return $stmt->fetch(PDO::FETCH_ASSOC);
            
        } catch (PDOException $e) {
            throw new Exception('Error en el sistema: ' . $e->getMessage());
        } finally {
            $cnx->cerrarConexion();
        }
    }

    public function editar($id_grupo, $nombre_grupo, $semestre, $capacidad, $turno, $id_ciclo, $id_materia) {
        $cnx = new Conexion();
        try {
            $conexion = $cnx->conectar();
            $stmt = $conexion->prepare("UPDATE grupos SET nombre_grupo = :nombre_grupo, semestre = :semestre, capacidad = :capacidad, turno = :turno, id_ciclo = :id_ciclo, id_materia = :id_materia WHERE id_grupo = :id");
            $stmt->bindParam(':nombre_grupo', $nombre_grupo);
            $stmt->bindParam(':semestre', $semestre);
            $stmt->bindParam(':capacidad', $capacidad);
            $stmt->bindParam(':turno', $turno);
            $stmt->bindParam(':id_ciclo', $id_ciclo);
            $stmt->bindParam(':id_materia', $id_materia);
            $stmt->bindParam(':id', $id_grupo);
            return $stmt->execute();
            
        } catch (PDOException $e) {
            throw new Exception('Error en el sistema: ' . $e->getMessage());
        } finally {
            $cnx->cerrarConexion();
        }
    }

    public function eliminar($id_grupo) {
        $cnx = new Conexion();
        try {
            $conexion = $cnx->conectar();
            $stmt = $conexion->prepare("DELETE FROM grupos WHERE id_grupo = :id");
            $stmt->bindParam(':id', $id_grupo);
            return $stmt->execute();
            
        } catch (PDOException $e) {
            throw new Exception('Error en el sistema: ' . $e->getMessage());
        } finally {
            $cnx->cerrarConexion();
        }
    }
}
<<<<<<< HEAD
?>
=======
?>
>>>>>>> 2168162cbb749a51f62ca038dcc58b76f650e736
