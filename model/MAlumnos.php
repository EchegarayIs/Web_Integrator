<?php
require_once "Conexion.php";

class MAlumnos{

    public function verificar($matricula, $contrasenia) {
        $cnx = new Conexion();

        try {
            $conexion = $cnx->conectar();
            $stmt = $conexion->prepare("SELECT * FROM alumnos WHERE matricula = :matricula AND contrasenia = :contrasenia");
            $stmt->bindParam(':matricula', $matricula);
            $stmt->bindParam(':contrasenia', $contrasenia);
            $stmt->execute();
            return $stmt->fetch(PDO::FETCH_ASSOC);
            
        } catch (PDOException $e) {
            throw new Exception('Error en el sistema: ' . $e->getMessage());

        } finally {
            $cnx->cerrarConexion();
        }
    }

    public function registrar($nombre, $app, $apm, $contrasenia, $estado, $matricula, $fechaNac, $semestre, $idCarrera) {
        $cnx = new Conexion();

        try {
            $conexion = $cnx->conectar();
            $stmt = $conexion->prepare("INSERT INTO alumnos (nombre, app, apm, contrasenia, activo, fecha_nac, matricula, semestre, id_carrera) 
            VALUES (:nombre, :app, :apm, :contrasenia, :estado, :fechaNac, :matricula, :semestre, :idCarrera)");

            $stmt->bindParam(':nombre', $nombre);
            $stmt->bindParam(':app', $app);
            $stmt->bindParam(':apm', $apm);
            $stmt->bindParam(':contrasenia', $contrasenia);
            $stmt->bindParam(':estado', $estado);
            $stmt->bindParam(':matricula', $matricula);
            $stmt->bindParam(':fechaNac', $fechaNac);
            $stmt->bindParam(':semestre', $semestre);
            $stmt->bindParam(':idCarrera', $idCarrera);
            return $stmt->execute();
            
        } catch (PDOException $e) {
            throw new Exception('Error en el sistema: ' . $e->getMessage());

        } finally {
            $cnx->cerrarConexion();
        }
    }

}
?>