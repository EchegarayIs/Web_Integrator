<?php
require_once "Conexion.php";

class MDocentes{

    public function verificar($noEmpleado, $contrasenia) {
        $cnx = new Conexion();

        try {
            $conexion = $cnx->conectar();
            $stmt = $conexion->prepare("SELECT * FROM docentes WHERE no_empleado = :noEmpleado AND contrasenia = :contrasenia");
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

    public function registrar($nombre, $app, $apm, $contrasenia, $estado, $noEmpleado, $fechaNac, $cedula, $especialidad, $gradoEstudio) {
        $cnx = new Conexion();

        try {
            $conexion = $cnx->conectar();
            $stmt = $conexion->prepare("INSERT INTO docentes (nombre, app, apm, contrasenia, activo, no_empleado, fecha_nac, cedula, especialidad, grado_estudio) 
            VALUES (:nombre, :app, :apm, :contrasenia, :estado, :noEmpleado, :fechaNac, :cedula, :especialidad, :gradoEstudio)");

            $stmt->bindParam(':nombre', $nombre);
            $stmt->bindParam(':app', $app);
            $stmt->bindParam(':apm', $apm);
            $stmt->bindParam(':contrasenia', $contrasenia);
            $stmt->bindParam(':estado', $estado);
            $stmt->bindParam(':noEmpleado', $noEmpleado);
            $stmt->bindParam(':fechaNac', $fechaNac);
            $stmt->bindParam(':cedula', $cedula);
            $stmt->bindParam(':especialidad', $especialidad);
            $stmt->bindParam(':gradoEstudio', $gradoEstudio);
            return $stmt->execute();
            
        } catch (PDOException $e) {
            throw new Exception('Error en el sistema: ' . $e->getMessage());

        } finally {
            $cnx->cerrarConexion();
        }
    }   
     // NUEVO MÉTODO
    public function obtenerDocentePorId($idDocente){

        $cnx = new Conexion();

        try {

            $conexion = $cnx->conectar();

            $stmt = $conexion->prepare("
                SELECT * 
                FROM docentes
                WHERE id_docente = :idDocente
            ");

            $stmt->bindParam(':idDocente', $idDocente);

            $stmt->execute();

            return $stmt->fetch(PDO::FETCH_ASSOC);

        } catch (PDOException $e) {

            throw new Exception('Error en el sistema: ' . $e->getMessage());

        } finally {

            $cnx->cerrarConexion();
        }
    }
    public function actualizarPassword($idDocente, $nuevaPassword){

    $cnx = new Conexion();

    try{

        $conexion = $cnx->conectar();

        $stmt = $conexion->prepare("
            UPDATE docentes
            SET contrasenia = :password
            WHERE id_docente = :idDocente
        ");

        $stmt->bindParam(':password', $nuevaPassword);
        $stmt->bindParam(':idDocente', $idDocente);

        return $stmt->execute();

    }catch(PDOException $e){

        throw new Exception('Error en el sistema: ' . $e->getMessage());

    }finally{

        $cnx->cerrarConexion();
    }
}
public function obtenerGruposDocente($idDocente){

    $cnx = new Conexion();

    try{

        $conexion = $cnx->conectar();

        $stmt = $conexion->prepare("
            SELECT 
                dg.id_docente_grupo,
                g.id_grupo,
                g.nombre_grupo,
                m.nombre_materia
            FROM docente_grupo dg
            INNER JOIN grupos g 
                ON dg.id_grupo = g.id_grupo
            INNER JOIN materias m
                ON g.id_materia = m.id_materia
            WHERE dg.id_docente = :idDocente
        ");

        $stmt->bindParam(':idDocente', $idDocente);

        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_ASSOC);

    }catch(PDOException $e){

        throw new Exception("Error en el sistema: " . $e->getMessage());

    }finally{

        $cnx->cerrarConexion();
    }
}


}
?>