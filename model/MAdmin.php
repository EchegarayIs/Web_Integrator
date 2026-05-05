<?php
require_once "Conexion.php";

class MAdmin{

    public function verificar($noEmpleado, $contrasenia) {
        $cnx = new Conexion();

        try {
            $conexion = $cnx->conectar();
            $stmt = $conexion->prepare("SELECT * FROM administradores WHERE no_empleado = :noEmpleado AND contrasenia = :contrasenia");
            $stmt->bindParam(':noEmpleado', $noEmpleado);
            $stmt->bindParam(':contrasenia', $contrasenia);
            $stmt->execute();
            return $stmt->fetch(PDO::FETCH_ASSOC);
            
        } catch (PDOException $e) {
            throw new Exception('Error en el sistema: ' . $e->getMessage());

        } finally {
            $cnx->cerrarConexion();
        }
    }

    public function registrar($nombre, $app, $apm, $contrasenia, $estado, $noEmpleado, $puesto, $departamento) {
        $cnx = new Conexion();

        try {
            $conexion = $cnx->conectar();
            $stmt = $conexion->prepare("INSERT INTO administradores (nombre, app, apm, contrasenia, activo, no_empleado, puesto, departamento) 
            VALUES (:nombre, :app, :apm, :contrasenia, :estado, :noEmpleado, :puesto, :departamento)");

            $stmt->bindParam(':nombre', $nombre);
            $stmt->bindParam(':app', $app);
            $stmt->bindParam(':apm', $apm);
            $stmt->bindParam(':contrasenia', $contrasenia);
            $stmt->bindParam(':estado', $estado);
            $stmt->bindParam(':noEmpleado', $noEmpleado);
            $stmt->bindParam(':puesto', $puesto);
            $stmt->bindParam(':departamento', $departamento);
            return $stmt->execute();
            
        } catch (PDOException $e) {
            throw new Exception('Error en el sistema: ' . $e->getMessage());

        } finally {
            $cnx->cerrarConexion();
        }
    }

}
?>