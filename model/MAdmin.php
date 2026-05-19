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

    public function consultarDatos($id) {
        $cnx = new Conexion();

        try {
            $conexion = $cnx->conectar();
            $stmt = $conexion->prepare("SELECT * FROM administradores WHERE id_admin = :id");
            $stmt->bindParam(':id', $id);
            $stmt->execute();
            return $stmt->fetch(PDO::FETCH_ASSOC);
            
        } catch (PDOException $e) {
            throw new Exception('Error en el sistema: ' . $e->getMessage());

        } finally {
            $cnx->cerrarConexion();
        }
    }
    public function reporteGrupos() {
        $cnx = new Conexion();

        try {
            $conexion = $cnx->conectar();
            $stmt = $conexion->prepare("
             SELECT 
                d.id_docente,
                d.nombre AS nombre_docente,
                d.app AS apellido_paterno_docente,
                d.apm AS apellido_materno_docente,
                g.id_grupo,
                g.nombre_grupo,
                m.nombre_materia,
                ce.nombre AS nombre_ciclo
            FROM docentes d
            INNER JOIN docente_grupo dg 
                ON d.id_docente = dg.id_docente
            INNER JOIN grupos g 
                ON dg.id_grupo = g.id_grupo
            INNER JOIN materias m 
                ON g.id_materia = m.id_materia
            INNER JOIN ciclos_escolares ce 
                ON g.id_ciclo = ce.id_ciclo
            ORDER BY d.nombre, g.nombre_grupo;
            ");
            $stmt->execute();
            return $stmt->fetch(PDO::FETCH_ASSOC);
            
        } catch (PDOException $e) {
            throw new Exception('Error en el sistema: ' . $e->getMessage());

        } finally {
            $cnx->cerrarConexion();
        }
    }

}
?>